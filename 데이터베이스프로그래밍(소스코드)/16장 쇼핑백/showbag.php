<?
if (!isset($UserID)) {
	echo ("<script>
		window.alert('�α��� ����ڸ� �̿��Ͻ� �� �־��')
		history.go(-1)
		</script>");
	exit;
}
?>

<table width=690 border=0>
<tr><td align=center><font size=3><b>���� īƮ</b></td></tr>
<tr><td align=right><font size=2><b><? echo $UserName; ?></b>���� ���� ���� īƮ ����</td>
</table>

<?
$con =   mysql_connect("localhost","root","apmsetup");
mysql_select_db("shopmall",$con);

// ��ü ���ι� ���̺��� Ư�� ������� ���� �������� �о��
$result = mysql_query("select * from shoppingbag where session='$Session'", $con);
$total = mysql_num_rows($result);

echo ("
	<table border=1 width=690>
    <tr><td width=100 align=center><font size=2>��ǰ����</td>
	<td width=300 align=center><font size=2>��ǰ�̸�</td>
	<td width=90 align=center><font size=2>����(�ܰ�)</td>
	<td width=50 align=center><font size=2>����</td>
	<td width=100 align=center><font size=2>ǰ���հ�</td>
	<td width=50 align=center><font size=2>����</td></tr>
");

if (!$total) {
     echo("<tr><td colspan=6 align=center><font size=2>���ι鿡 ��� ��ǰ�� �����ϴ�.</td></tr></table>");
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

		echo ("<tr><td align=center>
			<a href=# onclick=\"window.open('./photo/$userfile', '_new', 'width=450,   height=450')\"><img src='./photo/$userfile' width=50   border=0></a></td>
			<td align=left><font size=2><a   href=p-show.php?code=$pcode>$pname </a></td>
			<td align=right><font size=2>$price&nbsp;��</td>
			<td align=center>
			<form method=post action=qmodify.php?pcode=$pcode><input type=text name=newnum size=3 value=$quantity>&nbsp;<input type=submit value=����>
			</td></form>
			<td align=right><font size=2>$subtotalprice&nbsp;��</td>
			<td align=center>
			<form method=post action=itemdelete.php?pcode=$pcode><input type=submit value=����></td></form>
			</tr>");

		$counter++;
    endwhile;
 	
     echo("<tr><td colspan=6 align=right><font size=2>�� ���� �ݾ�: $totalprice ��</td></tr></table>");

}

mysql_close($con);	//�����ͺ��̽� ��������

echo ("<table width=690 border=0>
	<tr><td align=center><font size=2>[<a href=buy.php>���Ű���</a>] &nbsp; [<a href=p-list.php>���ΰ��</a>]</td></tr></table>");

?>
