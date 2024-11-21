<?php
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $page='my';
    header("Location: loginPage.php?page=$page");
    exit();
}

$con = mysqli_connect("localhost", "root", "0000", "shop");
date_default_timezone_set('Asia/Seoul'); 
$userjoindate = date('Y년 m월 d일');

$getorigininfo = mysqli_query($con,"SELECT * FROM user WHERE userid='$userid'");
$row=mysqli_fetch_assoc($getorigininfo);
$ousername = $row['username'];
$ouserphone = $row['userphone'];
$ouseremail = $row['useremail'];
$ouserbirth = $row['userbirth'];
$ozipcode = $row['zipcode'];
$oaddress1 = $row['address1'];
$oaddress2 = $row['address2'];

$oyear = substr($ouserbirth, 0, 4);
$omonth = substr($ouserbirth, 4, 2);
$odate = substr($ouserbirth, 6, 2);

$username = isset($_POST['username']) ? $_POST['username'] : $ousername;
$userphone = isset($_POST['userphone']) ? $_POST['userphone'] : $ouserphone;
$useremail = isset($_POST['useremail']) ? $_POST['useremail'] : $ouseremail;
$year = isset($_POST['year']) ? $_POST['year'] : $oyear;
$month = isset($_POST['month']) ? $_POST['month'] : $omonth;
$date = isset($_POST['date']) ? $_POST['date'] : $odate;
$zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : $ozipcode;
$address1 = isset($_POST['address1']) ? $_POST['address1'] : $oaddress1;
$address2 = isset($_POST['address2']) ?  $_POST['address2'] : $oaddress2;


$userbirth = $year.$month.$date;

$updateuser = mysqli_query($con, "UPDATE user SET username = '$username', userphone = '$userphone', useremail = '$useremail', userbirth = '$userbirth', zipcode = '$zipcode', address1 = '$address1', address2 = '$address2' WHERE userid = '$userid'");


mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=myPage.php'>");
