<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

$result = mysql_query("select * from product where code='$code'", $con);
$total = mysql_num_rows($result);

$name=mysql_result($result,0,"name");
$content=mysql_result($result,0,"content");
$content=nl2br($content);

$price1=mysql_result($result,0,"price1");
$price2=mysql_result($result,0,"price2");
$userfile=mysql_result($result,0,"userfile");

// ��ǰ�� ��ȸ���� �о�ͼ� 1 ������Ų ���� ������Ʈ ������ ����
$hit=mysql_result($result,0,"hit");
$hit++;
mysql_query("update product set hit=$hit where code='$code'", $con);

echo ("
	<table width=650 border=0>
    <tr><td width=250 align=center>
	<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=150 border=1></a></td>
    <td width=400 valign=top>
    <table border=0 width=100%>
	  <tr><td width=80 align=center>��ǰ�ڵ�: </td>
	  <td width=320>&nbsp;&nbsp;$code</td></tr>
	  <tr><td align=center>��ǰ�̸�: </td>
	  <td>&nbsp;&nbsp;$name</td></tr>
	  <tr><td align=center>��ǰ����: </td>
	  <td>&nbsp;&nbsp;<strike>$price1&nbsp;��</strike></td></tr>
	  <tr><td align=center>���ΰ���: </td>
	  <td>&nbsp;&nbsp;<b>$price2&nbsp;��</b></td></tr>
    	  <tr><td colspan=2 height=100 valign=bottom align=center>
	     <form method=post action=tobag.php?code=$code>
	     <input type=text size=3 name=quantity value=1>&nbsp;
	     <input type=submit value=���>
	     </td></tr></form>
	</table>
	</td>
	</tr>
	</table>	
	<br>
	<table width=650 border=0>
		<tr><td align=center>[��ǰ �� ����]</td></tr>
		<tr><td><hr size=1></td></tr>
		<tr><td>$content</td></tr>
	</table>
");
			 
mysql_close($con);

?>
