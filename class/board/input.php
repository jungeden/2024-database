<?php
$board = isset($_POST['board']) ? $_POST['board'] : 'testboard';

echo ("
<head>
    <link rel='stylesheet' href='style.css'>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');
<link href='https://cdn.quilljs.com/1.3.6/quill.snow.css' rel='stylesheet'>


</style>
<script>
        
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['clean', 'image'],    // remove formatting button
            [{ 'size': ['small', false, 'large', 'huge'] }],// custom dropdown => class로 적용되기에 다른 파일이 더 필요함. 따라서 지금은 적용 안 됨.
            [{ 'font': [] }]
        ];

        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        
</script>
</head>
<body>
<center><h1>게시판</h1></center>
<table align='right' width='700' >
<td align='right'>[ <a href='show.php?board=$board'>목록</a> ]</td>
</table>
<form method='post' action='process.php?board=$board' enctype='multipart/form-data'>
    <table  border='0' align='center' >
        <tr>
        <td></td>
            <td style='padding-bottom: 0px;'>작성자</td>
           </tr><tr><td></td>
            <td width='400'style='padding-top: 0px;' ><input class='input input1' type='text' name='writer' size='60' style='margin-bottom: 3px;' ></td>
        </tr>
        <tr>
        <td></td>
            <td style='padding-bottom: 0px;'>Email</td>
            </tr><tr><td></td>
            <td style='padding-top: 0px;'><input class='input input1' type='text' name='email' size='60' style='margin-bottom: 3px;'></td>
        </tr>
        <tr>
        <td></td>
            <td style='padding-bottom: 0px;'>제목</td>
            </tr><tr><td></td>
            <td style='padding-top: 0px;'><input class='input input1' type='text' name='topic' size='60' style='margin-bottom: 3px;'></td>
        </tr>
        <tr>
        <td></td>
            <td style='padding-bottom: 0px;'>내용</td>
            </tr><tr><td></td>
            <td style='padding-top: 0px;'><textarea class='input input1 content' name='content' rows='12' cols='50' style='margin-bottom: 3px;'></textarea></td>
        </tr>
         <tr>
         <td></td>
            <td style='padding-bottom: 0px;'>첨부 파일</td>
            </tr><tr><td></td>
             <td >
            <div class='files'>
            <label for='file-upload' class='input input1 file' >파일 선택</label>
            <input type='file' id='file-upload' class='file-input input input1' name='userfile' size='45' maxlength='80'>
            </div>

            </td>
        </tr>
        <tr>
        <td></td>
            <td style='padding-bottom: 0px;'>비밀번호</td>
            </tr><tr><td></td>
            <td style='padding-top: 0px;'><input class='input input1' type='password' name='passwd' size='60' style='margin-bottom: 3px;' ></td>
        </tr>
        <tr>
            <td align='center' colspan='2'>
                <input class='button button1' type='submit' value='등록하기'>
                <input class='button button1' type='reset' value='지우기'>
            </td>
        </tr>
    </table>
</form>
        
</body>
");
echo("
<style type='text/css'>
    a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }

</style>
");
?>
<script>
const fileInput = document.querySelector('.file-input');
const fileNameSpan = document.querySelector('.file-name');

fileInput.addEventListener('change', function () {
  fileNameSpan.textContent = this.files[0] ? this.files[0].name : '선택된 파일 없음';
});
<script>