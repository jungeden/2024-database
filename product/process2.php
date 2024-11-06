<? //process2.php
$con = mysqli_connect("localhost", "root", "0000", "class");
date_default_timezone_set('Asia/Seoul'); 

$wdate = date("m월 d일 H시 i분");
$ipcode = $_POST['ipcode'];
$ipunit = $_POST['ipunit'];

$insert = "INSERT INTO sales (pcode, punit, wdate) VALUES ('$ipcode', '$ipunit', '$wdate')";

// 현재 판매 수량 가져오기
$current_result = mysqli_query($con, "SELECT punit FROM product WHERE pcode='$ipcode'");
$row = mysqli_fetch_assoc($current_result);
$current_punit = $row['punit'];

if($current_punit > $ipunit) {
    $result = mysqli_query($con, $insert);
    $product = "UPDATE product SET punit=punit-$ipunit WHERE pcode='$ipcode'";
    $result2 = mysqli_query($con, $product);
} else if($current_punit == $ipunit) {
    $result = mysqli_query($con, $insert);
    $delete = "DELETE from product WHERE pcode = '$ipcode'";
    $result2 = mysqli_query($con, $delete);
} 



mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=sales.php'>");

?>