<?php

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "class");
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// 전달된 값 검사 및 할당
$delimage = isset($_GET['delimage']) ? mysqli_real_escape_string($con, $_GET['delimage']) : null;
$delpasswd = isset($_POST['delpasswd']) ? $_POST['delpasswd'] : null;

if (!$delimage || !$delpasswd) {
    echo ("<script>
           window.alert('필수 정보가 누락되었습니다.')
           history.go(-1);
           </script>");
    exit;
}

// 기존 비밀번호 조회
$query = "SELECT passwd FROM photo WHERE userfile='$delimage'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $oldpasswd = $row['passwd'];

    // 입력한 비밀번호가 맞는지 확인
    if ($delpasswd === $oldpasswd) {
        // 이미지 및 데이터베이스에서 삭제
        $deleteQuery = "DELETE FROM photo WHERE userfile='$delimage'";
        mysqli_query($con, $deleteQuery);
        unlink("./photo/$delimage");
        
        echo ("<script>
               window.alert('사진이 성공적으로 삭제되었습니다.')
               history.go(1);
               </script>");
    } else {
        echo ("<script>
               window.alert('비밀번호가 일치하지 않습니다. 다시 확인해주세요.')
               history.go(-1);
               </script>");
    }
} else {
    echo ("<script>
           window.alert('삭제할 사진이 존재하지 않습니다.')
           history.go(-1);
           </script>");
}

// 데이터베이스 연결 종료
mysqli_close($con);

// 페이지 리프레시
echo ("<meta http-equiv='Refresh' content='0; url=p-show.php'>");

?>
