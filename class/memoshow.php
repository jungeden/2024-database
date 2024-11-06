<?php
    // 데이터베이스 연결
    // $con = mysqli_connect("localhost", "root", "0000", "class");

    // // 쿼리 실행
    // $sql = "SELECT * FROM memojang ORDER BY num DESC";
    // $result = mysqli_query($con, $sql);
    // $total = mysqli_num_rows($result);

    // // 결과가 없는 경우 메시지 출력
    // if ($total == 0) {
    //     echo "아직 등록된 글이 없습니다.";
    // } else {
    //     // 테이블 헤더 출력
    //     echo "<table border=1 width=1000 style='border-collapse:collapse;'>
    //     <tr><td width=100>이름</td> <td width=100>날짜</td> <td width=450>메모</td></tr>";

    //     // 각 메모 출력
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $wname = $row['name'];
    //         $wdate = $row['wdate'];
    //         $wmemo = $row['message'];

    //         echo "<tr><td>$wname</td> <td>$wdate</td> <td>$wmemo</td></tr>";
    //     }

    //     echo "</table>";
    // }

    // echo "<br><a href='memo.html'>메모 쓰기</a>";

    // // 데이터베이스 연결 닫기
    // mysqli_close($con);


// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "class");

// 연결이 실패하면 에러 메시지 출력
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// 메모장 테이블에서 데이터를 가져오는 SQL 쿼리
$sql = "SELECT * FROM memojang ORDER BY num DESC";
$result = mysqli_query($con, $sql);

// 총 메모 수를 가져옴
$total = mysqli_num_rows($result);

if (!$total) {
    echo("아직 등록된 글이 없습니다.");
} else {
    echo("<table border=1 width=700 style='border-collapse:collapse;'>");
    echo("<tr><td width=50>글 번호</td><td width=100>이름</td><td width=400>메모</td><td width=150>날짜</td></tr>");

    // 한 페이지에 보여줄 메모 글의 개수
    $pagesize = 5;

    // 현재 페이지 설정
    $cpage = isset($_GET['cpage']) ? $_GET['cpage'] : 1;

    // 총 페이지 수 계산
    $endpage = (int)($total / $pagesize);
    if (($total % $pagesize) != 0) {
        $endpage = $endpage + 1;
    }

    // 현재 페이지에 맞는 메모 출력
    $start = ($cpage - 1) * $pagesize;
    $counter = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($counter >= $start && $counter < $start + $pagesize) {
            $num = $row["num"];
            $name = $row["name"];
            $wdate = $row["wdate"];
            $message = $row["message"];

            echo ("<tr><td>$num</td><td>$name</td><td>$message</td><td>$wdate</td></tr>");
        }
        $counter++;
        if ($counter >= $total) break;
    }
    echo("</table>");

    // 페이지 네비게이션
    echo("<table border=0 width=700><tr><td align=center>");

    // 이전 페이지 버튼
    $ppage = $cpage - 1;
    if ($cpage > 1) {
        echo ("[<a href='memoshow.php?cpage=$ppage'>이전</a>] ");
    }

    // 다음 페이지 버튼
    $npage = $cpage + 1;
    if ($cpage < $endpage) {
        echo ("[<a href='memoshow.php?cpage=$npage'>다음</a>]");
    }

    echo("</td></tr></table>");
}

echo("<br><a href='memo.html'>메모쓰기</a>");

// 데이터베이스 연결 종료
mysqli_close($con);
?>


