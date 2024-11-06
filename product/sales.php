<? //sales.php
    echo("
        <h1 style='text-align:center;'>매출관리</h1>
        <form align=center method=post action=process2.php>
        상품코드:<input name=ipcode type=text size=10>
        상품수량:<input name=ipunit type=text size=10>
        <input type=submit value=판매완료>
        </form>
    ");
    $con = mysqli_connect("localhost", "root", "0000", "class");
    // $product = "SELECT pname, pprice from product";
    // $sales = "SELECT * from sales";

    // $result = mysqli_query($con, $product);
    // $result2 = mysqli_query($con, $sales);
    // $total = mysqli_num_rows($result);
    $sql = " SELECT 
        s.wdate AS 판매날짜,
        p.pcode AS 상품코드,
        p.pname AS 상품이름,
        s.punit AS 판매수량,
        p.pprice AS 상품단가,
        (p.pprice * s.punit) AS 부분합계
    FROM 
        sales s
    JOIN 
        product p ON s.pcode = p.pcode";

    $result = mysqli_query($con, $sql);
    
    echo("<table border=1 width=700 align=center style='border-collapse:collapse'>
    <tr>
    <td align=center width=300>판매날짜</td>
    <td align=center width=100>상품코드</td>
    <td align=center width=200>상품이름</td>
    <td align=center width=100>판매수량</td>
    <td align=center width=200>상품단가</td>
    <td align=center width=200>부분합계</td>
    </tr>");

    $totalsales=0;
    // while ($row=mysqli_fetch_assoc($result)) {
    //     $opname = $row['pname'];
    //     $opprice = $row['pprice'];
    //     while ($rows = mysqli_fetch_assoc($result2)) {
    //         $opcode = $rows['pcode'];
    //         $opunit = $rows['punit'];
    //         $owdate = $rows['wdate'];
            
    //         $subtotal = $opprice * $opunit;
    //         $totalsales=$totalsales+$subtotal;
    // echo("<tr style='text-align:center;'><td>$owdate</td> <td>$opcode</td> <td>$opname</td> <td>$opunit</td> <td>$opprice</td>  <td>$subtotal</td> </tr>");

    //     }
    // }
    while ($row = mysqli_fetch_assoc($result)) {
        $owdate = $row['판매날짜'];
        $opcode = $row['상품코드'];
        $opname = $row['상품이름'];
        $opunit = $row['판매수량'];
        $opprice = $row['상품단가'];
        $subtotal = $row['부분합계'];
        $totalsales=$totalsales+$subtotal;
        echo("
            <tr>
                <td>$owdate</td>
                <td>$opcode</td>
                <td>$opname</td>
                <td>$opunit</td>
                <td>$opprice</td>
                <td>$subtotal</td>
            </tr>
        ");
    }

    echo("</table>");
    echo("<table border=1 width=700 align=center style='border-collapse:collapse'>");

    echo("<tr><td colspan='5' style='text-align:center;'>매출합계: $totalsales</td></tr>");
echo("</table>");

    echo("<p style='text-align:center;'> <a href=input.php>재고관리</a></p>");
?>