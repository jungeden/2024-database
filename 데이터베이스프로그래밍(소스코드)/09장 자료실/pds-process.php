<?

if (!$writer)   {
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է����ּ���')
		history.go(-1)
		</script>
	");
	exit;
}
if (!$title)   {      
	echo("
		<script>
		window.alert('Ÿ��Ʋ�� �����ϴ�. �ٽ� �Է����ּ���')
		history.go(-1)
		</script>
	");
	exit;
}

// MySQL ����Ÿ���̽��� ����
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);
$result = mysql_query("select id from $board", $con);
$total = mysql_num_rows($result);

// �ۿ� ���� id �ο�
if (!$total)   {
   $id = 1;
} else {
   $id = $total + 1;
}

//�� �� ��¥ ����
$wdate = date("Y-m-d H:i:s");

//���� ó�� ��ƾ
if ($userfile) {	
   $savedir = "./pds";	//÷�� ������ ����� ����
   $temp = $userfile_name;
   copy($userfile, "$savedir/$temp");
   unlink($userfile);
}

// ����Ÿ���̽��� �����Ͽ� ��� ������ ����
mysql_query("insert into $board(id, writer, passwd, title, wdate, filename, filesize) values($id, '$writer', '$passwd', '$title', '$wdate', '$userfile_name', '$userfile_size')", $con);

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=pds-show.php?board=$board'>");

?>
