<?
$userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if ($userid != '') {
    $out = null; 
}
echo("
<head>
<title> </title>
<style>
        @import url(start.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
    </style>
</head>
<body>
    <div class='container'>
        <div class='top start'>
            <div class='left top'>
                <a class='title top'>
                    TITLE
                </a>
            </div>
            <div class='right top'>
                <div class='button loginbutton' >");
                if($userid==''){
                echo("
                    <a class='tooltip loginbutton' href='loginPage.php'>
                        LOGIN
                    </a>");
                }else{
                    echo("
                 
                    <a class='tooltip loginbutton' href='startPage.php?userid=$out '>
                        LOGOUT
                    </a>
                    ");
                }

                echo("
                </div>
            </div>
        </div>

        <div class='middle start'>
            <div class='left middle'>
                <div class='middletop'>
                    <div >
                        <h1 class='maintext'>
                        WELCOME
                        THIS IS MY WEBPAGE
                        </h1>
                        
                    </div>
                </div>
                <div class='bottom start'>
                    <div class='button start l'>
                    <a class='tooltip start' href='shoppingPage.php?userid=$userid'>
                        SHOPPING
                    </a>
                </div>
                 <div class='button start m'>
                    <a class='tooltip start' href='aboutPage.php?userid=$userid'>
                        ABOUT US
                    </a>
                </div>
                <div class='button start r'>
                    <a class='tooltip start' href='myPage.php?userid=$userid'>
                        MYPAGE
                    </a>
                </div>
            </div>
           </div>
           <div class='right middle'>
                <div class='box'>
                    <div class='topbox'>
                        <div class='photo one'>
                            <a> PHOTO 1</a>
                        </div>
                        <div class='photo two'>
                            <a> PHOTO 2</a>
                        </div>
                    </div>
                    <div class='bottombox'>
                        <div class='photo three'>
                            <a> PHOTO 3</a>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        
            
        </div>
    </div>
</body>







");





?>