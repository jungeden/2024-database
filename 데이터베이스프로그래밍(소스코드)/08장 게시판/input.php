<?    

echo("
	<center><h1>�Խ���</h1></center>
	<form method=post action=process.php?board=$board>
	<table width=700 border=0>
	<tr>
	<td width=100 align=right>�̸� </td>
	<td width=600><input type=text name=writer size=20></td>
	</tr>
	<tr>
	<td align=right>Email </td>
	<td><input type=text name=email size=40></td>
	</tr>
	<tr>
	<td align=right>���� </td>
	<td><input type=text name=topic size=60></td>
	</tr>
	<tr>
	<td align=right>���� </td>
	<td><textarea name=content rows=12 cols=60></textarea></td>
	</tr>
	<tr>
	<td align=right>��ȣ </td>
	<td><input type=password name=passwd size=15></td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=����ϱ�>
	<input type=reset value=�����></td>
	</tr>
	</table>
	</form>
");

?>
