<?

if(!$writer){
	echo("
		<script>
		window.alert('�̸��� �����ϴ�. �ٽ� �Է��ϼ���.')
		history.go(-1)
		</script>
	");
	exit;
}

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

// �亯 ���� ���� �ۺ��� ���̰� 1 ������
$result=mysql_query("select space from $board where id=$id", $con);
$space=mysql_result($result, 0, "space");
$space=$space+1;

$wdate=date("Y-m-d"); // �ܺ� ���� �� ��¥ ����

// �亯���� �߰��Ǹ� ���� ������ �ϳ� �����ϹǷ� �� ��ȣ�� ����
$tmp = mysql_query("select id from $board", $con);
$total = mysql_num_rows($tmp);

while($total >= $id):
	mysql_query("update $board set id=id+1 where id=$total", $con);
	$total--;
endwhile;

// ���� �� ��ȣ ��ġ�� �亯 ���� ������
mysql_query("insert into   $board(id, writer, email, passwd, topic, content, hit, wdate, space) values ($id, '$writer', '$email', '$passwd', '$topic','$content', 0, '$wdate',   $space)", $con);

mysql_close($con);

echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");

?>
