<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}

$con = mysqli_connect("localhost", "root", "0000", "shop");
$duserid=$_GET['duserid'];

$deleteuser=mysqli_query($con, "DELETE FROM user WHERE userid='$duserid'");

mysqli_close($con);
header("Location: manageaccountsPage.php?userid=" . urlencode($userid));

?>