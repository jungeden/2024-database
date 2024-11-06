<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

$result = mysql_query("select *   from $board where id=$id");

$password = mysql_result($result, 0, "passwd");
$filename = mysql_result($result, 0,  "filename");

if ($pass != $password) {
	echo ("<script>
		window.alert('암호가 일치하지 않습니다');
		history.go(-1);
		</script>");
	exit;
} else {
    mysql_query("delete from $board where id=$id",$con);
    unlink("./pds/$filename");

	echo("
		<script>
		window.alert('자료가 삭제되었습니다.');
		</script>
	");

   // 삭제된 글보다 글 번호가 큰 게시물은 글 번호를 1씩 감소
   $result = mysql_query("select id from $board order by id desc", $con);
   $last = mysql_result($result, 0, "id");
   $i = $id + 1;

   while($i <= $last):
      mysql_query("update $board set id=id-1 where id=$i", $con);
      $i++;
   endwhile;

}

// 글 삭제 결과를 보여주기 위한 글 목록 보기 프로그램 호출
echo("<meta http-equiv='Refresh' content='0; url=pds-show.php?board=$board'>");

mysql_close($con);

?>
