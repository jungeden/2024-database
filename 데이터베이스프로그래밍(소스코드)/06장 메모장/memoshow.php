<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);

$result = mysql_query("select * from memojang order by num desc", $con);

$total = mysql_num_rows($result);

if (!$total) {
	echo ("아직 등록된 글이 없습니다");
} else {
	echo ("
		<table border=1 width=700>
		<tr><td width=100>이름</td><td width=150>날짜</td><td width=450>메모</td></tr>
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
 
echo ("<br><a href=memo.html>메모쓰기</a>");

mysql_close($con);

?>
