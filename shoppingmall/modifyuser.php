<?
$userid=$_GET['userid'];
$username=$_POST['username'];
$useremail=$_POST['useremail'];
$userphone=$_POST['userphone'];

// $zipcode=$_POST['zipcode'];
// $address1 = $_POST['address1'];
// $address2 = $_POST['address2'];
// $approved = $_POST['approved'];

$con = mysqli_connect("localhost", "root", "0000", "shop");
$userinfo=mysqli_query($con, "SELECT * from user WHERE userid='$userid'");
$row = mysqli_fetch_assoc($userinfo);

$ousername = $row['username'];
$ouserphone = $row['userphone'];
$ouseremail = $row['useremail'];
$ouserbirth = $row['userbirth'];
$ouserjoindate = $row['userjoindate'];
$ozipcode = $row['zipcode'];
$oaddress1 = $row['address1'];
$oaddress2 = $row['address2'];
$approved = $row['approved'];

if ($username=='') {
    $username=$ousername;
}
if ($userphone=='') {
    $userphone=$ouserphone;
}
if ($useremail=='') {
    $useremail=$ouseremail;
}
// zipcode='$zipcode', address1='$address1', address2='$address2', approved='$approved'

$usermodify=mysqli_query($con, "UPDATE user SET username='$username', userphone='$userphone', useremail='$useremail' WHERE userid='$userid'");
mysqli_close($con);


echo ("<meta http-equiv='Refresh' content='0; url=myPage.php?userid=$userid'>");




?>