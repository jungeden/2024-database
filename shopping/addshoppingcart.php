<?

session_start();
// $_SESSION['userid'] = 'testuser'; // 세션 값 설정
// var_dump($_SESSION); // 세션 값 확인

$userid = $_SESSION['userid'];
$Session = session_id();

$code=$_GET['code'];  
// $quantity = $_POST['quantity'];
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
// $session = isset($_SESSION['session']) ? $_SESSION['session'] : null;

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
} else {
    $page='shopping';
    header("Location: loginPage.php?page=$page");
    exit();
}





// if($userid=='') {
//     $page='shopping';
//     echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php?page=$page'>");
// }

$con = mysqli_connect("localhost", "root", "0000", "shop");



$updateshoppingcart = mysqli_query($con,"UPDATE shoppingcart SET quantity=quantity+$quantity WHERE session='$Session' and pcode='$code' and userid='$userid'");
if (mysqli_affected_rows($con) == 0) {
    $insertshoppingcart = mysqli_query($con, "INSERT INTO shoppingcart(userid, session, pcode, quantity) VALUES ('$userid', '$Session', '$code', $quantity)");

}

echo "<script>
                localStorage.setItem('cartMessage', '장바구니에 상품이 담겼습니다.');
                window.location.href = 'productdetailPage.php?&code=" . urlencode($code) ."';
              </script>";
// $comment='장바구니에 상품이 담겼습니다.';
// echo ("<meta http-equiv='Refresh' content='0; url=productdetailPage.php?userid=" . urlencode($userid) ."'>");

mysqli_close($con);

// header("Location: productdetailPage.php?userid=" . urlencode($userid). "&comment=" . urlencode($comment) ."&code=" . urlencode($code) );



?>