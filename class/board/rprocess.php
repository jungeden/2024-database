<?php
// 변수 초기화 및 유효성 검사
$writer = $_POST['writer'];
$board = $_GET['board'];
$id = $_GET['id'];
$pass = $_POST['paswd'];

$topic = $_POST['topic'];
$content = $_POST['content'];
$email = $_POST['email'];

echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>");


if (!$writer) {
    echo ("
    <script>
        window.alert('이름이 없습니다. 다시 입력하세요.');
        history.go(-1);
    </script>");
    exit;
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "class");


// 답변 글의 깊이를 원본 글보다 1 증가시킴
$result = mysqli_query($con, "SELECT space FROM $board WHERE id=$id");
$row = mysqli_fetch_assoc($result);
$space = $row['space'] + 1;

// 답변 글을 쓴 날짜 저장
$wdate = date("Y-m-d");

// 글의 총 개수를 구하여 글 번호 정리
$tmp = mysqli_query($con, "SELECT id FROM $board");
$total = mysqli_num_rows($tmp);

// 글 번호 정리
while ($total >= $id) {
    mysqli_query($con, "UPDATE $board SET id=id+1 WHERE id=$total");
    $total--;
}

// 답변 글 삽입
$sql = "INSERT INTO $board (id, writer, email, passwd, topic, content, hit, wdate, space) 
        VALUES ('$id', '$writer', '$email', '$pass', '$topic', '$content', 0, '$wdate', $space)";
mysqli_query($con, $sql);

// 데이터베이스 연결 종료
mysqli_close($con);

// 페이지 리디렉션
echo ("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");
?>
