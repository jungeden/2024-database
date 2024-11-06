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

echo ("<table border=0 width=560 align=center>
	<tr><td colspan=4 align=center><h1>Gallery</h1></td></tr>
	<tr><td colspan=2 align=left><font size=2 color=blue>(전체 사진매수: </font><font size=2 color=red>$total&nbsp;</font><font size=2 color=blue>매)</font></td>
	<td colspan=2 align=right><font size=2>[<a href=p-show.php>전체목록</a>][<a href=p-input.php>사진등록</a>]</font></td></tr>
	<tr>
	");

$counter = 0;
	
while ($counter < $total) :
	if (($counter % 4) == 0) echo ("</tr><tr><td colspan=4></td></tr><tr>");
	$wname = mysql_result($result, $counter, "wname");
	$wdate = mysql_result($result, $counter, "wdate");
	$userfile = mysql_result($result, $counter, "userfile");

    echo ("
       <td align=center>
		<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=920, height=620')\"><img src='./photo/$userfile' width=120 height=80 border=0></a><br><font size=2>$wname<br>($wdate)</font></td>
	");

	$counter = $counter + 1;
endwhile;
        
echo ("</tr></table>");

mysql_close($con);

?>
