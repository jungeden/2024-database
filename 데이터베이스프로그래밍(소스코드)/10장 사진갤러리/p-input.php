<?
echo ("
	<html>
    <head>
    <title>Photo Gallery</title>
    <style TYPE='text/css'>
    <!--
    a:link { text-decoration: none;}
    a:visited { text-decoration: none; }
    a:hover { text-decoration: underline; color:red; }
    -->
    </style>
    </head>
    <body>
");

echo("
	<table border=0 width=600 align=center>
	<tr><td colspan=2 height=7   align=center><h1>Gallery</h1></td></tr>
	<tr><td colspan=2 align=right><font size=2>[<a href=gallery.php>����������</a>]</td></tr>
	<form method=post action=p-process.php enctype='multipart/form-data'>
	<tr><td width=100 align=right><font size=2>����ڸ�</font></td>
	    <td width=500><input type=text name=wname size=10 style='color:#000080; background-color=ivory; border=1 solid blue; height:20px'></td></tr>
	<tr><td align=right><font size=2>��������</font></td>
		<td><input type=text name=summary size=70 style='color:#000080; background-color=ivory; border=1 solid blue;'></td></tr>
	<tr><td align=right><font size=2>����ȭ��</font></td>
		<td><input type=file name='userfile' size=47 maxlength=80 style='color:#000080; background-color=ivory; border=1 solid blue; height:20px'></td></tr>
	<tr><td align=right><font size=2>�� ȣ</font></td>
		<td><input type=password name=passwd size=15 style='color:#000080; background-color=ivory; border=1 solid blue; height:20px'></td></tr>
	<tr><td colspan=2>&nbsp;</td></tr>
	<tr align=center><td colspan=2><input type=submit value='�������' style='color:#000080; background-color=yellow; border=1 solid brown; height:20px'></tr>
	</table>
");

echo ("</body></html>");

?>
