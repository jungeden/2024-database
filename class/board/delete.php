<?
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');
    </style>");
$id=$_GET['id'];
$board = $_GET['board'];

$con = mysqli_connect("localhost", "root", "024120", "class");
$sql = "DELETE from $board WHERE id=$id";
$result = mysqli_query($con, $sql);

echo("<script>window.alert('글이 삭제 되었습니다.');</script>");

$tmp = "SELECT id from $board order by id desc";
$result = mysqli_query($con, $tmp);
$row = mysqli_fetch_assoc($result);
$last = $row['id'];

$i = $id +1;
while($i<$last) {
    $change="UPDATE $board set id=id-1 WHERE id=$i";
    $result=mysqli_query($con, $change);
    $i++;
}


//------------------
$filedelete = mysqli_query($con, "SELECT fileName FROM boardfile WHERE id = $id");

$row = mysqli_fetch_assoc($filedelete);
$fileName = $row['fileName'];
$passwd = $row['passwd']; 


mysqli_query($con, "DELETE FROM boardfile WHERE id = $id");

// 업로드된 파일 제거
if (file_exists("./files/$fileName")) {
    unlink("./files/$fileName");
}

echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");
mysqli_close($con);

?>