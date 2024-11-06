<?php
$con = mysqli_connect("localhost", "root", "0000", "shop");
date_default_timezone_set('Asia/Seoul'); 
$userjoindate = date('Y-m-d H:i:s');
$userid = $_POST['userid'];
$userpasswd = $_POST['userpasswd'];
// SQL 쿼리 작성
$insertSql = "INSERT INTO user (userid, userpasswd, userpasswdcheck, username, userphone, useremail, userbirth, userjoindate) VALUES ('$_POST[userid]', '$_POST[userpasswd]', '$_POST[userpasswdcheck]', '$_POST[username]', '$_POST[userphone]', '$_POST[useremail]', '$_POST[userbirth]', '$userjoindate')";
mysqli_query($con, $insertSql);


mysqli_close($con);

// 리다이렉션
echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php?userid=$userid&userpasswd=$userpasswd'>");
?>