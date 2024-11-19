<?
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}

$num = $_GET['num'];
$userid=$_GET['userid'];
$pcode=$_GET['pcode'];
$quantity = $_GET['quantity'];
$con = mysqli_connect("localhost", "root", "0000", "shop");


if ($num=='up') {
    $up = mysqli_query($con, "UPDATE shoppingcart SET quantity=$quantity+1 WHERE userid='$userid' and pcode='$pcode'");
} else if ($num=='down' && $quantity>1) {
    $down = mysqli_query($con, "UPDATE shoppingcart SET quantity=$quantity-1 WHERE userid='$userid' and pcode='$pcode'");
}

mysqli_close($con);
header("Location: shoppingcartPage.php?userid=" . urlencode($userid));
exit;



?>