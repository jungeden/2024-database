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

// ��ü �湮�� ���� �̹����� �����ֱ�
$len = strlen($totalcount);

$i = 0;
while ($i < $len):
         $num = substr($totalcount, $i, 1);
 switch ($num) {
	case   0:
	      echo ("<img src=images/0.jpg   border=0>");
	      break;
	case   1:   
	      echo ("<img src=images/1.jpg   border=0>");
	      break;
	case   2:   
	      echo   ("<img src=images/2.jpg border=0>");
	      break;
	case   3:   
	      echo ("<img src=images/3.jpg   border=0>");
	      break;
	case   4:   
	      echo ("<img src=images/4.jpg   border=0>");
	      break;
	case   5:   
	      echo ("<img src=images/5.jpg   border=0>");
	      break;
	case   6:   
	      echo ("<img src=images/6.jpg   border=0>");
	      break;
	case   7:   
	      echo ("<img src=images/7.jpg   border=0>");
	      break;
	case   8:   
	      echo ("<img src=images/8.jpg   border=0>");
	      break;
	case   9:   
	      echo ("<img src=images/9.jpg   border=0>");
	      break;
        }
	$i++;
endwhile;

mysql_close($con);
                   
?>
