<?
session_start();
$code=$_GET['code'];
$session=$_GET['session'];
// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
$con = mysqli_connect("localhost","root", "0000", "shop");

$deletereview = mysqli_query($con, "DELETE FROM review WHERE userid='$userid' AND session='$session' AND pcode='$code'");


mysqli_close($con);
header("Location: productdetailPage.php?code=" . urlencode($code));

?>