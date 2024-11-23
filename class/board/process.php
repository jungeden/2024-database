<?php
// POST 요청으로부터 값 가져오기
$writer = $_POST['writer'];
$topic = $_POST['topic'];
// $content = htmlspecialchars($_POST['content']);
$content = $_POST['content'];
$email = $_POST['email'];
$passwd = $_POST['passwd'];  
$board = $_GET['board'];
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>");
// 입력 값 유효성 검사
if (empty($writer)) {
    echo ("<script>
        window.alert('이름이 없습니다. 다시 입력하세요.');
        history.go(-1);
    </script>");
    exit;
}

if (empty($topic)) {
    echo ("<script>
        window.alert('제목이 없습니다. 다시 입력하세요.');
        history.go(-1);
    </script>");
    exit;
}

if (empty($content)) {
    echo ("<script>
        window.alert('내용이 없습니다. 다시 입력하세요.');
        history.go(-1);
    </script>");
    exit;
}

// 데이터베이스에 연결
$con = mysqli_connect("localhost", "root", "0000", "class");


// 글에 대한 ID 부여
// $result = mysqli_query($con, "SELECT id FROM $board");
// $total = mysqli_num_rows($result);

// $id = ($total == 0) ? 1 : $total + 1;  // ID 부여

$wdate = date("Y-m-d");

// 데이터 삽입
$sql = "INSERT INTO $board (writer, email, passwd, topic, content, hit, wdate, space) 
        VALUES ('$writer', '$email', '$passwd', '$topic', '$content', 0, '$wdate', 0)";

if (!mysqli_query($con, $sql)) {
    echo "Error: " . mysqli_error($con);
}

//-----------------------------------------


// 업로드 폴더 설정 및 권한 체크

$savedir = "./files";
echo realpath($savedir); 

if (!file_exists($savedir)) {
    mkdir($savedir, 0777, true); 
}

// 파일 업로드 처리
$userfile_name = $_FILES['userfile']['name'];
$userfile_size = $_FILES['userfile']['size'];
$filepath = "$savedir/$userfile_name";

// 업로드 중 오류 발생 여부 확인
if(!empty($userfile_name)) {
    move_uploaded_file($_FILES['userfile']['tmp_name'], $filepath);
} else {
    // $userfile_name='';
    // $userfile_size='';
}
// 파일 업로드 시도
// if () {
//     echo "파일이 성공적으로 업로드되었습니다.";
// } else {
//     // echo "파일 업로드에 실패했습니다. 경로와 권한을 확인하세요.";
//     // exit;
// }

// 데이터베이스에 삽입
$insert_query = "INSERT INTO boardfile (id, writer, passwd, title, wdate, fileName, fileSize) 
                 VALUES ('$id','$writer', '$passwd', '$title', '$wdate', '$userfile_name', '$userfile_size')";

mysqli_query($con, $insert_query);

// 데이터베이스 연결 종료
mysqli_close($con);

// 리디렉션
// header("Location: show.php?board=$board");
echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board&id=$id'>");
exit;
?>