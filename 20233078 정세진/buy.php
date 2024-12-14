<?php
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
$Session = session_id();


// 폼 데이터 가져오기
$receiver = $_POST['receiver'];
$phone = $_POST['phone'];
$zipcode = $_POST['zipcode'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$message = $_POST['message'];
$payment = $_POST['payment'];

$totalprice = $_POST['totalprice'];

$userpoint = $_POST['userpoint'] ?? 0;

if (empty($receiver)) {
    echo ("<script>
        window.alert('받는 사람을 입력해주세요.');
        window.location.href = 'buyPage.php?page=shoppingcart';
    </script>");
    exit();
}
if (empty($phone)) {
    echo ("<script>
        window.alert('전화 번호를 입력해주세요.');
        window.location.href = 'buyPage.php?page=shoppingcart';
    </script>");
    exit();
}
if (empty($zipcode)) {
    echo ("<script>
        window.alert('배송지를 입력해주세요.');
        window.location.href = 'buyPage.php?page=shoppingcart';
    </script>");
    exit();
}
if (empty($payment)) {
    echo ("<script>
        window.alert('결제수단을 입력해주세요.');
        window.location.href = 'buyPage.php?page=shoppingcart';
    </script>");
    exit();
}
$randomnum = rand(1000, 9999);

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

$insertreceiver = mysqli_query($con, "INSERT INTO receivers (userid, session, receiver, phone, address, message, buydate, ordernum, status, payment, randomnum, totalprice) VALUES ('$userid','$Session', '$receiver', '$phone', '$address', '$message', '$buydate', '$ordernum', '$status', '$payment','$randomnum', '$totalprice')");

$getshoppingcart = mysqli_query($con, "SELECT * FROM shoppingcart WHERE userid ='$userid'");
while($row=mysqli_fetch_assoc($getshoppingcart)) {
    $pcode=$row['pcode'];
    $quantity=$row['quantity'];
    $color=$row['color'];
    $size=$row['size'];
    $insertorderlist=mysqli_query($con,"INSERT INTO orderlist (userid, session, pcode, quantity, size, color, randomnum) VALUES ('$userid', '$Session', '$pcode', '$quantity', '$size', '$color','$randomnum')");
}

$deleteshoppingcart = mysqli_query($con, "DELETE FROM shoppingcart WHERE userid='$userid'");


if($userpoint != 0) {
    $usepoint = mysqli_query($con, "UPDATE user SET point=point-$userpoint WHERE userid='$userid'");
    $getpoint = mysqli_query($con, "SELECT point FROM user WHERE userid='$userid'");
    $pointrow=mysqli_fetch_assoc($getpoint);
    $rpoint=$pointrow['point'];

    $insertusepoint = mysqli_query($con, "INSERT INTO pointlist (userid, pmpoint, pm, udate, resultpoint) VALUES ('$userid', '$userpoint','-','$buydate','$rpoint') ");
}



$pluspoint = $totalprice*0.01;
if($pluspoint > 5000) {
    $pluspoint = 5000;
}
echo("<script>console.log('pluspoint: ', $pluspoint)</script>");
echo("<script>console.log('totalprice: ', $totalprice)</script>");
$addpoint = mysqli_query($con,"UPDATE user SET point=point+$pluspoint WHERE userid='$userid'");
$getpoint = mysqli_query($con, "SELECT point FROM user WHERE userid='$userid'");
$pointrow=mysqli_fetch_assoc($getpoint);
$rpoint=$pointrow['point'];

$insertaddpoint = mysqli_query($con, "INSERT INTO pointlist (userid, pmpoint, pm, udate, resultpoint) VALUES ('$userid', '$pluspoint','+','$buydate','$rpoint') ");


mysqli_close($con);

echo ("<script>
    window.alert('구매가 완료되었습니다. \\n 주문번호: $ordernum \\n 포인트 적립: $pluspoint');");
    echo("window.location.href = 'orderlistPage.php?userid=" . urlencode($userid) . "';");
    echo("
</script>");
?>
