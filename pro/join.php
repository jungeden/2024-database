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
    <div class="head join">
    <!-- <h1 class="logo" style="cursor: pointer" onclick="window.location.href='firstPage.php'" >
                B:ACK
            </h1> -->
      </div>
      <div class="top join">

      </div>
        <div class="middle join">
            <div class="formBox">
            <form  action="process.php" method="POST" style="margin: 0px 0px 0px 75px" id="joinForm">
                <label for="useridJoin" style="font-size:16px; color:rgb(82,82,82); margin: 0px 0px 0px 15px;">아이디</label>
                <input class="input join" type="text" name="iuserIdJoin" id="useridJoin" placeholder="아이디 입력 (6-20자)"> 
                <label for="userpasswordJoin" style="font-size:16px; color:rgb(82,82,82); margin: 0px 0px 0px 15px;">비밀번호</label>
                <input class="input join" type="password" name="iuserPasswordJoin" id="userpasswordJoin" placeholder="비밀번호 입력">
                <label for="userpasswordAgainJoin" style="font-size:16px; color:rgb(82,82,82); margin: 0px 0px 0px 15px;">비밀번호 확인</label>
                <input class="input join" type="password" name="iuserPasswordAgainJoin" id="userpasswordAgainJoin" placeholder="비밀번호 입력">
                <label for="usernameJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">이름</label>
                <input class="input join" type="text" name="iuserNameJoin" id="usernameJoin" placeholder="이름을 입력해주세요"> 
                <label for="userphoneJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">전화번호</label>             
                <input class="input join" type="text" name="iuserPhoneJoin" id="userphoneJoin" placeholder="전화번호 입력 (-제외 11자리 입력)"> 
                <label for="useremailJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">이메일 주소</label>              
                <input class="input join" type="text" name="iuserEmailJoin" id="useremailJoin" placeholder="이메일 주소"> 
                <label for="userbirthJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">생년월일</label>
                <input class="input join" type="text" name="iuserBirthJoin" id="userbirthJoin" placeholder="생년월일"> 

            </form>
            </div>
           
        </div>
            <div class="bottom join">
            <div class="button login" onclick="document.getElementById('joinForm').submit();">
                    <span class="tooltip login">
                        JOIN
                    </span>
                </div>
              
            </div>
        </div>
</body>
</html>