<?php
$con = mysqli_connect("localhost", "root", "0000", "class");

// SQL 쿼리 작성
// $sql = "INSERT INTO addressbook (iname, iphone, iaddress) VALUES ('$_POST[iname]', '$_POST[iphone]', '$_POST[iaddress]')";
$sql = "INSERT INTO addressbook (name, phone, address) VALUES ('$_POST[iname]', '$_POST[iphone]', '$_POST[iaddress]')";

mysqli_query($con, $sql);

mysqli_close($con);

// 리다이렉션
echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");
?>