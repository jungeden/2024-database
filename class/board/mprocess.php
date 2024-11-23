<?
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>");
$board = $_GET['board'];  
$id = $_GET['id'];
$writer = $_POST['writer'];
$topic = $_POST['topic'];
$content = $_POST['content'];
$email = $_POST['email'];



if (!$writer) {
    echo("<script> window.alert('이름이 없습니다. 다시 입력하세요'
    history.go(-1);</script>");
    exit;
}
if(!$topic) {
    echo("<script> window.alert('제목이 없습니다. 다시 입력하세요'
    history.go(-1;</script>");
    exit;
}
if(!$content) {
    echo("<script> window.alert('내용이 없습니다. 다시 입력하세요'
    history.go(-1);</script>");
    exit;
}
$con = mysqli_connect("localhost", "root", "0000", "class");
$sql = "SELECT * from $board WHERE id=$id";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);
$space = $row['space'];
$hit = $row['hit'];
$opasswd = $row['passwd'];

$passwd = isset($_POST['passwd']) && $_POST['passwd'] !== '' ? $_POST['passwd'] : $opasswd;

$wdate = date('Y-m-d');

$new = "UPDATE testboard set writer='$writer', email='$email', passwd='$passwd',topic='$topic', content='$content', hit='$hit', wdate='$wdate', space=$space WHERE id=$id";
$result = mysqli_query($con, $new);

//------------------------
if (!empty($_FILES['userfile']['name'])) {
    $savedir = "./files";
    echo realpath($savedir); 
    
    if (!file_exists($savedir)) {
        mkdir($savedir, 0777, true); 
    }
    
    // 파일 업로드 처리
    $userfile_name = $_FILES['userfile']['name'];
    $userfile_size = $_FILES['userfile']['size'];
    $filepath = "$savedir/$userfile_name";
    
    // 업로드 중 오류 발생 여부 확인
    
    // 파일 업로드 시도
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $filepath)) {
        echo "파일이 성공적으로 업로드되었습니다.";
    } else {
        
    }
    // 데이터베이스에 삽입
    $insert_query = "INSERT INTO boardfile (id, writer, passwd, title, wdate, fileName, fileSize) 
                     VALUES ('$id','$writer', '$passwd', '$title', '$wdate', '$userfile_name', '$userfile_size')";
    
    mysqli_query($con, $insert_query);
}


mysqli_close($con);

echo("<meta http-equiv='Refresh' content='0; url=show.php?board=$board'>");



?>