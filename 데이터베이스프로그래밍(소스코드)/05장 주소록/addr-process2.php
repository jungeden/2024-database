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

if   (!$address) {
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

// MySQL ����Ÿ���̽��� �����ϱ�
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);

// ����Ÿ���̽��� �����Ͽ� ��� ������  ������Ʈ
mysql_query("update addressbook set name='$name', address='$address', homephone='$htel', cellphone='$mtel', email='$email' where name='$editname'", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=addr-show.php'>");

?>
