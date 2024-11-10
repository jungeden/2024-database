<?
$userid = isset($_GET['userid']) ? $_GET['userid'] : '';

$my=1;
$usermodify='usermodify';
$passwdmodify='passwdmodify';

$con = mysqli_connect("localhost", "root", "0000", "shop");
if($userid!='') {
$userinfo=mysqli_query($con, "SELECT * from user WHERE userid='$userid'");

$row = mysqli_fetch_assoc($userinfo);
$passwd = $row['userpasswd'];
$username = $row['username'];
$userphone = $row['userphone'];
$useremail = $row['useremail'];
$userbirth = $row['userbirth'];
$userjoindate = $row['userjoindate'];
$zipcode = $row['zipcode'];
$address1 = $row['address1'];
$address2 = $row['address2'];
$approved = $row['approved'];
$i = 0;
$phone1 = $phone2 = $phone3 = "";  

while (true) {
    if ($i < 3) { 
        $phone1 .= $userphone[$i];  
    } else if ($i >= 3 && $i < 7) {
        $phone2 .= $userphone[$i];
    } else if ($i >= 7 && $i < 11) {
        $phone3 .= $userphone[$i];
    } else {
        break;
    }
    $i++;
}
}
echo("
<head>
        <style>

        @import url(start.css);
        @import url(my.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
        ");
//         echo(".input {background-color:rgb(215, 233, 250);
//         border: 2px solid rgb(139, 164, 190);
//         color:rgb(24, 25, 28);
//         }
//         .input.submit{background-color:rgb(139, 164, 190);
//         color:rgb(215, 233, 250);
//         }
//         .input.submit:hover {
//         background-color:rgb(215, 233, 250);
//         color:rgb(139, 164, 190);

// }");
        echo("

    </style>

    </head>
    <body>
        <div class='container my'>
            <div class='top my'>
                <div class='left top'>
                    <div class='tltle'>
                        <a class='title' href='startPage.php?userid=$userid'>TITLE</a>
                    </div>
                </div>
                <div class='right top'>

                </div>
            </div>
            <div class='middle my'>
                <div class='left middle'>
                    <div class='infoname'>
                        <div class='menu name'>");
                        if($userid==''){
                            echo("
                            <a class='name'>로그인</a>
                        </div>
                    </div>
                    <div class='info'>
                        <div class='menu'>
                            <a class='text' >회원정보 수정</a>
                        </div>
                        <div class='menu'>
                            <a class='text' >장바구니</a>
                        </div>
                        <div class='menu'>
                            <a class='text' >비밀번호 수정</a>
                        </div>
                        <div class='menu'>
                            <a class='text' href='customer.php?userid=$userid'>고객센터</a>
                        </div>
                    </div>
                </div>
                <div class='right middle'>
                    <form method='post' action='login.php?my=$my'>
                        <div class='left'>
                            <div class=inputform>
                                <input class='input' type='text' name='userid' placeholder='ID 입력' value='$userid'>         
                                <input class='input passwd' type='password' name='userpasswd' placeholder='PASSWORD 입력'>
                            </div>
            
                        </div>
                        <div class='right'>
                            <input class='button input submit' type='submit' value='LOGIN'>
                        </div>
                    </form>
                            ");

                        } else {
                            echo("
                            <a class='name'>$userid</a>
                            <a class='logout' href='startPage.php'>LOGOUT</a>
                        </div>
                    </div>
                    <div class='info'>
                        <div class='menu'>
                            <a class='text' href='passPage.php?page=$usermodify&userid=$userid'>회원정보 수정</a>
                        </div>
                        <div class='menu'>
                            <a class='text' href='basketPage.php?userid=$userid'>장바구니</a>
                        </div>
                        <div class='menu'>
                            <a class='text' href='passPage.php?page=$passwdmodify&userid=$userid'>비밀번호 수정</a>
                        </div>
                        <div class='menu'>
                            <a class='text' href='customerPage.php?userid=$userid'>고객센터</a>
                        </div>
                    </div>
                </div>
                <div class='right middle'>
                    <div class='userinfobox'>
                        <div class='userinfo'>
                            <div class='userinfotext'>
                                <a>이름</a>
                                <a class='utext'>
                                    $username
                                </a>
                            </div>
                            <div class='userinfotext'>
                                <a>전화번호</a>
                                <a class='utext'>
                                $phone1 - $phone2 - $phone3
                                </a>
                            </div>
                            <div class='userinfotext'>
                                <a>이메일</a>
                                <a class='utext'>
                                $useremail
                                </a>
                            </div>
                            <div class='userinfotext'>
                                <a>주소</a>
                                <a class='utext'>
                                $address1
                                </a>
                            </div>
                            <div class='userinfotext'>
                                <a></a>
                                <a class='utext'>
                                </a>
                            </div>
                            <div class='userinfotext'>
                                <a></a>
                                <a class='utext'>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                       ");
                    }
                        
                echo("
                </div>
            </div>
            <div class='bottom my'>

            </div>
        </div>
    </body>
");







?>