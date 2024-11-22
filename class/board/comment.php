<?
$con = mysqli_connect("localhost", "root", "0000", "class");

// 요청된 ID를 가져옴
$id = $_GET['id']; 
$board = $_GET['board'];
$message = $_POST['commentmessage'];
$name = $_POST['commentwriter'];
$wdate = date("Y-m-d H:i:s");

$insert = "INSERT INTO comment (id, name, wdate, message) VALUES ('$id', '$name', '$wdate', '$message')";
mysqli_query($con, $insert);

echo ("<meta http-equiv='Refresh' content='0; url=content.php?board=$board&id=$id'>");

?>