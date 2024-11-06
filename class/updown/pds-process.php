<?php


$writer = $_POST['writer'];
$title = $_POST['title'];
$passwd = $_POST['passwd'];
$board = $_GET['board'];

$con = mysqli_connect("localhost", "root", "0000", "class");

// 필드 값 가져오기


// 작성자 이름이 비어 있는지 확인
if (!$writer) {
    echo ("
    <script>
    window.alert('이름이 없습니다. 다시 입력해주세요');
    history.go(-1);
    </script>
    ");
    exit;
}

// 제목이 비어 있는지 확인
if (!$title) {
    echo ("
    <script>
    window.alert('타이틀이 없습니다. 다시 입력해주세요');
    history.go(-1);
    </script>
    ");
    exit;
}



$result = mysqli_query($con, "SELECT MAX(id) as max_id FROM updown");
$row = mysqli_fetch_assoc($result);
$total = $row['max_id'] ?? 0; // max_id가 없을 경우 0으로 초기화

// ID 설정
$id = $total + 1; // 다음 ID

$wdate = date("Y-m-d H:i:s");

// 업로드 폴더 설정 및 권한 체크

$savedir = "./pds";
echo realpath($savedir); // 경로를 확인합니다.

if (!file_exists($savedir)) {
    mkdir($savedir, 0777, true); // pds 폴더 생성 및 권한 설정
}

// 파일 업로드 처리
$userfile_name = $_FILES['userfile']['name'];
$userfile_size = $_FILES['userfile']['size'];
$filepath = "$savedir/$userfile_name";

// 업로드 중 오류 발생 여부 확인

// 파일 업로드 시도
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $filepath)) {
    echo "파일이 성공적으로 업로드되었습니다.";
} else {
    echo "파일 업로드에 실패했습니다. 경로와 권한을 확인하세요.";
    exit;
}

// 데이터베이스에 삽입
$insert_query = "INSERT INTO updown (id, writer, passwd, title, wdate, fileName, fileSize) 
                 VALUES ('$id','$writer', '$passwd', '$title', '$wdate', '$userfile_name', '$userfile_size')";

mysqli_query($con, $insert_query);

// 데이터베이스 연결 종료
mysqli_close($con);

// 리디렉션
echo("<meta http-equiv='Refresh' content='0; url=pds-show.php?board=$board'>");
?>




<!-- $con = mysqli_connect("localhost", "root", "0000", "class");
$result = mysqli_query($con,"SELECT id from $board");

$total = mysqli_num_rows($result);

if(!$total) {
    $id = 1;
} else {
    $id = $total+1;
}
$wdate = date("Y-m-d H:i:s");

if($userfile) {
    $savedir ="/.pds";
    $temp = $userfile_name;
    copy($userfile, "$savedir/$temp");
    unlink($userfile);
}
mysqli_query($con,"INSERT into $board(id, writer, passwd, title, wdate, filename, filesize) VALUES($id, '$writer','$passwd', '$title','$wdate', '$userfile_name', '$userfile_size'  ");
mysqli_close($con);

echo("<meta http-equiv='Refresh' content='0; url=pds-show.php?board=$board'>"); -->
