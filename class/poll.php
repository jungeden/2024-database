<?php
// 응답이 선택되었는지 확인
if (!isset($_POST['answer'])) {
    echo "
    <script>
        window.alert('설문 항목을 선택해 주세요');
        history.go(-1);
    </script>";
    exit;
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "class");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$answer = (int)$_POST['answer'];
$result = mysqli_query($con, "SELECT * FROM poll");
$total = mysqli_num_rows($result);

if ($total == 0) {
    // 응답이 없는 경우 초기화
    $ans1 = 0;
    $ans2 = 0;
    $ans3 = 0;
    $ans4 = 0;
    mysqli_query($con, "INSERT INTO poll (ans1, ans2, ans3, ans4) VALUES (0, 0, 0, 0)");
} else {
    // 현재 결과 가져오기
    $row = mysqli_fetch_assoc($result);
    $ans1 = $row["ans1"];
    $ans2 = $row["ans2"];
    $ans3 = $row["ans3"];
    $ans4 = $row["ans4"];

    // 선택된 답변 업데이트
    switch ($answer) {
        case 1:
            $ans1++;
            break;
        case 2:
            $ans2++;
            break;
        case 3:
            $ans3++;
            break;
        case 4:
            $ans4++;
            break;
    }

    mysqli_query($con, "UPDATE poll SET ans1='$ans1', ans2='$ans2', ans3='$ans3', ans4='$ans4'");
}

// 전체 응답 수 계산
$total = $ans1 + $ans2 + $ans3 + $ans4;

// 비율 및 막대 그래프 너비 계산
$ans1_rate = $total ? (int)(($ans1 / $total) * 100) : 0;
$ans1_width = $total ? (int)(($ans1 / $total) * 300) : 0;
$ans2_rate = $total ? (int)(($ans2 / $total) * 100) : 0;
$ans2_width = $total ? (int)(($ans2 / $total) * 300) : 0;
$ans3_rate = $total ? (int)(($ans3 / $total) * 100) : 0;
$ans3_width = $total ? (int)(($ans3 / $total) * 300) : 0;
$ans4_rate = $total ? (int)(($ans4 / $total) * 100) : 0;
$ans4_width = $total ? (int)(($ans4 / $total) * 300) : 0;

// 결과 표시
echo "<table border=1 width=600>
<tr><td align=center colspan=4>설문 조사 결과 (총 응답자 수: $total)</td></tr>
<tr><td>항목</td><td>응답자 수</td><td>비율 (%)</td><td width=300>막대 그래프</td></tr>
<tr><td>답변 1</td><td>$ans1</td><td>$ans1_rate</td>
<td align=left><hr size=4 color=red width=$ans1_width></td></tr>
<tr><td>답변 2</td><td>$ans2</td><td>$ans2_rate</td>
<td align=left><hr size=4 color=blue width=$ans2_width></td></tr>
<tr><td>답변 3</td><td>$ans3</td><td>$ans3_rate</td>
<td align=left><hr size=4 color=brown width=$ans3_width></td></tr>
<tr><td>답변 4</td><td>$ans4</td><td>$ans4_rate</td>
<td align=left><hr size=4 color=green width=$ans4_width></td></tr>
</table>";

mysqli_close($con);
?>
