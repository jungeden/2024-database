<?php
// 데이터베이스에 연결
$con = mysqli_connect("localhost", "root", "0000", "class");



// URL에서 ID와 board를 가져오고 POST 요청에서 비밀번호를 가져옴
$id = $_GET['id'];
$board = $_GET['board'];
$password = $_POST['passwd']; // 비밀번호 필드 이름으로 가정

// 주어진 ID와 관련된 파일 이름과 비밀번호를 가져오는 쿼리 준비 및 실행
$stmt = mysqli_prepare($con, "SELECT filename, passwd FROM updown WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// 연관 배열로 데이터 가져오기
$row = mysqli_fetch_assoc($result);



$filename = $row['filename'];
$dbPassword = $row['password']; // 데이터베이스에 저장된 비밀번호

// 입력된 비밀번호가 저장된 비밀번호와 일치하는지 확인
if ($password != $dbPassword) {
    echo "<script>
            window.alert('암호가 일치하지 않습니다');
            history.go(-1);
          </script>";
    exit;
} else {
    // 게시판에서 레코드 삭제
    mysqli_query($con, "DELETE FROM updown WHERE id = $id");

    // 업로드된 파일 제거
    if (file_exists("./pds/$filename")) {
        unlink("./pds/$filename");
    }

    // 사용자에게 알리고 리디렉션
    echo "<script>
            window.alert('자료가 삭제되었습니다.');
          </script>";

    // 나머지 레코드의 ID 조정
    $result = mysqli_query($con, "SELECT id FROM updown ORDER BY id DESC");
    $last = mysqli_num_rows($result);

    $i = $id + 1; // 다음 ID부터 시작
    while ($i <= $last) {
        mysqli_query($con, "UPDATE updown SET id = id - 1 WHERE id = $i");
        $i++;
    }

    // 게시판 목록으로 리디렉션
    echo "<meta http-equiv='Refresh' content='0; url=pds-show.php?board=updown'>";
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
