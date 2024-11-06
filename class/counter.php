<?php

$con = mysqli_connect("localhost", "root", "0000", "class");

$sql = "SELECT * FROM counter";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
$today = date("Ymd");

if ($total == 0) {
    // 테이블에 데이터가 없을 때 초기화
    $totalcount = 0;
    $todaycount = 0;
    $lastlogin = $today;
    mysqli_query($con, "INSERT INTO counter (today, total, lastlogin) VALUES ($todaycount, $totalcount, '$lastlogin')");
} else {
    $row = mysqli_fetch_assoc($result);
    $todaycount = intval($row["today"]);
    $totalcount = intval($row["total"]);
    $lastlogin = $row["lastlogin"];
}

// 오늘 첫 방문인지 확인
if ($lastlogin == $today) {
    $todaycount += 1;
} else {
    $todaycount = 1;
}
$totalcount += 1;

// UPDATE 쿼리에서 'id'를 제거하고 테이블 전체를 업데이트
mysqli_query($con, "UPDATE counter SET today = $todaycount, total = $totalcount, lastlogin = '$today'");

echo "TODAY = $todaycount, TOTAL = $totalcount";

mysqli_close($con);

?>

