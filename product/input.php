<? //input.php
    echo("
        <h1 style='text-align:center;'>재고관리</h1>
        <form method=post action=process.php align=center >
        상품코드:<input name=ipcode type=text size=10>
        상품이름:<input name=ipname type=text size=10>
        상품단가:<input name=ipprice type=text size=10>
        상품수량:<input name=ipunit type=text size=10>
        <input type=submit value=신규구입>
        </form>
    ");
    $con = mysqli_connect("localhost", "root", "0000", "class");
    $sql = "SELECT * from product";

    $result = mysqli_query($con, $sql);
    $total = mysqli_num_rows($result);
    
    echo("<table border=1 width=500 align=center style='border-collapse:collapse'>
    <tr >
    <td align=center width=100>상품코드</td>
    <td align=center width=100>상품이름</td>
    <td align=center width=100>상품단가</td>
    <td align=center width=100>상품수량</td>
    <td align=center width=100>관리</td>
    </tr>");


    while ($row=mysqli_fetch_assoc($result)) {
        $opcode = $row['pcode'];
        $opname = $row['pname'];
        $opprice = $row['pprice'];
        $opunit = $row["punit"];
        echo("<tr style='text-align:center;'><td>$opcode</td> <td>$opname</td> <td>$opprice</td> <td>$opunit</td> 
        <td><a href=modify.php?mpcode=$opcode>O</a>/<a href=delete.php?dpcode=$opcode>X</a></td> </tr>");
    }
    echo("</table>");

    echo("<p style='text-align:center;'><a href=sales.php >매출관리</a></p>");
?>