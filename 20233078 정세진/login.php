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


session_unset();
session_destroy();
session_start();
session_regenerate_id(true);

$userid = $_POST['userid'];
$userpasswd = $_POST['userpasswd'];

$_SESSION['userid'] = $userid;
$_SESSION['userpasswd'] = $userpasswd;

setcookie('userid', $userid, time() + 3600, "/");
$session_id = md5(uniqid(rand()));
setcookie("user_session", $session_id, 0, "/");

$Session = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;


mysqli_query($con, "DELETE FROM shoppingcart WHERE userid='$userid'");


//========

switch($page) {
    case 'my':
        echo ("<meta http-equiv='Refresh' content='0; url=startPage.php?userid=" . urlencode($userid) . "'>");
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
