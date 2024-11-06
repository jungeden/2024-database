<?php
// 데이터베이스 연결
$db_conn = mysqli_connect("localhost", "root", "0000", "class");

// 파일 업로드 처리
if (isset($_FILES['upfile']) && $_FILES['upfile']['name'] != "") {
    $file = $_FILES['upfile'];
    $upload_directory = 'data/';
    $allowed_extensions = ["hwp", "xls", "doc", "xlsx", "docx", "pdf", "jpg", "gif", "png", "txt", "ppt", "pptx"];
    $max_file_size = 5242880; // 5MB

    // 파일 확장자 추출
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // 확장자 체크
    if (!in_array($ext, $allowed_extensions)) {
        echo "업로드할 수 없는 확장자입니다.";
        exit;
    }

    // 파일 크기 체크
    if ($file['size'] > $max_file_size) {
        echo "5MB 까지만 업로드 가능합니다.";
        exit;
    }

    // 고유한 파일 이름 생성
    $path = md5(microtime()) . '.' . $ext;

    // 파일 이동
    if (move_uploaded_file($file['tmp_name'], $upload_directory . $path)) {
        // 데이터베이스에 파일 정보 저장
        $query = "INSERT INTO upload_file (file_id, name_orig, name_save, reg_time) VALUES (?, ?, ?, NOW())";
        $file_id = md5(uniqid(rand(), true));
        $name_orig = $file['name'];
        $name_save = $path;

        $stmt = mysqli_prepare($db_conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // 성공 메시지 출력
        echo "<h3>파일 업로드 성공</h3>";
        echo '<a href="file_list.php">업로드 파일 목록</a>';
    } else {
        echo "<h3>파일 업로드에 실패했습니다.</h3>";
        echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
    }
} else {
    echo "<h3>파일이 업로드되지 않았습니다.</h3>";
    echo '<a href="javascript:history.go(-1);">이전 페이지</a>';
}

// 데이터베이스 연결 종료
mysqli_close($db_conn);
?>
