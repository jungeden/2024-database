<?

if ($UserID != 'admin') {
	echo ("<script>
		window.alert('�����ڸ� ���� ������ ����Դϴ�')
		history.go(-1)
		</script>");
    exit;
} 

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
	
$result = mysql_query("select * from member order by uname", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=0 width=690>
    <tr><td align=center><font size=3><b>[ȸ�� ��� ��ȸ]</b></td></tr>
	<tr><td align=right><font size=2>[<a href=admin.php>Back</a>]</td>
	</tr></table> ");
	   
$i = 0;	

echo ("
	<table border=1 width=690>
	<tr height=35>
	<td align=center width=60><font size=2><b>ID</b></td>
	<td align=center width=50><font   size=2><b>�̸�</b></td>
	<td align=center width=340><font size=2><b>�ּ�</b></td>
	<td align=center width=100><font size=2><b>��ȭ��ȣ</b></td>
	<td align=center width=100><font size=2><b>�̸���</b></td>
	<td align=center width=40><font size=2><b>����</b></td></tr>
");	

while($i < $total):
	$uid = mysql_result($result, $i, "UID");
	$uname = mysql_result($result, $i, "UNAME");
	$zip = mysql_result($result, $i, "ZIPCODE");
	$addr1 = mysql_result($result, $i, "ADDR1");
	$addr2 = mysql_result($result, $i, "ADDR2");
	$mphone = mysql_result($result, $i, "MPHONE");
	$email = mysql_result($result, $i, "EMAIL");
	$approved = mysql_result($result, $i, "APPROVED");

	$address = "(" . $zip .   ")" . "&nbsp;" . $addr1 . "&nbsp;" .   $addr2;
	
    echo ("<tr height=30><td align=center><font size=2>$uid</td>
		<td align=center><font size=2>$uname</td>
		<td><font size=2>$address</td>
		<td align=center><font size=2>$mphone</td>
		<td align=center><font size=2>$email</td>");
		
	if ($approved == 0) {
		echo ("<td align=center><a href=memberchange.php?uid=$uid><font size=2>���</a></td></tr>");
	} else {
		echo ("<td align=center><a href=memberchange.php?uid=$uid><font size=2>�Ϸ�</a></td></tr>");
	}
	      
	$i++;
endwhile;

echo ("</table>");
mysql_close($con);

?>
