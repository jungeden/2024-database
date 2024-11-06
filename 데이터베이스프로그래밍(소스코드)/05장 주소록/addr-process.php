<?

if (!$name) {
	echo("
		<script>
		window.alert('이름이 없습니다. 다시 입력해주세요')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$address) {
	echo("
		<script>
		window.alert('집 주소가 없습니다. 다시 입력해주세요')
		history.go(-1)
		</script>
	");
	exit;
} 

if (!$mtel) {	
	echo("
		<script>
		window.alert('휴대폰 번호가 없군요. 다시 입력해주세요')
		history.go(-1)
		</script>
	");
	exit;
} 

// MySQL 데이타베이스에 연결해서 쿼리 하기
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);

// 데이타베이스에 접속하여 모든 내용을 저장
mysql_query("insert into addressbook(name, address, homephone, cellphone, email) values ('$name', '$address', '$htel', '$mtel', '$email')", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=addr-show.php'>");

?>
