<?

if (!$answer)   {
	echo ("
		<script>
		window.alert('���� �׸��� ������ �ּ���');
		history.go(-1);
		</script>
		");
	exit;
}

$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("comma", $con);
$result = mysql_query("select * from poll", $con);
$total = mysql_num_rows($result);

if (!$total) {
	$ans1=0;
	$ans2=0;
	$ans3=0;
	$ans4=0;
	mysql_query("insert into poll values ($ans1, $ans2, $ans3,   $ans4)", $con);
} else {
	$ans1 = mysql_result($result, 0, "ans1");
	$ans2 = mysql_result($result, 0, "ans2");
	$ans3 = mysql_result($result, 0, "ans3");
	$ans4 = mysql_result($result, 0, "ans4");
}

switch ($answer) {
	case 1:
		$ans1++;
		break;
	case 2:
		$ans2++;
		break;
	case 3:
		$ans3++;
		break;
	case 4:
		$ans4++;
		break;
}

mysql_query("update poll set ans1=$ans1, ans2=$ans2, ans3=$ans3, ans4=$ans4", $con);

$total = $ans1 + $ans2 + $ans3 + $ans4;

$ans1rate=  (int)(($ans1 / $total) * 100);     // �����ϴ� ����(�����)
$ans1width= (int)(($ans1 / $total) * 300);    // �׸� ����׷��� ����
$ans2rate=  (int)(($ans2 / $total) * 100);
$ans2width= (int)(($ans2 / $total) * 300);
$ans3rate=  (int)(($ans3 / $total) * 100);
$ans3width= (int)(($ans3 / $total) * 300);
$ans4rate= (int)(($ans4   / $total) * 100);
$ans4width= (int)(($ans4 / $total) * 300);

echo ("<table border=1 width=600>
	<tr><td align=center colspan=4>���� ���� ���(�� ������ �� : $total ��)</td></tr>
	<tr><td>�׸�</td><td>�����ڼ�</td><td>����(%)</td><td width=300>����׷���</td></tr>
	<tr><td>�ͽ��÷η�</td><td>$ans1</td><td>$ans1rate</td>
	<td align=left><hr size=4 color=red width=$ans1width></td></tr>
	<tr><td>����ũ��</td><td>$ans2</td><td>$ans2rate</td><td   align=left><hr size=4 color=blue width=$ans2width></td></tr>
	<tr><td>���̾�����</td><td>$ans3</td><td>$ans3rate</td>
	<td align=left><hr size=4 color=brown width=$ans3width></td> 
	</tr>
	<tr><td>��Ÿ</td><td>$ans4</td><td>$ans4rate</td>
	<td align=left><hr size=4 color=green width=$ans4width></td>
	</tr>
");
echo ("</table>");
mysql_close($con);

?>
