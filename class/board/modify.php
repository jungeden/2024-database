<?
$board = $_GET['board']; 
$id = $_GET['id']; 


$con = mysqli_connect("localhost", "root", "024120", "class");
$sql = "SELECT * from $board WHERE id = $id";
$fileupload = "SELECT * from boardfile WHERE id = $id";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);
$writer = $row['writer'];
$topic = $row['topic'];
$content = $row['content'];
$email = $row['email'];
$passwd = $row['passwd'];


$file = mysqli_query($con, $fileupload);

if (!$file || mysqli_num_rows($file) == 0) {
    $fileName = null;
} else {
    $files = [];
    while ($filerow = mysqli_fetch_assoc($file)) {
        $fileName = htmlspecialchars($filerow['fileName']);
        $fileSize = $filerow['fileSize'];
    // 파일 정보를 배열에 추가
        $files[] = ["name" => $fileName];
    }
}


echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');
    
    </style>
    <style type='text/css'>
    a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }

</style>
<center><h1>게시판</h1></center>
<form method=post action=mprocess.php?board=$board&id=$id&passwd=$passwd enctype='multipart/form-data'>
<table border=0 align='center'>
<tr>
<td></td>
<td width=100 style='padding-bottom: 0px;' >이름</td>
 </tr><tr><td></td>
<td width=400 width='400'style='padding-top: 0px;'><input type=text name=writer size=60 value='$writer' style='margin-bottom: 3px;'></td>
</tr>
<tr>
<td></td>
<td style='padding-bottom: 0px;'>Email</td>
 </tr><tr><td></td>
<td width='400'style='padding-top: 0px;'><input type=text name=email size=60 value='$email' style='margin-bottom: 3px;'></td>
</tr>
<tr>
<td></td>
<td style='padding-bottom: 0px;'>제목</td>
 </tr><tr><td></td>
<td width='400'style='padding-top: 0px;'><input type=text name=topic size=60 value='$topic' style='margin-bottom: 3px;'></td>
</tr>
<tr>
<td></td>
<td style='padding-bottom: 0px;'>내용</td>
 </tr><tr><td></td>
<td width='400'style='padding-top: 0px;'><textarea name=content rows=12 cols=50>$content</textarea style='margin-bottom: 3px;'></td>
</tr>");


if($fileName) {
    echo("<tr>
         <td></td>
            <td style='padding-bottom: 0px;'>첨부 파일 <a href='filedelete.php?board=$board&id=$id'>[삭제]</a> ");
            if (!empty($files)) {
            
                foreach ($files as $file) {
                    echo "<br><a href='./files/{$file['name']}'>{$file['name']}</a> ";
                }
            }
            
            
             
            echo("</td>
            </tr><tr><td></td>
            <td style='padding-top: 0px;'><input type='file' name='userfile' size='45' maxlength='80' style='margin-bottom: 3px;'></td>
        </tr>");
} else {
    
echo("
<tr>
         <td></td>
            <td style='padding-bottom: 0px;'>첨부 파일    </td>
            </tr><tr><td></td>
            <td style='padding-top: 0px;'><input type='file' name='userfile' size='45' maxlength='80' style='margin-bottom: 3px;'></td>
        </tr>
");
}

echo("<tr>
<td></td>
<td style='padding-bottom: 0px;'>암호</td>
 </tr><tr><td></td>
<td width='400'style='padding-top: 0px;'><input type=password name=passwd size=60 style='margin-bottom: 3px;'></td>
</tr>


<tr>
<td align=center colspan=2>
<input type=submit value=수정완료>
<input type=reset value=지우기></td>
</tr>
</table>
</form>
");
mysqli_close($con);
?>