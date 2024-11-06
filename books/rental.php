<?
echo("
<h1 style='text-align:center;'>도서 대여 관리</h1>
<form align=center method=post action=process2.php>
도서코드:<input name=ibcode type=text size=10>
도서수량:<input name=ibunit type=text size=10>
<input type=submit value=대여도서>
</form>
");
$con = mysqli_connect("localhost", "root", "0000", "class");

$sql = " SELECT 
r.rdate AS 대여날짜,
r.bcode AS 도서코드,
m.bname AS 도서이름,
r.bunit AS 판매수량,
m.bprice AS 도서단가,
(m.bprice * r.bunit) AS 부분합계
FROM 
rental r
JOIN 
mbook m ON r.bcode = m.bcode";

$result = mysqli_query($con, $sql);

echo("<table border=1 width=700 align=center style='border-collapse:collapse'>
<tr>
<td align=center width=300>대여날짜</td>
<td align=center width=100>도서코드</td>
<td align=center width=200>도서이름</td>
<td align=center width=100>도서수량</td>
<td align=center width=200>도서단가</td>
<td align=center width=200>부분합계</td>
</tr>");

$totalsales=0;
while ($row = mysqli_fetch_assoc($result)) {
    $ordate = $row['대여날짜'];
    $obcode = $row['도서코드'];
    $obname = $row['도서이름'];
    $obunit = $row['판매수량'];
    $obprice = $row['도서단가'];
    $subtotal = $row['부분합계'];
    $totalsales=$totalsales+$subtotal;
    echo("
        <tr>
            <td>$ordate</td>
            <td>$obcode</td>
            <td>$obname</td>
            <td>$obunit</td>
            <td>$obprice</td>
            <td>$subtotal</td>
        </tr>
    ");
}

echo("</table>");
echo("<table border=1 width=700 align=center style='border-collapse:collapse'>");

echo("<tr><td colspan='5' style='text-align:center;'>매출합계: $totalsales</td></tr>");
echo("</table>");

echo("<p style='text-align:center;'> <a href=input.php>도서관리</a></p>");


?>