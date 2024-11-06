<?
$con = mysqli_connect("localhost", "root", "0000", "class");
$dbcode = $_GET['dbcode'];

$sql = "DELETE from mbook WHERE bcode='$dbcode'";
$result = mysqli_query($con, $sql);

mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=input.php'>");


?>