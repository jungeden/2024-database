<?
//데이타베이스에 연결
 $con = mysql_connect("localhost", "root", "apmsetup");
 mysql_select_db("comma", $con);

 $result = mysql_query("select * from counter", $con);
 $total = mysql_num_rows($result);
 
 $today = date("Ymd");
 
 if ($total == 0) {     // 카운터 값을 담을 레코드가 존재하지 않는 경우
    $todaycount = 0;
    $totalcount = 0;
    $lastlogin = $today;
    mysql_query("insert into counter values ($todaycount, $totalcount, '$lastlogin')", $con);
    
 } else {              // 각 필드에 해당하는 데이터를 뽑아 내는 과정
    $todaycount = mysql_result($result, 0, "today");
    $totalcount = mysql_result($result, 0, "total");
    $lastlogin = mysql_result($result, 0, "lastlogin");
 }
 
 if ($lastlogin == $today) $todaycount = $todaycount + 1;
 else $todaycount =1;
 
 $totalcount = $totalcount + 1;
     
 mysql_query("update counter set today =  $todaycount, total = $totalcount, lastlogin = '$today'", $con);
     
//오늘 방문자 수와 전체 방문자 수를 화면  디스플레이
 echo "TODAY = $todaycount, TOTAL = $totalcount";

 mysql_close($con);

?>
