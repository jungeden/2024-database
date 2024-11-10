<?
$userid = isset($_GET['userid']) ? $_GET['userid'] : '';

echo("
    <head>
        <style>
        @import url(start.css);
        @import url(shopping.css);
        @import url(login.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        a {text-decoration: none;}
    </style>

    </head>
    <body>
        <div class='container shopping'>
            <div class='top shopping'>
                <div class='lefttop'>
                    <div class='title shopping'>
                        <a  class='title shopping' href='startPage.php?userid=$userid'>TITLE</a>
                    </div>
                </div>
                <div class='righttop'>");
                if($userid == '') {
                    $userlogin='로그인';
                    echo(" <a class='menu shopping' href='loginPage.php'>$userlogin</a>");
                } else {
                    $userlogin = $userid .'님';
                    echo(" <div class='mine'>
                    <a class='menu nim' href='myPage.php?userid=$userid'>$userlogin</a>
                    <a class=logout href='shoppingPage.php'>LOGOUT</a>
                    </div>");

                }
                echo("
                
                   
                </div>
            </div>
            <div class='middle shopping'>
                <div class='left shopping'>
                    <div class='button shopping'>
                        <a class='tooltip shopping'>
                            PRODUCT1
                        </a>
                    </div>
                    <div class='button shopping'>
                        <a class='tooltip shopping' href=' '>
                            PRODUCT2
                        </a>
                    </div>
                    <div class='button shopping'>
                        <a class='tooltip shopping' href=' '>
                            PRODUCT3
                        </a>
                    </div>
                    <div class='button shopping'>
                        <a class='tooltip shopping' href=' '>
                            PRODUCT4
                        </a>
                    </div>
                    <div class='button shopping'>
                        <a class='tooltip shopping' href=' '>
                            PRODUCT5
                        </a>
                    </div>
                    <div class='button shopping'>
                        <a class='tooltip shopping' href=' '>
                            PRODUCT6
                        </a>
                    </div>

                </div>
                <div class='right shopping'>
              
                    <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                        </div>
                    </div>
                    <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                        </div>
                    </div>
                    <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                            <a class='ptexttitle'> 상품 이름</a><br>
                            <a class='ptext'> 상세 상품 설명</a>
                        </div>
                    </div>
                    <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                        </div>
                    </div>
                    <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                        </div>
                    </div>
                     <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                        </div>
                    </div>
                     <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                        </div>
                    </div>
                     <div class='product'>
                        <div class='productphoto'>
                        </div>
                        <div class='producttext'>
                        </div>
                    </div>
                
                </div>
            </div>
            <div class='bottom shopping'>

            </div>
        </div>

    </body>

");


?>