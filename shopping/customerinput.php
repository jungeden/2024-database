<?
session_start();

$con = mysqli_connect("localhost", "root", "0000", "shop");

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}
$content = $_POST['content'];
$issecret = isset($_POST['issecret']) ? $_POST['issecret'] : 'n';
$topic = $_POST['topic'];
$class = $_POST['class'];

if (empty($topic)) {
    echo ("<script>
        window.alert('제목을 입력해주세요');
        history.go(-1);
    </script>");
    exit;
}
if (empty($class)) {
    echo ("<script>
        window.alert('문의 유형을 선택해주세요');
        history.go(-1);
    </script>");
    exit;
}
if (empty($content)) {
    echo ("<script>
        window.alert('내용을 입력해주세요);
        history.go(-1);
    </script>");
    exit;
}
$uploadDir = 'customerfiles/'; 
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$customerboardfile = $_FILES['customerboardfile'];

if (isset($_FILES['customerboardfile']) && is_array($_FILES['customerboardfile']['name'])) {
    $customerboardfile = $_FILES['customerboardfile'];
    $customerfile = ''; // 파일명 저장용

    for ($i = 0; $i < count($customerboardfile['name']); $i++) {
        $fileName = basename($customerboardfile['name'][$i]);
        $fileTmpName = $customerboardfile['tmp_name'][$i];
        $fileError = $customerboardfile['error'][$i];

        if ($fileError === UPLOAD_ERR_OK) {
            $targetFilePath = $uploadDir . '/' . $fileName;

            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                $uploadedFiles[] = $fileName; // 업로드된 파일명 저장
            } else {
                echo "파일 이동 실패: $fileName<br>";
            }

            if ($customerfile != '') {
                $customerfile .= ','; // 콤마로 구분
            }
            $customerfile .= $fileName;
        } else {
            // echo "파일 업로드 중 에러 발생: $fileError<br>";
        }
    }
}

$result = mysqli_query($con, "SELECT num FROM customerboard");
$total = mysqli_num_rows($result);

$num = ($total == 0) ? 1 : $total + 1;  

$wdate = date("Y-m-d");

$insertboard = mysqli_query($con, "INSERT INTO customerboard (num, userid, topic, content, hit, wdate, space, parentid, customerfile, class, issecret) 
        VALUES ('$num', '$userid', '$topic', '$content', 0, '$wdate', 0, NULL, '$customerfile', '$class' , '$issecret')");



mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=customerPage.php?userid=" . urlencode($userid) . "'>");

?>