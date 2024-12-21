<? //commentmodify.php

$con = mysqli_connect("localhost", "root", "0000", "class");
$id = $_GET['id']; 
$board = $_GET['board'];

$commentname=$_GET['commentname'];
$date=$_GET['date'];
$commentmessage=$_POST['commentmessage'];

$modifycomment=mysqli_query($con,"UPDATE comment SET message='$commentmessage' WHERE id='$id' AND name='$commentname' AND wdate='$date'");

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");

?>