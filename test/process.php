<?php
$con = mysqli_connect("localhost", "root", "024120", "class");

// SQL 쿼리 작성
$sql = "INSERT INTO buy (name, price) VALUES ('$_POST[iname]', '$_POST[iprice]')";

mysqli_query($con, $sql);

mysqli_close($con);

// 리다이렉션
echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");
?>