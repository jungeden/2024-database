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

$userid=$_GET['userid'];

$con = mysqli_connect('localhost','root','0000','shop');
$getemail = mysqli_query($con,"SELECT useremail FROM user WHERE userid='$userid'");
$row=mysqli_fetch_assoc($getemail);
$useremail=$row['useremail'];


$randomNumber1 = rand(100, 999);
$randomNumber2 = rand(100, 999);

$randomNumber = $randomNumber1 . $randomNumber2;

try {

    $mail->isSMTP();                                     
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = '----------@gmail.com'; // 본인 이메일 사용
    $mail->Password = '--------------';    //본인 이메일 앱 비밀번호 사용
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   
    $mail->Port = 587;

    
    $mail->setFrom('---------@gmail.com', 'JAUM'); //본인 이메일 사용
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