<?

//mysql ����Ÿ���̽��� ����
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

$result = mysql_query("select passwd from photo where userfile='$delimage'",$con);

$oldpasswd = mysql_result($result, 0, "passwd");

if ($delpasswd == $oldpasswd) {
    mysql_query("delete from photo where userfile='$delimage'",$con);
    unlink("./photo/$delimage");
    echo (" <script>
             window.alert('���������� �����Ǿ����ϴ�.')
             history.go(1)
             </script>
          ");
} else {
     echo (" <script>
             window.alert('��ȣ�� ���� �ʱ���. �ٽ� Ȯ���ϼ���')
             history.go(1)
             </script>
          ");
}

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-show.php'>");

?>
