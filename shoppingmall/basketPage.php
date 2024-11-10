<?
$userid = isset($_GET['userid']) ? $_GET['userid'] : '';
$my=1;
$usermodify='usermodify';
$passwdmodify='passwdmodify';


$con = mysqli_connect("localhost", "root", "0000", "shop");

echo("
<head>
        <style>
        @import url(basket.css);
        @import url(start.css);
        @import url(my.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
        

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

                        }else {
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
                    <div class='totalbox'>
                        <div class='left'>
                            
                        </div>
                        <div class='totalright'>
                            <div class='total'>
                                <a class='ttext'>총 금액</a>
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