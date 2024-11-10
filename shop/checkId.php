<?
$userid=$_POST['userid'];

if (empty($userid)) {
    echo ("<script>
        window.alert('입력을 확인해주세요');
        history.go(-1);
    </script>");
    exit;
}
$con = mysqli_connect("localhost", "root" , "0000" , "shop");

// echo ("<script>
//     window.alert('입력을 확인해주세요');
//     window.location.href = 'joinPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) . "&username=" . urlencode($username) . "';
// </script>");
// exit;

$inuserid = mysqli_query($con, 'SELECT userid FROM user');

$useridExists = false; 

while ($_POST = mysqli_fetch_assoc($inuserid)) {
    $originuserid = $_POST['userid'];
    if ($originuserid == $userid) {
        $useridExists = true;
        break; 
    }
}

if ($useridExists) {
    $comment = "사용할 수 없는 아이디";
    echo ("<script>
        window.alert('이미 존재하는 아이디 입니다.');
        window.location.href = 'joinPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) . "&comment=" . urlencode($comment) . "';
      
    </script>");
    exit;
} else {
    $comment = "사용할 수 있는 아이디";

    echo ("<script>
        window.alert('사용할 수 있는 아이디 입니다.');
        window.location.href = 'joinPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) .  "&comment=" . urlencode($comment) . "';
    </script>");
    exit;
}

// echo ("<meta http-equiv='Refresh' content='0; url=joinPage.php?userid=$userid'>");



?>