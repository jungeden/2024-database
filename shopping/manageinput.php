<?php
session_start();

$con = mysqli_connect("localhost", "root", "0000", "shop");
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
$code=$_POST['code'];
$class=$_POST['class'];
$name=$_POST['name'];
$price1=$_POST['price1'];
$content=$_POST=['content'];
$price2 = isset($_POST['price2']) && $_POST['price2'] !== '' ? str_replace(",", "", $_POST['price2']) : 0;


$userfile = $_FILES['userfile'];

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

$query = "SELECT COUNT(*) FROM product WHERE code = '$code'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
if ($row[0] > 0) {
    echo "이 상품코드가 이미 존재합니다. 다른 코드를 사용하세요.";
    exit;
}



$inputproducts  = mysqli_query($con, "INSERT INTO product(class, code, name, content, price1, price2, userfile, hit) VALUES ($class, '$code', '$name', '$content', '$price1', '$price2', '$userfile_name', 1)");


echo ("<meta http-equiv='Refresh' content='0; url=manageproductsPage.php?userid=" . urlencode($userid) . "'>");

mysqli_close($con);
?>
