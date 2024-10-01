<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>black</title>
    <style>
        @import url(pro.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
    </style>
    
</head>
<body>
<div class="container">
    <div class="head">
    <h1 class="logo" style="cursor: pointer" onclick="window.location.href='firstPage.php'" >
                B:ACK
            </h1>
      </div>
      <div class="top">

      </div>
        <div class="middle login">
            
            <div class="left loginInput">
                <!-- <div class="input"> -->
                <form action="/submit" method="POST" >
                <input class="input" type="text" name="userid" id="userid" placeholder="ID 입력">
           

                    <!-- ID 입력
                </div> -->
 
                <input class="input" type="text" name="userpassword" id="userpassword" placeholder="PASSWORD 입력">
                </form>
                <!-- <div class="input">
                    PASSWORD 입력
                </div> -->
            </div>
            <div class="right loginInput">
                <div class="button loginButton">
                LOGIN
                </div>
               
            </div>
            
           
        </div>
            <div class="bottom">
            <div class="button login" onclick="window.location.href='join.php'">
                    <span class="tooltip login">
                        JOIN
                    </span>
                </div>
              
            </div>
        </div>
</body>
</html>