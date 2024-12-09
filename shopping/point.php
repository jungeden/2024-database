<?
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
// $form_data = $_SESSION['form_data'] ?? [];
$userid = $_SESSION['userid'];

// // 현재 POST 요청 데이터를 병합
// $form_data = array_merge($form_data, $_POST);
// $_SESSION['form_data'] = $form_data;

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

// header("Location: buyPage.php?page=" . urlencode($page) . "&code=" . urlencode($pcode) . "&userpoint=" . urlencode($userpoint));
echo("<script>
history.go(-1)
</script>");



?>