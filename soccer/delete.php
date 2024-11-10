<? //delete.php
$did = $_GET['did'];

$con = mysqli_connect("localhost", "root", "0000", "class");

//team.php 삭제
$result = mysqli_query($con,"SELECT * from soccer WHERE id = '$did'");

while ($_POST=mysqli_fetch_assoc($result)) {
    $oid = $_POST['id'];
    $ateamName = $_POST['ateam'];
    $bteamName = $_POST['bteam'];
    $ateamScore = $_POST["ascore"];
    $bteamScore = $_POST["bscore"];
}

if ($ateamScore > $bteamScore) {
    $winscore = -1;
    $lossscore = 0;
    $tiescore = 0;
} else if($ateamScore < $bteamScore) {
    $winscore = 0;
    $lossscore = -1;
    $tiescore = 0;
} else {
    $winscore = 0;
    $lossscore = 0;
    $tiescore = -1;
}
//ateam
$ateamPoint = ($winscore * 3) + ($tiescore * 1);
$ateamupdate = "UPDATE team 
                SET win = win + $winscore, 
                    loss = loss + $lossscore, 
                    tie = tie + $tiescore, 
                    deuk = deuk - $ateamScore, 
                    sil = sil - $bteamScore, 
                    point = point + $ateamPoint
                WHERE name = '$ateamName'";
mysqli_query($con, $ateamupdate);
//bteam
$bteamPoint = ($lossscore * 3) + ($tiescore * 1);
$bteamupdate = "UPDATE team 
                SET win = win + $lossscore, 
                    loss = loss + $winscore, 
                    tie = tie + $tiescore, 
                    deuk = deuk - $bteamScore, 
                    sil = sil - $ateamScore, 
                    point = point + $bteamPoint
                WHERE name = '$bteamName'";
mysqli_query($con, $bteamupdate);
//ateam 경기 기록 없으면 아예 삭제
$agame = mysqli_query($con, "SELECT win,loss,tie FROM team WHERE name='$ateamName'");
$_POST = mysqli_fetch_assoc($agame);
$awin = $_POST['win'];
$atie = $_POST['tie'];
$aloss = $_POST['loss'];

if($awin+$atie+$aloss == 0) {
    $delete = "DELETE from team WHERE name = '$ateamName'";
    $result2 = mysqli_query($con, $delete);
} 
//bteam 경기 기록 없으면 아예 삭제
$bgame = mysqli_query($con, "SELECT win,loss,tie FROM team WHERE name='$bteamName'");
$_POST = mysqli_fetch_assoc($bgame);
$bwin = $_POST['win'];
$btie = $_POST['tie'];
$bloss = $_POST['loss'];

if($bwin+$btie+$bloss == 0) {
    $delete = "DELETE from team WHERE name = '$bteamName'";
    $result2 = mysqli_query($con, $delete);
} 

//show.php 삭제
$deleteShow = "DELETE from soccer WHERE id = '$did'";

$result = mysqli_query($con, $deleteShow);
$total = mysqli_affected_rows($con);


echo("<script>window.alert('해당기록이 삭제 되었습니다.');</script>");

$idChangeQuery = "SELECT id FROM soccer ORDER BY id DESC";
$idChangeResult = mysqli_query($con, $idChangeQuery);

if ($idChangeResult && mysqli_num_rows($idChangeResult) > 0) {
    $_POST = mysqli_fetch_assoc($idChangeResult);
    $last = $_POST['id'];

    for ($i = $did + 1; $i <= $last; $i++) {
        $change = "UPDATE soccer SET id = id - 1 WHERE id = $i";
        mysqli_query($con, $change);
    }
}


mysqli_close($con);

echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");

?>