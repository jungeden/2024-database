<? //modify2.php
$mid = $_GET['mid'];
$iateam = $_POST['iateam'];
$ibteam = $_POST['ibteam'];
$iascore = $_POST['iascore'];
$ibscore = $_POST['ibscore'];

$con = mysqli_connect("localhost", "root", "0000", "class");


$result = mysqli_query($con,"SELECT * from soccer WHERE id = '$mid'");

while ($row=mysqli_fetch_assoc($result)) {
    $oid = $row['id'];
    $ateamName = $row['ateam'];
    $bteamName = $row['bteam'];
    $ateamScore = $row["ascore"];
    $bteamScore = $row["bscore"];
}
$winscore = 0;
$lossscore = 0;
$tiescore = 0;
if ($ateamScore > $bteamScore && $iascore < $ibscore) {
    $winscore = -1;
    $lossscore = 1;
    $tiescore = 0;
} else if($ateamScore < $bteamScore && $iascore > $ibscore) {
    $winscore = 1;
    $lossscore = -1;
    $tiescore = 0;
} else if($ateamScore == $bteamScore && $iascore > $ibscore){
    $winscore = 1;
    $lossscore = 0;
    $tiescore = -1;
} else if($ateamScore == $bteamScore && $iascore < $ibscore){
    $winscore = 0;
    $lossscore = 1;
    $tiescore = -1;
} else if($ateamScore > $bteamScore && $iascore == $ibscore){
    $winscore = -1;
    $lossscore = 0;
    $tiescore = 1;
} else if($ateamScore < $bteamScore && $iascore == $ibscore){
    $winscore = 0;
    $lossscore = -1;
    $tiescore = 1;
}

$ateamupdate = "UPDATE team 
                SET win = win + $winscore, 
                    loss = loss + $lossscore, 
                    tie = tie + $tiescore, 
                    deuk = deuk - $ateamScore + $iascore, 
                    sil = sil - $bteamScore + $ibscore, 
                    point = ((win + $winscore) * 3) + ((tie + $tiescore) * 1)
                WHERE name = '$ateamName'";
mysqli_query($con, $ateamupdate);

$bteamupdate = "UPDATE team 
                SET win = win + $lossscore, 
                    loss = loss + $winscore, 
                    tie = tie + $tiescore, 
                    deuk = deuk - $bteamScore + $ibscore, 
                    sil = sil - $ateamScore + $iascore, 
                    point = ((win + $winscore) * 3) + ((tie + $tiescore) * 1)
                WHERE name = '$bteamName'";
mysqli_query($con, $bteamupdate);

$updateShow = "UPDATE soccer 
                SET ascore = $iascore,
                    bscore = $ibscore
                WHERE id = '$mid'";

$result = mysqli_query($con, $updateShow);
$total = mysqli_affected_rows($con);

mysqli_close($con);
echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");

?>