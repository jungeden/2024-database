<?php
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        @import url(join.css);
        @import url(shop.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
    </style>
</head>
<body>
    <div class='container'>
        <div class='top join'>
            <a class='title login' href='startPage.php'>TITLE</a>
        </div>
        <div class='middle join'>
            <form method='post' action='join.php' id="joinForm">
                <div class='inputid'>
                    <input class='input id' type='text' name='userid' placeholder='아이디 입력 (6-20자)'>
                    <a href='checkId.php?id=id'>
                        <input class='button check'  value='확인'>
                    </a>
                </div>
                <div class='inputelement'>
                    <input class='input element' type='password' name='userpasswd' placeholder='비밀번호 입력'>
                    <input class='input element' type='password' name='userpasswdcheck' placeholder='비밀번호 확인'>
                    <input class='input element' type='text' name='username' placeholder='이름 입력'>
                    <input class='input element' type='text' name='userphone' placeholder='전화번호 입력 (-제외 11자리 입력)'>
                    <input class='input element' type='text' name='useremail' placeholder='이메일 주소'>
                    <input type="hidden" name="userbirth" id="userbirth">
                </div>
                <div class='inputbirth'>
                    <button class='birthday year' type='button' name='userbirthYear' id='userBirthYearJoin' onclick="showOption('year')">년</button>
                    <ul class='birthdayBoxOption hide' id='Year'>
                        <li><button type='button' class=' option' id='2010' onclick="changeBirth('Year', this.id)">2010</button></li>
                        <li><button type='button' class=' option' id='2009' onclick="changeBirth('Year', this.id)">2009</button></li>
                        <li><button type='button' class=' option' id='2008' onclick="changeBirth('Year', this.id)">2008</button></li>
                        <li><button type='button' class=' option' id='2007' onclick="changeBirth('Year', this.id)">2007</button></li>
                        <li><button type='button' class=' option' id='2006' onclick="changeBirth('Year', this.id)">2006</button></li>
                        <li><button type='button' class=' option' id='2005' onclick="changeBirth('Year', this.id)">2005</button></li>
                        <li><button type='button' class=' option' id='2004' onclick="changeBirth('Year', this.id)">2004</button></li>
                        <li><button type='button' class=' option' id='2003' onclick="changeBirth('Year', this.id)">2003</button></li>
                        <li><button type='button' class=' option' id='2002' onclick="changeBirth('Year', this.id)">2002</button></li>
                        <li><button type='button' class=' option' id='2001' onclick="changeBirth('Year', this.id)">2001</button></li>
                        <li><button type='button' class=' option' id='2000' onclick="changeBirth('Year', this.id)">2000</button></li>

                        <li><button type='button' class=' option' id='1999' onclick="changeBirth('Year', this.id)">1999</button></li>
                        <li><button type='button' class=' option' id='1998' onclick="changeBirth('Year', this.id)">1998</button></li>
                        <li><button type='button' class=' option' id='1997' onclick="changeBirth('Year', this.id)">1997</button></li>
                        <li><button type='button' class=' option' id='1996' onclick="changeBirth('Year', this.id)">1996</button></li>
                        <li><button type='button' class=' option' id='1995' onclick="changeBirth('Year', this.id)">1995</button></li>
                        <li><button type='button' class=' option' id='1994' onclick="changeBirth('Year', this.id)">1994</button></li>
                        <li><button type='button' class=' option' id='1993' onclick="changeBirth('Year', this.id)">1993</button></li>
                        <li><button type='button' class=' option' id='1992' onclick="changeBirth('Year', this.id)">1992</button></li>
                        <li><button type='button' class=' option' id='1991' onclick="changeBirth('Year', this.id)">1991</button></li>
                        <li><button type='button' class=' option' id='1990' onclick="changeBirth('Year', this.id)">1990</button></li>

                        <li><button type='button' class=' option' id='1989' onclick="changeBirth('Year', this.id)">1989</button></li>
                        <li><button type='button' class=' option' id='1988' onclick="changeBirth('Year', this.id)">1988</button></li>
                        <li><button type='button' class=' option' id='1987' onclick="changeBirth('Year', this.id)">1987</button></li>
                        <li><button type='button' class=' option' id='1986' onclick="changeBirth('Year', this.id)">1986</button></li>
                        <li><button type='button' class=' option' id='1985' onclick="changeBirth('Year', this.id)">1985</button></li>
                        <li><button type='button' class=' option' id='1984' onclick="changeBirth('Year', this.id)">1984</button></li>
                        <li><button type='button' class=' option' id='1983' onclick="changeBirth('Year', this.id)">1983</button></li>
                        <li><button type='button' class=' option' id='1982' onclick="changeBirth('Year', this.id)">1982</button></li>
                        <li><button type='button' class=' option' id='1981' onclick="changeBirth('Year', this.id)">1981</button></li>
                        <li><button type='button' class=' option' id='1980' onclick="changeBirth('Year', this.id)">1980</button></li>

                        <li><button type='button' class=' option' id='1979' onclick="changeBirth('Year', this.id)">1979</button></li>
                        <li><button type='button' class=' option' id='1978' onclick="changeBirth('Year', this.id)">1978</button></li>
                        <li><button type='button' class=' option' id='1977' onclick="changeBirth('Year', this.id)">1977</button></li>
                        <li><button type='button' class=' option' id='1976' onclick="changeBirth('Year', this.id)">1976</button></li>
                        <li><button type='button' class=' option' id='1975' onclick="changeBirth('Year', this.id)">1975</button></li>
                        <li><button type='button' class=' option' id='1974' onclick="changeBirth('Year', this.id)">1974</button></li>
                        <li><button type='button' class=' option' id='1973' onclick="changeBirth('Year', this.id)">1973</button></li>
                        <li><button type='button' class=' option' id='1972' onclick="changeBirth('Year', this.id)">1972</button></li>
                        <li><button type='button' class=' option' id='1971' onclick="changeBirth('Year', this.id)">1971</button></li>
                        <li><button type='button' class=' option' id='1970' onclick="changeBirth('Year', this.id)">1970</button></li>

                        <li><button type='button' class=' option' id='1969' onclick="changeBirth('Year', this.id)">1969</button></li>
                        <li><button type='button' class=' option' id='1968' onclick="changeBirth('Year', this.id)">1968</button></li>
                        <li><button type='button' class=' option' id='1967' onclick="changeBirth('Year', this.id)">1967</button></li>
                        <li><button type='button' class=' option' id='1966' onclick="changeBirth('Year', this.id)">1966</button></li>
                        <li><button type='button' class=' option' id='1965' onclick="changeBirth('Year', this.id)">1965</button></li>
                        <li><button type='button' class=' option' id='1964' onclick="changeBirth('Year', this.id)">1964</button></li>
                        <li><button type='button' class=' option' id='1963' onclick="changeBirth('Year', this.id)">1963</button></li>
                        <li><button type='button' class=' option' id='1962' onclick="changeBirth('Year', this.id)">1962</button></li>
                        <li><button type='button' class=' option' id='1961' onclick="changeBirth('Year', this.id)">1961</button></li>
                        <li><button type='button' class=' option' id='1960' onclick="changeBirth('Year', this.id)">1960</button></li>

                        <li><button type='button' class=' option' id='1959' onclick="changeBirth('Year', this.id)">1959</button></li>
                        <li><button type='button' class=' option' id='1958' onclick="changeBirth('Year', this.id)">1958</button></li>
                        <li><button type='button' class=' option' id='1957' onclick="changeBirth('Year', this.id)">1957</button></li>
                        <li><button type='button' class=' option' id='1956' onclick="changeBirth('Year', this.id)">1956</button></li>
                        <li><button type='button' class=' option' id='1955' onclick="changeBirth('Year', this.id)">1955</button></li>
                        <li><button type='button' class=' option' id='1954' onclick="changeBirth('Year', this.id)">1954</button></li>
                        <li><button type='button' class=' option' id='1953' onclick="changeBirth('Year', this.id)">1953</button></li>
                        <li><button type='button' class=' option' id='1952' onclick="changeBirth('Year', this.id)">1952</button></li>
                        <li><button type='button' class=' option' id='1951' onclick="changeBirth('Year', this.id)">1951</button></li>
                        <li><button type='button' class=' option' id='1950' onclick="changeBirth('Year', this.id)">1950</button></li>

                        <li><button type='button' class=' option' id='1949' onclick="changeBirth('Year', this.id)">1949</button></li>
                        <li><button type='button' class=' option' id='1948' onclick="changeBirth('Year', this.id)">1948</button></li>
                        <li><button type='button' class=' option' id='1947' onclick="changeBirth('Year', this.id)">1947</button></li>
                        <li><button type='button' class=' option' id='1946' onclick="changeBirth('Year', this.id)">1946</button></li>
                        <li><button type='button' class=' option' id='1945' onclick="changeBirth('Year', this.id)">1945</button></li>
                        <li><button type='button' class=' option' id='1944' onclick="changeBirth('Year', this.id)">1944</button></li>
                        <li><button type='button' class=' option' id='1943' onclick="changeBirth('Year', this.id)">1943</button></li>
                        <li><button type='button' class=' option' id='1942' onclick="changeBirth('Year', this.id)">1942</button></li>
                        <li><button type='button' class=' option' id='1941' onclick="changeBirth('Year', this.id)">1941</button></li>
                        <li><button type='button' class=' option' id='1940' onclick="changeBirth('Year', this.id)">1940</button></li>
                    </ul>
                    <button class='birthday month' type='button' name='userbirthMonth' id='userBirthMonthJoin' onclick="showOption('month')">월</button>
                    <ul class='birthdayBoxOption month hide' id='Month'>
                        <li><button type='button' class=' option' id='01' onclick="changeBirth('Month', this.id)">01</button></li>
                        <li><button type='button' class=' option' id='02' onclick="changeBirth('Month', this.id)">02</button></li>
                        <li><button type='button' class=' option' id='03' onclick="changeBirth('Month', this.id)">03</button></li>
                        <li><button type='button' class=' option' id='04' onclick="changeBirth('Month', this.id)">04</button></li>
                        <li><button type='button' class=' option' id='05' onclick="changeBirth('Month', this.id)">05</button></li>
                        <li><button type='button' class=' option' id='06' onclick="changeBirth('Month', this.id)">06</button></li>
                        <li><button type='button' class=' option' id='07' onclick="changeBirth('Month', this.id)">07</button></li>
                        <li><button type='button' class=' option' id='08' onclick="changeBirth('Month', this.id)">08</button></li>
                        <li><button type='button' class=' option' id='09' onclick="changeBirth('Month', this.id)">09</button></li>
                        <li><button type='button' class=' option' id='10' onclick="changeBirth('Month', this.id)">10</button></li>
                        <li><button type='button' class=' option' id='11' onclick="changeBirth('Month', this.id)">11</button></li>
                        <li><button type='button' class=' option' id='12' onclick="changeBirth('Month', this.id)">12</button></li>

                    </ul>
                    <input class='input element birth' type='text' name='userbirthday' placeholder='일' id="userbirthDateJoin">
                </div>
            </form>
        </div>
        <div class='bottom join'>
            <div class="button loginbutton" onclick="birth();">
                <span class="tooltip loginbutton">JOIN</span>
            </div>
        </div>
    </div>
    <script>
        function changeBirth(type, value) {
            let birthButton = document.getElementById(`userBirth\${type}Join`);
            birthButton.textContent = value;
            birthButton.style.color = "rgb(215, 233, 250)"; 
            document.getElementById(`userBirth\${type}Join`).value = value;

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
            document.getElementById('userbirth').value = fullBirthDate;
            document.getElementById('joinForm').submit();
        }

        function showOption(type) {
            const ids = {
                year: "Year",
                month: "Month"
            };
            document.getElementById(ids.year).style.visibility = (type === 'year') ? "visible" : "hidden";
            document.getElementById(ids.month).style.visibility = (type === 'month') ? "visible" : "hidden";
        }
    </script>
</body>
</html>
HTML;
?>
