<?

$con =   mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma",   $con);

$result = mysql_query("select * from addressbook order by name", $con);
$total  = mysql_num_rows($result);

echo("
	<table border=0 width=800>
	<tr><td align=center><font size=6>Address Book</font></td></tr>
	<tr><td align=right>��ü ����ڼ�: $total ��</td></tr>
	</table>
	<table border=1 width=800>
	<tr><td width=50   align=center>�̸�</td>
	<td width=200 align=center>���ּ�</td>
    <td width=150 align=center>����ȭ</td>
	<td width=150 align=center>�޴���</td>
	<td width=180 align=center>�̸���</td>
	<td width=70 align=center>����/����</td></tr>
");
	   
if (!$total)   {
     echo ("<tr><td align=center colspan=6>��ϵ� �ڷᰡ �����ϴ�</td></tr>");
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
	    <td><a href=addr-modify.php?editname=$name>����</a>/<a href=addr-delete.php?delname=$name>����</a></td></tr>
		"); 

	$counter = $counter + 1;
	endwhile;
}

echo ("</table>");

mysql_close($con);

?>
