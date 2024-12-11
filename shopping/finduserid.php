<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
$name=$_POST['name'];
$phone=isset($_POST['phone']) ? $_POST['phone'] : '';
$email=isset($_POST['email']) ? $_POST['email'] : '';
echo("<script>console.log('name: $name')</script>");
echo("<script>console.log('phone: $phone')</script>");
echo("<script>console.log('email: $email')</script>");

$con = mysqli_connect('localhost','root','0000','shop');

if (empty($name)) {
    echo ("<script>
        alert('이름을 입력해주세요.');
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
    $userExists = mysqli_query($con,"SELECT * FROM user WHERE username='$name' AND userphone='$phone'");
} else if (!empty($email)) {
    $userExists = mysqli_query($con, "SELECT * FROM user WHERE username='$name' AND useremail='$email'");
}

if (mysqli_num_rows($userExists) == 0) {
    echo ("<script>
        alert('존재하지 않는 회원입니다.');
        history.go(-1);
    </script>");
    exit;
} else {
    $row=mysqli_fetch_assoc($userExists);
    $finduserid=$row['userid'];
    echo("<script>console.log('finduserid: $finduserid')</script>");

}


mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=findresultPage.php?finduserid=" . urlencode($finduserid) . "'>");

?>