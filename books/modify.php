<?
$con = mysqli_connect("localhost", "root", "0000", "class");
$mbcode = $_GET['mbcode'];

$sql = "SELECT * from mbook WHERE bcode='$mbcode'";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);
$obname = $row['bname'];
$obprice = $row['bprice'];
$obunit = $row['bunit'];

echo("
        <h1 style='text-align:center;'>도서 재고 관리</h1>
        <form method=post action=modify2.php?mbcode=$mbcode align=center >
        <td align=center width=100>도서코드:<b> $mbcode</b></td>
        도서이름:<input name=ibname type=text size=10 value='$obname'>
        도서단가:<input name=ibprice type=text size=10 value='$obprice'>
        도서수량:<input name=ibunit type=text size=10 value='$obunit'>
        <input type=submit value=수정완료>
        </form>
    ");



?>