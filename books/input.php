<? //input.php
    echo("
        <h1 style='text-align:center;'>도서 재고 관리</h1>
        <form method=post action=process.php align=center >
        도서코드:<input name=ibcode type=text size=10>
        도서이름:<input name=ibname type=text size=10>
        도서단가:<input name=ibprice type=text size=10>
        도서수량:<input name=ibunit type=text size=10>
        <input type=submit value=신규구입>
        </form>
    ");
    $con = mysqli_connect("localhost", "root", "0000", "class");
    $sql = "SELECT * from mbook";

    $result = mysqli_query($con, $sql);
    $total = mysqli_num_rows($result);
    
    echo("<table border=1 width=500 align=center style='border-collapse:collapse'>
    <tr >
    <td align=center width=100>도서코드</td>
    <td align=center width=100>도서이름</td>
    <td align=center width=100>도서단가</td>
    <td align=center width=100>도서수량</td>
    <td align=center width=100>관리</td>
    </tr>");


    while ($row=mysqli_fetch_assoc($result)) {
        $obcode = $row['bcode'];
        $obname = $row['bname'];
        $obprice = $row['bprice'];
        $obunit = $row["bunit"];
        echo("<tr style='text-align:center;'><td>$obcode</td> <td>$obname</td> <td>$obprice</td> <td>$obunit</td> 
        <td><a href=modify.php?mbcode=$obcode>O</a>/<a href=delete.php?dbcode=$obcode>X</a></td> </tr>");
    }
    echo("</table>");

    echo("<p style='text-align:center;'><a href=rental.php >대여관리</a></p>");
?>