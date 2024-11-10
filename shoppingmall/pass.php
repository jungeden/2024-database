<?
$userid=$_GET['userid'];
$page=$_GET['page'];
$userpasswd=$_POST['userpasswd'];
$con = mysqli_connect("localhost", "root", "0000", "shop");

$getpasswd = mysqli_query($con, "SELECT * FROM user WHERE userid='$userid'");
$row = mysqli_fetch_assoc($getpasswd);
$passwd = $row['userpasswd'];
$username = $row['username'];
$userphone = $row['userphone'];
$useremail = $row['useremail'];
$userbirth = $row['userbirth'];
$userjoindate = $row['userjoindate'];
$zipcode = $row['zipcode'];
$address1 = $row['address1'];
$address2 = $row['address2'];
$approved = $row['approved'];

if($passwd != $userpasswd) {
    echo ("<script>
        window.alert('비밀번호가 일치하지 않습니다.');
        window.location.href = 'passPage.php?userid=" . urlencode($userid) . "&page=" . urlencode($page) .  "';
    </script>");
    exit;
}

switch($page) {
    case 'usermodify':
        echo ("<meta http-equiv='Refresh' content='0; url=modifyuserPage.php?userid=$userid&userpasswd=$userpasswd&username=$username&userphone=$userphone&useremail=$useremail&userbirth=$userbirth&userjoindate=$userjoindate&zipcode=$zipcode&address1=$address1&address2=$address2&approved=$approved'>");
        break;
    case 'passwdmodify':
        echo ("<meta http-equiv='Refresh' content='0; url=modifypasswdPage.php?userid=$userid&userpasswd=$userpasswd'>");
        break;
}


?>