<script language='Javascript'>
	function go_zip(){
		window.open('zipcode2.php', 'zipcode',   'width=470, height=180, scrollbars=yes');
	}
</script>

<table width=690 border=0>
<tr><td align=center><font size=3><b>��ǰ ���� �ܰ�</b></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>���� ���� ����   ǰ��</td>
</table>

<?

$con = mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// ��ü ���ι� ���̺��� Ư�� ������� ���� �������� �о��
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=690>
    <tr><td width=100 align=center><font size=2>��ǰ����</td>
	<td width=300 align=center><font size=2>��ǰ�̸�</td>
	<td width=90 align=center><font size=2>����(�ܰ�)</td>
	<td width=50 align=center><font ssize=2>����</td>
	<td width=100 align=center><font size=2>ǰ���հ�</td></tr>
	");

if (!$total) {
     echo("<tr><td colspan=5 align=center><font   size=2><b>���ι鿡 ��� ��ǰ��   �����ϴ�.</b>
        </font></td></tr></table>");
} else {

    $counter=0;
    $totalprice=0;    // �� ���� �ݾ�  

    while ($counter < $total) :
		$pcode = mysql_result($result, $counter, "pcode");
		$quantity = mysql_result($result, $counter, "quantity");
      
		$subresult = mysql_query("select * from product where code='$pcode'", $con);
		$userfile = mysql_result($subresult, 0, "userfile");
		$pname = mysql_result($subresult, 0, "name");
		$price = mysql_result($subresult, 0, "price2");
       
		$subtotalprice = $quantity * $price;
		$totalprice = $totalprice + $subtotalprice; 
	 
		echo("<tr><td align=center><a href=#   onclick=\"window.open('./photo/$userfile', '_new', 'width=450, height=450')\"><img src='./photo/$userfile' width=50 border=0></a></td>
			<td align=left><font size=2><a href=p-show.php?code=$pcode>$pname</a></td>
			<td align=right><font size=2>$price&nbsp;��</td>
			<td align=center><font size=2>$quantity&nbsp;��</td>
			<td align=right><font size=2>$subtotalprice&nbsp;��</td></tr>");

		$counter++;

    endwhile;
 
     echo("<tr><td colspan=5 align=right><font size=2>�� ���� �ݾ�: $totalprice ��</td></tr></table>");
}

mysql_close($con);	//�����ͺ��̽� ��������

echo ("<br>
		<table border=0 width=690>
        <tr><td align=center><font size=2>�Ա� ����: <b>�ϳ����� 595-910154-33707 (������: ȫ�浿)</b><br><br>
		* �����Ͻ� ��ǰ�� �Ա� Ȯ���� ��۵Ǹ�, �ֹ� ���� ��Ȳ�� My Page���� Ȯ���Ͻ� �� �ֽ��ϴ�.<br>
		* ��ǰ ��� ������ �ֹ� ��Ҹ� ���Ͻø� My Page���� ���� �ֹ� ��� ��û�� �Ͻø� �˴ϴ�.<br>
		* ��ǰ�� ��� ������ �Ŀ� ���� ��Ҹ� ���Ͻø� ������(��ȭ:070-8236-4423)�� �����ּ���.
       </td></tr>
       </table>");

echo("
    <br><br>
	<table width=690 border=0>
	<tr><td align=center><font size=3><b>������� �Է�</b></td></tr>
	</table>

	<table width=690 border=0>
	<form method=post action=endshopping.php name=buy>
	<tr><td align=right><font size=2>�޴���</td>
	<td><input type=text name=receiver size=10></td>
	</tr>
	<tr>
	<td align=right><font size=2>��ȭ��ȣ</td>
	<td><input type=text name=phone   size=20></td>
	</tr>
	<tr><td height=30 align=right><font size=2>����ּ�</td>
	<td align=left><input type=text size=6 name=zip readonly=readonly>
	<font size=2>[<a href='javascript:go_zip()'>�����ȣ�˻�</a>]<br>
	<input type=text size=55 name=addr1 readonly=readonly style='font-size:10pt; font-family:Tahoma;'>
	<input type=text size=30 name=addr2   style='font-size:10pt; font-family:Tahoma;'></td>
	<tr><td align=right><font size=2>�ֹ��䱸����</td>
	<td><textarea name=message rows=3 cols=65></textarea></td></tr>
	<tr><td align=center colspan=2>
	<input type=submit value=���ſϷ�></td></tr>
	</table>
	</form>
	</center>
");

?>
