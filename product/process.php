<? //process.php
$con = mysqli_connect("localhost", "root", "0000", "class");

$ipcode = $_POST['ipcode'];
$ipname = $_POST['ipname'];
$ipprice = $_POST['ipprice'];
$ipunit = $_POST['ipunit'];

$update = "UPDATE product SET pprice=(pprice*punit+$ipprice*$ipunit)/(punit+$ipunit), punit=punit+$ipunit WHERE pcode='$ipcode'";

$result = mysqli_query($con, $update);

if (mysqli_affected_rows($con) == 0) {
    $insert = "INSERT INTO product (pcode, pname, pprice, punit) 
               VALUES ('$ipcode', '$ipname', '$ipprice', '$ipunit')";
    $result = mysqli_query($con, $insert);
}
mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");

?>