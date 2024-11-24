<? //delete.php
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>");
$id=$_GET['id'];
$board = $_GET['board'];

$con = mysqli_connect("localhost", "root", "0000", "class");

$getnum = mysqli_query($con, "SELECT * FROM $board WHERE id='$id'");
$rows=mysqli_fetch_assoc($getnum);
$deleted_num=$rows['num'];

$sql = "DELETE FROM $board WHERE id=$id";
mysqli_query($con, $sql);


$tmp = "SELECT num FROM $board ORDER BY num DESC";
$result = mysqli_query($con, $tmp);
$row = mysqli_fetch_assoc($result);
$last = $row['num'];


// $i = $num +1;
// while($i<$last) {
//     $change="UPDATE $board SET num=num-1 WHERE num=$i";
//     $result=mysqli_query($con, $change);
//     $i++;
// }
// 삭제된 글 뒤에 있는 글들의 num을 1씩 감소
mysqli_query($con, "UPDATE $board SET num = num - 1 WHERE num > '$deleted_num'");

// $getcomment = mysqli_query($con,"SELECT * FROM comment");
// while ($row=mysqli_fetch_assoc($getcomment) && $i<$last) {
//     $updatecomment = mysqli_query($con, "UPDATE comment SET id=id-1 WHERE id=$i ");
//     $i++;
// }
$deleteComments = mysqli_query($con, "DELETE FROM comment WHERE id=$id");

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

echo("<script>window.alert('글이 삭제 되었습니다.');</script>");


echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");
mysqli_close($con);

?>