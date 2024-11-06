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
    a:hover { text-decoration: underline; color:#0066cc; }
    -->
    </style>
</head>
<body>
");

$con = mysqli_connect("localhost", "root", "0000", "class");

if (!$con) {
    die("데이터베이스 연결 실패: " . mysqli_connect_error());
}

// UTF-8 설정
mysqli_set_charset($con, "utf8");

$result = mysqli_query($con, "SELECT * FROM photo ORDER BY wdate DESC");
$total = mysqli_num_rows($result);

echo ("<table border=0 width=560 align=center>
    <tr><td colspan=4 align=center><h1>Gallery</h1></td></tr>
    <tr><td colspan=2 align=left><font size=2 color=blue>(전체 등록수: </font><font size=2 color=red>$total&nbsp;</font><font size=2 color=blue>개)</font></td>
    <td colspan=2 align=right><font size=2>[<a href=p-show.php>전체보기</a>][<a href=p-input.php>사진등록</a>]</font></td></tr>
    <tr>
");

$counter = 0;

// 갤러리 아이템 출력
while ($row = mysqli_fetch_assoc($result)) {
    if (($counter % 4) == 0) echo ("</tr><tr><td colspan=4></td></tr><tr>");
    $wname = htmlspecialchars($row['wname']);
    $wdate = htmlspecialchars($row['wdate']);
    $userfile = htmlspecialchars($row['userfile']);

    echo ("
        <td align=center>
            <a href='#' onclick=\"window.open('./photo/$userfile', '_new', 'width=920, height=620')\">
                <img src='./photo/$userfile' width=120 height=80 border=0>
            </a><br>
            <font size=2>$wname<br>($wdate)</font>
        </td>
    ");
    $counter++;
}

echo ("</tr></table>");

mysqli_close($con);

?>
