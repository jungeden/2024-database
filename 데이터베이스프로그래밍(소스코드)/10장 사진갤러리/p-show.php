<?

echo ("
        <html>
        <head>
        <title>Photo Gallery</title>
        <style TYPE='text/css'>
        <!--
        a:link { text-decoration: none;}
        a:visited { text-decoration: none; }
        a:hover { text-decoration: underline; color:#0066cc; }
        -->
        </style>
        </head>
        <body>
");

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);
$result = mysql_query("select * from photo order by wdate desc", $con);
$total = mysql_num_rows($result);

$pagesize = 10;
if ($cpage == '') $cpage = 1;
$endpage = (int)($total / $pagesize);
if (($total % $pagesize) != 0) $endpage= $endpage + 1;

if (!$total) {
   echo ("
		<script>
		window.alert('���� ��ϵ� ������ �����ϴ�');
        history.go(1);
		</script>
   ");
   echo ("<meta http-equiv='Refresh' content='0; url=p-input.php'>");
   exit;
} else {
   echo ("<table border=0 width=600 align=center>
		<tr><td colspan=2 height=7 align=center><h1>Gallery</h1></td> </tr>
		<tr><td align=right><font size=2>[<a href=p-input.php>�������</a>]</font><font size=2>[<a href=gallery.php>����������</a>]</font></td></tr></table>");

   echo ("<table border=0 width=600 align=center>
		<form method=post action=p-delete.php>
		<tr bgcolor=#000080><td align=center width=70><font size=2 color=white><b>�̸�</b></font></td>
		<td align=center width=80><font size=2 color=white><b>��ϳ�¥</b></font></td>
		<td align=center width=420><font size=2 color=white><b>���� ����</b></font></td>
		<td align=center width=30><input type=submit value=���� style='color=red; background-color=yellow; border=1 solid blue; height=20px'></td></tr>
	");

   $i = 0;
	
   while ($i < $pagesize) :
		$counter = $pagesize * ($cpage - 1) + $i;

		if ($counter == $total) break; 

		$wname = mysql_result($result, $counter, "wname");
		$summary = mysql_result($result, $counter, "summary");
		$wdate = mysql_result($result, $counter, "wdate");
		$userfile = mysql_result($result, $counter, "userfile");

		if ( ($i % 2) == 0 ) {
			echo ("<tr bgcolor=#ffefff>");
		} else {
			echo ("<tr bgcolor=#ffffef>");
		}

		echo ("
		   <td align=center><font size=2>$wname</font></td>
		   <td align=center><font size=2>$wdate</font></td>
		   <td><a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=920,height=620')\"><font size=2>$summary</font></a></td>
		   <td align=center><input type=checkbox name=delimage value='$userfile'></td></tr>
        ");

		$i++;
	endwhile;       
}

mysql_close($con);

$ppage = $cpage - 1;
$npage = $cpage + 1;

echo ("<tr><td colspan=4>&nbsp;</td></tr>");

// ù��° �������̸鼭 ���� �������� �����ϴ� ���
if ($cpage == 1 && $cpage != $endpage)
   echo ("<tr><td colspan=4 align=center><font size=2 color=red>$cpage</font> <font size=2>of</font> <font size=2 color=blue>$endpage</font> <font size=2>[<a href=p-show.php?cpage=$npage>����������</a>]</font></td></tr>");

// ù��° �������� �ƴϸ鼭 ������ �������� ���
if ($cpage != 1 && $cpage == $endpage)
   echo ("<tr><td colspan=4 align=center><font size=2>[<a href=p-show.php?cpage=$ppage>����������</a>]</font> <font size=2 color=red>$cpage</font> <font size=2>of</font> <font size=2 color=blue>$endpage</font></td></tr>");

// �߰� �������� ���
if ($cpage > 1 && $cpage < $endpage) 
  echo ("<tr><td colspan=4 align=center><font size=2>[<a href=p-show.php?cpage=$ppage>����������</a>]</font> <font size=2 color=red>$cpage</font> <font size=2>of</font> <font size=2 color=blue>$endpage</font> <font size=2>[<a href=p-show.php?cpage=$npage>����������</a>]</font></td></tr>");

echo ("</table>");
echo ("</body></html>");

?>
