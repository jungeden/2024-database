<?

// MySQL ����Ÿ���̽��� �����ϱ�
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);

// ����Ÿ���̽��� �����Ͽ� �ش� ���ڵ带 ����
mysql_query("delete from addressbook where name='$delname'", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=addr-show.php'>");

?>
