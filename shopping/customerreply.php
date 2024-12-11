<?
session_start();


// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}
$con = mysqli_connect("localhost","root", "0000", "shop");

$parentid=$_GET['parentid'];
$issecret=$_GET['issecret'];
$class = $_GET['class'];
$content = $_POST['content'];
$topic = $_POST['topic'];

$parentspace = mysqli_query($con, "SELECT num, space FROM customerboard WHERE id=$parentid");
if (!$parentspace || mysqli_num_rows($parentspace) == 0) {
    echo ("<script>
        window.alert('부모 글이 존재하지 않습니다.');
        history.go(-1);
    </script>");
    exit;
}
$row = mysqli_fetch_assoc($parentspace);
$parent_num = $row['num'];
$space = $row['space'] + 1;
echo ("<script>
        console.log($parent_num);
    </script>");


if (empty($topic)) {
    echo ("<script>
        window.alert('제목을 입력해주세요');
        history.go(-1);
    </script>");
    exit;
}
if (empty($class)) {
    echo ("<script>
        window.alert('문의 유형을 선택해주세요');
        history.go(-1);
    </script>");
    exit;
}
if (empty($content)) {
    echo ("<script>
        window.alert('내용을 입력해주세요');
        history.go(-1);
    </script>");
    exit;
}

$wdate = date("Y-m-d");
mysqli_query($con, "UPDATE customerboard SET num = num + 1 WHERE num >= '$parent_num'");

$new_num = $parent_num;
echo ("<script>
        console.log($new_num);
    </script>");
$insertboard = mysqli_query($con, "INSERT INTO customerboard (num, userid, topic, content, hit, wdate, space, parentid, class, issecret) 
        VALUES ('$new_num', '$userid', '$topic', '$content', 0, '$wdate', $space, $parentid, '$class' , '$issecret')");



mysqli_close($con);
header("Location: customerPage.php");
exit;


?>