<?
echo("<head> 
<link rel='stylesheet' href='address.css' type='text/css'>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap');
         display:flex; 
         flex-direction:colunm; 
         justify-content:center;
       

</style></head>");

$con = mysqli_connect("localhost", "root", "0000", "class");

$ifield = $_POST['ifield'];
$ikey = $_POST['ikey'];


$sql = "SELECT * from addressbook WHERE $ifield like '%$ikey%'";
$result = mysqli_query($con,$sql);
$total = mysqli_num_rows($result);
echo ("<h1 style='font-family: \"Gowun Batang\", sans-serif;'>Addressbook</h1>");
echo("<h2 style='text-align:center; font-family: \"Gowun Batang\", sans-serif;'>검색결과</h2>");


echo ("
    <table border=1 width=500 align=center style='border-collapse:collapse;'>
<tr>
<td width = 100 align=center style='background-color:white; font-family: \"Gowun Batang\", sans-serif;'>이름</td>
<td width = 150 align=center style='background-color:white; font-family: \"Gowun Batang\", sans-serif;'>전화</td>
<td width = 200 align=center style='background-color:white; font-family: \"Gowun Batang\", sans-serif;'>주소</td>


</tr>");




while ($row = mysqli_fetch_assoc($result)) {
    $oname = $row['name'];
    $ophone = $row['phone'];
    $oaddress = $row['address'];
    echo ("<tr><td align=center style='background-color:white;'>$oname</td>  <td style='background-color:white;'>$ophone</td>  <td style='background-color:white;'>$oaddress</td></tr><br>");
}
echo("</table>");
// echo ("<center><a href=input.php style='font-family: \"Gowun Batang\", sans-serif;'>주소입력</a></center><br>");

mysqli_close($con);

?>

