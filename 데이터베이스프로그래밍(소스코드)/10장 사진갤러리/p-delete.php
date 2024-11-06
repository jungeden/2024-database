<?

if (!$delimage) {
      echo ("<script>
           window.alert('삭제할 사진이 선택되지 않았습니다')
           history.go(-1) 
           </script>
          ");
      exit;
}

echo ("
	<html>
	<head>
	<title>Photo   Gallery(암호 입력)</title>
	<style TYPE='text/css'>
	<!--
	a:link { text-decoration: none;}
		  a:visited { text-decoration: none; }
		  a:hover { text-decoration: underline; color:#0066cc; }
	-->
	</style>
	</head>
	<body>
	<table border=0 width=600 align=center>
	<tr><td align=center><h1>Gallery</h1></font></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td align=center>
	<form method=post action=p-delete2.php?delimage=$delimage>
	<font  size=2 color=red>삭제할 사진의 암호를 입력하세요</font></td></tr>
	<tr><td align=center>
	<br>
	<font size=2 color=#000080>암 호  </font>
	<input type=password   name=delpasswd size=15 style='color:#000080; background-color=ivory; border=1   solid blue; height:20px'>
	<input   type=submit value=입력 style='color:#000080;   background-color=skyblue; border=1 solid blue; height:20px'>
	</form>
	</td></tr>
	<tr><td align=center><font size=2 color=#000080><br>[<a href=p-show.php>돌아가기</a>]</font></td></tr>
	</table>
	</body>
	</html>
");

?>
