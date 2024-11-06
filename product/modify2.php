<? //modify2.php
$ipname = $_POST['ipname'];
$ipprice = $_POST['ipprice'];
$ipunit = $_POST['ipunit'];

$mpcode = $_GET['mpcode'];

$con = mysqli_connect("localhost", "root", "0000", "class");
$sql = "UPDATE product SET pname='$ipname', pprice='$ipprice', punit='$ipunit' WHERE pcode='$mpcode'";


$result = mysqli_query($con, $sql);
// $total = mysqli_affected_rows($con);

// 연결 종료
$con->close();

echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");

?>