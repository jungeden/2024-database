<table border=0 width=650>
<form method=post action=p-process.php enctype='multipart/form-data'>
<tr>
<td width=100 align=right>상품분류</td>
<td width=550>
	<select name=class>
	<option value=1>프로그래밍 관련서적</option>
	<option value=2>네트워크 관련서적</option>
	<option value=3>웹디자인 관련서적</option>
	</select>
</td>
</tr>
<tr>
<td align=right>상품코드</td>
<td><input type=text name=code size=20></td>
</tr>
<tr>
<td align=right>상품이름</td>
<td><input type=text name=name size=70></td>
</tr>
<tr>
<td align=right>상품설명</td>
<td><textarea name=content rows=15 cols=75></textarea></td>
</tr>
<tr>
<td align=right>정상가격</td>
<td><input type=text name=price1 size=15>원</td>
</tr>
<tr>
<td align=right>할인가격</td>
<td><input type=text name=price2 size=15>원</td>
</tr>
<tr>
<td align=right>상품사진</td>
<td><input type=file size=30 name=userfile></td>
</tr>
<tr>
<td align=center colspan=5>
<input type=submit value=등록하기></td>
</tr>
</form>
</table>
