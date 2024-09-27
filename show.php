<?
echo("<head> 
<link rel='stylesheet' href='address.css' type='text/css'>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap');

</style></head>");

$con = mysqli_connect("localhost", "root", "024120", "class");


$sql = "SELECT * from addressbook";
$result = mysqli_query($con,$sql);
$total = mysqli_num_rows($result);
echo ("<h1 style='font-family: \"Gowun Batang\", sans-serif;'>Addressbook</h1>");
echo("<h2 style='text-align:center; font-family: \"Gowun Batang\", sans-serif;'>주소록</h2>");
echo ("
    <table border=1 width=500 align=center style='border-collapse:collapse;'>
<tr>
<td width = 100 align=center style='background-color:gray; font-family: \"Gowun Batang\", sans-serif;'>이름</td>
<td width = 150 align=center style='background-color:gray; font-family: \"Gowun Batang\", sans-serif;'>전화</td>
<td width = 200 align=center style='background-color:gray; font-family: \"Gowun Batang\", sans-serif;'>주소</td>
<td width = 50 align=center style='background-color:gray; font-family: \"Gowun Batang\", sans-serif;'>관리</td>

</tr>");




while ($row = mysqli_fetch_assoc($result)) {
    $oname = $row['name'];
    $ophone = $row['phone'];
    $oaddress = $row['address'];
    echo ("<tr><td align=center>$oname</td>  <td>$ophone</td>  <td>$oaddress</td><td align=center>O/<a href=delete.php?dname=$oname>X</a></td></tr><br>");
}
echo("</table>");
echo ("<center><a href=input.php style='font-family: \"Gowun Batang\", sans-serif;'>주소입력</a></center><br>");
mysqli_close($con);

?>

