<? //reply.php
$id = $_GET['id'];
$board = $_GET['board'];

$con = mysqli_connect("localhost", "root", "0000", "class");
$sql = "SELECT * from $board WHERE id=$id";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$topic = $row['topic'];
$content = $row['content'];

$topic='[RE]' . $topic;

$pre_content="\n\n\n----------<원본글>----------\n" . $content . "\n";

echo("
    
<head>
<link rel='stylesheet' href='style.css'>
<link href='https://cdn.quilljs.com/1.3.6/quill.snow.css' rel='stylesheet'>
</head>");
echo("
    <center><h1>게시판</h1></center>
    <script src='https://cdn.quilljs.com/1.3.6/quill.min.js'></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
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
                <td width='400'><input class='input input2' type='text' name='writer' size='60'></td>
            </tr>
            <tr>
            <td></td>
                <td  >Email </td>
                </tr><tr><td></td>
                <td><input class='input input2' type='text'  name='email' size='60'></td>
            </tr>
            <tr>
            <td></td>
                <td  >제목 </td>
                </tr><tr><td></td>
                <td><input class='input input2' type='text' name='topic' size='60' value='$topic'></td>
            </tr>
            <tr>
            <td></td>
                <td  >내용 </td>
                </tr><tr><td></td>
                <td>
                 <div id='editor'>
                 <pre>
                 \n
                 </pre>
                 $pre_content
                </div>
                <textarea name='content' class='input input1 content' hidden></textarea>
                </td>
            </tr>
            <tr>
            <td></td>
                <td  >암호 </td>
                </tr><tr><td></td>
                <td><input class='input input2' type='password' name='pass' size='60'></td>
            </tr>
            <tr>
                <td align='center' colspan='2'>
                    <input class='button button1' type='submit' value='답변 완료'>
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
");



?>