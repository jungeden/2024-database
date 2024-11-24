<? //content.php
// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "class");

// 요청된 ID를 가져옴
$id = $_GET['id']; // 기본값은 0
$board = $_GET['board'];
// 게시글 정보를 가져오기
$result = mysqli_query($con, "SELECT * FROM $board WHERE id = $id");
$fileupload = mysqli_query($con, "SELECT * FROM boardfile WHERE id = $id");
$comment = mysqli_query($con,"SELECT * FROM comment WHERE id = $id" );
$row = mysqli_fetch_assoc($result);


if ($row) {
    $sid = $row["id"];
    $writer = $row["writer"];
    $topic = $row["topic"];
    $hit = $row["hit"] + 1; // 조회 수 증가
    $content = $row["content"];
    $wdate = $row["wdate"];
    $num=$row["num"];
    $parentid = $row['parentid'];

    if(!empty($parentid)) {
        $fileupload = mysqli_query($con, "SELECT * FROM boardfile WHERE id = $parentid");
    }
    $files = [];
    while ($filerow = mysqli_fetch_assoc($fileupload)) {
        $fileName = htmlspecialchars($filerow['fileName']);
        $fileSize = $filerow['fileSize'];

        // 파일 크기 계산
        if ($fileSize > 1000) {
            $kb_filesize = (int)($fileSize / 1000);
            $disp_size = $kb_filesize . ' KBytes';
        } else {
            $disp_size = $fileSize . ' Bytes';
        }

        // 파일 정보를 배열에 추가
        $files[] = ["name" => $fileName, "size" => $disp_size];
    }

    // 조회 수 업데이트
    mysqli_query($con, "UPDATE $board SET hit = $hit WHERE id = $sid");

    $comments = [];
    while($commentrow = mysqli_fetch_assoc($comment)) {
        $name = htmlspecialchars($commentrow['name']);
        $message = htmlspecialchars($commentrow['message']);
        $wdate = htmlspecialchars($commentrow['wdate']);

        $comments[] = ["commentname" => $name, "commentmessage" => $message, "date" => $wdate];
    }
    
    // var_dump(htmlspecialchars($content));
    echo("
    
    <head>
    <link rel='stylesheet' href='style.css'>
    <link href='https://cdn.quilljs.com/1.3.6/quill.snow.css' rel='stylesheet'>

  
  
    
    
    </head>");
    echo ("
    <script src='https://cdn.quilljs.com/1.3.6/quill.min.js'></script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');

    <script>

    </script>
    </style>
    <body>
    <div class='container'>
        <table border=0  align='center'>
            <tr>
                <td ><h1>게시글 보기</h1></td>
            </tr>
        </table>
        <div class='icons'>
        <table  border=0 align='right'>
            <tr>
                <td align='right'>
                    <a href='pass.php?board=$board&id=$id&mode=0'>
                    <svg xmlns='http://www.w3.org/2000/svg' height='20px' viewBox='0 -960 960 960' width='20px' fill='#faebd7'><path class='icon' d='M363.35-600.48v-86.22h354.02v86.22H363.35Zm0 126.22v-86.22h354.02v86.22H363.35Zm115.22 311.39h-275.7 275.7Zm0 91h-235.7q-54.58 0-92.79-38.21-38.21-38.21-38.21-92.79v-130.52h120.48v-554.74h616.02v368.65q-22.87-3.43-46.24.43-23.37 3.85-44.76 15.25v-293.33H323.35v463.74h250.76l-91 91H202.87v39.52q0 17 11.5 28.5t28.5 11.5h235.7v91Zm80 0v-129.7L781-423q9.72-9.76 21.59-14.1 11.88-4.33 23.76-4.33 12.95 0 24.8 4.85Q863-431.72 872.7-422l37 37q8.67 9.72 13.55 21.59 4.88 11.88 4.88 23.76 0 12.19-4.36 24.41T909.7-293.3L688.26-71.87H558.57Zm304.78-267.78-37-37 37 37Zm-240 203h38L781.39-257.7l-18-19-19-18-121.04 120.05v38ZM763.39-276.7l-19-18 37 37-18-19Z'/></svg>
                     </a>
                    <a href='pass.php?board=$board&id=$id&mode=1'>
                    <svg xmlns='http://www.w3.org/2000/svg' height='22px' viewBox='0 -960 960 960' width='22px' fill='#faebd7'><path class='icon' d='M277.37-111.87q-37.78 0-64.39-26.61t-26.61-64.39v-514.5h-45.5v-91H354.5v-45.5h250.52v45.5h214.11v91h-45.5v514.5q0 37.78-26.61 64.39t-64.39 26.61H277.37Zm405.26-605.5H277.37v514.5h405.26v-514.5ZM355.7-280.24h85.5v-360h-85.5v360Zm163.1 0h85.5v-360h-85.5v360ZM277.37-717.37v514.5-514.5Z'/></svg>
                     </a>
                    <a href='reply.php?board=$board&id=$id'>
                    <svg xmlns='http://www.w3.org/2000/svg' height='20px' viewBox='0 -960 960 960' width='20px' fill='#faebd7'><path class='icon' d='M240-384h336v-72H240v72Zm0-132h480v-72H240v72Zm0-132h480v-72H240v72ZM87.87-87.87v-701.26q0-34.48 24.26-58.74 24.26-24.26 58.74-24.26h618.26q34.48 0 58.74 24.26 24.26 24.26 24.26 58.74v474.26q0 34.48-24.26 58.74-24.26 24.26-58.74 24.26H231.87l-144 144Zm114-227h587.26v-474.26H170.87v505.5l31-31.24Zm-31 0v-474.26 474.26Z'/></svg>
                     </a>
                    <a href='show.php?board=$board'>
                    <svg xmlns='http://www.w3.org/2000/svg' height='22px' viewBox='0 -960 960 960' width='22px' fill='#faebd7'><path class='icon' d='M323.79-289.43q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.28-10.5 10.29-10.5 25.5 0 15.22 10.29 25.72 10.29 10.5 25.5 10.5Zm0-154.57q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5Zm0-154.57q15.21 0 25.71-10.28 10.5-10.29 10.5-25.5 0-15.22-10.29-25.72-10.29-10.5-25.5-10.5t-25.71 10.29q-10.5 10.29-10.5 25.5t10.29 25.71q10.29 10.5 25.5 10.5ZM432-289.43h240v-72H432v72ZM432-444h240v-72H432v72Zm0-154.57h240v-72H432v72Zm-213.13 462.7q-34.48 0-58.74-24.26-24.26-24.26-24.26-58.74v-522.26q0-34.48 24.26-58.74 24.26-24.26 58.74-24.26h522.26q34.48 0 58.74 24.26 24.26 24.26 24.26 58.74v522.26q0 34.48-24.26 58.74-24.26 24.26-58.74 24.26H218.87Zm0-83h522.26v-522.26H218.87v522.26Zm0-522.26v522.26-522.26Z'/></svg>
                     </a>
                </td>
            </tr>
        </table>
        </div>
        <div class='infobox'>
        
        <table border=0 width=700 style=border-collapse:collapse; align='center'>
            <tr>
                <td class='element num' width=100>번호 : $num</td>
                <td class='element wri' width=250>글쓴이 : <a href='mailto:$writer'>$writer</a></td>
                <td class='element dat' width=250>작성일 : $wdate</td>
                <td  class='element hit' width=100>조회수 : $hit</td>
            </tr>
            <tr>
                <td class='element top' colspan=4>제목 : $topic</td>
            </tr>
            <tr>
                <td colspan=4>");
            if(!empty($files)) {
                if(!empty($parentid)) {
                    $delimiter = "<p>----------&lt;원본글&gt;----------</p>";
                    list($content1, $content2) = explode($delimiter, $content, 2);


                    echo(" 
                        <style>
                        .element.con{height:150px;}
                        </style>
                    <div class='ql-editor element con'>$content1</div>
                    <div>\n- - - - - - - - - - - - - - - - - - - - <원본글> - - - - - - - - - - - - - - - - - - - -\n\n\n\n</div>
                    <div  class='photobox'><img class='photo' src='./files/$fileName'></div>
                    <div class='ql-editor element con'> $content2</div>

                    ");
                } else {
                   echo(" 
                    <div  class='photobox'><img class='photo' src='./files/$fileName'></div>
                    <div class='ql-editor element con'>$content</div>

                    ");
                }
            } else {
                   echo(" <div class='ql-editor element con'>$content</div>");
            }
                echo("</td>
            </tr>
        </table>
        </div>
            ");
                
    // 첨부 파일이 있을 경우만 출력
    if (!empty($files)) {
        echo ("<tr>
                <td colspan=4> ");
        foreach ($files as $file) {
            
            echo "<a href='./files/{$file['name']}'>{$file['name']} [{$file['size']}]</a><br>";
        }
        echo(" </td>
            </tr>");
    } else {
       
    }
                
    echo ("
    <form method='post' action=' comment.php?board=$board&id=$sid'>
        
        
        <br><br>
    ");
   // 이전 글 찾기
$beforeQuery = "SELECT * FROM $board WHERE num < $num ORDER BY num DESC LIMIT 1";
$beforeResult = mysqli_query($con, $beforeQuery);
$beforeRow = mysqli_fetch_assoc($beforeResult);

// 다음 글 찾기
$afterQuery = "SELECT * FROM $board WHERE num > $num ORDER BY num ASC LIMIT 1";
$afterResult = mysqli_query($con, $afterQuery);
$afterRow = mysqli_fetch_assoc($afterResult);

// HTML 출력
echo("<div class='pagechangebox'>
<table border=0 align=center>
");

// 이전 게시글 출력
if ($beforeRow) {
    echo "
    <tr>
        <td width=110px ><a class='atext h' >이전 게시글: </a></td>
        <td width=110px><a class='atext' href='content.php?id={$beforeRow['id']}&board=$board'>{$beforeRow['topic']}</a></td>
        <td width=100px><a class='atext h' >{$beforeRow['writer']}</a></td>
        <td width=130px><a class='atext h' >{$beforeRow['wdate']}</a></td>
        <td width=40px><a class='atext h' >{$beforeRow['hit']}</a></td>
    </tr>
    <tr><td colspan=5><div class='line2'></div></td></tr>";
}

// 다음 게시글 출력
if ($afterRow) {
    echo "
    <tr>
        <td width=110px ><a class='atext h' >다음 게시글: </a></td>
        <td width=110px><a class='atext' href='content.php?id={$afterRow['id']}&board=$board'>{$afterRow['topic']}</a></td>
        <td width=100px><a class='atext h' >{$afterRow['writer']}</a></td>
        <td width=130px><a class='atext h' >{$afterRow['wdate']}</a></td>
        <td width=40px><a class='atext h' >{$afterRow['hit']}</a></td>
    </tr>";
}

echo("</table></div>");



echo("
<div class='line'></div>");

    
    echo "<div class='box' style='min-height: 200px; max-height: 400px; overflow-y: auto;'>";
    echo "<table border=0 width=700 align='center' border=1 style='border-collapse:collapse;'>";

    if (!empty($comments)) {
        $commentcount = mysqli_query($con, "SELECT COUNT(*) AS count FROM comment WHERE id = $id");
        $rows = mysqli_fetch_assoc($commentcount);
        $idcommentcount = $rows['count'];
        echo("<tr>
            <td colspan=2 border=0 ><a style='font-size:25px;'>댓글</a><a style='font-size:24px;'> $idcommentcount</a></td>
        </tr>");
        foreach ($comments as $pcomment) {
            echo ("
            
            <tr>
                <td style='vertical-align: bottom;' colspan=2>
                    <div class='commentname'>
                        {$pcomment['commentname']}&nbsp; 
                        <a style='font-size:12px; color:gray; a:hover {color:gray}'>({$pcomment['date']})</a>
                        <a href='contentmodifycomment.php?commentname={$pcomment['commentname']}&date={$pcomment['date']}&commentmessage={$pcomment['commentmessage']}&id=$id&board=$board' style='margin:0 6px 0 0; position:absolute; right:20px;'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='16px' viewBox='0 -960 960 960' width='16px' fill='#faebd7'><path class='icon' d='M363.35-600.48v-86.22h354.02v86.22H363.35Zm0 126.22v-86.22h354.02v86.22H363.35Zm115.22 311.39h-275.7 275.7Zm0 91h-235.7q-54.58 0-92.79-38.21-38.21-38.21-38.21-92.79v-130.52h120.48v-554.74h616.02v368.65q-22.87-3.43-46.24.43-23.37 3.85-44.76 15.25v-293.33H323.35v463.74h250.76l-91 91H202.87v39.52q0 17 11.5 28.5t28.5 11.5h235.7v91Zm80 0v-129.7L781-423q9.72-9.76 21.59-14.1 11.88-4.33 23.76-4.33 12.95 0 24.8 4.85Q863-431.72 872.7-422l37 37q8.67 9.72 13.55 21.59 4.88 11.88 4.88 23.76 0 12.19-4.36 24.41T909.7-293.3L688.26-71.87H558.57Zm304.78-267.78-37-37 37 37Zm-240 203h38L781.39-257.7l-18-19-19-18-121.04 120.05v38ZM763.39-276.7l-19-18 37 37-18-19Z'/></svg>
                        </a>
                        <a href='commentdelete.php?commentname={$pcomment['commentname']}&date={$pcomment['date']}&commentmessage={$pcomment['commentmessage']}&id=$id&board=$board' style='position:absolute; right:5px;'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='18px' viewBox='0 -960 960 960' width='18px' fill='#faebd7'><path class='icon' d='M277.37-111.87q-37.78 0-64.39-26.61t-26.61-64.39v-514.5h-45.5v-91H354.5v-45.5h250.52v45.5h214.11v91h-45.5v514.5q0 37.78-26.61 64.39t-64.39 26.61H277.37Zm405.26-605.5H277.37v514.5h405.26v-514.5ZM355.7-280.24h85.5v-360h-85.5v360Zm163.1 0h85.5v-360h-85.5v360ZM277.37-717.37v514.5-514.5Z'/></svg>
                        </a>
                    </div>
                </td>
                
            </tr>
            <tr><td style=' vertical-align: top;' colspan=2><div class='commenttext'>{$pcomment['commentmessage']}</div></td></tr>");
        }
    } else {
        echo "<tr><td colspan=2 style='text-align: center;'>댓글이 없습니다.</td></tr>";
    }

    echo "</table></div><br><br>";

    // 댓글 입력 폼 출력
    echo ("
<div class='commentbox'>
    <table border='0' width='500' align='center' style='border-collapse: collapse;'>
        <tr>
            <td style='padding: 0; width: 410px;'>
                <table border='0' style='border-spacing: 0; margin: 0; border-collapse: collapse; width: 100%;'>
                    <tr>
                        <td style='padding: 0;'><input class='commentinput' type='text' name='commentwriter' placeholder='이름 입력' style='width: 100%; box-sizing: border-box;'></td>
                    </tr>
                    <tr>
                        <td style='padding: 0;'><textarea class='commentinput co' name='commentmessage' rows='4' style='width: 100%; box-sizing: border-box;'></textarea></td>
                    </tr>
                </table>
            </td>
            <td style='padding: 0; vertical-align: top; width: 90px; height:110px'>
                <table border='0' style='border-spacing: 0; margin: 0; border-collapse: collapse; height: 100%; width: 100%;'>
                    <tr>
                        <td style='padding: 0;'><input class='commentbutton' type='submit' value='등록' style='width: 100%; height: 100%; box-sizing: border-box;'></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>


    </form>

    
    ");




echo("</div>
</body>");
} else {
    echo "<p>해당 게시글이 존재하지 않습니다.</p>";
}



echo("</div>
<style type='text/css'>
   a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }

</style>");

// 데이터베이스 연결 종료
mysqli_close($con);
?>
