<?
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');
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
$con = mysqli_connect("localhost", "root", "024120", "class");
$sql = "SELECT * from $board WHERE $field like '%$key%' order by id desc";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
echo("<table border=0 width=700 style='border-collapse:collapse'; align=center>
<tr><td align=center colspan=2><h1>게시판</h1></td></tr>
<tr><td>검색어:$key, 찾은 개수:$total 개</td>
<td align=right><a href=show.php?board=$board>[전체목록]</a></td></tr>
</table>");
echo("<table border=1 width=700 style='border-collapse:collapse;' align=center>
<tr>
<td align=center width=50><b>번호</b></td>
<td align=center width=100><b>글쓴이</b></td>
<td align=center width=400><b>제목</b></td>
<td align=center width=150><b>날짜</b></td>
<td align=center width=50><b>조회</b></td></tr>
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
            <td align='left'>$t<a href='content.php?board=$board&id=$id'>$topic</a></td>
            <td align='center'>$wdate</td>
            <td align='center'>$id</td>
        </tr>");
        $counter = $counter+1;
    }
    echo "</table>";
}
mysqli_close($con);
?>
