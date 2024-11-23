<?php
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
} else {
    header("Location: loginPage.php");
    exit();
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "0000", "shop");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_GET['session'])) {
    $session = $_GET['session'];
} else {
    header("Location: orderlistPage.php");
    exit();
}


if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    $deleteorderlist = mysqli_query($con, "DELETE FROM orderlist WHERE userid='$userid' AND session='$session'");
    $deleteorderlist = mysqli_query($con, "DELETE FROM receivers WHERE userid='$userid' AND session='$session'");
    if ($deleteorderlist) {
        echo "<script>
            alert('주문이 취소되었습니다.');
            window.location.href = 'orderlistPage.php';
        </script>";
    } else {
        echo "<script>
            alert('주문 취소 중 오류가 발생했습니다: " . mysqli_error($con) . "');
            window.location.href = 'orderlistPage.php';
        </script>";
    }
    exit();
} elseif (isset($_GET['confirm']) && $_GET['confirm'] === 'no') {
    header("Location: orderlistPage.php");
    exit();
}


echo "<script>
    var userConfirm = confirm('주문을 취소하시겠습니까?');
    if (userConfirm) {
        window.location.href = '?session=$session&confirm=yes';
    } else {
        window.location.href = '?session=$session&confirm=no';
    }
</script>";
?>
