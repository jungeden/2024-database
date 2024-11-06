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
            <form  action="process.php" method="POST" style="margin: 0px 0px 0px 0px" id="joinForm">
                <label for="userIdJoin" style="font-size:16px; color:rgb(82,82,82); margin: 0px 0px 0px 15px;">아이디</label>
                <input class="input join" type="text" name="iuserIdJoin" id="userIdJoin" placeholder="아이디 입력 (6-20자)"> 
                <label for="userPasswordJoin" style="font-size:16px; color:rgb(82,82,82); margin: 0px 0px 0px 15px;">비밀번호</label>
                <input class="input join" type="password" name="iuserPasswordJoin" id="userPasswordJoin" placeholder="비밀번호 입력">
                <label for="userPasswordAgainJoin" style="font-size:16px; color:rgb(82,82,82); margin: 0px 0px 0px 15px;">비밀번호 확인</label>
                <input class="input join" type="password" name="iuserPasswordAgainJoin" id="userPasswordAgainJoin" placeholder="비밀번호 입력">
                <label for="userNameJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">이름</label>
                <input class="input join" type="text" name="iuserNameJoin" id="userNameJoin" placeholder="이름을 입력해주세요"> 
                <label for="userPhoneJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">전화번호</label>             
                <input class="input join" type="text" name="iuserPhoneJoin" id="userPhoneJoin" placeholder="전화번호 입력 (-제외 11자리 입력)"> 
                <label for="userEmailJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">이메일 주소</label>              
                <input class="input join" type="text" name="iuserEmailJoin" id="userEmailJoin" placeholder="이메일 주소"> 
                <label for="userBirthJoin" style="font-size:16px; color:rgb(82,82,82);  margin: 0px 0px 0px 15px;">생년월일</label>
                <input type="hidden" name="iuserBirthJoin" id="userBirthJoin" value="">

                <div class="birthdayBox">
                   
                <!-- <input class="input join birthday" type="text" name="iuserBirthJoin" id="userbirthJoin" placeholder="생년월일">  -->
                <button class="birthday year" type="button" name="iuserBirthYearJoin" value="" id="userBirthYearJoin" onclick="showOption('year')">
                    년
                </button>
                <ul class="birthdayBoxOption hide" id="Year">
                    <li><button type="button" class="option" id="2010" onclick="changeBirth('Year', this.id)">2010</button></li>
                    <li><button type="button" class="option" id="2009" onclick="changeBirth('Year', this.id)">2009</button></li>
                    <li><button type="button" class="option" id="2008" onclick="changeBirth('Year', this.id)">2008</button></li>
                    <li><button type="button" class="option" id="2007" onclick="changeBirth('Year', this.id)">2007</button></li>
                    <li><button type="button" class="option" id="2006" onclick="changeBirth('Year', this.id)">2006</button></li>
                    <li><button type="button" class="option" id="2005" onclick="changeBirth('Year', this.id)">2005</button></li>
                    <li><button type="button" class="option" id="2004" onclick="changeBirth('Year', this.id)">2004</button></li>
                    <li><button type="button" class="option" id="2003" onclick="changeBirth('Year', this.id)">2003</button></li>
                    <li><button type="button" class="option" id="2002" onclick="changeBirth('Year', this.id)">2002</button></li>
                    <li><button type="button" class="option" id="2001" onclick="changeBirth('Year', this.id)">2001</button></li>
                    <li><button type="button" class="option" id="2000" onclick="changeBirth('Year', this.id)">2000</button></li>
                    <li><button type="button" class="option" id="1999" onclick="changeBirth('Year', this.id)">1999</button></li>
                </ul>
              

                <!-- <select class="birthday year" name="iuserbirthYearJoin" id="userbirthYearJoin" style="font-size:16px; color:rgb(82,82,82);">
                    년
                    <option style="rgb(209, 196, 179)" value="">년</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                </select> -->
                <button class="birthday month" type="button" name="iuserBirthMonthJoin" value="" id="userBirthMonthJoin" onclick="showOption('month')">
                    월
                </button>
                <ul class="birthdayBoxOption month hide " id="Month">
                    <li><button type="button" class="option" id="01" onclick="changeBirth('Month', this.id)">01</button></li>
                    <li><button type="button" class="option" id="02" onclick="changeBirth('Month', this.id)">02</button></li>
                    <li><button type="button" class="option" id="03" onclick="changeBirth('Month', this.id)">03</button></li>
                    <li><button type="button" class="option" id="04" onclick="changeBirth('Month', this.id)">04</button></li>
                    <li><button type="button" class="option" id="05" onclick="changeBirth('Month', this.id)">05</button></li>
                    <li><button type="button" class="option" id="06" onclick="changeBirth('Month', this.id)">06</button></li>
                    <li><button type="button" class="option" id="07" onclick="changeBirth('Month', this.id)">07</button></li>
                    <li><button type="button" class="option" id="08" onclick="changeBirth('Month', this.id)">08</button></li>
                    <li><button type="button" class="option" id="09" onclick="changeBirth('Month', this.id)">09</button></li>
                    <li><button type="button" class="option" id="10" onclick="changeBirth('Month', this.id)">10</button></li>
                    <li><button type="button" class="option" id="11" onclick="changeBirth('Month', this.id)">11</button></li>
                    <li><button type="button" class="option" id="12" onclick="changeBirth('Month', this.id)">12</button></li>
                </ul>
                <input class="birthday date" type="text" name="iuserBirthDateJoin" id="userbirthDateJoin" placeholder="일" style="width: 75px;"> 

                <!-- <button class="birthday date" type="button" name="iuserBirthDateJoin" id="userBirthDateJoin" onclick="showOption()">
                    일
                </button>
                <ul class="birthdayBoxOption hide">
                    <li><button type="button" class="option" id="2010" onclick="changeDate(2010)">2010</button></li>
                    <li><button type="button" class="option" id="2009" onclick="changeDate(2009)">2009</button></li>
                    <li><button type="button" class="option" id="2008" onclick="changeDate(2008)">2008</button></li>
                    <li><button type="button" class="option" id="2007" onclick="changeDate(2007)">2007</button></li>
                    <li><button type="button" class="option" id="2006" onclick="changeDate(2006)">2006</button></li>
                    <li><button type="button" class="option" id="2005" onclick="changeDate(2005)">2005</button></li>
                    <li><button type="button" class="option" id="2004" onclick="changeDate(2004)">2004</button></li>
                    <li><button type="button" class="option" id="2003" onclick="changeDate(2003)">2003</button></li>
                    <li><button type="button" class="option" id="2002" onclick="changeDate(2002)">2002</button></li>
                    <li><button type="button" class="option" id="2001" onclick="changeDate(2001)">2001</button></li>
                    <li><button type="button" class="option" id="2000" onclick="changeDate(2000)">2000</button></li>
                    <li><button type="button" class="option" id="1999" onclick="changeDate(1999)">1999</button></li>
                </ul> -->
                 <!-- <select class="birthday month" for="userbirthJoin" style="font-size:16px; color:rgb(82,82,82);">월</select> -->
                 <!-- <select class="birthday date" for="userbirthJoin" style="font-size:16px; color:rgb(82,82,82);">일</select> -->

                </div>
            </form>
            </div>
           
        </div>
            <div class="bottom join">
            <div class="button login" onclick="birth();">
                    <span class="tooltip login">
                        JOIN
                    </span>
                </div>
              
            </div>
        </div>
        <script>
   


function changeBirth(type, value) {
    
    let birthButton = document.getElementById(`userBirth${type}Join`);
    let selectedId = value;
    
    
    birthButton.textContent = value; 
    birthButton.style.color = "rgb(82,82,82)"; 
    document.getElementById(`userBirth${type}Join`).value = selectedId;


   
    let elements = document.getElementsByClassName("birthdayBoxOption");
    for (let i = 0; i < elements.length; i++) {
        elements[i].style.visibility = "hidden";
    }
}

function birth() {
    let year = document.getElementById('userBirthYearJoin').value;
    let month = document.getElementById('userBirthMonthJoin').value;
    let date = document.getElementById('userbirthDateJoin').value; 

  
    let fullBirthDate = year + month.padStart(2, '0') + date.padStart(2, '0'); 

    document.getElementById('userBirthJoin').value = fullBirthDate;
    document.getElementById('joinForm').submit();
}

function showOption(type) {
    const ids = {
        year: "Year",
        month: "Month"
    };

    const yearElement = document.getElementById(ids.year);
    const monthElement = document.getElementById(ids.month);
    
    yearElement.style.visibility = (type === 'year') ? "visible" : "hidden";
    monthElement.style.visibility = (type === 'month') ? "visible" : "hidden";
}



    
    
</script>

</body>
</html>