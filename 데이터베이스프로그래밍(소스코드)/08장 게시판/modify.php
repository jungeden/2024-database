<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

$result=mysql_query("select *   from $board where id=$id",$con);

// �����ϰ��� �ϴ� ���� �Խù����� ���� ������ �׸��� ������
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");
$email=mysql_result($result,0,"email");

echo("<center><h1>�Խ���</h1></center>
	<form method=post action=mprocess.php?board=$board&id=$id>
	<table width=700 border=0>
	<tr>
	<td width=100 align=right>�̸� </td>
	<td width=600><input type=text name=writer size=20 value='$writer'></td>
	</tr>
	<tr>
	<td align=right>Email </td>
	<td><input type=text name=email size=40 value='$email'></td>
	</tr>
	<tr>
	<td align=right>���� </td>
	<td><input type=text name=topic size=60 value='$topic'></td>
	</tr>
	<tr>
	<td align=right>���� </td>
	<td><textarea name=content rows=12 cols=60>$content</textarea></td>
	</tr>
	<tr>
	<td align=right>��ȣ </td>
	<td><input type=password name=passwd size=15></td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=�����Ϸ�>
	<input type=reset value=�����></td>
	</tr>
	</table>
	</form>");

mysql_close($con);

?>
