<?

if (!$name) {
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է����ּ���')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$address) {
	echo("
		<script>
		window.alert('�� �ּҰ� �����ϴ�. �ٽ� �Է����ּ���')
		history.go(-1)
		</script>
	");
	exit;
} 

if (!$mtel) {	
	echo("
		<script>
		window.alert('�޴��� ��ȣ�� ������. �ٽ� �Է����ּ���')
		history.go(-1)
		</script>
	");
	exit;
} 

// MySQL ����Ÿ���̽��� �����ؼ� ���� �ϱ�
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);

// ����Ÿ���̽��� �����Ͽ� ��� ������ ����
mysql_query("insert into addressbook(name, address, homephone, cellphone, email) values ('$name', '$address', '$htel', '$mtel', '$email')", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=addr-show.php'>");

?>
