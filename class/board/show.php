<?php

$con = mysqli_connect("localhost", "root", "0000", "class");
$board = $_GET['board'];
// echo $board;


$sql = "SELECT * FROM $board ORDER BY id DESC";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);


echo ("
    <link rel='stylesheet' href='style.css'>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');

    </style>
<div class='container show'>
<div class=show>
<table border='0' width='700' align=center>
    <tr>
        <td colspan='2' align='center'><h1>게시판</h1></td>
    </tr>
    
    <tr >
        <td >
        <div class='search'>
        <div>
            <form method='post' action='search.php?board=$board'>
                <select name='field' class='select'>
                    <option value='writer'>글쓴이</option>
                    <option value='topic'>제목</option>
                    <option value='content'>내용</option>
                </select>
                </div>
                <div class='input-container'>
                <input class='input' type='text' name='key' >
                <input class='button' type='submit' value='검색'>
                </div>
            </form>
             </div>
        </td>
        <td align='right'>
        <a href='input.php?board=$board'>
        <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#faebd7'><path class='icon' d='M202.63-202.87h57.24l374.74-374.74-56.76-57-375.22 375.22v56.52Zm-90.76 91v-185.3l527.52-526.76q12.48-11.72 27.7-17.96 15.21-6.24 31.93-6.24 16.48 0 32.2 6.24 15.71 6.24 27.67 18.72l65.28 65.56q12.48 11.72 18.34 27.56 5.86 15.83 5.86 31.79 0 16.72-5.86 32.05-5.86 15.34-18.34 27.82L297.65-111.87H111.87Zm642.87-586.39-56.24-56.48 56.24 56.48Zm-148.89 92.41-28-28.76 56.76 57-28.76-28.24Z'/></svg>
        </a></td>
    </tr>
   
</table>
<style type='text/css'>
    a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }

</style>");

// <div class='table'>
echo("
<div class='infobox'>
<table  border=0 style=border-collapse:collapse; align=center>

    <tr>
        <td class='element num' width=100><b>번호</b></td>
        <td class='element wri' width=200><b>글쓴이</b></a></td>
        <td align=center colspan=2 class='element wri' width=400><b>제목</b></a></td>
        <td class='element wd' width=200><b>날짜</b></td>
        <td  class='element hit' width=100><b>조회</b></td>
    </tr>
  
");


if ($total == 0) {
    echo ("
        <tr>
            <td colspan='5' align='center'>등록된 글이 없습니다.</td>
        </tr>
    ");
} else {
    if (!isset($_GET['cpage']) || $_GET['cpage'] == '') {
        $cpage = 1;  // 기본값을 1로 설정
    } else {
        $cpage = (int)$_GET['cpage'];  // 전달된 값은 정수로 변환
    }
    
   
    $pageSize = 8;  // 한 페이지에 출력할 데이터 수
    
    // 전체 페이지 수 계산
    $sqlTotal = "SELECT COUNT(*) FROM $board";
    $resultTotal = mysqli_query($con, $sqlTotal);
    $rowTotal = mysqli_fetch_row($resultTotal);
    $total = $rowTotal[0];
    $totalPage = ceil($total / $pageSize);

    $start = ($cpage - 1) * $pageSize;

    $sql = "SELECT * FROM $board ORDER BY id DESC LIMIT $start, $pageSize";
    $result = mysqli_query($con, $sql);

    $counter = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $writer = $row['writer'];
        $topic = $row['topic'];
        $hit = $row['hit'];
        $wdate = $row['wdate'];
        $space = $row['space'];

        // $files=[];

        $commentcount = mysqli_query($con, "SELECT COUNT(*) AS count FROM comment WHERE id = $id");
        $rows = mysqli_fetch_assoc($commentcount);
        $idcommentcount = $rows['count'];
        
        $fileupload = mysqli_query($con, "SELECT * FROM boardfile WHERE id='$id'");
        while ($filerow = mysqli_fetch_assoc($fileupload)) {
            $fileName = htmlspecialchars($filerow['fileName']);
        }

        $t = "";
        if ($space > 0) {
            for ($i = 0; $i <= $space; $i++) {
                $t .= "&nbsp;";
            }
        }
        echo ("
            <tr>
                <td class='element text e' align='center'>$id</td>
                <td class='element text ' align='center'>$writer</td>
                <td class='element text l' align='left' style='border-right:0;'>$t<a href='content.php?board=$board&id=$id'>$topic</a>");
                if ($idcommentcount!=0) {
                echo(" [$idcommentcount]");}
                echo("</td><td class='element text2' style='border-left:0;' align='right'>");
                if (!empty($fileName)) {
                    echo("
                    <a >
                    <svg xmlns='http://www.w3.org/2000/svg' height='16px' viewBox='0 -960 960 960' width='16px' fill='#faebd7'><path d='M708.44-309.61q0 92.97-66.42 157.35-66.42 64.39-159.87 64.39-94.58 0-160.19-66.81-65.61-66.82-65.61-161.93v-394.26q0-67.63 48.13-114.45 48.13-46.81 116.24-46.81 69.11 0 116.5 49.31 47.39 49.32 47.39 118.95v370.02q0 42.3-29.96 71.54-29.96 29.24-72.5 29.24-43.39 0-72.68-30.4-29.3-30.41-29.3-74.38v-380h80.61v384q0 8.97 6.09 14.69 6.08 5.73 15.28 5.73 9.21 0 15.53-5.61 6.32-5.6 6.32-14.81v-376.78q.24-34.04-24.38-57.59-24.62-23.54-59.1-23.54-34.48 0-59.02 24.42-24.54 24.43-24.54 58.47v399.26q.24 59.52 42.83 99.95 42.6 40.42 102.6 41.42 60.24 1 103.08-41.92 42.83-42.93 42.36-104.45v-412.32h80.61v417.32Z'/></svg>
                    </a>
                    ");
                }
                echo("</td>
                <td class='element text' align='center'>$wdate</td>
                <td class='element text' align='center'>$hit</td>
            </tr>
        ");
        $counter++;
    }
    echo ("</table> ");
echo(" </div>");
    
    echo("<table border=0 width=700 align=center style='border-collapse:collapse';>
    <tr><td align=center><div class='pagenumbox'>");

    if (!isset($cblock) || $cblock == '') {
        $cblock = 1;
    }

    $blockSize = 5;  
    $pblock = $cblock - 1;
    $nblock = $cblock + 1;

    $startPage = ($cblock - 1) * $blockSize + 1;
    $pStartPage = $startPage - 1;
    $nStartPage = $startPage + $blockSize;
    
      // 이전 블록 링크
      if ($pblock > 0) {
        echo "<a href='show.php?cblock=$pblock&cpage=$pStartPage&userid=$userid&board=$board'>
            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'>
                <path class='icon' id='beforepage' d='M560-267.69 347.69-480 560-692.31 588.31-664l-184 184 184 184L560-267.69Z'/>
            </svg>
        </a>";
    }

    // 페이지 번호 출력
    for ($i = $startPage; $i < $nStartPage && $i <= $totalPage; $i++) {
        $class = ($i == $cpage) ? 'class="current"' : '';  // 현재 페이지는 스타일링
        echo "<div class='pagenum'><a style='color:rgb(37,37,37);' href='show.php?cblock=$cblock&cpage=$i&board=$board' $class>$i</a></div>&nbsp;";
    }

    // 다음 블록 링크
    if ($nStartPage <= $totalPage) {
        echo "<a href='show.php?cblock=$nblock&cpage=$nStartPage&userid=$userid&board=$board'>
            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'>
                <path class='icon' id='afterpage' d='m531.69-480-184-184L376-692.31 588.31-480 376-267.69 347.69-296l184-184Z'/>
            </svg>
        </a>";
    }
    echo("</div></td></tr></table></div></div>");
}

mysqli_close($con);
?>



