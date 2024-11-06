<?

if (!$writer)   {
	echo("
		<script>
		window.alert('이름이 없습니다. 다시 입력해주세요')
		history.go(-1)
		</script>
	");
	exit;
}
if (!$title)   {      
	echo("
		<script>
		window.alert('타이틀이 없습니다. 다시 입력해주세요')
		history.go(-1)
		</script>
	");
	exit;
}

// MySQL 데이타베이스에 연결
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);
$result = mysql_query("select id from $board", $con);
$total = mysql_num_rows($result);

// 글에 대한 id 부여
if (!$total)   {
   $id = 1;
} else {
   $id = $total + 1;
}

//글 쓴 날짜 저장
$wdate = date("Y-m-d H:i:s");

//파일 처리 루틴
if ($userfile) {	
   $savedir = "./pds";	//첨부 파일이 저장될 폴더
   $temp = $userfile_name;
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
}

// 데이타베이스에 접속하여 모든 내용을 저장
mysql_query("insert into $board(id, writer, passwd, title, wdate, filename, filesize) values($id, '$writer', '$passwd', '$title', '$wdate', '$userfile_name', '$userfile_size')", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=pds-show.php?board=$board'>");

?>
