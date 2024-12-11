<?
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];

} else {
    $userid='';
}
// $page = isset($_GET['page']) ? $_GET['page'] : '';
// $code = isset($_GET['code']) ? $_GET['code'] : '';
$userid=$_GET['userid'];

$con = mysqli_connect('localhost','root','0000','shop');
$getemail = mysqli_query($con,"SELECT useremail FROM user WHERE userid='$userid'");
$row=mysqli_fetch_assoc($getemail);
$useremail=$row['useremail'];

// $to = $useremail; 
// $subject = "ZAUM 비밀번호 인증 코드"; 
$randomNumber1 = rand(100, 999);
$randomNumber2 = rand(100, 999);
// $message = "ZAUM 비밀번호 인증 코드입니다.\n\n $randomNumber1  $randomNumber2 \n\n 인증번호 입력란에 입력해주세요."; 
// // $headers = "From: sender@example.com\r\n"; 
$randomNumber = $randomNumber1 . $randomNumber2;

// if (mail($to, $subject, $message)) {
//     echo "이메일이 성공적으로 전송되었습니다.";
//     echo("<script>console.log('$randomNumber, $useremail')</script>");
// } else {
//     echo "이메일 전송에 실패했습니다.";
// }
try {
    // 서버 설정
    $mail->isSMTP();                                     
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'eden.wooj120@gmail.com'; 
    $mail->Password = 'vbwz zipz kefd logs';    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
    $mail->Port = 587;

    
    $mail->setFrom('eden.wooj120@gmail.com', 'JAUM');
    $mail->addAddress($useremail, $userid);

   
    $mail->isHTML(true);
    $mail->Subject = 'ZAUM 비밀번호 인증 코드';
    $mail->Body    = "<b>ZAUM 비밀번호 인증 코드: $randomNumber1 $randomNumber2</b><br>인증번호 입력란에 입력해주세요.";
    $mail->AltBody = "ZAUM 비밀번호 인증 코드: $randomNumber1 $randomNumber2\n인증번호 입력란에 입력해주세요.";

    
    $mail->send();
    echo '성공';
    echo("<script>$randomNumber</script>");
} catch (Exception $e) {
    echo "실패 Mailer Error: {$mail->ErrorInfo}";
}

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=findpwemailcheckPage.php?userid=" . urlencode($userid) . "&checkcode=" . urldecode($randomNumber) . "'>");

?>