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

$file = mysqli_query($con, "SELECT * FROM product WHERE code='$code'");
$row = mysqli_fetch_assoc($file);

$userfile = trim($row['userfile']);
$detailfiles = explode(',', $row['detailfile']); 

if ($userfile && file_exists("./photo/$userfile")) {
    unlink("./photo/$userfile");
}

foreach ($detailfiles as $detailfile) {
    $detailfile = trim($detailfile); 
    if ($detailfile && file_exists("./uploads/$detailfile")) {
        unlink("./uploads/$detailfile");
    }
}



$deleteproduct=mysqli_query($con, "DELETE FROM product WHERE code='$code'");
$deleteshoppingcart=mysqli_query($con, "DELETE FROM shoppingcart WHERE pcode='$code'");

mysqli_close($con);
header("Location: manageproductsPage.php?userid=" . urlencode($userid));

?>