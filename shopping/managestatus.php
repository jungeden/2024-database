<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}
$con = mysqli_connect("localhost", "root", "0000", "shop");

$status=$_GET['status'];
$session=$_GET['session'];
$orderuserid=$_GET['orderuserid'];

if($status==3) {
    $status=0;
}
$updatestatus=mysqli_query($con,"UPDATE receivers SET status=$status+1 WHERE userid='$orderuserid' AND session='$session'");
$getstatus=mysqli_query($con, "SELECT status FROM receivers WHERE userid='$orderuserid' AND session='$session'");

$row=mysqli_fetch_assoc($getstatus);
$status=$row['status'];
echo("<script>
console.log($status);
</script>");
mysqli_close($con);
header("Location: manageorderlistPage.php?status=" . urlencode($status));
exit;




?>