<?
// $con = mysqli_connect("localhost", "root", "024120", "class");

// $sql = "DELETE from addressbook where name = '$dname'";
// $result = mysqli_query($con,$sql);

// echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");

$con = mysqli_connect("localhost", "root", "024120", "class");

// GET 요청에서 dname 값을 받아오기
$dname = isset($_GET['dname']) ? $_GET['dname'] : '';

if ($dname) {
    // SQL 인젝션 방지를 위해 prepared statement 사용
    $stmt = $con->prepare("DELETE FROM addressbook WHERE name = ?");
    $stmt->bind_param("s", $dname);
    $stmt->execute();
    $stmt->close();
}

echo ("<meta http-equiv='Refresh' content='0; url=show.php'>");
mysqli_close($con);



?>