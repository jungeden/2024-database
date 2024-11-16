<?

$con = mysqli_connect("localhost", "root", "0000", "shop");


echo("
<head>
       <style>
       @import url(find.css);
       @import url(start.css);
       @import url(login.css);
       @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
       a {text-decoration: none;}
   </style>

   </head>
   <body>
       <div class='container find'>
           <div class='top find'>
               <a class='title login' href='startPage.php'>
                   TITLE
               </a>
           </div>
           <div class='middle find'>z
               <div class='label'>
                   <div class='text'>
                       <a class='text'>아이디 찾기</a>
                   </div>
                   
                   <div class='findinput'>
                       <form method='post' action='finduserid.php'>
                            <div class='findtexta'>
                                <a class='afind'>이름</a>
                            </div>
                            <div class='findtext'>
                               <input class='input finduserinfo' type='text' name='username' placeholder='이름 입력'>
                            </div>
                            <div class='findtexta'>
                                <a class='afind'>전화번호로 찾기</a>
                            </div>
                            <div class='findtext'>
                               <input class='input finduserinfo' type='text' name='userphone' placeholder='전화번호 입력'>
                            </div>
                            <div class='findtexta'>
                                <a class='afind'>이메일로 찾기</a>
                            </div>
                            <div class='findtext'>
                               <input class='input finduserinfo' type='text' name='useremail' placeholder='이메일 입력'>
                               <input class='button input' type='submit' value='입력완료'>
                            </div>
                   </form>
                   </div>
               </div>
           </div>
           <div class='bottom find'>

           </div>
       </div>

");




?>