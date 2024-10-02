<?php
$con = mysqli_connect("localhost", "root", "024120", "class");

// SQL 쿼리 작성
$sql = "INSERT INTO userJoin (userIdJoin, userPasswordJoin, userPasswordAgainJoin, userNameJoin, userPhoneJoin, userEmailJoin, userBirthJoin ) VALUES ('$_POST[iuserIdJoin]', '$_POST[iuserPasswordJoin]', '$_POST[iuserPasswordAgainJoin]', '$_POST[iuserNameJoin]', '$_POST[iuserPhoneJoin]', '$_POST[iuserEmailJoin]', '$_POST[iuserBirthJoin]')";

mysqli_query($con, $sql);

mysqli_close($con);

// 리다이렉션
echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php'>");
?>