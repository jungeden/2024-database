<?

echo("
	<table border=0 width=600>
	<tr><td align=center><font size=6>Address Book</font></td></tr>
	<tr><td><hr   size=1></td></tr>
	</table>

	<table border=0 width=600>
	<form method=post action=addr-process.php>
	<tr> 
	<td width=100 align=right>이름</td>
	<td   width=500><input type=text name=name size=15></td>
	</tr>
	<tr>
	<td align=right>집주소</td>
	<td><input type=text name=address size=70></td>
	</tr>
	<tr>
	<td align=right>집전화</td>
	<td><input type=text name=htel size=30></td>
	</tr>
	<tr>
	<td align=right>휴대폰</td>
	<td><input type=text name=mtel size=20></td>
	</tr>
	<tr>
	<td align=right>이메일</td>
	<td><input   type=text name=email size=50></td>
	</tr>
	<tr><td colspan=2><hr size=1></td></tr>
	<tr>
	<td colspan=2 align=center><input type=submit value=주소등록>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>
");

?>
