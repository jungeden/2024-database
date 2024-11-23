<?
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>");
$key=$_POST['key'];
$field = $_POST['field'];
$board = $_GET['board'];

if(!$key){
    echo("<script>
    window.alert('검색어를 입력하세요');
    history.go(-1);
    </script>");
    exit;
}
echo("
<style type='text/css'>
    a {text-decoration: none; color: antiquewhite;}
    a:hover {text-decoration: underline;
            color: rgb(172, 155, 134);
            }

</style>");
$con = mysqli_connect("localhost", "root", "0000", "class");
$sql = "SELECT * from $board WHERE $field like '%$key%' order by id desc";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
echo("

<div class='container'>
<table border=0 width=700 style='border-collapse:collapse'; align=center>
<tr><td align=center colspan=2><h1>게시판</h1></td></tr>
<tr><td>검색어 : $key, 찾은 개수 : $total 개</td>
<td align=right>
<a href=show.php?board=$board>
    <svg xmlns='http://www.w3.org/2000/svg' height='22px' viewBox='0 -960 960 960' width='22px' fill='#faebd7'><path class='icon' d='M323.79-289.43q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.28-10.5 10.29-10.5 25.5 0 15.22 10.29 25.72 10.29 10.5 25.5 10.5Zm0-154.57q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5Zm0-154.57q15.21 0 25.71-10.28 10.5-10.29 10.5-25.5 0-15.22-10.29-25.72-10.29-10.5-25.5-10.5t-25.71 10.29q-10.5 10.29-10.5 25.5t10.29 25.71q10.29 10.5 25.5 10.5ZM432-289.43h240v-72H432v72ZM432-444h240v-72H432v72Zm0-154.57h240v-72H432v72Zm-213.13 462.7q-34.48 0-58.74-24.26-24.26-24.26-24.26-58.74v-522.26q0-34.48 24.26-58.74 24.26-24.26 58.74-24.26h522.26q34.48 0 58.74 24.26 24.26 24.26 24.26 58.74v522.26q0 34.48-24.26 58.74-24.26 24.26-58.74 24.26H218.87Zm0-83h522.26v-522.26H218.87v522.26Zm0-522.26v522.26-522.26Z'/></svg>
</a></td></tr>
</table>");
echo("<div class='infobox'>
<table border=0 width=700 style='border-collapse:collapse;' align=center>
<tr>
 <td class='element num' width=100><b>번호</b></td>
        <td class='element wri' width=200><b>글쓴이</b></a></td>
        <td align=center colspan=2 class='element wri' width=400><b>제목</b></a></td>
        <td class='element wd' width=200><b>날짜</b></td>
        <td  class='element hit' width=100><b>조회</b></td></tr>
");

if(!$total) {
    echo("<tr><td colspan=5 align=center>검색된 글이 없습니다.</td></tr>");
} else {
    $counter=0;

    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch data from the row
        $id = $row['id'];
        $writer = $row['writer'];
        $topic = $row['topic'];
        
        $wdate = $row['wdate'];
        $hit = $row['hit'];
        $space = $row['space'];
    
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
        </tr>");
        $counter = $counter+1;
    }
    echo "</table></div></div>";
}
mysqli_close($con);
?>
