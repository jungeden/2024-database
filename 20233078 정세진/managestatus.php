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
$randomnum=isset($_GET['randomnum'])?$_GET['randomnum']:'';


if($status==3) {
    $status=0;
}
if(empty($randomnum)) {
    $updatestatus=mysqli_query($con,"UPDATE receivers SET status=$status+1 WHERE userid='$orderuserid' AND session='$session' ");
    $getstatus=mysqli_query($con, "SELECT status FROM receivers WHERE userid='$orderuserid' AND session='$session'");
} else {
    $updatestatus=mysqli_query($con,"UPDATE receivers SET status=$status+1 WHERE userid='$orderuserid' AND session='$session' AND randomnum='$randomnum'");
    $getstatus=mysqli_query($con, "SELECT status FROM receivers WHERE userid='$orderuserid' AND session='$session' AND randomnum='$randomnum'");    
}
$row=mysqli_fetch_assoc($getstatus);
$status=$row['status'];
echo("<script>
console.log($status);
</script>");
mysqli_close($con);
header("Location: manageorderlistPage.php?status=" . urlencode($status));
exit;




?>