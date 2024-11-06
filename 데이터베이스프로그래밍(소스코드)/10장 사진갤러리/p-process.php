<?

if (!$wname){
      echo("
          <script>
          window.alert('등록자명을 입력해주세요')
          history.go(-1)
          </script>
         ");
      exit;
}

if (!$summary){
      echo("
          <script>
          window.alert('사진 설명을 간단히 적어주세요')
          history.go(-1)
          </script>
         ");
      exit;
}

if ($userfile == "none"){
      echo("
          <script>
          window.alert('업로드 할 사진을 골라주세요')
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
                window.alert('서버에 동일한 화일이 이미 존재합니다')
                history.go(-1)
                </script>
               ");
         exit;
      } else {
         copy($userfile,   "$savedir/$temp");
         unlink($userfile);
      }
}

//mysql 데이타베이스에 연결
$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

//데이터베이스에 글에 대한 정보 저장
$result = mysql_query("insert into photo(wname, summary, wdate, userfile, passwd) values('$wname', '$summary', '$wdate', '$userfile_name', '$passwd')", $con);

mysql_close($con);	//데이터베이스 연결해제

if (!$result) {
     echo("
        <script>
        window.alert('사진 등록에 실패했습니다.')
        history.go(-1)
        </script>
     ");
     exit;
} else {
     echo("
        <script>
        window.alert('사진 등록이 완료되었습니다')
        </script>
     ");
     echo ("<meta http-equiv='Refresh' content='0; url=p-show.php'>");
}

?>
