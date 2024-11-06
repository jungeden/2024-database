<?php
    date_default_timezone_set('Asia/Seoul'); 

function check($message) {
    echo ("
    <script>
    window.alert(\"$message\");
    history.go(-1);
    </script>
    ");
    exit;
}

// POST 요청으로 받은 데이터 초기화
$wname = isset($_POST['wname']) ? $_POST['wname'] : '';
$wmemo = isset($_POST['wmemo']) ? $_POST['wmemo'] : '';

// 변수 $wname과 $wmemo가 비어 있는지 확인합니다.
if (!$wname) check("이름을 입력하세요");
if (!$wmemo) check("내용을 입력하세요");

$con = mysqli_connect("localhost", "root", "0000", "class");

// 데이터베이스에 값 삽입
$wdate = date("Y-m-d H:i:s"); // 날짜 형식 설정
$sql = "INSERT INTO memojang (name, wdate, message) VALUES ('$wname', '$wdate', '$wmemo')";
$result = mysqli_query($con, $sql);

if ($result) {
    echo ("<meta http-equiv='Refresh' content='0; url=memoshow.php'>");
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
