<?php
$con = mysqli_connect("localhost", "root", "0000", "shop");
date_default_timezone_set('Asia/Seoul'); 
$userjoindate = date('Y년 m월 d일');
$userid = $_GET['userid'];
$userpasswd = $_POST['userpasswd'];
$userpasswdcheck = $_POST['userpasswdcheck'];
$username = $_POST['username'];
$userphone = $_POST['userphone'];
$useremail = $_POST['useremail'];
$userbirth = $_POST['userbirth'];



if (empty($userpasswd) || empty($userpasswdcheck) || empty($username) || empty($userphone) ||empty($useremail) ||empty($userbirth)) {
    echo ("<script>
        window.alert('입력을 확인해주세요');
                window.location.href = 'joinPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) . "&userpasswdcheck=" . urlencode($userpasswdcheck) ."&username=" . urlencode($username) ."&userphone=" . urlencode($userphone) ."&useremail=" . urlencode($useremail) ."';

    </script>");
    exit;
}
if ($userid == '') {
    echo ("<script>
        window.alert('아이디 중복확인 해주세요');
        window.location.href = 'joinPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) . "&userpasswdcheck=" . urlencode($userpasswdcheck) ."&username=" . urlencode($username) ."&userphone=" . urlencode($userphone) ."&useremail=" . urlencode($useremail) ."';

    </script>");
    exit;
}
if($userpasswd != $userpasswdcheck) {
    $comment2 = "일치하지 않는 비밀번호";
    echo ("<script>
        window.alert('비밀번호를 확인해주세요');
        window.location.href = 'joinPage.php?userid=" . urlencode($userid) . "&userpasswd=" . urlencode($userpasswd) . "&comment2=" . urlencode($comment2) . "&userpasswdcheck=" . urlencode($userpasswdcheck) ."&username=" . urlencode($username) ."&userphone=" . urlencode($userphone) ."&useremail=" . urlencode($useremail) ."';
    </script>");
    exit;
}


// SQL 쿼리 작성
$insertSql = "INSERT INTO user (userid, userpasswd, userpasswdcheck, username, userphone, useremail, userbirth, userjoindate) VALUES ('$_GET[userid]', '$_POST[userpasswd]', '$_POST[userpasswdcheck]', '$_POST[username]', '$_POST[userphone]', '$_POST[useremail]', '$_POST[userbirth]', '$userjoindate')";
mysqli_query($con, $insertSql);

//비밀번호 확인 일치하는지 확인

mysqli_close($con);

// 리다이렉션
echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php?userid=$userid&userpasswd=$userpasswd'>");
?>