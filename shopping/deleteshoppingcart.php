<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}

$con = mysqli_connect("localhost", "root", "0000", "shop");
$pcode = $_GET['pcode'];
$userid = $_GET['userid'];

$delete = mysqli_query($con,"DELETE FROM shoppingcart WHERE pcode='$pcode' and userid='$userid'");

header("Location: shoppingcartPage.php?userid=" . urlencode($userid));

?>