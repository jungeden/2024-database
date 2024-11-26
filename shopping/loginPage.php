<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
$page = isset($_GET['page']) ? $_GET['page'] : '';
$code = isset($_GET['code']) ? $_GET['code'] : '';


echo("
<head>
<title> </title>
<style>
        @import url(shop.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
        
    </style>
 



</head>
<body>
    <div class='container'>
        <div class='top'>
            <div class='left top'>
                <a class='title'>
                    TITLE
                </a>
            </div>
            <div class='center top'>
                <a href='startPage.php?userid=$userid' class='menu'> HOME</a>
                <a href='shoppingPage.php?userid=$userid' class='menu'> SHOPPING</a>
                <a href='aboutPage.php?userid=$userid' class='menu'> ABOUT</a>
            </div>
            <div class='right top'>
                <div class='topbutton'>
                    <a href='shoppingcartPage.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='shoppingcart' d='M292.31-115.38q-25.31 0-42.66-17.35-17.34-17.35-17.34-42.65 0-25.31 17.34-42.66 17.35-17.34 42.66-17.34 25.31 0 42.65 17.34 17.35 17.35 17.35 42.66 0 25.3-17.35 42.65-17.34 17.35-42.65 17.35Zm375.38 0q-25.31 0-42.65-17.35-17.35-17.35-17.35-42.65 0-25.31 17.35-42.66 17.34-17.34 42.65-17.34t42.66 17.34q17.34 17.35 17.34 42.66 0 25.3-17.34 42.65-17.35 17.35-42.66 17.35ZM235.23-740 342-515.38h265.38q6.93 0 12.31-3.47 5.39-3.46 9.23-9.61l104.62-190q4.61-8.46.77-15-3.85-6.54-13.08-6.54h-486Zm-19.54-40h520.77q26.08 0 39.23 21.27 13.16 21.27 1.39 43.81l-114.31 208.3q-8.69 14.62-22.58 22.93-13.88 8.31-30.5 8.31H324l-48.62 89.23q-6.15 9.23-.38 20 5.77 10.77 17.31 10.77h435.38v40H292.31q-35 0-52.23-29.5-17.23-29.5-.85-59.27l60.15-107.23L152.31-820H80v-40h97.69l38 80ZM342-515.38h280-280Z'/></svg>
                    </a>
                    <a href='searchPage?userid=$userid.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='search'  d='M779.38-153.85 528.92-404.31q-30 25.54-69 39.54t-78.38 14q-96.1 0-162.67-66.53-66.56-66.53-66.56-162.57 0-96.05 66.53-162.71 66.53-66.65 162.57-66.65 96.05 0 162.71 66.56Q610.77-676.1 610.77-580q0 41.69-14.77 80.69t-38.77 66.69l250.46 250.47-28.31 28.3ZM381.54-390.77q79.61 0 134.42-54.81 54.81-54.8 54.81-134.42 0-79.62-54.81-134.42-54.81-54.81-134.42-54.81-79.62 0-134.42 54.81-54.81 54.8-54.81 134.42 0 79.62 54.81 134.42 54.8 54.81 134.42 54.81Z'/></svg>
                    </a>
                    <a href='myPage.php?userid=$userid'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='my'  d='M247.85-260.62q51-36.69 108.23-58.03Q413.31-340 480-340t123.92 21.35q57.23 21.34 108.23 58.03 39.62-41 63.73-96.84Q800-413.31 800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 66.69 24.12 122.54 24.11 55.84 63.73 96.84ZM480.02-460q-50.56 0-85.29-34.71Q360-529.42 360-579.98q0-50.56 34.71-85.29Q429.42-700 479.98-700q50.56 0 85.29 34.71Q600-630.58 600-580.02q0 50.56-34.71 85.29Q530.58-460 480.02-460ZM480-120q-75.31 0-141-28.04t-114.31-76.65Q176.08-273.31 148.04-339 120-404.69 120-480t28.04-141q28.04-65.69 76.65-114.31 48.62-48.61 114.31-76.65Q404.69-840 480-840t141 28.04q65.69 28.04 114.31 76.65 48.61 48.62 76.65 114.31Q840-555.31 840-480t-28.04 141q-28.04 65.69-76.65 114.31-48.62 48.61-114.31 76.65Q555.31-120 480-120Zm0-40q55.31 0 108.85-19.35 53.53-19.34 92.53-52.96-39-31.31-90.23-49.5Q539.92-300 480-300q-59.92 0-111.54 17.81-51.61 17.81-89.84 49.88 39 33.62 92.53 52.96Q424.69-160 480-160Zm0-340q33.69 0 56.85-23.15Q560-546.31 560-580t-23.15-56.85Q513.69-660 480-660t-56.85 23.15Q400-613.69 400-580t23.15 56.85Q446.31-500 480-500Zm0-80Zm0 350Z'/></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class='line'></div>

        <div class='middle'>
            <div class='label'>
                <form method='post' action='login.php?page=$page&code=$code'>
                    <div class='inputbox'>
                    
                        <div class='left login'>
                            <input class='input login' type='text' name='userid' placeholder='ID 입력' value='$userid'>
                            <input class='input login' type='password' name='userpasswd' placeholder='PASSWORD 입력'>
                        </div>
                        <div class='right login'>
                            <input class='button login' type='submit' value='LOGIN'>
                        </div>
                    </div>
                </form>
                <div class='textbox'>
                    <a class='logintext'  href='finduseridPage.php' > 
                        아이디 찾기
                    </a>
                    <a> | </a>
                    <a class='logintext'  href='finduserpasswdPage.php' > 
                        비밀번호 찾기
                    </a>
                    <a> | </a>
                    <a class='logintext'  href='joinPage.php' > 
                        회원가입
                    </a>
                </div>
            </div>
        </div>
        <div class='bottom'>

        </div>




");


?>