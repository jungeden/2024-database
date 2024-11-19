<?php
session_start(); // 세션 시작




// 쿠키에서 가져오기 (있을 경우)
if (isset($_COOKIE['userid'])) {
    $_SESSION['userid'] = $_COOKIE['userid'];
} else {
    // 로그인 페이지로 리다이렉트
    $page = 'productdetail';
    $code = $_GET['code'];
    header("Location: loginPage.php?page=$page&code=$code");
    exit();
}
$userid = $_SESSION['userid'];
$Session = session_id();
 // 세션에서 사용자 ID 가져오기

// 폼 데이터 가져오기
$receiver = $_POST['receiver'];
$phone = $_POST['phone'];
$zipcode = $_POST['zipcode'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$message = $_POST['message'];
$payment = $_POST['payment'];

// 유효성 검사
if (empty($receiver)) {
    echo ("<script>
        window.alert('받는 사람을 입력해주세요.');
        window.location.href = 'buyPage.php';
    </script>");
    exit();
}
if (empty($phone)) {
    echo ("<script>
        window.alert('전화 번호를 입력해주세요.');
        window.location.href = 'buyPage.php';
    </script>");
    exit();
}
if (empty($zipcode)) {
    echo ("<script>
        window.alert('배송지를 입력해주세요.');
        window.location.href = 'buyPage.php';
    </script>");
    exit();
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "shop");
date_default_timezone_set('Asia/Seoul'); 
$buydate = date("Y.m.d H:i:s");
$ordernum = substr($buydate, 5, 2) . substr($buydate, 8, 2) . " - " . strtoupper(substr($userid, 0, 2))
    . " - " . strtoupper(substr($Session, 0, 4)). " - " . rand(1000, 9999);
$status = 1;
$address = "(" . $zipcode . ") " . $address1 . " " . $address2;

if ($payment == 'pay1') {
    $payment = '신용/체크 카드';
} elseif ($payment == 'pay2') {
    $payment = '간편결제';
} else {
    $payment = '무통장입금';
}

$insertreceiver = mysqli_query($con, "INSERT INTO receivers (userid, session, receiver, phone, address, message, buydate, ordernum, status, payment) VALUES ('$userid','$Session', '$receiver', '$phone', '$address', '$message', '$buydate', '$ordernum', '$status', '$payment')");

$getshoppingcart = mysqli_query($con, "SELECT pcode, quantity FROM shoppingcart WHERE userid ='$userid'");
while($row=mysqli_fetch_assoc($getshoppingcart)) {
    $pcode=$row['pcode'];
    $quantity=$row['quantity'];
    $insertorderlist=mysqli_query($con,"INSERT INTO orderlist (userid, session, pcode, quantity) VALUES ('$userid', '$Session', '$pcode', '$quantity')");
}

$deleteshoppingcart = mysqli_query($con, "DELETE FROM shoppingcart WHERE userid='$userid'");

mysqli_close($con);

// 완료 메시지 출력
echo ("<script>
    window.alert('구매가 완료되었습니다. \\n 주문번호: $ordernum');
    window.location.href = 'orderlistPage.php?userid=" . urlencode($userid) . "';
</script>");
?>
