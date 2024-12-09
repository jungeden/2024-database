<?
session_start();

$userid = $_SESSION['userid'];
$Session = session_id();
$pcode=$_GET['pcode']; 
$page=$_GET['page'];

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
} else {
    $page='productdetail';
    header("Location: loginPage.php?page=$page");
    exit();
}

$con = mysqli_connect("localhost", "root", "0000", "shop");

$islike=$_GET['islike'];
if ($islike == 1) {
    $like=mysqli_query($con,"INSERT INTO likeit(userid, session, pcode) VALUES ('$userid','$Session','$pcode')");
    
    $islike=0;
} else if ($islike == 0){
    $like=mysqli_query($con,"DELETE FROM likeit WHERE userid='$userid' AND pcode='$pcode'");
    $islike=1;
}

mysqli_close($con);
if($page=='shopping') {
    header("Location: shoppingPage.php?islike=" . urlencode($islike));

} else if($page=='productdetail') {
    header("Location: productdetailPage.php?islike=" . urlencode($islike) . "&code=" . urlencode($pcode));

}



?>