<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

$result = mysql_query("select *   from $board where id=$id");

$password = mysql_result($result, 0, "passwd");
$filename = mysql_result($result, 0,  "filename");

if ($pass != $password) {
	echo ("<script>
		window.alert('��ȣ�� ��ġ���� �ʽ��ϴ�');
		history.go(-1);
		</script>");
	exit;
} else {
    mysql_query("delete from $board where id=$id",$con);
    unlink("./pds/$filename");

	echo("
		<script>
		window.alert('�ڷᰡ �����Ǿ����ϴ�.');
		</script>
	");

   // ������ �ۺ��� �� ��ȣ�� ū �Խù��� �� ��ȣ�� 1�� ����
   $result = mysql_query("select id from $board order by id desc", $con);
   $last = mysql_result($result, 0, "id");
   $i = $id + 1;

   while($i <= $last):
      mysql_query("update $board set id=id-1 where id=$i", $con);
      $i++;
   endwhile;

}

// �� ���� ����� �����ֱ� ���� �� ��� ���� ���α׷� ȣ��
echo("<meta http-equiv='Refresh' content='0; url=pds-show.php?board=$board'>");

mysql_close($con);

?>
