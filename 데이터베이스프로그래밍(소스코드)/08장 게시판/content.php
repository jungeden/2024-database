<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);
$result=mysql_query("select * from $board where id=$id",$con);

// �� �ʵ忡 �ش��ϴ� �����͸� �̾� ���� ����
$id=mysql_result($result,0,"id");
$writer=mysql_result($result,0,"writer");
$topic=mysql_result($result,0,"topic");
$hit=mysql_result($result,0,"hit");

$hit = $hit +1;   //��ȸ���� �ϳ� ����
mysql_query("update $board set hit=$hit where id=$id",$con);

$wdate=mysql_result($result,0,"wdate");
$email=mysql_result($result,0,"email");
$content=mysql_result($result,0,"content");

// ���̺�κ��� ���� ������ ȭ�鿡 ���÷���
echo("
	<table border=0 width=700>
	<tr><td align=center><h1>�Խ���</h1></td></tr>
	</table>

	<table border=1 width=700>
	<tr>
	<td width=100>��ȣ: $id</td>
	<td width=200>�۾���: <a href=mailto:$email>$writer</a></td>
	<td width=300>�۾���¥: $wdate</td>
	<td width=100>��ȸ: $hit</td>
	</tr>
	<tr>
	<td colspan=4>����: $topic</td>
	</tr>
	<tr>
	<td colspan=4><pre>$content</pre></td>
	</tr>
	</table>

	<table   border=0 width=700>
	<tr><td align=center>
	<a href=pass.php?board=$board&id=$id&mode=0>[����]</a>
	<a href=pass.php?board=$board&id=$id&mode=1>[����]</a>
	<a href=reply.php?board=$board&id=$id>[�亯]</a>
	<a href=show.php?board=$board>[����Ʈ]</a>
	</td></tr>
	</table>
");

?>
