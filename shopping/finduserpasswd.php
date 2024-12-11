<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
$userid=$_POST['userid'];
$phone=isset($_POST['phone']) ? $_POST['phone'] : '';
$email=isset($_POST['email']) ? $_POST['email'] : '';
echo("<script>console.log('userid: $userid')</script>");
echo("<script>console.log('phone: $phone')</script>");
echo("<script>console.log('email: $email')</script>");

$con = mysqli_connect('localhost','root','0000','shop');

if (empty($userid)) {
    echo ("<script>
        alert('아이디를 입력해주세요.');
        history.go(-1);
    </script>");
    exit;
}
if (empty($phone) && empty($email)) {
    echo ("<script>
        alert('전화번호 혹은 이메일을 입력해주세요.');
        history.go(-1);
    </script>");
    exit;
}

if(!empty($phone)) {
    $userExists = mysqli_query($con,"SELECT * FROM user WHERE userid='$userid' AND userphone='$phone'");
} else if (!empty($email)) {
    $userExists = mysqli_query($con, "SELECT * FROM user WHERE userid='$userid' AND useremail='$email'");
}

if (mysqli_num_rows($userExists) == 0) {
    echo ("<script>
        alert('존재하지 않는 회원입니다.');
        history.go(-1);
    </script>");
    exit;
} 


mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=findpwemailcheckPage.php?userid=" . urlencode($userid) . "'>");

?>