<?
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];

} else {
    $userid='';
}

$userid=$_GET['userid'];
$userpasswd=$_POST['userpasswd'];
$userpasswdcheck=$_POST['userpasswdcheck'];

$con = mysqli_connect('localhost','root','0000','shop');

if($userpasswd == $userpasswdcheck) {
    $updatepasswd = mysqli_query($con, "UPDATE user SET userpasswd='$userpasswd', userpasswdcheck='$userpasswdcheck' WHERE userid='$userid'");
} else {
    echo ("<script>
        alert('비밀번호가 일치하지 않습니다.');
        history.go(-1);
    </script>");
}

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php?finduserid=" . urlencode($finduserid) . "'>");


?>