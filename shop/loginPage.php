<?
// $userid = $_GET['userid'];
// $userpasswd = $_GET['userpasswd'];
echo("
<head>
    <style>
        @import url(shop.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
    </style>
</head>
<body>
    <div class='container'>
        <div class='top login'>
            <a class='title login' href='startPage.php'>
                TITLE
            </a>
        </div>
        <div class='middle login'>
            <form method='post' action='login.php'>
            <div class='left'>

                    <div class=inputform>
                        <input class='input' type='text' name='userid' placeholder='ID 입력'>         
                        <input class='input passwd' type='password' name='userpasswd' placeholder='PASSWORD 입력'>
                    </div>
            
            </div>
            <div class='right'>

                        <input class='button input submit' type='submit' value='LOGIN'>
               
            </div>
             </form>
        </div>
        <div class='bottom login'>
            <div class=join>
                <a class='join'  href='joinPage.php' > 
                    회원가입
                </a>
            </div>

        </div>
    </div>
</body>
");






?>