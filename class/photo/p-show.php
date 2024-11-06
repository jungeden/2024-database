<?php
echo ("
<html>
<head>
    <meta charset='UTF-8'>
    <title>Photo Gallery</title>
    <style TYPE='text/css'>
    <!--
    a:link { text-decoration: none; }
    a:visited { text-decoration: none; }
    a:hover { text-decoration: underline; color: #0066cc; }
    -->
    </style>
</head>
<body>
");

$con = mysqli_connect("localhost", "root", "0000", "class");

if (!$con) {
    die("데이터베이스 연결 실패: " . mysqli_connect_error());
}

// 현재 페이지와 페이지 크기 설정
$cpage = isset($_GET['cpage']) ? (int)$_GET['cpage'] : 1;
$pagesize = 10;

// 전체 데이터 수 조회
$result = mysqli_query($con, "SELECT * FROM photo ORDER BY wdate DESC");
$total = mysqli_num_rows($result);
$endpage = ceil($total / $pagesize);

if (!$total) {
    echo ("
        <script>
        window.alert('등록된 자료가 없습니다');
        history.go(-1);
        </script>
    ");
    echo ("<meta http-equiv='Refresh' content='0; url=p-input.php'>");
    exit;
} else {
    echo ("<table border=0 width=600 align=center>
            <tr><td colspan=2 height=7 align=center><h1>Gallery</h1></td></tr>
            <tr><td align=right><font size=2>[<a href=p-input.php>사진등록</a>]</font> <font size=2>[<a href=gallery.php>갤러리보기</a>]</font></td></tr>
          </table>");

    echo ("<table border=0 width=600 align=center>
            <form method=post action=p-delete.php>
            <tr bgcolor=#000080><td align=center width=70><font size=2 color=white><b>이름</b></font></td>
            <td align=center width=80><font size=2 color=white><b>작성날짜</b></font></td>
            <td align=center width=420><font size=2 color=white><b>사진 설명</b></font></td>
            <td align=center width=30><input type=submit value=삭제 style='color:red; background-color:yellow; border:1px solid blue; height:20px'></td></tr>
          ");

    // 페이징 처리된 데이터 출력
    $start = ($cpage - 1) * $pagesize;
    $result = mysqli_query($con, "SELECT * FROM photo ORDER BY wdate DESC LIMIT $start, $pagesize");

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $wname = htmlspecialchars($row['wname']);
        $summary = htmlspecialchars($row['summary']);
        $wdate = htmlspecialchars($row['wdate']);
        $userfile = htmlspecialchars($row['userfile']);
        
        $bgcolor = ($i % 2 == 0) ? '#ffefff' : '#ffffef';
        echo ("<tr bgcolor=$bgcolor>
               <td align=center><font size=2>$wname</font></td>
               <td align=center><font size=2>$wdate</font></td>
               <td><a href='#' onclick=\"window.open('./photo/$userfile', '_new', 'width=920,height=620')\"><font size=2>$summary</font></a></td>
               <td align=center><input type=checkbox name=delimage[] value='$userfile'></td></tr>
        ");
        $i++;
    }

    echo ("</table>");
}

mysqli_close($con);

// 이전 및 다음 페이지 링크
$ppage = $cpage - 1;
$npage = $cpage + 1;

echo ("<tr><td colspan=4>&nbsp;</td></tr>");
echo ("<table align=center>");

if ($cpage > 1) {
    echo ("<tr><td align=center><font size=2>[<a href='p-show.php?cpage=$ppage'>이전 페이지</a>]</font></td></tr>");
}

if ($cpage < $endpage) {
    echo ("<tr><td align=center><font size=2>[<a href='p-show.php?cpage=$npage'>다음 페이지</a>]</font></td></tr>");
}

echo ("</table>");
echo ("</body></html>");
?>
