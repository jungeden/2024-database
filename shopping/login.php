<?php
session_start();

$page=$_GET['page'];
$code=$_GET['code'];
$con = mysqli_connect("localhost", "root", "0000", "shop");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$userid = mysqli_real_escape_string($con, $_POST['userid']);
$userpasswd = mysqli_real_escape_string($con, $_POST['userpasswd']);


$useridExistsQuery = "SELECT userpasswd FROM user WHERE userid='$userid'";
$getpasswd = mysqli_query($con, $useridExistsQuery);

if (mysqli_num_rows($getpasswd) == 0) {
    echo ("<script>
        alert('존재하지 않는 아이디입니다.');
        history.go(-1);
    </script>");
    exit;
}

$row = mysqli_fetch_assoc($getpasswd);
$passwd = $row['userpasswd'];

if ($passwd !== $userpasswd) {
    echo ("<script>
        alert('아이디 혹은 비밀번호가 일치하지 않습니다.');
        window.location.href = 'loginPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) .  "';
    </script>");
    exit;
}



$userid = $_POST['userid'];
$userpasswd = $_POST['userpasswd'];

// 세션 변수 설정
$_SESSION['userid'] = $userid;
$_SESSION['userpasswd'] = $userpasswd;

// 사용자 식별을 위한 쿠키 설정 (1시간 동안 유효)
setcookie('userid', $userid, time() + 3600, "/");
// 비밀번호 쿠키는 일반적으로 보안 문제로 저장하지 않는 것이 좋음
// setcookie('userpasswd', $userpasswd, time() + 3600, "/");

// 세션 식별을 위한 임의의 값 생성 및 쿠키 설정
$session_id = md5(uniqid(rand()));
setcookie("user_session", $session_id, 0, "/");

// $Session 변수는 세션의 userid를 참조
$Session = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

// 세션 및 쿠키 확인용 디버깅 출력 (개발 시에만 사용)
// echo "세션 ID: " . session_id() . "<br>";
// echo "세션 변수: " . $Session . "<br>";
// echo "쿠키(user_session): " . (isset($_COOKIE['user_session']) ? $_COOKIE['user_session'] : "설정되지 않음") . "<br>";

// 사용자 장바구니 초기화
mysqli_query($con, "DELETE FROM shoppingcart WHERE userid='$userid'");


//========

switch($page) {
    case 'my':
        echo ("<meta http-equiv='Refresh' content='0; url=shoppingPage.php?userid=" . urlencode($userid) . "'>");
        break;

    case 'shopping':
        echo ("<meta http-equiv='Refresh' content='0; url=shoppingPage.php?userid=" . urlencode($userid) . "'>");
        break;
    case 'productdetail':
        echo ("<meta http-equiv='Refresh' content='0; url=productdetailPage.php?userid=" . urlencode($userid) . "&code=" . urlencode($code) . "'>");
        break;
    default:
        echo ("<meta http-equiv='Refresh' content='0; url=startPage.php?userid=" . urlencode($userid) . "'>");
        break;

}




mysqli_close($con);
?>
