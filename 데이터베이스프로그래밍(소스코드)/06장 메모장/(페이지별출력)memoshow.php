<?

$con =   mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma",   $con);

$result =   mysql_query("select * from memojang order by num desc", $con);

$total =   mysql_num_rows($result);

if (!$total)   {
	echo ("���� ��ϵ� ���� �����ϴ�");
} else {
	echo ("
		<table border=1 width=700>
		<tr><td width=50>�۹�ȣ</td><td width=100>�̸�</td>
		<td width=150>����¥</td><td width=400>�޸�</td></tr>
	");

	$pagesize =   5;	// �� �������� ���� �� �޸� ���� ����

	if ($cpage ==  '') $cpage = 1; 

	$endpage = (int)($total / $pagesize);

	if ( ($total % $pagesize) != 0 ) $endpage = $endpage + 1;

	$i = 0;

	while ( $i   < $pagesize ) :
		$counter = $pagesize * ($cpage - 1) + $i;
		if ($counter == $total) break;
		$num = mysql_result($result, $counter, "num");
		$name = mysql_result($result, $counter, "name");
		$wdate = mysql_result($result, $counter, "wdate");
		$message = mysql_result($result,   $counter, "message");

		echo ("
			<tr><td>$num</td><td>$name</td>
			<td>$wdate</td><td>$message</td></tr>
		");

		$i++;

	endwhile;

	echo ("</table>");
}

echo ("<table border=0 width=700><tr><td align=center>");
	
$ppage =   $cpage - 1;
$npage =   $cpage + 1;

if ($cpage > 1) echo ("[<a href=memoshow.php?cpage=$ppage>����������</a>]");

if ($cpage < $endpage) echo ("[<a href=memoshow.php?cpage=$npage>����������</a>]");

echo ("</td></tr>
        <tr><td align=center><a   href=memo.html>�޸𾲱�</a></td></tr>
   </table>");

mysql_close($con);

?>
