<?php
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
    // HTML 출력
    echo ("
    <link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');

    
    </style>
        <table border=0  align='center'>
            <tr>
                <td ><h1>게시글 보기</h1></td>
            </tr>
        </table>
        
        <table border=1 width=700 style=border-collapse:collapse; align='center'>
            <tr>
                <td width=100>번호 : $sid</td>
                <td width=200>글쓴이 : <a href='mailto:$writer'>$writer</a></td>
                <td width=300>작성일 : $wdate</td>
                <td width=100>조회수 : $hit</td>
            </tr>
            <tr>
                <td colspan=4>제목 : $topic</td>
            </tr>
            <tr>
                <td colspan=4><pre>$content</pre></td>
            </tr>
            ");
                
    // 첨부 파일이 있을 경우만 출력
    if (!empty($files)) {
        echo ("<tr>
                <td colspan=4> ");
        foreach ($files as $file) {
            echo "<a href='./files/{$file['name']}'>{$file['name']}</a> [{$file['size']}]<br>";
        }
        echo(" </td>
            </tr>");
    } else {
       
    }
                
    echo ("
    <form method='post' action=' comment.php?board=$board&id=$sid'>
        </table>
        
        <table border=0 width=700 align='center'>
            <tr>
                <td align='center'>
                    <a href='pass.php?board=$board&id=$id&mode=0'>[ 수정 ]</a>
                    <a href='pass.php?board=$board&id=$id&mode=1'>[ 삭제 ]</a>
                    <a href='reply.php?board=$board&id=$id'>[ 답변 ]</a>
                    <a href='show.php?board=$board'>[ 리스트 ]</a>
                </td>
            </tr>
        </table><br><br>
    ");
    
    echo "<div style='min-height: 200px; max-height: 400px; overflow-y: auto;'>";
    echo "<table width=700 align='center' border=1 style='border-collapse:collapse;'>";

    if (!empty($comments)) {
        $commentcount = mysqli_query($con, "SELECT COUNT(*) AS count FROM comment WHERE id = $id");
        $rows = mysqli_fetch_assoc($commentcount);
        $idcommentcount = $rows['count'];
        echo("<tr>
            <td colspan=2>댓글 $idcommentcount</td>
        </tr>");
        foreach ($comments as $pcomment) {
            echo ("
            
            <tr><td colspan=2><b>{$pcomment['commentname']}</b> <a style='font-size:12px; color:gray; a:hover {color:gray}'>({$pcomment['date']})</a></td></tr>
            <tr><td colspan=2>{$pcomment['commentmessage']}</td></tr>");
        }
    } else {
        echo "<tr><td colspan=2 style='text-align: center;'>댓글이 없습니다.</td></tr>";
    }

    echo "</table></div><br><br>";

    // 댓글 입력 폼 출력
    echo ("
    <table border=1 width=700 align='center' style='border-collapse:collapse;'>
        <tr>
            <td colspan=2>댓글 쓰기</td>
        </tr>
        <tr>
            <td> 이름 : <input class='commentinput' type='text' name='commentwriter'> </td>
            <td align='right' width=10> <input class='commentbutton' type=submit value=등록 ></td>
        </tr>
        <tr>
            <td colspan=2><textarea class='commentinput' name='commentmessage' rows='4' cols='84'></textarea></td>
        </tr>
    </table>
    </form>
    ");
} else {
    echo "<p>해당 게시글이 존재하지 않습니다.</p>";
}
$beforeid=$sid-1;
$afterid=$sid+1;
$getboard = mysqli_query($con, "SELECT * from $board WHERE id='$beforeid' AND id='$afterid'");
while($row=mysqli_fetch_assoc($getboard)) {

    echo("
    <table border=1 width=700 style=border-collapse:collapse; align=center>
        <tr>
            <td align='center'>$id</td>
                <td align='center'>$writer</td>
        </tr>
    
    
    
    </table>
    ");
}

echo("
<style type='text/css'>
   a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }

</style>");

// 데이터베이스 연결 종료
mysqli_close($con);
?>
