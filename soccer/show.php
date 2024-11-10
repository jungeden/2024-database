<?
echo("
        <h1 style='text-align:center;'>k-리그 축구 기록 관리</h1>
        <form method=post action=process.php align=center >
        <select name='iateam'>
            <option>클럽선택</option>
            <option value='강원'>강원</option>
            <option value='서울'>서울</option>
            <option value='제주'>제주</option>
            <option value='전북'>전북</option>
            <option value='부산'>부산</option>
            <option value='경남'>경남</option>
            <option value='대구'>대구</option>
         </select>
:
         <select name='ibteam'>
            <option>상대팀선택</option>
            <option value='강원'>강원</option>
            <option value='서울'>서울</option>
            <option value='제주'>제주</option>
            <option value='전북'>전북</option>
            <option value='부산'>부산</option>
            <option value='경남'>경남</option>
            <option value='대구'>대구</option>
         </select>
=
         <select name='iascore'>
            <option>득점선택</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
         </select>
:
          <select name='ibscore'>
            <option>득점선택</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
         </select>
        <input type=submit value=등록>
        </form>
");

$con = mysqli_connect("localhost", "root", "024120", "class");
$sql = "SELECT * from soccer";

$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
echo("<p style='text-align:center;'><a href=team.php >k-리그 순위</a></p>");
echo("<table border=1 width=700 align=center style='border-collapse:collapse'>
    <tr >
    <td align=center width=100>번호</td>
    <td align=center width=100>클럽이름</td>
    <td align=center width=150>상대팀클럽</td>
    <td align=center width=100>득점</td>
    <td align=center width=100>실점</td>
  
    <td align=center width=300>경기일자</td>
    <td align=center width=100>관리</td>
    </tr>");
 // ID 부여

 
   

    $pagesize = 5;

    // 현재 페이지 설정
    $cpage = isset($_GET['cpage']) ? $_GET['cpage'] : 1;

    // 총 페이지 수 계산
    $endpage = (int)($total / $pagesize);
    if (($total % $pagesize) != 0) {
        $endpage = $endpage + 1;
    }

    $start = ($cpage - 1) * $pagesize;
    $counter = 0;
    while ($_POST = mysqli_fetch_assoc($result)) {
        if ($counter >= $start && $counter < $start + $pagesize) {
            $oid = $_POST['id'];
            $oateam = $_POST['ateam'];
            $obteam = $_POST['bteam'];
            $oascore = $_POST["ascore"];
            $obscore = $_POST["bscore"];
            $opdate = $_POST["pdate"];
      
        echo("<tr style='text-align:center;'><td>$oid</td><td>$oateam</td> <td>$obteam</td> <td>$oascore</td> <td>$obscore</td> <td>$opdate</td>  
        <td><a href=modify.php?mid=$oid>O</a>/<a href=delete.php?did=$oid>X</a></td> </tr>");
    }
        $counter++;
        if ($counter >= $total) break;
    }

    
    echo("</table>");

    echo("<table border=0 width=700><tr><td align=center>");

 
    $ppage = $cpage - 1;
    if ($cpage > 1) {
        echo ("[<a href='show.php?cpage=$ppage' style='text-align:center;'>이전</a>] ");
    }


    $npage = $cpage + 1;
    if ($cpage < $endpage) {
        echo ("[<a href='show.php?cpage=$npage' style='text-align:center;'>다음</a>]");
    }

    echo("</td></tr></table>");
?>