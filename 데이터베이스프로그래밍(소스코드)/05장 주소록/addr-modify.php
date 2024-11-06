<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma",   $con);

$result = mysql_query("select * from addressbook where name='$editname'", $con);
 
$address = mysql_result($result, 0, "address");
$homephone = mysql_result($result, 0, "homephone");
$cellphone = mysql_result($result, 0, "cellphone");
$email = mysql_result($result, 0, "email");

echo("
	<table border=0 width=600>
	<tr><td align=center><font size=6>Address Book</font></td></tr>
	<tr><td><hr size=1></td></tr>
	</table>

	<table border=0 width=600>
	<form method=post action=addr-process2.php?editname=$editname>
	<tr> 
	<td width=100 align=right>이름</td>
	<td width=500><input type=text name=name value='$editname' size=15></td>
	</tr>
	<tr>
	<td align=right>집주소</td>
	<td><input type=text name=address value='$address' size=70></td>
	</tr>
	<tr>
	<td align=right>집전화</td>
	<td><input type=text name=htel value='$homephone' size=30></td>
	</tr>
	<tr>
	<td align=right>휴대폰</td>
	<td><input type=text name=mtel value='$cellphone' size=20></td>
	</tr>
	<tr>
	<td align=right>이메일</td>
	<td><input type=text name=email value='$email' size=50></td>
	</tr>
	<tr><td colspan=2><hr size=1></td></tr>
	<tr align=center>
	<td colspan=2><input type=submit value=수정완료>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>
");

?>
