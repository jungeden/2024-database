<?php
session_start();

$con = mysqli_connect("localhost", "root", "0000", "shop");
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}

$an=$_POST['content'];

$update  = mysqli_query($con, "UPDATE  managenotice SET an='$an' WHERE num='1'");
// $insert  = mysqli_query($con, "INSERT INTO managenotice (an) VALUES ('$an')");

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=myPage.php?userid=" . urlencode($userid) . "'>");


?>