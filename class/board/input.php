<? //input.php
$board = isset($_POST['board']) ? $_POST['board'] : 'testboard';

echo ("
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>게시판</title>
    <link rel='stylesheet' href='style.css'>
    <link href='https://cdn.quilljs.com/1.3.6/quill.snow.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
        a {
            text-decoration: none;
            color: antiquewhite;
        }
        a:hover {
            text-decoration: underline;
            color: rgb(172, 155, 134);
        }
    </style>
    <script src='https://cdn.quilljs.com/1.3.6/quill.min.js'></script>
</head>
<body>
    <center><h1>게시판</h1></center>
    <table align='right' width=1070>
        <tr>
            <td align='right'> <a href='show.php?board=$board'>
            <svg xmlns='http://www.w3.org/2000/svg' height='30px' viewBox='0 -960 960 960' width='30px' fill='#faebd7'><path class='icon' d='M324.67-298.46q13.1 0 21.91-8.86 8.8-8.86 8.8-21.96 0-13.1-8.86-21.91T324.56-360q-13.1 0-21.91 8.86-8.8 8.86-8.8 21.96 0 13.1 8.86 21.91t21.96 8.81Zm0-150.77q13.1 0 21.91-8.86 8.8-8.86 8.8-21.96 0-13.1-8.86-21.91t-21.96-8.81q-13.1 0-21.91 8.86-8.8 8.86-8.8 21.96 0 13.1 8.86 21.91t21.96 8.81Zm0-150.77q13.1 0 21.91-8.86 8.8-8.86 8.8-21.96 0-13.1-8.86-21.91t-21.96-8.81q-13.1 0-21.91 8.86-8.8 8.86-8.8 21.96 0 13.1 8.86 21.91t21.96 8.81Zm123.02 290.77h215.39v-40H447.69v40Zm0-150.77h215.39v-40H447.69v40Zm0-150.77h215.39v-40H447.69v40ZM224.62-160q-27.62 0-46.12-18.5Q160-197 160-224.62v-510.76q0-27.62 18.5-46.12Q197-800 224.62-800h510.76q27.62 0 46.12 18.5Q800-763 800-735.38v510.76q0 27.62-18.5 46.12Q763-160 735.38-160H224.62Zm0-40h510.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93v-510.76q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H224.62q-9.24 0-16.93 7.69-7.69 7.69-7.69 16.93v510.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69ZM200-760v560-560Z'/></svg>
            </a> </td>
        </tr>
    </table>
    <form method='post' action='process.php?board=$board' enctype='multipart/form-data'>
        <table border='0' align='center'>
    <tr>
        <td>
            <table>
                <tr><td>작성자</td></tr>
                <tr><td><input class='input input1' type='text' name='writer' size='60'></td></tr>
                <tr><td>Email</td></tr>
                <tr><td><input class='input input1' type='email' name='email' size='60'></td></tr>
            </table>
        </td>
        <td>
            <table>
                <tr><td>제목</td></tr>
                <tr><td><input class='input input1' type='text' name='topic' size='60'></td></tr>
                <tr><td>비밀번호</td></tr>
                <tr><td><input class='input input1' type='password' name='passwd' size='60'></td></tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan='2'>
            <table>
                <tr><td>내용</td></tr>
                <tr>
                    <td>
                        <div id='editor'></div>
                        <textarea name='content' class='input input1 content' hidden></textarea>
                    </td>
                </tr>
                <tr><td>첨부 파일</td></tr>
                <tr>
                    <td>
                        <div class='files'>
                            <label for='file-upload' class='input input1 file'>파일 선택</label>
                            <input type='file' id='file-upload' class='file-input input input1' name='userfile'>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align='center' colspan='2'>
            <input class='button button1' type='submit' value='등록하기'>
            <input class='button button1' type='reset' value='지우기'>
        </td>
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

</body>
</html>
");
?>
