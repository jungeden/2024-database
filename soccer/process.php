<?php
// process.php
$con = mysqli_connect("localhost", "root", "0000", "class");
date_default_timezone_set('Asia/Seoul'); 

$pdate = date("Y-m-d H:i:s");



$iateam = $_POST['iateam'];
$ibteam = $_POST['ibteam'];
$iascore = $_POST['iascore'];
$ibscore = $_POST['ibscore'];


$result = mysqli_query($con, "SELECT MAX(id) AS max_id FROM soccer");
$row = mysqli_fetch_assoc($result);
$id = $row['max_id'] + 1;  


$insert = "INSERT INTO soccer (id, ateam, bteam, ascore, bscore, pdate)  
           VALUES ('$id', '$iateam', '$ibteam', '$iascore', '$ibscore', '$pdate')";
$result = mysqli_query($con, $insert);


$tiescore = 0;
$winscore = 0;
$lossscore = 0;


if ($iascore > $ibscore) {
    $winscore = 1;
    $lossscore = 0;
    $tiescore = 0;
} else if ($iascore < $ibscore) {
    $winscore = 0;
    $lossscore = 1;
    $tiescore = 0;
} else {
    $tiescore = 1;
}

$ateamPoint = ($winscore * 3) + ($tiescore * 1);
$teamupdate1 = "UPDATE team 
                SET win = win + $winscore, 
                    loss = loss + $lossscore, 
                    tie = tie + $tiescore, 
                    deuk = deuk + $iascore, 
                    sil = sil + $ibscore, 
                    point = point + $ateamPoint
                WHERE name = '$iateam'";
mysqli_query($con, $teamupdate1);


if (mysqli_affected_rows($con) == 0) {
    $teaminsert1 = "INSERT INTO team (name, win, tie, loss, deuk, sil, point)  
                    VALUES ('$iateam', '$winscore', '$tiescore', '$lossscore', '$iascore', '$ibscore', '$ateamPoint')";
    mysqli_query($con, $teaminsert1);
}

$bteamPoint = ($lossscore * 3) + ($tiescore * 1);
$teamupdate2 = "UPDATE team 
                SET win = win + $lossscore, 
                    loss = loss + $winscore, 
                    tie = tie + $tiescore, 
                    deuk = deuk + $ibscore, 
                    sil = sil + $iascore, 
                    point = point + $bteamPoint
                WHERE name = '$ibteam'";
mysqli_query($con, $teamupdate2);

// 두 번째 팀이 없으면 삽입
if (mysqli_affected_rows($con) == 0) {
    $teaminsert2 = "INSERT INTO team (name, win, tie, loss, deuk, sil, point)  
                    VALUES ('$ibteam', '$lossscore', '$tiescore', '$winscore', '$ibscore', '$iascore', '$bteamPoint')";
    mysqli_query($con, $teaminsert2);
}


mysqli_close($con);


echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");
?>
