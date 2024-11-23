<?
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>");
$board = $_GET['board']; 
$id = $_GET['id']; 
$mode = $_GET['mode'];    


$pass = $_POST['pass']; 

$con = mysqli_connect("localhost", "root", "0000", "class");
$sql = "SELECT passwd from $board WHERE id=$id";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$passwd = $row['passwd'];

if ($pass != $passwd) {
    echo("<script>window.alert('입력 암호가 일치하지 않네요');
    history.go(-1);</script>");
    exit;
} else {
    switch ($mode) {
        case 0:
            echo("<meta http-equiv='Refresh' content='0; url=modify.php?board=$board&id=$id'>");
            break;
        case 1:
            echo("<meta http-equiv='Refresh' content='0; url=delete.php?board=$board&id=$id'>");
            break;
        }
}
mysqli_close($con);


?>