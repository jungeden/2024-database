<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);
	
$result = mysql_query("select * from product order by name", $con);

$total = mysql_num_rows($result);

echo ("<table border=1 width=690>
	<tr><td align=center><font size=2>��ǰ�ڵ�</td>
	<td colspan=2 align=center><font size=2>��ǰ��</td>
	<td align=center><font size=2>���尡��</td>
	<td align=center><font size=2>�ǸŰ���</td>
	<td align=center><font size=2>����/����</td></tr>");
							
if (!$total) {

  echo("<tr><td colspan=6 align=center>���� ��ϵ� ��ǰ�� �����ϴ�</td></tr>");

} else {

	$counter = 0;

	while ($counter < $total) :

		$code=mysql_result($result,$counter,"code");
		$name=mysql_result($result,$counter,"name");
		$userfile=mysql_result($result,$counter,"userfile");
		$price1=mysql_result($result,$counter,"price1");
		$price2=mysql_result($result,$counter,"price2");

		echo ("
		   <tr><td width=100 align=center><font size=2>$code</td>
			 <td align=center width=30><img src=./photo/$userfile width=40 height=40 border=0></td>
			   <td width=350 align=left><a href=p-show.php?code=$code><font size=2>$name</a></td>
			   <td align=right width=70><font size=2><strike>$price1&nbsp;��</strike></td>
			   <td align=right width=70><font size=2>$price2&nbsp;��</td>
			   <td width=70 align=center><font size=2><a href=p-modify.php?code=$code>����</a>/<a href=p-delete.php?code=$code>����</a></td></tr>");

		$counter++;
	endwhile;
}

echo ("</table>");
	     
mysql_close($con);

?>
