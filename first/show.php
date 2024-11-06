<?
echo("<head> 
<link rel='stylesheet' href='address.css' type='text/css'>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap');

</style></head>");

$con = mysqli_connect("localhost", "root", "0000", "class");


$sql = "SELECT * from addressbook";
$result = mysqli_query($con,$sql);
$total = mysqli_num_rows($result);
// echo ("<h1 style='text-align:center; style='font-family: \"Gowun Batang\", sans-serif;'>Addressbook</h1>");
echo("<h2 style='text-align:center; font-family: \"Gowun Batang\", sans-serif;'>주소록</h2>");


echo ("

    <form method=post action=process.php align=center>
    Name:<input type=text name=iname size=10>
    Phone:<input type=text name=iphone size=10>
    Address:<input type=text name=iaddress size=20>
    <input type=submit value=SUBMIT></form>
    ");
    
echo ("
    <table border=1 width=500 align=center style='border-collapse:collapse;'>
<tr>
<td width = 100 align=center style='background-color:white; font-family: \"Gowun Batang\", sans-serif;'>이름</td>
<td width = 150 align=center style='background-color:white; font-family: \"Gowun Batang\", sans-serif;'>전화</td>
<td width = 200 align=center style='background-color:white; font-family: \"Gowun Batang\", sans-serif;'>주소</td>
<td width = 50 align=center style='background-color:white; font-family: \"Gowun Batang\", sans-serif;'>관리</td>

</tr>");




while ($row = mysqli_fetch_assoc($result)) {
    $oname = $row['name'];
    $ophone = $row['phone'];
    $oaddress = $row['address'];
    echo ("<tr><td align=center style='background-color:white;'>$oname</td>  <td style='background-color:white;'>$ophone</td>  <td style='background-color:white;'>$oaddress</td><td align=center style='background-color:white;'><a href=modify.php?mname=$oname>O</a>/<a href=delete.php?dname=$oname>X</a></td></tr><br>");
}
echo("</table>");
// echo ("<center><a href=input.php style='font-family: \"Gowun Batang\", sans-serif;'>주소입력</a></center><br>");
echo ("<center>
            <form method=post action=search.php>
                <select name='ifield'>
                    <option>선택하세요</option>
                    <option value = 'name' selected>이름</option>
                    <option value = 'phone'>전화번호</option>
                    <option value = 'address'>주소</option>
                </select>
            검색어 <input type=text size=10 name='ikey'>
            <input type=submit value='검색'>
            </form>
    </center>");
mysqli_close($con);

?>

