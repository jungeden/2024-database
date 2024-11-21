<?
session_start();

$con = mysqli_connect("localhost", "root", "0000", "shop");
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}
$code=$_GET['code'];

$deleteproduct=mysqli_query($con, "DELETE FROM product WHERE code='$code'");
$deleteshoppingcart=mysqli_query($con, "DELETE FROM shoppingcart WHERE pcode='$code'");

mysqli_close($con);
header("Location: manageproductsPage.php?userid=" . urlencode($userid));

?>