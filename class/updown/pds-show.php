<?php
// 데이터베이스 연결

$con = mysqli_connect("localhost", "root", "0000", "class");



// 게시판 이름을 안전하게 처리하기 위한 예제 (SQL 인젝션 방지)
$board = mysqli_real_escape_string($con, $_GET['board']);

// 데이터 가져오기
$result = mysqli_query($con, "SELECT * FROM updown ORDER BY id");
$total = mysqli_num_rows($result);

// HTML 출력
echo("<table border=0 width=700 style='border-collapse:collapse;'>
    <tr><td align=center><h1>자료실</h1></td></tr>
    <td align=right>[<a href=pds-input.php?board=$board>자료등록</a>]</td> 
    </tr>
    </table>");

if (!$total) {
    echo("<table border=0 width=700>
        <tr><td align=center>게시물이 존재하지 않습니다.</td></tr>
        </table>");
} else {
    echo ("<table border=1 width=1000 style='border-collapse:collapse;'>
    <tr><td width=40 align=center>번호</td>
    <td width=60 align=center>등록자</td>
    <td width=200 align=center>제목</td>
    <td width=200 align=center>첨부파일</td>
    <td width=120 align=center>등록일</td>
    <td width=50 align=center>삭제</td></tr>");

    // 데이터 출력
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $writer = htmlspecialchars($row['writer']);
        $title = htmlspecialchars($row['title']);
        $wdate = htmlspecialchars($row['wdate']);
        $fileName = htmlspecialchars($row['fileName']);
        $fileSize = $row['fileSize'];

        // 파일 사이즈 표시
        if ($fileSize > 1000) {
            $kb_filesize = (int)($fileSize / 1000);
            $disp_size = $kb_filesize . ' KBytes';
        } else {
            $disp_size = $fileSize . ' Bytes';
        }

        echo ("<tr>
            <td align=center>$id</td>
            <td align=center>$writer</td>
            <td>$title</td>
            <td align=center><a href=./pds/$fileName>$fileName</a><br> [$disp_size]</td>
            <td align=center>$wdate</td>
            <td align='center'><a href='pds-delete.php?board=$board&id=$id'>X</a></td>
            </tr>");
    }

    echo ("</table>");
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
