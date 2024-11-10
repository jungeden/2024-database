<?
$con = mysqli_connect("localhost", "root", "0000", "shop");

$userid = $_POST['userid'];
$userpasswd = $_POST['userpasswd'];
$getpasswd = mysqli_query($con, "SELECT userpasswd FROM user WHERE userid='$userid'");
$_POST = mysqli_fetch_assoc($getpasswd);
$passwd = $_POST['userpasswd'];

$useridExists = false; 

$inuserid = mysqli_query($con,"SELECT userid FROM user");
while ($_POST = mysqli_fetch_assoc($inuserid)) {
    $originuserid = $_POST['userid'];
    if ($originuserid == $userid) {
        $useridExists = true;
        break; 
    } 
}
if (!$useridExists) {
    echo ("<script>
        window.alert('존재하지 않는 아이디 입니다.');
        history.go(-1);
      
    </script>");
    exit;
} 

if($passwd != $userpasswd) {
    echo ("<script>
        window.alert('아이디 혹은 비밀번호가 일치하지 않습니다.');
        window.location.href = 'loginPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) .  "';
    </script>");
    exit;
}


echo ("<meta http-equiv='Refresh' content='0; url=shoppingPage.php?userid=$userid&userpasswd=$userpasswd'>");
?>