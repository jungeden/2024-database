<?
echo("<head> 
<link rel='stylesheet' href='address.css' type='text/css'>

<style>
        @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap');

</style></head>");
$con = mysqli_connect("localhost", "root", "0000", "class");

$mname = isset($_GET['mname']) ? $_GET['mname'] : '';
// echo ($mname);

$sql = "SELECT * from addressbook WHERE name='$mname'";
$result = mysqli_query($con,$sql);
$total = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result);
$oname = $row['name'];
$ophone = $row['phone'];
$oaddress = $row['address'];

echo ("<tr><td align=center>$oname</td>  <td>$ophone</td>  <td>$oaddress</td><td align=center><br>");

echo ("<h1> Addressbook</h1>

    <form method=post action=process2.php?mname=$mname>
    Name:<input type=text name=iname size=10 value='$oname'><br>
    Phone:<input type=text name=iphone size=10 value='$ophone'><br>
    Address:<input type=text name=iaddress size=20 value='$oaddress'><br>
    <input type=submit value=MODIFY></form>
    ");
    

?>