<?

$con =   mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma",   $con);

$result = mysql_query("select * from addressbook order by name", $con);
$total  = mysql_num_rows($result);

echo("
	<table border=0 width=800>
	<tr><td align=center><font size=6>Address Book</font></td></tr>
	<tr><td align=right>전체 등록자수: $total 명</td></tr>
	</table>
	<table border=1 width=800>
	<tr><td width=50   align=center>이름</td>
	<td width=200 align=center>집주소</td>
    <td width=150 align=center>집전화</td>
	<td width=150 align=center>휴대폰</td>
	<td width=180 align=center>이메일</td>
	<td width=70 align=center>수정/삭제</td></tr>
");
	   
if (!$total)   {
     echo ("<tr><td align=center colspan=6>등록된 자료가 없습니다</td></tr>");
} else {
	$counter = 0;
	while ($counter < $total) :
		$name = mysql_result($result, $counter,   "name");
		$address = mysql_result($result, $counter, "address");
		$htel = mysql_result($result, $counter, "homephone");
		$mtel = mysql_result($result, $counter, "cellphone");
		$email = mysql_result($result, $counter, "email");
	
	echo ("
		<tr><td align=center>$name</td><td>$address</td>
		<td align=center>$htel</td>	
		<td align=center>$mtel</td><td>$email</td>
	    <td><a href=addr-modify.php?editname=$name>수정</a>/<a href=addr-delete.php?delname=$name>삭제</a></td></tr>
		"); 

	$counter = $counter + 1;
	endwhile;
}

echo ("</table>");

mysql_close($con);

?>
