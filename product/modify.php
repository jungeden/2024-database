<? //modify.php
$con = mysqli_connect("localhost", "root", "0000", "class");
$mpcode = isset($_GET['mpcode']) ? $_GET['mpcode'] : '';

$sql = "SELECT * from product WHERE pcode='$mpcode'";

$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

$rows = mysqli_fetch_assoc($result);
$opcode = $rows['pcode'];
$opname = $rows['pname'];
$opprice = $rows['pprice'];
$opunit = $rows['punit'];

echo (" 
<form method=post action=modify2.php?mpcode=$mpcode>
    <tr>상품코드: <td align=center><b>$opcode</b></td> 
    상품이름:<input type=text name=ipname size=10 value='$opname'>
    상품단가:<input type=text name=ipprice size=10 value='$opprice'>
    상품수량:<input type=text name=ipunit size=20 value='$opunit'>
    <input type=submit value=수정완료></form><tr>
    ");
?>