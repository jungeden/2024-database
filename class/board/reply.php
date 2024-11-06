<?
$id = $_GET['id'];
$board = $_GET['board'];

$con = mysqli_connect("localhost", "root", "024120", "class");
$sql = "SELECT * from $board WHERE id=$id";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$topic = $row['topic'];
$content = $row['content'];

$topic='[RE]' . $topic;

$pre_content="\n\n\n----------<원본글>----------\n" . $content . "\n";


echo("
    <center><h1>게시판</h1></center>
    <link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');
    a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }
    </style>
    <form method='post' action='rprocess.php?board=$board&id=$id'>
        <table  border='0' style='border-collapse:collapse;' align='center'>
            <tr>
            <td></td>
                <td width='100'  >이름 </td>
                </tr><tr><td></td>
                <td width='400'><input type='text' name='writer' size='60'></td>
            </tr>
            <tr>
            <td></td>
                <td  >Email </td>
                </tr><tr><td></td>
                <td><input type='text' name='email' size='60'></td>
            </tr>
            <tr>
            <td></td>
                <td  >제목 </td>
                </tr><tr><td></td>
                <td><input type='text' name='topic' size='60' value='$topic'></td>
            </tr>
            <tr>
            <td></td>
                <td  >내용 </td>
                </tr><tr><td></td>
                <td><textarea name='content' rows='12' cols='50'>$pre_content</textarea></td>
            </tr>
            <tr>
            <td></td>
                <td  >암호 </td>
                </tr><tr><td></td>
                <td><input type='password' name='pass' size='60'></td>
            </tr>
            <tr>
                <td align='center' colspan='2'>
                    <input type='submit' value='답변 완료'>
                    <input type='reset' value='지우기'>
                </td>
            </tr>
        </table>
    </form>
");



?>