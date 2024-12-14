<?
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];

} else {
    $userid='';
}

$userid=$_GET['userid'];
$usercheckcode=$_POST['usercheckcode'];
$checkcode=$_POST['checkcode'];


if (empty($usercheckcode)) {
    echo ("<script>
        alert('인증번호를 입력해주세요.');
        history.go(-1);
    </script>");
    exit;
}

if ($usercheckcode != $checkcode) {
    echo ("<script>
        alert('인증번호가 일치하지 않습니다.');
        history.go(-1);
    </script>");
    exit;
}

if ($usercheckcode == $checkcode) {
echo ("<meta http-equiv='Refresh' content='0; url=findpwchangePage.php?userid=" . urlencode($userid) . "'>");
    
}
?>