<?
session_start();


// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}

$id=$_GET['id'];

$con = mysqli_connect("localhost","root", "0000", "shop");

$getinfo = mysqli_query($con, "SELECT * FROM customerboard WHERE id=$id");
$row=mysqli_fetch_assoc($getinfo);
$otopic=$row['topic'];
$ocontent=$row['content'];
$ocustomerfile=$row['customerfile'];
$oclass=$row['class'];
$oissecret=$row['issecret'];

$topic=isset($_POST['topic']) ? $_POST['topic'] : $otopic;
$content=isset($_POST['content']) ? $_POST['content'] : $ocontent;
$class=isset($_POST['class']) ? $_POST['class'] : $oclass;
$issecret=isset($_POST['issecret']) ? $_POST['issecret'] : $oissecret;


$uploadedFiles = [];
if (isset($_FILES['customerfile']) && count($_FILES['customerfile']['name']) > 0) {
    $customerfile = $_FILES['customerfile'];
    $detailfile = '';

    for ($i = 0; $i < count($customerfile['name']); $i++) {
        $fileName = preg_replace("/[^a-zA-Z0-9\._-]/", "", basename($detailuserfile['name'][$i]));
        $fileTmpName = $customerfile['tmp_name'][$i];
        $fileError = $customerfile['error'][$i];

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

    
    if (empty($uploadedFiles)) {
        $detailfile = $ocustomerfile;
    }
} else {
    $detailfile = $ocustomerfile; 
}
$updatecustomerboard = mysqli_query($con, "UPDATE customerboard SET topic='$topic', class='$class', content='$content', issecret='$issecret', customerfile='$detailfile' WHERE id='$id'");
mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=customerboarddetailPage.php?id=$id'>");
?>
