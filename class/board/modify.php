<? //modify.php
$board = $_GET['board']; 
$id = $_GET['id']; 


$con = mysqli_connect("localhost", "root", "0000", "class");
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
<head>
<link rel='stylesheet' href='style.css'>
<link href='https://cdn.quilljs.com/1.3.6/quill.snow.css' rel='stylesheet'>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    
    </style>
    <style type='text/css'>
    a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }

</style>
    <script src='https://cdn.quilljs.com/1.3.6/quill.min.js'></script>

<center><h1>게시판</h1></center>
<form method=post action=mprocess.php?board=$board&id=$id&passwd=$passwd enctype='multipart/form-data'>
<table border=0 align='center'>
<tr>
<td></td>
<td width=100 style='padding-bottom: 0px;' >이름</td>
 </tr><tr><td></td>
<td width=400 width='400'style='padding-top: 0px;'><input class='input input2' type=text name=writer size=60 value='$writer' style='margin-bottom: 3px;'></td>
</tr>
<tr>
<td></td>
<td style='padding-bottom: 0px;'>Email</td>
 </tr><tr><td></td>
<td width='400'style='padding-top: 0px;'><input class='input input2' type=text name=email size=60 value='$email' style='margin-bottom: 3px;'></td>
</tr>
<tr>
<td></td>
<td style='padding-bottom: 0px;'>제목</td>
 </tr><tr><td></td>
<td width='400'style='padding-top: 0px;'><input class='input input2' type=text name=topic size=60 value='$topic' style='margin-bottom: 3px;'></td>
</tr>
<tr>
<td></td>
<td style='padding-bottom: 0px;'>암호</td>
 </tr><tr><td></td>
<td width='400'style='padding-top: 0px;'><input class='input input2' type=password name=passwd size=60 style='margin-bottom: 3px;'></td>
</tr>

<tr>
<td></td>
<td colspan='2'>
            <table>
                <tr><td>내용</td></tr>
                <tr>
                    <td>
                        <div id='editor' >$content</div>
                        <textarea name='content'  class='input input1 content' hidden></textarea>
                    </td>
                </tr>");


if($fileName) {
    echo("
    <tr>
         
            <td style='padding-bottom: 0px;'><div class='filebox'><a class='atext h'>첨부 파일&nbsp;&nbsp;</a> 
            <a class='atext h' href='filedelete.php?board=$board&id=$id'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='20px' viewBox='0 -960 960 960' width='20px' fill='#faebd7'><path class='icon' d='M277.37-111.87q-37.78 0-64.39-26.61t-26.61-64.39v-514.5h-45.5v-91H354.5v-45.5h250.52v45.5h214.11v91h-45.5v514.5q0 37.78-26.61 64.39t-64.39 26.61H277.37Zm405.26-605.5H277.37v514.5h405.26v-514.5ZM355.7-280.24h85.5v-360h-85.5v360Zm163.1 0h85.5v-360h-85.5v360ZM277.37-717.37v514.5-514.5Z'/></svg>

            </a> ");
            if (!empty($files)) {
            
                foreach ($files as $file) {
                    echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;<a class='atext' href='./files/{$file['name']}'>{$file['name']}</a> ";
                }
            }
            
            
             
            echo("</div></td>
            <tr>
                    <td>
                        <div class='files'>
                            <label for='file-upload' class='input input1 file'>파일 선택</label>
                            <input type='file' id='file-upload' class='file-input input input1' name='userfile'>
                        </div>
                    </td>
                </tr>
            </table>");
} else {
    
echo("
<tr><td><div class='filebox'><a class='atext h'>첨부 파일</a></td></tr>
                <tr>
                    <td>
                        <div class='files'>
                            <label for='file-upload' class='input input1 file'>파일 선택</label>
                            <input type='file' id='file-upload' class='file-input input input1' name='userfile'>
                        </div>
                        </div>
                    </td>
                </tr>
            </table>
");
}

echo("


<tr>
<td align=center colspan=2>
<input class='button button1' type=submit value=수정완료>
<input class='button button1' type=reset value=지우기></td>
</tr>
</table>
</form>

<script>
    // Quill 에디터 설정
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], 
        ['blockquote', 'code-block'],            
        [{ 'header': 1 }, { 'header': 2 }],      
        [{ 'color': [] }, { 'background': [] }],  
        [{ 'align': [] }],                        
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'font': [] }]                         
    ];

    var quill = new Quill('#editor', {
        modules: { toolbar: toolbarOptions },
        theme: 'snow'
    });

 
    const form = document.querySelector('form');
    const textarea = document.querySelector('textarea[name=\"content\"]');

    form.onsubmit = function () {
     
        textarea.value = quill.root.innerHTML;
        console.log('전송될 내용:', textarea.value); // textarea 값 확인
    return true;
    };
</script>

");
mysqli_close($con);
?>