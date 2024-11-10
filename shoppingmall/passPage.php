<?
$userid = $_GET['userid'];
$page = $_GET['page'];
echo("
 <head>
        <style>
        @import url(pass.css);
        @import url(start.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
    </style>

    </head>
    <body>
        <div class='container pass'>
            <div class='top pass'>
                <a class='title login' href='startPage.php'>
                    TITLE
                </a>
            </div>
            <div class='middle pass'>
                <div class='label'>
                    <div class='text'>
                        <a class='text'>비밀번호를 입력해주세요.</a>
                    </div>
                    
                    <div class='passinput'>
                        <form method='post' action='pass.php?userid=$userid&page=$page'>
                                <input class='input passwd' type='password' name='userpasswd' placeholder='PASSWORD 입력'>
                                <input class='button input' type='submit' value='입력완료'>
                    </form>
                    </div>
                </div>
            </div>
            <div class='bottom pass'>

            </div>
        </div>

");




?>