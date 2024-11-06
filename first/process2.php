<?php
// POST 데이터 받기
$iname = $_POST['iname'];
$iphone = $_POST['iphone'];
$iaddress = $_POST['iaddress'];

// GET 파라미터에서 mname 받기 (폼 제출 시 전달된 mname을 사용)
$mname = $_GET['mname'];

// var_dump($_POST);

// MySQL 연결
$con = mysqli_connect("localhost", "root", "0000", "class");


// Prepared Statement 사용
$stmt = $con->prepare("UPDATE addressbook SET name = ?, phone = ?, address = ? WHERE name = ?");
$stmt->bind_param("ssss", $iname, $iphone, $iaddress, $mname);

// 실행
$stmt->execute();

// Prepared Statement 종료
$stmt->close();

// MySQL 연결 종료
mysqli_close($con);

// 리다이렉션
echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");
?>
