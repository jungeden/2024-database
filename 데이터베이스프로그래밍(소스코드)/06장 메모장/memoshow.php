<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);

$result = mysql_query("select * from memojang order by num desc", $con);

$total = mysql_num_rows($result);

if (!$total) {
	echo ("���� ��ϵ� ���� �����ϴ�");
} else {
	echo ("
		<table border=1 width=700>
		<tr><td width=100>�̸�</td><td width=150>��¥</td><td width=450>�޸�</td></tr>
	");

	$counter = 0;

	while ($counter < $total) :
		$wname = mysql_result($result, $counter, "name");
		$wdate = mysql_result($result, $counter, "wdate");
		$wmemo = mysql_result($result, $counter, "message");

		echo ("<tr><td>$wname</td><td>$wdate</td> <td>$wmemo</td></tr>");

		$counter = $counter + 1;
	endwhile;

	echo ("</table>");
}
 
echo ("<br><a href=memo.html>�޸𾲱�</a>");

mysql_close($con);

?>
