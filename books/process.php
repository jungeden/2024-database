<?
$con = mysqli_connect("localhost", "root", "0000", "class");

$ibcode = $_POST['ibcode'];
$ibname = $_POST['ibname'];
$ibprice = $_POST['ibprice'];
$ibunit = $_POST['ibunit'];

$insert = "INSERT into mbook(bcode, bname, bprice, bunit) VALUES ('$ibcode', '$ibname', $ibprice, $ibunit)";
$update = "UPDATE mbook SET bprice=(bprice*bunit+$ibprice*$ibunit)/(bunit+$ibunit), bunit=$ibunit+bunit WHERE bcode='$ibcode'";

$result = mysqli_query($con, $update);
if (mysqli_affected_rows($con) == 0) {
    $result = mysqli_query($con, $insert);
}
mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");
?>