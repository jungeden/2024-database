<?

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);
$result = mysql_query("select * from $board order by id", $con);
$total = mysql_num_rows($result);

echo("<table border=0 width=700>
    <tr><td align=center><h1>�ڷ��</h1></td></tr>
    <td align=right>[<a href=pds-input.php?board=$board>�ڷ���</a>]</td> 
	</tr>
    </table>");

if (!$total) {
	echo("<table border=0 width=700>
		<tr><td align=center>���� ��ϵ� �ڷᰡ �����ϴ�</td></tr>
		</table>");
} else {
	echo ("<table border=1 width=700>
	<tr><td width=40 align=center>��ȣ</td>
	<td width=60 align=center>�����</td>
	<td width=280 align=center>Ÿ��Ʋ</td>
	<td width=150 align=center>÷������</td>
	<td width=120 align=center>�����</td>
	<td width=50 align=center>����</td></tr>");

	$counter = 0;

	while ($counter < $total) :
		$id = mysql_result($result, $counter, "id");
		$writer = mysql_result($result, $counter, "writer");
		$title = mysql_result($result, $counter, "title");
		$wdate = mysql_result($result, $counter, "wdate");
		$filename = mysql_result($result, $counter, "filename");
		$fileSize = mysql_result($result, $counter, "filesize");

		// ���� ũ�⸦ 1000���� ������ KBytes ǥ�ø� ����
		if ($fileSize > 1000) {
			$kb_filesize =   (int)($fileSize / 1000);
			$disp_size = $kb_filesize . ' KBytes';
		} else {
			$disp_size = $fileSize . ' Bytes';
		}

		echo ("<tr><td align=center>$id</td>
			<td align=center>$writer</td><td>$title</td>
			<td align=center><a href=./pds/$filename>$filename</a><br> [$disp_size]</td>
			<td align=center>$wdate</td>
			<td align=center><a href=pds-delete.php?board=$board&id=$id>x</a></td></tr>");

		$counter = $counter + 1;

	endwhile;

	echo ("</table>");
}

mysql_close($con);

?>
