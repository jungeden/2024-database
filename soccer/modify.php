<? //modify.php
$mid = $_GET['mid'];
$con = mysqli_connect("localhost", "root", "0000", "class");

$result = mysqli_query($con,"SELECT * from soccer WHERE id = '$mid'");
$row = mysqli_fetch_assoc($result);
$id = $row['id'];
$ateam = $row['ateam'];
$bteam = $row['bteam'];
$ascore = $row["ascore"];
$bscore = $row["bscore"];
$pdate = $row["pdate"];

echo(" <h1 style='text-align:center;'>k-리그 축구 기록 수정</h1>");
echo(" <h2 style='text-align:center;'>$ateam : $bteam = $ascore : $bscore (경기일자: $pdate)</h2>");

echo("
<form method=post action=modify2.php?mid=$mid align=center >
        <input type=text name=iateam size=10 value='$ateam'>
        :
        <input type=text name=ibteam size=10 value='$bteam'>
=
         <select name='iascore' >
            <option >$ascore</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
         </select>
:
          <select name='ibscore' >
            <option>$bscore</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
         </select>
        <input type=submit value=수정완료>
        </form>
");

?>