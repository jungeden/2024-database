<? //delete.php
$dpcode = $_GET['dpcode'];

$con = mysqli_connect("localhost", "root", "0000", "class");
$sql = "DELETE from product WHERE pcode = '$dpcode'";

$result = mysqli_query($con, $sql);
$total = mysqli_affected_rows($con);

mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");

?>