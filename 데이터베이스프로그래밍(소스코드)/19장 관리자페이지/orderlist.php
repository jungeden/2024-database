<?

if ($UserID != 'admin') {
	echo ("<script>
		window.alert('�����ڸ� ���� ������ ����Դϴ�')
		history.go(-1)
		</script>");
    exit;
} 

echo ("<table border=0 width=690>
    <tr><td align=center><font size=3><b>[�ֹ� ���� ��ȸ]</b></td></tr>
    <tr><td align=right><font size=2>[<a href=admin.php>Back</a>]</td>
	</tr></table>");
	  	  
$con = mysql_connect("localhost", "root", "apmsetup");
mysql_select_db("shopmall",   $con);
	
$result = mysql_query("select * from receivers order by buydate desc", $con);
$total = mysql_num_rows($result);

echo (" <table border=1 width=690>
	<tr height=25 valign=center>
	<td align=center width=90><font size=2><b>�ֹ���ȣ</b></td>
	<td width=140 align=center><font size=2><b>�ֹ�����</b></td>
	<td width=300 align=center><font size=2><b>�ֹ�����</b></td>
	<td width=70 align=center><font size=2><b>�ֹ��Ѿ�</b></td>
	<td width=90 align=center><font size=2><b>���º���</b></td></tr>");	

if ($total > 0) {	

	$counter = 0;
		
	while($counter < $total) :

		$session =  mysql_result($result, $counter, "session");
		$buydate = mysql_result($result, $counter, "buydate");
		$ordernum = mysql_result($result, $counter, "ordernum");
		$status = mysql_result($result, $counter, "status");
			 
		switch ($status) {
			case 1:
				$tstatus = "�ֹ���û";
				break;
			case 2:
				$tstatus = "�ֹ�����";
				break;
			case 3: 
				$tstatus = "����غ���";
				break;
			case 4:
				$tstatus = "�����";
				break;
			case 5:
				$tstatus = "��ۿϷ�";
				break;
			case 6:
				$tstatus = "���ſϷ�";
				break;
		}
		  
		$subresult = mysql_query("select * from orderlist where session='$session'",   $con);
		$subtotal = mysql_num_rows($subresult);

		$subcounter=0;
		$totalprice=0;

		while ($subcounter < $subtotal) :
			$pcode = mysql_result($subresult, $subcounter, "pcode");
			$quantity = mysql_result($subresult, $subcounter, "quantity");
			$tmpresult = mysql_query("select * from product where code='$pcode'", $con);
			$pname = mysql_result($tmpresult, 0, "name");
			$price = mysql_result($tmpresult, 0, "price2");
		   
			$subtotalprice = $quantity * $price;
			$totalprice = $totalprice + $subtotalprice;
			$subcounter++;
		endwhile;
		
		$items = $subtotal - 1;
		
		echo ("<tr><td align=center><a href=#   onclick=\"window.open('detailview.php?ordernum=$ordernum', '_new', 'width=940, height=250, scrollbars=yes');\"><font size=2>$ordernum</a></td>
			<td align=center><font size=2>$buydate</td>
			<td><font size=2>$pname �� $items ��</td>
			<td align=right><font size=2>$totalprice ��</td>
			<td align=center><font size=2>");
		if ($status < 6) { 
			echo ("<a href=changestatus.php?ordernum=$ordernum> <b>$tstatus</b></a></td></tr>");
		} else {
		  echo ("<b>$tstatus</b></td></tr>");
		}
		
		$counter++;

	endwhile;

} else {
       echo ("<tr><td align=center colspan=5><font size=2><b>�ֹ� ������ �������� �ʽ��ϴ�</b></td></tr>");
}

echo ("</table>");

mysql_close($con);

?>
