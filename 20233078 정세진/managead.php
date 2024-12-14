<?php
session_start();

$con = mysqli_connect("localhost", "root", "0000", "shop");
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}

$uploadDir = 'ad/'; 
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$uploadedFiles = [];
if (isset($_FILES['adfile']) && count($_FILES['adfile']['name']) > 0) {
    $adfile = $_FILES['adfile'];
    $detailfile = '';

    for ($i = 0; $i < count($adfile['name']); $i++) {
        $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "", basename($adfile['name'][$i]));
        $fileTmpName = $adfile['tmp_name'][$i];
        $fileError = $adfile['error'][$i];

        if ($fileError === UPLOAD_ERR_OK) {
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                $uploadedFiles[] = $fileName;
                $detailfile .= ($detailfile ? ',' : '') . $fileName; 
            } else {
                echo "파일 이동 실패: $fileName<br>";
            }
        } elseif ($fileError !== UPLOAD_ERR_NO_FILE) {
            echo "파일 업로드 중 에러 발생: $fileError<br>";
        }
    }
    
} 
$update = mysqli_query($con, "UPDATE managenotice SET ad='$detailfile' WHERE num='1'");

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=myPagead.php?userid=" . urlencode($userid) . "'>");


?>