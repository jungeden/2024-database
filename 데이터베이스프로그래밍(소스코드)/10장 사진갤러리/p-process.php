<?

if (!$wname){
      echo("
          <script>
          window.alert('����ڸ��� �Է����ּ���')
          history.go(-1)
          </script>
         ");
      exit;
}

if (!$summary){
      echo("
          <script>
          window.alert('���� ������ ������ �����ּ���')
          history.go(-1)
          </script>
         ");
      exit;
}

if ($userfile == "none"){
      echo("
          <script>
          window.alert('���ε� �� ������ ����ּ���')
          history.go(-1)
          </script>
        ");
      exit;
}

$wdate = date("y-m-d");

if ($userfile) {
      $savedir = "./photo";
      $temp = $userfile_name;
      if (file_exists("$savedir/$temp")) {
         echo (" 
                <script>
                window.alert('������ ������ ȭ���� �̹� �����մϴ�')
                history.go(-1)
                </script>
               ");
         exit;
      } else {
         copy($userfile,   "$savedir/$temp");
         unlink($userfile);
      }
}

//mysql ����Ÿ���̽��� ����
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

//�����ͺ��̽��� �ۿ� ���� ���� ����
$result = mysql_query("insert into photo(wname, summary, wdate, userfile, passwd) values('$wname', '$summary', '$wdate', '$userfile_name', '$passwd')", $con);

mysql_close($con);	//�����ͺ��̽� ��������

if (!$result) {
     echo("
        <script>
        window.alert('���� ��Ͽ� �����߽��ϴ�.')
        history.go(-1)
        </script>
     ");
     exit;
} else {
     echo("
        <script>
        window.alert('���� ����� �Ϸ�Ǿ����ϴ�')
        </script>
     ");
     echo ("<meta http-equiv='Refresh' content='0; url=p-show.php'>");
}

?>
