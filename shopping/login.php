<?php
session_start();

$page=$_GET['page'];
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

setcookie('userid', $userid, time() + 3600, "/");
// setcookie('userpasswd', $userpasswd, time() + 3600, "/");

// 세션 변수 설정
$_SESSION['userid'] = $userid;
$_SESSION['userpasswd'] = $userpasswd;

// 세션 식별을 위한 임의의 값 생성 및 쿠키 설정
$session = md5(uniqid(rand()));
setcookie("session_id", $session, 0, "/");

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
        echo ("<meta http-equiv='Refresh' content='0; url=productdetailPage.php?userid=" . urlencode($userid) . "'>");
        break;
    default:
        echo ("<meta http-equiv='Refresh' content='0; url=startPage.php?userid=" . urlencode($userid) . "'>");
        break;

}




mysqli_close($con);
?>
