<?

$con=mysql_connect("localhost","root","apmsetup");
mysql_select_db("comma",$con);

// 해당 게시물의 모든 내용을 읽어들임
$result=mysql_query("select * from $board where id=$id",$con);

$topic=mysql_result($result,0,"topic");
$content=mysql_result($result,0,"content");

$topic="[Re]" .  $topic;  // 원본 글 제목 앞에   "[Re]" 글자를 추가 

// 원본 글 본문의 앞뒤에 구분자 표시
$pre_content=   "\n\n\n--------------< 원본글 >-------------\n" . $content . "\n";	

// 답변 글 입력 폼
echo("
	<center><h1>게시판</h1></center>
	<form method=post   action=rprocess.php?board=$board&id=$id>
	<table width=700 border=0>
	<tr>
	<td width=100 align=right>이름 </td>
	<td width=600><input   type=text name=writer size=20></td>
	</tr>
	<tr>
	<td align=right>Email </td>
	<td><input type=text name=email size=40></td>
	</tr>
	<tr>
	<td align=right>제목 </td>
	<td><input type=text name=topic size=60 value='$topic'></td>
	</tr>
	<tr>
	<td align=right>내용 </td>
	<td><textarea name=content rows=12 cols=60>$pre_content</textarea> </td>
	</tr>
	<tr>
	<td align=right>암호 </td>
	<td><input type=password name=passwd size=15></td>
	</tr>
	<tr>
	<td align=center colspan=2>
	<input type=submit value=답변완료>
	<input type=reset value=지우기></td>
	</tr>
	</table>
	</form>
");

mysql_close($con);

?>
