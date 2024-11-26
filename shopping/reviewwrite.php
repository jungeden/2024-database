<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}
$con = mysqli_connect("localhost", "root", "0000", "shop");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['star'])) {
        $star = $_POST['star'];
        echo "Star value received: $star";
    } else {
        echo "Star value is not set!";
    }
}




$pcode=$_GET['pcode'];
date_default_timezone_set('Asia/Seoul'); 
$wdate=date('Y년 m월 d일');
$star = $_POST['star'];
$content = $_POST['content'];
$userfile = $_FILES['userfile'];
var_dump($_POST);


if (isset($userfile['name'])) {
    $userfile_name = basename($userfile['name']);
    $savedir = "./photo";

    // 파일 이름에 공백이나 특수문자 방지 (파일 이름을 안전하게 처리)
    $userfile_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $userfile_name);

    if (!file_exists("$savedir/$userfile_name")) {
        // 파일 업로드
        if (move_uploaded_file($userfile['tmp_name'], "$savedir/$userfile_name")) {
            echo "파일 업로드 성공!";
        } else {
            echo "파일 업로드 실패!";
        }
    }
}


$insertreview = mysqli_query($con,"INSERT INTO review(pcode, userid, wdate, star, content, userfile) VALUES ('$pcode', '$userid', '$wdate', '$star', '$content','$userfile_name')");

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=productdetailPage.php?code=$pcode'>");

?>