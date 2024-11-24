<? //commentdelete.php

$con = mysqli_connect("localhost", "root", "0000", "class");
$id = $_GET['id']; 
$board = $_GET['board'];

$commentname=$_GET['commentname'];
$date=$_GET['date'];
$commentmessage=$_GET['commentmessage'];

$deletecomment=mysqli_query($con,"DELETE FROM comment WHERE message='$commentmessage' AND id='$id' AND name='$commentname' AND wdate='$date'");


mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");

?>