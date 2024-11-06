<? //process2.php
$con = mysqli_connect("localhost", "root", "0000", "class");
date_default_timezone_set('Asia/Seoul'); 

$rdate = date("y-m-d H:i");
$ibcode = $_POST['ibcode'];
$ibunit = $_POST['ibunit'];

$insert = "INSERT INTO rental (bcode, bunit, rdate) VALUES ('$ibcode', '$ibunit', '$rdate')";

// 현재 판매 수량 가져오기
$current_result = mysqli_query($con, "SELECT bunit FROM mbook WHERE bcode='$ibcode'");
$row = mysqli_fetch_assoc($current_result);
$current_bunit = $row['bunit'];

if($current_bunit > $ibunit) {
    $result = mysqli_query($con, $insert);
    $product = "UPDATE mbook SET bunit=bunit-$ibunit WHERE bcode='$ibcode'";
    $result2 = mysqli_query($con, $product);
} else if($current_bunit == $ibunit) {
    $result = mysqli_query($con, $insert);
    $delete = "DELETE from mbook WHERE bcode = '$ibcode'";
    $result2 = mysqli_query($con, $delete);
} 



mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=rental.php'>");

?>