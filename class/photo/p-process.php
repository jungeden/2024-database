<?php
$wname = $_POST['wname'];
$summary = $_POST['summary'];
$passwd = $_POST['passwd'];
// 입력 유효성 검사
if (!$wname){
    echo("
        <script>
        window.alert('작성자를 입력해주세요');
        history.go(-1);
        </script>
    ");
    exit;
}

if (!$summary){
    echo("
        <script>
        window.alert('사진 설명을 입력해 주세요');
        history.go(-1);
        </script>
    ");
    exit;
}

if ($_FILES['userfile']['error'] == UPLOAD_ERR_NO_FILE) {
    echo("
        <script>
        window.alert('업로드할 파일을 선택해주세요');
        history.go(-1);
        </script>
    ");
    exit;
}

// 업로드 날짜 설정
$wdate = date("Y-m-d");

// 파일 업로드 처리
$savedir = "./photo";
$userfile_name = $_FILES['userfile']['name'];
$filepath = "$savedir/$userfile_name";

// 디렉토리 생성
if (!file_exists($savedir)) {
    mkdir($savedir, 0777, true);
}

// 파일 중복 확인 및 복사
if (file_exists($filepath)) {
    echo("
        <script>
        window.alert('같은 이름의 파일이 이미 존재합니다.');
        history.go(-1);
        </script>
    ");
    exit;
} else {
    move_uploaded_file($_FILES['userfile']['tmp_name'], $filepath);
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "class");

if (!$con) {
    die("데이터베이스 연결 실패: " . mysqli_connect_error());
}

// 데이터베이스에 데이터 삽입
$query = "INSERT INTO photo (wname, summary, wdate, userfile, passwd) VALUES ('$wname', '$summary', '$wdate', '$userfile_name', '$passwd')";
$result = mysqli_query($con, $query);

mysqli_close($con); // 데이터베이스 연결 종료

// 결과 확인
if (!$result) {
    echo("
        <script>
        window.alert('글 저장에 실패하였습니다.');
        history.go(-1);
        </script>
    ");
    exit;
} else {
    echo("
        <script>
        window.alert('글 저장이 완료되었습니다.');
        </script>
    ");
    echo ("<meta http-equiv='Refresh' content='0; url=p-show.php'>");
}
?>
