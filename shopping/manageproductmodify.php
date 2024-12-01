<?
session_start();

$con = mysqli_connect("localhost", "root", "0000", "shop");
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}
$code=$_GET['code'];
$getproduct = mysqli_query($con, "SELECT * FROM product WHERE code='$code'");
$row=mysqli_fetch_assoc($getproduct);
$oname=$row['name'];
$oclass=$row['class'];
$ocontent=$row['content'];
$oprice1=$row['price1'];
$oprice2=isset($row['price2']) ? $row['price2'] : '';
$ouserfile=$row['userfile'];
$odetailfile=$row['detailfile'];
$osize=$row['size'];
$ocolor=$row['color'];

$name = isset($_POST['name']) ? $_POST['name'] : $oname;
$class = isset($_POST['class']) ? $_POST['class'] : $oclass;
$content = isset($_POST['content']) ? $_POST['content'] : $ocontent;
$price1 = isset($_POST['price1']) ? $_POST['price1'] : $oprice1;
$price2 = isset($_POST['price2']) ? $_POST['price2'] : $oprice2;
$size = isset($_POST['size']) ? $_POST['size'] : $osize;
$color = isset($_POST['color']) ? $_POST['color'] : $ocolor;
// 업로드된 파일 정보
if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] === UPLOAD_ERR_OK) {
    $userfile = $_FILES['userfile'];
    $userfile_name = basename($userfile['name']);
    $savedir = "./photo";

    // 파일 이름에 공백이나 특수문자 방지 (파일 이름을 안전하게 처리)
    $userfile_name = preg_replace("/[^a-zA-Z0-9\._-]/", "", $userfile_name);

    // 파일 업로드 처리
    if (move_uploaded_file($userfile['tmp_name'], "$savedir/$userfile_name")) {
        echo "파일 업로드 성공!";
    } else {
        echo "파일 업로드 실패!";
    }
} else {
    // 업로드된 파일이 없을 경우 기존 파일 사용
    $userfile_name = $ouserfile; // 기존 파일명을 그대로 사용
}

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$uploadedFiles = [];
if (isset($_FILES['detailuserfile']) && count($_FILES['detailuserfile']['name']) > 0) {
    $detailuserfile = $_FILES['detailuserfile'];
    $detailfile = '';

    for ($i = 0; $i < count($detailuserfile['name']); $i++) {
        $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "", basename($detailuserfile['name'][$i]));
        $fileTmpName = $detailuserfile['tmp_name'][$i];
        $fileError = $detailuserfile['error'][$i];

        if ($fileError === UPLOAD_ERR_OK) {
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                $uploadedFiles[] = $fileName;
                $detailfile .= ($detailfile ? ',' : '') . $fileName; // 파일 이름 연결
            } else {
                echo "파일 이동 실패: $fileName<br>";
            }
        } elseif ($fileError !== UPLOAD_ERR_NO_FILE) {
            echo "파일 업로드 중 에러 발생: $fileError<br>";
        }
    }

    // 파일이 없는 경우 기존 데이터 유지
    if (empty($uploadedFiles)) {
        $detailfile = $odetailfile;
    }
} else {
    $detailfile = $odetailfile; // 파일이 업로드되지 않으면 기존 데이터 유지
}

$updateproduct = mysqli_query($con, "UPDATE product SET name='$name', class='$class', content='$content', price1='$price1', price2='$price2', userfile='$userfile_name', detailfile='$detailfile', size='$size', color='$color' WHERE code='$code'");



mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=manageproductsPage.php'>");

// header("Location: manageproductsPage.php?userid=" . urlencode($userid));

?>