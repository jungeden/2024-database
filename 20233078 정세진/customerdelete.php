<?
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    header("Location: loginPage.php");
    exit();
}


$con=mysqli_connect("localhost",'root','0000','shop');

$id=$_GET['id'];



if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    $file = mysqli_query($con, "SELECT * FROM customerboard WHERE id='$id'");
    $row = mysqli_fetch_assoc($file);
    // $num=$row['num'];
    $deleted_num = $row['num'];
    $customerfiles = explode(',', $row['customerfile']); 

    foreach ($customerfiles as $customerfile) {
        $customerfile = trim($customerfile); // 공백 제거
        if ($customerfile && file_exists("./customerfiles/$customerfile")) {
            unlink("./customerfiles/$customerfile");
        }
    }

    $delete = mysqli_query($con,"DELETE FROM customerboard WHERE id=$id");


    $result = mysqli_query($con, "SELECT num FROM customerboard ORDER BY num DESC");
    $row = mysqli_fetch_assoc($result);
    $last = $row['num'];

    mysqli_query($con, "UPDATE customerboard SET num = num - 1 WHERE num > '$deleted_num'");

    echo("<script>window.alert('글이 삭제 되었습니다.');</script>");
    mysqli_close($con);
    header("Location: customerPage.php");

    exit();
} else if (isset($_GET['confirm']) && $_GET['confirm'] === 'no') {
    mysqli_close($con);

    header("Location: customerboarddetailPage.php?id=$id");
    exit();
}
echo "<script>
    var userConfirm = confirm('글을 삭제하시겠습니까?');
    if (userConfirm) {
        window.location.href = '?id=$id&confirm=yes';
    } else {
        window.location.href = '?id=$id&confirm=no';
    }
</script>";

?>