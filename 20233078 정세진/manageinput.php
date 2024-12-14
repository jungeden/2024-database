<?php
session_start();

$con = mysqli_connect("localhost", "root", "0000", "shop");
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}
$code=$_POST['code'];
$class=$_POST['class'];
$name=$_POST['name'];
$price1=$_POST['price1'];
$price2=isset($_POST['price2'])?$_POST['price2']:0;
$content=$_POST['content'];
$size = $_POST['size'];
$color = $_POST['color'];


$userfile = $_FILES['userfile'];

if (isset($userfile['name'])) {
    $userfile_name = basename($userfile['name']);
    $savedir = "./photo";

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

$uploadDir = 'uploads/'; 
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}


$detailuserfile = $_FILES['detailuserfile'];

if (isset($_FILES['detailuserfile']) && is_array($_FILES['detailuserfile']['name'])) {
    $detailuserfile = $_FILES['detailuserfile'];
    $detailfile = ''; 

    for ($i = 0; $i < count($detailuserfile['name']); $i++) {
        $fileName = basename($detailuserfile['name'][$i]);
        $fileTmpName = $detailuserfile['tmp_name'][$i];
        $fileError = $detailuserfile['error'][$i];

        if ($fileError === UPLOAD_ERR_OK) {
            $targetFilePath = $uploadDir . '/' . $fileName;

            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                $uploadedFiles[] = $fileName; 
            } else {
                echo "파일 이동 실패: $fileName<br>";
            }

            if ($detailfile != '') {
                $detailfile .= ','; 
            }
            $detailfile .= $fileName;
        } else {
            echo "파일 업로드 중 에러 발생: $fileError<br>";
        }
    }
}

if (!empty($uploadedFiles)) {
    echo "업로드된 파일들: " . implode(', ', $uploadedFiles) . "<br>";
} else {
    echo "파일이 업로드되지 않았습니다.<br>";
}





$query = "SELECT COUNT(*) FROM product WHERE code = '$code'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
if ($row[0] > 0) {
    echo "이 상품코드가 이미 존재합니다. 다른 코드를 사용하세요.";
    exit;
}



$inputproducts  = mysqli_query($con, "INSERT INTO product(class, code, name, content, price1, price2, userfile, hit, detailfile, size, color) VALUES ($class, '$code', '$name', '$content', '$price1', '$price2', '$userfile_name', 1, '$detailfile', '$size', '$color')");
var_dump($_FILES['detailuserfile']);

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=manageproductsPage.php?userid=" . urlencode($userid) . "'>");


?>
