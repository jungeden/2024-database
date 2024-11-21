<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
$page=isset($_GET['page']) ? $_GET['page'] : '';
$code=isset($_GET['code']) ? $_GET['code'] : '';

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $page='productdetail';
    $code=$_GET['code'];
    header("Location: loginPage.php?page=$page&code=$code");
    exit();
}
$userid=$_GET['userid'];

$receiver = isset($_GET['receiver']) ? $_GET['receiver'] : '';
$phone = isset($_GET['phone']) ? $_GET['phone'] : '';
$zipcode = isset($_GET['zipcode']) ? $_GET['zipcode'] : '';
$address1 = isset($_GET['address1']) ? $_GET['address1'] : '';
$address2 = isset($_GET['address2']) ? $_GET['address2'] : '';
$message = isset($_GET['message']) ? $_GET['message'] : '';


$con = mysqli_connect("localhost", "root", "0000", "shop");

$getuserinfo = mysqli_query($con, "SELECT * FROM user WHERE userid='$userid'");
$row = mysqli_fetch_assoc($getuserinfo);
if($zipcode=='') {
    $zipcode=$row['zipcode'];
    $address1=$row['address1'];
    $address2=$row['address2'];
}

$username=$row['username'];


if ($page == 'productdetail') {
    $product=mysqli_query($con, "SELECT * FROM product WHERE code='$code'");
} else if($page == 'shoppingcart') {
    $product=mysqli_query($con, "SELECT * FROM shoppingcart WHERE userid='$userid'");
}

echo("
<head>
<title> </title>
<style>
        @import url(shop.css);
        @import url(buy.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');

    </style>
</head>
<body>
    <div class='container'>
        <div class='top buy'>
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
                <div class='topbutton'>");
                if($userid=='admin') {
                    echo("
                        <a href='manageproductsPage.php?userid=$userid'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='manageproducts' d='M160-240v-480 480Zm24.62 40q-27.62 0-46.12-18.5Q120-237 120-264.62v-430.76q0-27.62 18.5-46.12Q157-760 184.62-760h199.23l80 80h311.53q27.62 0 46.12 18.5Q840-643 840-615.38v94.3q-9.77-3.38-19.88-4.34-10.12-.96-20.12-.27v-89.69q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H447.77l-80-80H184.62q-10.77 0-17.7 6.92-6.92 6.93-6.92 17.7v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69h290.15l-.92.92V-200H184.62Zm384.61 80v-88.38l213.31-212.31q5.92-5.93 12.31-8 6.38-2.08 12.77-2.08 6.61 0 13.38 2.58 6.77 2.57 11.92 7.73l37 37.77q4.93 5.92 7.5 12.31Q880-364 880-357.62q0 6.39-2.46 12.89-2.46 6.5-7.62 12.42L657.62-120h-88.39Zm275.39-237.62-37-37.76 37 37.76Zm-240 202.24h38l138.69-138.93-18.77-19-18.23-19.54-139.69 139.47v38Zm157.92-157.93-18.23-19.54 37 38.54-18.77-19Z'/></svg>
                        </a>
                        <a href='manageaccountsPage.php?userid=$userid'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='manageaccounts' d='M400-504.62q-49.5 0-84.75-35.25T280-624.62q0-49.5 35.25-84.75T400-744.62q49.5 0 84.75 35.25T520-624.62q0 49.5-35.25 84.75T400-504.62ZM120-215.38v-65.85q0-27.62 13.92-47.77 13.93-20.15 39.31-32.08 48.69-23.69 100.39-39 51.69-15.3 126.38-15.3h9.38q3.7 0 8.93.46-4.16 10.3-6.58 20.19-2.42 9.88-4.65 19.35H400q-67.15 0-117.12 13.76-49.96 13.77-90.57 35.62-18.23 9.62-25.27 20.15-7.04 10.54-7.04 24.62v25.85h252q2.92 9.46 7.15 20.34 4.23 10.89 9.31 19.66H120Zm528.46 19.23-5.84-46.16q-16.62-3.46-31.35-11.65-14.73-8.19-26.5-20.81l-43.39 17.23-16.92-28.77L561.23-314q-6.61-17.08-6.61-35.23t6.61-35.23l-36-29.23 16.92-28.77 42.62 18q11-12.62 26.11-20.42 15.12-7.81 31.74-11.27l5.84-46.16h33.85l5.07 46.16q16.62 3.46 31.74 11.38 15.11 7.92 26.11 20.77l42.62-18.46 16.92 29.23-36 29.23q6.61 16.86 6.61 35.12 0 18.26-6.61 34.88l36.77 27.69-16.92 28.77-43.39-17.23q-11.77 12.62-26.5 20.81t-31.35 11.65l-5.07 46.16h-33.85Zm16.22-80.77q29.86 0 51.05-21.26 21.19-21.26 21.19-51.12 0-29.85-21.26-51.05-21.26-21.19-51.11-21.19-29.86 0-51.05 21.26-21.19 21.26-21.19 51.12 0 29.85 21.26 51.04 21.26 21.2 51.11 21.2ZM400-544.62q33 0 56.5-23.5t23.5-56.5q0-33-23.5-56.5t-56.5-23.5q-33 0-56.5 23.5t-23.5 56.5q0 33 23.5 56.5t56.5 23.5Zm0-80Zm12 369.24Z'/></svg>
                        </a>
                    ");
                        
                    }
                    echo("
                        <a href='shoppingcartPage.php'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='shoppingcart' d='M292.31-115.38q-25.31 0-42.66-17.35-17.34-17.35-17.34-42.65 0-25.31 17.34-42.66 17.35-17.34 42.66-17.34 25.31 0 42.65 17.34 17.35 17.35 17.35 42.66 0 25.3-17.35 42.65-17.34 17.35-42.65 17.35Zm375.38 0q-25.31 0-42.65-17.35-17.35-17.35-17.35-42.65 0-25.31 17.35-42.66 17.34-17.34 42.65-17.34t42.66 17.34q17.34 17.35 17.34 42.66 0 25.3-17.34 42.65-17.35 17.35-42.66 17.35ZM235.23-740 342-515.38h265.38q6.93 0 12.31-3.47 5.39-3.46 9.23-9.61l104.62-190q4.61-8.46.77-15-3.85-6.54-13.08-6.54h-486Zm-19.54-40h520.77q26.08 0 39.23 21.27 13.16 21.27 1.39 43.81l-114.31 208.3q-8.69 14.62-22.58 22.93-13.88 8.31-30.5 8.31H324l-48.62 89.23q-6.15 9.23-.38 20 5.77 10.77 17.31 10.77h435.38v40H292.31q-35 0-52.23-29.5-17.23-29.5-.85-59.27l60.15-107.23L152.31-820H80v-40h97.69l38 80ZM342-515.38h280-280Z'/></svg>
                        </a>
                        <a href='searchPage.php?userid=$userid'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='search'  d='M779.38-153.85 528.92-404.31q-30 25.54-69 39.54t-78.38 14q-96.1 0-162.67-66.53-66.56-66.53-66.56-162.57 0-96.05 66.53-162.71 66.53-66.65 162.57-66.65 96.05 0 162.71 66.56Q610.77-676.1 610.77-580q0 41.69-14.77 80.69t-38.77 66.69l250.46 250.47-28.31 28.3ZM381.54-390.77q79.61 0 134.42-54.81 54.81-54.8 54.81-134.42 0-79.62-54.81-134.42-54.81-54.81-134.42-54.81-79.62 0-134.42 54.81-54.81 54.8-54.81 134.42 0 79.62 54.81 134.42 54.8 54.81 134.42 54.81Z'/></svg>
                        </a>
                        <a href='myPage.php?userid=$userid'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='my'  d='M247.85-260.62q51-36.69 108.23-58.03Q413.31-340 480-340t123.92 21.35q57.23 21.34 108.23 58.03 39.62-41 63.73-96.84Q800-413.31 800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 66.69 24.12 122.54 24.11 55.84 63.73 96.84ZM480.02-460q-50.56 0-85.29-34.71Q360-529.42 360-579.98q0-50.56 34.71-85.29Q429.42-700 479.98-700q50.56 0 85.29 34.71Q600-630.58 600-580.02q0 50.56-34.71 85.29Q530.58-460 480.02-460ZM480-120q-75.31 0-141-28.04t-114.31-76.65Q176.08-273.31 148.04-339 120-404.69 120-480t28.04-141q28.04-65.69 76.65-114.31 48.62-48.61 114.31-76.65Q404.69-840 480-840t141 28.04q65.69 28.04 114.31 76.65 48.61 48.62 76.65 114.31Q840-555.31 840-480t-28.04 141q-28.04 65.69-76.65 114.31-48.62 48.61-114.31 76.65Q555.31-120 480-120Zm0-40q55.31 0 108.85-19.35 53.53-19.34 92.53-52.96-39-31.31-90.23-49.5Q539.92-300 480-300q-59.92 0-111.54 17.81-51.61 17.81-89.84 49.88 39 33.62 92.53 52.96Q424.69-160 480-160Zm0-340q33.69 0 56.85-23.15Q560-546.31 560-580t-23.15-56.85Q513.69-660 480-660t-56.85 23.15Q400-613.69 400-580t23.15 56.85Q446.31-500 480-500Zm0-80Zm0 350Z'/></svg>
                        </a> 
                    </div>");
            echo("</div>
            
        </div>
            <div class='line'></div>

        <div class='middle buy'>
            <div class='left middle'>
                <div class='userinfobox'>
                    <a class='titletext'>배송 정보</a>
                    <div>
                        <a style='font-size:13px'>주문자<a/>
                    </div>
                    <div>
                        <a style='font-size:20px; margin-bottom:5px;'>$username</a>
                    </div>
                    <form method='post' action='buy.php?userid=$userid' id='buyform' name='buyform'>
                        <div class='inputreceiverinfobox'>
                            <div>
                                <a class='rtext'>받는 사람</a>
                            </div>
                            <input class='input element' type='text' name='receiver' placeholder='받는 사람 입력' value='$receiver'>
                            <div>
                                <a class='rtext'>전화번호</a>
                            </div>
                            <input class='input element' type='text' name='phone' placeholder='전화 번호 입력' value='$phone'>
                            <div>
                                <a class='rtext'>배송지</a>
                            </div>
                            <div class='inputaddress1'>
                                <input class='input zip' type='text' name='zipcode' placeholder='우편번호 찾기' value='$zipcode'>
                                <button class='button check zipcode' type='button' onclick=\"window.open('findzipcodePage.php?page=buy','findreceiverzipcode','width=400,height=400,location=no,status=no,scrollbars=yes');\">
                                    &nbsp;&nbsp;&nbsp;&nbsp;우편번호
                                </button>
                            </div>
                            <div class='inputaddress'>
                                <input class='input element addr' name='address1' placeholder='주소' value='$address1'>
                                <input class='input element addr' name='address2' type='text' placeholder='상세주소' value='$address2'>
                            </div>
                            <div style='margin-top:10px;'>
                                <a class='rtext'>배송 메세지</a>
                            </div>
                            <input class='input element' type='text' name='message' placeholder='배송 메세지 (0~30자 입력)' value='$message'>
                            <div>
                                <a class='rtext'>결제 수단</a>
                            </div>
                            <div class='paymentbox'>
                                <input style='display:none;' id='payment' name='payment' >
                                <div class='paymentbuttonbox'>
                                    <div class='paymentbutton' id='pay1' onclick=\"toggleFixed(this)\"></div>
                                    <div class='paymenttext'>
                                        <a >신용/체크 카드</a>
                                    </div>
                                </div>
                                <div class='paymentbuttonbox'>
                                    <div class='paymentbutton' id='pay2' onclick=\"toggleFixed(this)\"></div>
                                    <div class='paymenttext'>
                                        <a >간편결제</a>
                                    </div>
                                </div>
                                <div class='paymentbuttonbox'>
                                    <div class='paymentbutton' id='pay3' onclick=\"toggleFixed(this)\"></div>
                                    <div class='paymenttext'>
                                        <a >무통장입금</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input class='button b' type='submit' value='구매 하기'>
                    </form>
                </div>
            </div>
            <div class='right middle'>
                <div class='productbox'>
                    <a class='titletext'>주문 정보</a>");

                    $counter = 0;
                    $totalprice = 0; 
                    while($row=mysqli_fetch_assoc($product)) {
                        if($page=='shoppingcart') {
                            $code=$row['pcode'];
                            $quantity = $row['quantity'];
                            $getproduct = mysqli_query($con, "SELECT * FROM product WHERE code=$code");
                            $row=mysqli_fetch_assoc($getproduct);
                            $price1 = $row['price1'];
                            $totalprice += ($price1 * $quantity);
                        }
                        
                        $name = $row['name'];
                        $price1 = $row['price1'];
                        $userfile = $row['userfile'];
                        
                        $quantity = isset($quantity) ? $quantity : 1; 
                        $sumprice = number_format($price1 * $quantity);
                        $price1 = number_format($price1);

                        
                    echo("
                    <div class='productinfo'>
                        <div class='productphoto'>
                            <img class='photo' src='./photo/$userfile'>
                        </div>
                        <div class='productinfotext'>
                            <a >$name</a>
                            <a class='ptext'>$price1 / $quantity 개</a>
                            <a class='ptext'>상품옵션</a>
                            <a class='ptext'> 합계 : $sumprice</a>
                        </div>
                        
                    </div>
                    <div class='line p'></div>
                    ");
                    $counter++;
                    }
                    $totalprice = isset($totalprice) ? $totalprice : $sumprice; 
                    $totalprice = number_format($totalprice);
                    

                    echo("
                    <div class='total'>
                        <a style='font-size:13px; margin-top:10px;'>총 결제 금액 </a>
                        <a>$totalprice 원</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script>
    function toggleFixed(element) {
        document.getElementById('pay1').classList.remove('fixed');
        document.getElementById('pay2').classList.remove('fixed');
        document.getElementById('pay3').classList.remove('fixed');
        
        element.classList.add('fixed');

        document.getElementById('payment').value = element.id;
    }



    </script>
</body>
");
mysqli_close($con);

?>