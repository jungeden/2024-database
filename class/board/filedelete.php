<?
$con = mysqli_connect("localhost", "root", "024120", "class");

$id = $_GET['id'];
$board = $_GET['board'];
$result = mysqli_query($con, "SELECT fileName FROM boardfile WHERE id = $id");

$row = mysqli_fetch_assoc($result);
$fileName = $row['fileName'];
$passwd = $row['passwd']; 


mysqli_query($con, "DELETE FROM boardfile WHERE id = $id");

// 업로드된 파일 제거
if (file_exists("./files/$fileName")) {
    unlink("./files/$fileName");
}
mysqli_close($con);

echo("<meta http-equiv='Refresh' content='0; url=modify.php?board=$board&id=$id'>");

?>