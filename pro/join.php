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
        <div class="middle join">
            <div class="formBox">
            <form action="/submit" method="POST">
            <!-- <label for="id" style="font-size:20px;">이름:</label> -->
                <input class="input join" type="text" name="useridJoin" id="useridJoin" placeholder="ID 입력"> 
                <input class="input join" type="text" name="userpasswordJoin" id="userpasswordJoin" placeholder="PASSWORD 입력">
            </form>
            </div>
           
        </div>
            <div class="bottom">
            
              
            </div>
        </div>
</body>
</html>