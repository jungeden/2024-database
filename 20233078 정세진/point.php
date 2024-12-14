<?
session_start(); 

if (isset($_COOKIE['userid'])) {
    $_SESSION['userid'] = $_COOKIE['userid'];
} else {
    $page = 'productdetail';
    $code = $_GET['code'];
    header("Location: loginPage.php?page=$page&code=$code");
    exit();
}

$userid = $_SESSION['userid'];



$userpoint = $_POST['userpoint'];
$page=$_GET['page'];
$code=$_GET['code'];
$con = mysqli_connect("localhost", "root", "0000", "shop");

$getpoint = mysqli_query($con,"SELECT * FROM user WHERE userid='$userid'");
$row=mysqli_fetch_assoc($getpoint);
$point=$row['point'];

if($userpoint>$point) {
    echo ("<script>
        const point = $point;
        window.alert('사용 가능한 포인트 : '+ point);
        window.location.href = 'buyPage.php?page=shoppingcart';
    </script>");
    exit();
}
mysqli_close($con);

header("Location: buyPage.php?page=" . urlencode($page) . "&code=" . urlencode($pcode) . "&userpoint=" . urlencode($userpoint));




?>