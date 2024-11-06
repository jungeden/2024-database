<?

// MySQL 데이타베이스에 연결하기
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);

// 데이타베이스에 접속하여 해당 레코드를 삭제
mysql_query("delete from addressbook where name='$delname'", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=addr-show.php'>");

?>
