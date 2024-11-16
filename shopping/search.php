<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
$selectedclass = isset($_POST['selectedClass']) ? $_POST['selectedClass'] : '';
$searchname = isset($_POST['name']) ? $_POST['name'] : '';

// MySQL 연결
$con = mysqli_connect("localhost", "root", "0000", "shop");

// 사용자가 입력한 값을 SQL에서 안전하게 사용하기 위해 escape 처리
$searchname = mysqli_real_escape_string($con, $searchname);
$selectedclass = mysqli_real_escape_string($con, $selectedclass);

if($selectedclass == '') {
    $sql = "SELECT * FROM product ORDER BY code DESC";

} else if($selectedclass == '모두') {
    // name을 LIKE로 검색, $searchname이 포함된 제품을 찾음
    $sql = "SELECT * FROM product WHERE name LIKE '%$searchname%'";
} else {
    // 특정 class를 검색
    $sql = "SELECT * FROM product WHERE class = '$selectedclass' AND name LIKE '%$searchname%'";
}

$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

// 결과가 있으면 출력
if ($total > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // 필요한 데이터를 가져옵니다.
        $code = $row['code'];
        $name = $row['name'];
        $price1 = $row['price1'];
        $price2 = $row['price2'];
        $content = $row['content'];
        $class = $row['class'];
        $userfile = $row['userfile'];
        $hit = $row['hit'];
        // 각 제품을 표시하는 코드 작성
    }
} else {
    $comment= "해당 상품이 없습니다.";
}


?>