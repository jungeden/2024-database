<?

//mysql 데이타베이스에 연결
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

$result = mysql_query("select passwd from photo where userfile='$delimage'",$con);

$oldpasswd = mysql_result($result, 0, "passwd");

if ($delpasswd == $oldpasswd) {
    mysql_query("delete from photo where userfile='$delimage'",$con);
    unlink("./photo/$delimage");
    echo (" <script>
             window.alert('성공적으로 삭제되었습니다.')
             history.go(1)
             </script>
          ");
} else {
     echo (" <script>
             window.alert('암호가 맞지 않군요. 다시 확인하세요')
             history.go(1)
             </script>
          ");
}

mysql_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=p-show.php'>");

?>
