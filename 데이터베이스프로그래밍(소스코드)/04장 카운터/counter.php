<?
//����Ÿ���̽��� ����
 $con = mysql_connect("localhost", "root", "apmsetup");
 mysql_select_db("comma", $con);

 $result = mysql_query("select * from counter", $con);
 $total = mysql_num_rows($result);
 
 $today = date("Ymd");
 
 if ($total == 0) {     // ī���� ���� ���� ���ڵ尡 �������� �ʴ� ���
    $todaycount = 0;
    $totalcount = 0;
    $lastlogin = $today;
    mysql_query("insert into counter values ($todaycount, $totalcount, '$lastlogin')", $con);
    
 } else {              // �� �ʵ忡 �ش��ϴ� �����͸� �̾� ���� ����
    $todaycount = mysql_result($result, 0, "today");
    $totalcount = mysql_result($result, 0, "total");
    $lastlogin = mysql_result($result, 0, "lastlogin");
 }
 
 if ($lastlogin == $today) $todaycount = $todaycount + 1;
 else $todaycount =1;
 
 $totalcount = $totalcount + 1;
     
 mysql_query("update counter set today =  $todaycount, total = $totalcount, lastlogin = '$today'", $con);
     
//���� �湮�� ���� ��ü �湮�� ���� ȭ��  ���÷���
 echo "TODAY = $todaycount, TOTAL = $totalcount";

 mysql_close($con);

?>
