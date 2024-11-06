<?
$con = mysqli_connect("localhost", "root", "0000", "class");
$mbcode = $_GET['mbcode'];

$ibname = $_POST['ibname'];
$ibprice = $_POST['ibprice'];
$ibunit = $_POST['ibunit'];

$sql = "UPDATE mbook SET bname='$ibname', bprice='$ibprice', bunit='$ibunit' WHERE bcode='$mbcode'";
$result = mysqli_query($con, $sql);

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");

?>