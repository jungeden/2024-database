<?
session_start();
$code=$_GET['code'];
$comment=isset($_GET['comment']) ? $_GET['comment'] : '';
// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
// if ($comment == '장바구니에 상품이 담겼습니다.') {
//     echo "<script>showMessage('" . addslashes($comment) . "');</script>";
//     // showMessage($comment);
// }

// $userfile=$_GET['userfile'];
$con = mysqli_connect("localhost","root", "0000", "shop");
$getproductinfo=mysqli_query($con, "SELECT * from product WHERE code='$code'");

$row = mysqli_fetch_assoc($getproductinfo);
$code=$row['code'];
$name=$row['name'];
$price1=$row['price1'];
$price2=$row['price2'];
$content=$row['content'];
$hit=$row['hit'];
$userfile=$row['userfile'];
$price1=number_format($price1);


$hitupdate = mysqli_query($con, "UPDATE product SET hit=hit+1 WHERE code='$code'");
echo("
<head>
<title> </title>
<style>
        @import url(shop.css);
        @import url(productdetail.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
 
    </style>

</head>
<body>
    <div class='container'>
        <div class='top start'>
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
                </div>
            </div>

            
        </div>
            <div class='line'></div>

        <div class='middle productdetail'>
            <div class='left middle'>
                <div class='back'>
                    <a href='shoppingPage.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='backbutton' d='m276.85-460 231.69 231.69L480-200 200-480l280-280 28.54 28.31L276.85-500H760v40H276.85Z'/></svg>
                    </a>  
                </div>
                <div class='photobox'>
                    <div class='photo'>
                        <a href='#' onclick=\"window.open('./photo/$userfile','_new')\"><img class='photo' src='./photo/$userfile'></a>
                    </div>
                </div>
                
                <div class='line'></div>
                <div class='reviewbox'>
                    <div class='reviewstart'>
                    </div>
                    ");
                    if($review=='') {

                    } else {
                    echo("
                    <div class='reivew'>
                        <div class='reviewuser'>
                            <div class='icon'>
                            </div>
                            <div class='reviewuserinfo'>
                            </div>
                        </div>
                        <div class='reviewstart user'>
                        </div>
                        <div class='reviewtext'>
                        </div>
                    </div>
                    <div class='line'></div>
                    ");
                    }
                    echo("
                </div>

            </div>
            <div class='right middle'>
                <div class='prouctinfobox'>
                <div class='producthit'>
                    <a >
                        <svg class='hitimg' xmlns='http://www.w3.org/2000/svg' height='20px' viewBox='0 -960 960 960' width='20px' fill='#181818'><path d='M480.18-345.85q55.97 0 94.97-39.18t39-95.15q0-55.97-39.18-94.97t-95.15-39q-55.97 0-94.97 39.18t-39 95.15q0 55.97 39.18 94.97t95.15 39ZM480-384q-40 0-68-28t-28-68q0-40 28-68t68-28q40 0 68 28t28 68q0 40-28 68t-68 28Zm.11 152q-126.55 0-230.68-67.73Q145.31-367.46 91.08-480q54.23-112.54 158.24-180.27Q353.34-728 479.89-728t230.68 67.73Q814.69-592.54 868.92-480q-54.23 112.54-158.24 180.27Q606.66-232 480.11-232ZM480-480Zm0 216q112 0 207-58t146-158q-51-100-146-158t-207-58q-112 0-207 58T127-480q51 100 146 158t207 58Z'/></svg>
                    </a>
                    <a style='font-size:13px; '>$hit</a>
                        </div>
                    <div class='namelikebox'>
                    
                        <div class='productname'>
                            <a class='productinfotext name'>$name</a>
                        </div>
                        <div class='likebutton'>
                            <a></a>
                        </div>
                    </div>
                    <div class='productcontentbox'>
                        <a class='productinfotext'>$price1</a><br>
                        <a class='productinfotext'>$content</a>
                    </div>
                    <div class='selectquantity'>
     
                        <div class='numbuttonbox'>
                            <div class='numbuttontext'>
                                <input class='input num' id='choosequantity' name='quantity' min='1' max='100' value='1'>
                            </div>
                            <div class='numbuttonupdown'>
                                <button class='numbutton up' onclick=\"numchange('up')\">
                                </button>
                                <button class='numbutton down' onclick=\"numchange('down')\">
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class='buttonbox'>
                        <form id='shoppingcartquantity' method='post' action='addshoppingcart.php?code=$code&userid=$userid'>
                            <input id='addshoppingcart' class='button' type='submit' name='shoppingcart' value='장바구니'>
                        </form>
                        <form method='post' action='buyPage.php?code=$code&userid=$userid&page=productdetail'>
                            <input class='button' type='submit' name='tobuy' value='구매하기'>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div id='messageBox' class='messagebox'></div>
        <div class='bottom start'>

        </div>
    </div>

        
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const messagebox = document.getElementById('messageBox');
    const message = localStorage.getItem('cartMessage');

    if (message) {
        messagebox.style.display = 'block';
      
                    messagebox.innerHTML = message;

      

        setTimeout(() => {
            messagebox.style.display = 'none';
        }, 1300);

        localStorage.removeItem('cartMessage');
    }
});

 

    document.getElementById('shoppingcartquantity').addEventListener('submit', function(event) {
    
    const outsideValue = document.getElementById('choosequantity').value;

   
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'quantity'; 
    hiddenInput.value = outsideValue;

   
    this.appendChild(hiddenInput);
  });


   

  function numchange(updown) {
    const quantityInput = document.getElementById('choosequantity');
    let num = parseInt(quantityInput.value); 
    if (updown === 'up') {
        quantityInput.value = num + 1;
    } else {
        if (num > 1) { 
            quantityInput.value = num - 1;
        }
    }
}
</script>
</body>


");
echo ("<script>
    console.log('PHP 실행 확인: 장바구니 메시지 저장');
    localStorage.setItem('cartMessage', '장바구니에 상품이 담겼습니다.'");

mysqli_close($con);
?>