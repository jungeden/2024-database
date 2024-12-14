<?
session_start();

$userid = $_SESSION['userid'];
$Session = session_id();
$size=$_POST['size'];
$color=$_POST['color'];
$code=$_GET['code'];  
// $quantity = $_POST['quantity'];
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;


if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
} else {
    $page='shopping';
    header("Location: loginPage.php?page=$page");
    exit();
}
if (empty($size) || empty($color)) {
    echo ("<script>
        window.alert('옵션을 선택해주세요');
        window.location.href = 'productdetailPage.php?code=" . urlencode($code) . "&quantity=" . urlencode($quantity) ."';

    </script>");
    exit;
}
// if($userid=='') {
//     $page='shopping';
//     echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php?page=$page'>");
// }

$con = mysqli_connect("localhost", "root", "0000", "shop");

$updateshoppingcart = mysqli_query($con,"UPDATE shoppingcart SET quantity=quantity+$quantity WHERE session='$Session' and pcode='$code' and userid='$userid' and size='$size' and color='$color'");
if (mysqli_affected_rows($con) == 0) {
    $insertshoppingcart = mysqli_query($con, "INSERT INTO shoppingcart(userid, session, pcode, quantity, size, color) VALUES ('$userid', '$Session', '$code', $quantity, '$size', '$color')");

}

echo "<script>
                localStorage.setItem('cartMessage', '장바구니에 상품이 담겼습니다.');
                window.location.href = 'productdetailPage.php?&code=" . urlencode($code) ."';
              </script>";

mysqli_close($con);

?>