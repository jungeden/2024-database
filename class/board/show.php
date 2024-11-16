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
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');
    </style>
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
        <td align='right'>[ <a href='input.php?board=$board'>쓰기</a> ]</td>
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
<table  border=1 width=700 style=border-collapse:collapse; align=center>

    <tr>
        <td align='center' width=50><b>번호</b></td>
        <td align='center' width=100><b>글쓴이</b></td>
        <td align='center' width=400><b>제목</b></td>
        <td align='center' width=100><b>날짜</b></td>
        <td align='center' width=50><b>조회</b></td>
        
    </tr>
  
");


if ($total == 0) {
    echo ("
        <tr>
            <td colspan='5' align='center'>등록된 글이 없습니다.</td>
        </tr>
    ");
} else {
    if (!isset($cpage) || $cpage == '') {
        $cpage = 1;
    }
    
    $pageSize = 5;

   
    $totalPage = ceil($total / $pageSize); 

    $counter = 0;

    while ($counter < $pageSize) {
        $newCounter = ($cpage - 1) * $pageSize + $counter;
        if ($newCounter == $total) {
            break;
        }
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $writer = $row['writer'];
        $topic = $row['topic'];
        $hit = $row['hit'];
        $wdate = $row['wdate'];
        $space = $row['space'];

        $commentcount = mysqli_query($con, "SELECT COUNT(*) AS count FROM comment WHERE id = $id");
        $rows = mysqli_fetch_assoc($commentcount);
        $idcommentcount = $rows['count'];
        

        $t = "";
        if ($space > 0) {
            for ($i = 0; $i <= $space; $i++) {
                $t .= "&nbsp;";
            }
        }
        echo ("
            <tr>
                <td align='center'>$id</td>
                <td align='center'>$writer</td>
                <td align='left'>$t<a href='content.php?board=$board&id=$id'>$topic</a>");
                if ($idcommentcount!=0) {
                echo(" [$idcommentcount]");}
                echo("</td>
                <td align='center'>$wdate</td>
                <td align='center'>$hit</td>
            </tr>
        ");
        $counter++;
    }
    echo ("</table> ");
// echo(" </div>");
    
    echo("<table border=0 width=700 align=center style='border-collapse:collapse';>
    <tr><td align=center>");

    if (!isset($cblock) || $cblock == '') {
        $cblock = 1;
    }

    $blockSize = 5;
    $pblock = $cblock - 1;
    $nblock = $cblock + 1;

    $startPage = ($cblock - 1) * $blockSize + 1;

    $pStartPage = $startPage - 1;
    $nStartPage = $startPage + $blockSize;

    if ($pblock > 0) {
        echo("[<a href='show.php?board=$board&cblock=$pblock&cpage=$pStartPage'>이전 블록</a>]");
    }

    $i = $startPage;
    while ($i < $nStartPage && $i <= $totalPage) {
        echo("[<a href='show.php?board=$board&cblock=$cblock&cpage=$i'>$i</a>]");
        $i++;
    }

    if ($nStartPage <= $totalPage) {
        echo("[<a href='show.php?board=$board&cblock=$nblock&cpage=$nStartPage'>다음 블록</a>]");
    }
    echo("</td></tr></table></div>");
}

mysqli_close($con);
?>



