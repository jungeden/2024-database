<? //rprocess.php
// 변수 초기화 및 유효성 검사
$writer = $_POST['writer'];
$board = $_GET['board'];
$id = $_GET['id'];
$pass = $_POST['pass'];
$topic = $_POST['topic'];
$content = $_POST['content'];
$email = $_POST['email'];

echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>");

// 입력값 확인
if (empty($writer)) {
    echo ("<script>
        window.alert('이름이 없습니다. 다시 입력하세요.');
        history.go(-1);
    </script>");
    exit;
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "class");

// 부모 글의 `space` 값 가져오기
$result = mysqli_query($con, "SELECT num, space FROM $board WHERE id=$id");
if (!$result || mysqli_num_rows($result) == 0) {
    echo ("<script>
        window.alert('부모 글이 존재하지 않습니다.');
        history.go(-1);
    </script>");
    exit;
}

$row = mysqli_fetch_assoc($result);
$parent_num = $row['num'];
$space = $row['space'] + 1; // 부모 글의 들여쓰기 +1

// 답변 글의 깊이를 원본 글보다 1 증가시킴


// 답변 글을 쓴 날짜 저장
$wdate = date("Y-m-d");
// $tmp = mysqli_query($con, "SELECT num FROM $board");
// $total = mysqli_num_rows($tmp);
// $row = mysqli_fetch_assoc($tmp);
// $num = $row['num'];
// 글 번호 정리
// while ($total >= $num) {
//     mysqli_query($con, "UPDATE $board SET num=num+1 WHERE num='$total'");
//     $total--;
// }



// 부모 글보다 크거나 같은 num 값을 1씩 증가
mysqli_query($con, "UPDATE $board SET num = num + 1 WHERE num >= '$parent_num'");


$new_num = $parent_num;

// `num` 정리: 부모 글보다 작은 `num`을 1씩 증가
// mysqli_query($con, "UPDATE $board SET num = num + 1 WHERE num <= '$parent_num'");



// 답변 글 삽입

$sql = "INSERT INTO $board (num, parentid, writer, email, passwd, topic, content, hit, wdate, space) 
        VALUES ('$new_num', '$id', '$writer', '$email', '$pass', '$topic', '$content', 0, '$wdate', '$space')";

if (!mysqli_query($con, $sql)) {
    echo "Error: " . mysqli_error($con);
    exit;
}

// 데이터베이스 연결 종료
mysqli_close($con);

// 페이지 리디렉션
echo ("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");
?>
