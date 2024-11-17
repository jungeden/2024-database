<?
session_start();
include('top.php');



?>

<?
echo("
<style>
        @import url(my.css);
    </style>");
// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';

// if($userid=='') {
//     $page='my';
//     echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php?page=$my'>");
// }

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
} else {
    $page='my';
    header("Location: loginPage.php?page=$page");
    exit();
} 

$con = mysqli_connect("localhost","root","0000","shop");
$getuserinfo=mysqli_query($con, "SELECT * from user WHERE userid='$userid'");
$row=mysqli_fetch_assoc($getuserinfo);
$username=$row['username'];
$userphone=$row['userphone'];
$useremail=$row['useremail'];
$address1=$row['address1'];
$address2=$row['address2'];
$useraddress= $address1 . $address2;

$num1 = substr($userphone, 0, 3);  
$num2 = substr($userphone, 3, 4); 
$num3 = substr($userphone, 7, 4);  




echo("


        <div class='middle'>
            <div class='left middle'>
                <div class='usernamebox'>
                    <div class=username>
                        <div class='usernametext'>
                            <a class='text name'>$userid</a>
                            <a class='text nim'>님</a>
                        </div>
                        <div class='logouttext'>
                            <a class='logouttext' href='logout.php' >LOGOUT<a>
                        </div>
                    </div>

                </div>
                <div class='menubox'>
                    <div class='menutext'>
                        <div class='mbox'>
                            <a class='m' href='pass.php'>회원정보 수정</a>
                            <div class='mdiv'></div>
                        </div>
                        <div class='mbox'>
                            <a class='m' href='shoppingcartPage.php'>장바구니</a>
                            <div class='mdiv'></div>
                        </div>
                        <div class='mbox'>
                            <a class='m' href='likePage.php'>찜</a>
                            <div class='mdiv'></div>
                        </div>
                        <div class='mbox'>
                            <a class='m' href='orderlistPage.php'>주문목록</a>
                            <div class='mdiv'></div>
                        </div>
                        <div class='mbox'>
                            <a class='m' href='customersPage.php'>고객센터</a>
                            <div class='mdiv'></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class='right middle'>
                <div class='userinfobox'>
                    <a class='text infolabeltext'>이름<a>
                    <a class='text userinfotext'>$username<a>
                    <a class='text infolabeltext'>전화번호<a>
                    <a class='text userinfotext'>$num1-$num2-$num3<a>
                    <a class='text infolabeltext'>이메일<a>
                    <a class='text userinfotext'>$useremail<a>
                    <a class='text infolabeltext'>주소<a>
                    <a class='text userinfotext'>$useraddress<a>
                </div>
            </div>
        </div>
    </div>
<body>
");



?>