<?

if (!$writer){
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է��ϼ���')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$topic){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���')
		history.go(-1)
		</script>
	");
	exit;
}

if (!$content){
	echo("
		<script>
		window.alert('������ �����ϴ�. �ٽ� �Է��ϼ���')
		history.go(-1)
		</script>
	");
	exit;
}

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);
$result = mysql_query("select * from $board where id=$id", $con);

// ���� �ʵ尪�� ������ �׸��� ������
$space = mysql_result($result, 0, "space");
$hit = mysql_result($result, 0, "hit");

$wdate = date("Y-m-d");	//�� ������ ��¥ ����

// ���� ������ ���̺� ������
mysql_query("update $board set  writer='$writer', email='$email', passwd='$passwd', topic='$topic', content='$content', hit=$hit, wdate='$wdate', space=$space where   id=$id", $con);

echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");

mysql_close($con);

?>
