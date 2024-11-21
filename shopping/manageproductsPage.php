<?
session_start();

// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  
} else {
    $userid='';
}
$selectedclass = isset($_POST['selectedClass']) ? $_POST['selectedClass'] : '';
$searchname = isset($_POST['name']) ? $_POST['name'] : '';

if($selectedclass == '' && $searchname=='') {
    $sql = "SELECT * FROM product ORDER BY code DESC";

} else if($selectedclass == '모두' || $selectedclass =='') {
    // name을 LIKE로 검색, $searchname이 포함된 제품을 찾음
    $sql = "SELECT * FROM product WHERE name LIKE '%$searchname%'";
} else {
    // 특정 class를 검색
    $sql = "SELECT * FROM product WHERE class = '$selectedclass' AND name LIKE '%$searchname%'";
}

$con = mysqli_connect("localhost", "root", "0000", "shop");
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

$row=mysqli_fetch_assoc($result);
$code=$row['code'];
$name=$row['name'];
$price1=$row['price1'];
$price2=$row['price2'];
$content=$row['content'];
$class=$row['class'];
$userfile=$row['userfile'];
$hit=$row['hit'];
$class=$row['class'];
$price1=number_format($price1);


echo("
<head>
<title> </title>
<style>
        @import url(shop.css);
        @import url(manageproducts.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
      
    </style>
    <script>
        function changeoption(value) {
            let classButton = document.getElementById('class');
            document.getElementById('selectedClass').value = value;
            classButton.textContent = value;
            classButton.style.color = \"rgb(28, 28, 28)\"; 
            document.getElementById('class').value = value;

            let elements = document.getElementsByClassName(\"classoption\");
            for (let i = 0; i < elements.length; i++) {
                elements[i].style.visibility = \"hidden\";
            }
        }

        function showOption() {
           
            document.getElementById('classoption').style.visibility =  \"visible\" ;

        }
    </script>

</head>
<body>
    <div class='container'>
        <div class='top manageproducts'>
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
        <div class='middle manageproducts'>
            <div class='searchbox'>
                <form class='searchform' method='post' action='manageproductsPage.php?userid=$userid&selectedclass=$selectedclass&searchname=$searchname'>
                         <button class='selectclass' type='button' name='class' id='class' onclick=\"showOption()\">선택</button>
                         <input type='hidden' id='selectedClass' name='selectedClass' value=''>
                        <ul class='classoption' id='classoption'>
                            <li><button type='button' class=' option' id='모두' onclick=\"changeoption(this.id)\">모두</button></li>
                            <li><button type='button' class=' option' id='01' onclick=\"changeoption(this.id)\">01</button></li>
                            <li><button type='button' class=' option' id='02' onclick=\"changeoption(this.id)\">02</button></li>
                            <li><button type='button' class=' option' id='03' onclick=\"changeoption(this.id)\">03</button></li>
                        </ul>
                        <input class='input search' type='text' name='name' placeholder='검색어 입력' >
                        <input class='button search' type='submit' value='검색'>
                    </form>
            </div>
            <div class='linesearch'></div>

            <div class='productbox'>
                <div class='products'>
                    <div class='product'>
                        <a href='manageinputPage.php?userid=$userid'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='input' d='M460-460H240v-40h220v-220h40v220h220v40H500v220h-40v-220Z'/></svg>
                        <a>
                    </div>
                    <div class='infoelement'>
                        <div class='productinfo'>
                                <a class='productinfotext' href='productdetailPage.php?code=$code'>
                                </a>
                        </div>
                    </div>
                </div >
            
        

            

                ");
                
                if ($total == 0) {
                    echo "</div>";
                } else {
                    if (!isset($_GET['cpage']) || $_GET['cpage'] == '') {
                        $cpage = 1;  // 기본값을 1로 설정
                    } else {
                        $cpage = (int)$_GET['cpage'];  // 전달된 값은 정수로 변환
                    }
                    
                    $pageSize = 9;  // 한 페이지에 출력할 데이터 수
                    
                    // 전체 페이지 수 계산
                    $sqlTotal = "SELECT COUNT(*) FROM product";
                    $resultTotal = mysqli_query($con, $sqlTotal);
                    $rowTotal = mysqli_fetch_row($resultTotal);
                    $total = $rowTotal[0];
                    
                    // 전체 페이지 수 계산
                    $totalPage = ceil($total / $pageSize);
                    // echo "Total pages: " . $totalPage . "<br>"; // 페이지 수 확인
                    
                    // 현재 페이지의 시작 위치 계산
                    $start = ($cpage - 1) * $pageSize;
                    // echo "Start position: $start<br>";  // 시작 위치 출력
                    
                    // 페이지네이션 쿼리 적용 (LIMIT 사용)

                    if($selectedclass == '' && $searchname=='') {
                        $sql = "SELECT * FROM product ORDER BY code DESC LIMIT $start, $pageSize";

                    } else if($selectedclass == '모두' || $selectedclass =='') {
                        // name을 LIKE로 검색, $searchname이 포함된 제품을 찾음
                        $sql = "SELECT * FROM product WHERE name LIKE '%$searchname%' LIMIT $start, $pageSize";
                    } else {
                        // 특정 class를 검색
                        $sql = "SELECT * FROM product WHERE class = '$selectedclass' AND name LIKE '%$searchname%' LIMIT $start, $pageSize";
                    }

                    // $sql = "SELECT * FROM product LIMIT $start, $pageSize";
                    // echo "Executing query: $sql<br>";  // 쿼리 확인
                    $result = mysqli_query($con, $sql);
                    
                    // 쿼리 결과 출력
                    // var_dump($result);  // 쿼리 결과 확인
                    
                    // 상품 목록 출력
                    $counter = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $code = $row['code'];
                        $name = $row['name'];
                        $price1 = $row['price1'];
                        $price2 = $row['price2'];
                        $userfile = $row['userfile'];  // 이미지 파일 경로
                        $price1=number_format($price1);
                    
                        echo "
                        <div class='products'>
                            <div class='product'>
                                <a href='productdetailPage.php?code=$code&userid=$userid&userfile=$userfile'>
                                    <img class='photo' src='./photo/$userfile'>
                                </a>
                            </div>
                            <div class='infoelement'>
                                <div class='productinfo'>
                                    <a class='productinfotext' href='productdetailPage.php?code=$code&userid=$userid&userfile=$userfile'>
                                        $name
                                    </a>
                                    <a class='productinfotext'>
                                        $price1
                                    </a>
                                    
                                </div>
                                <a class='button delete' href='manageproductmodifyPage.php?code=$code'>
                                    <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='modify' d='M375.38-624.62v-40h329.24v40H375.38Zm0 110.77v-40h329.24v40H375.38ZM473.85-160H200h273.85Zm0 40H240q-33.85 0-56.92-23.08Q160-166.15 160-200v-110.77h120V-840h520v315.62q-10.77.3-20.5 2.26-9.73 1.97-19.5 5.58V-800H320v489.23h213.85l-40 40H200V-200q0 17 11.5 28.5T240-160h233.85v40Zm95.38 0v-88.38l213.31-212.31q5.92-5.93 12.31-8 6.38-2.08 12.77-2.08 6.61 0 13.38 2.58 6.77 2.57 11.92 7.73l37 37.77q4.93 5.92 7.5 12.31Q880-364 880-357.62q0 6.39-2.46 12.89-2.46 6.5-7.62 12.42L657.62-120h-88.39Zm275.39-237.62-37-37.76 37 37.76Zm-240 202.24h38l138.69-138.93-18.77-19-18.23-19.54-139.69 139.47v38Zm157.92-157.93-18.23-19.54 37 38.54-18.77-19Z'/></svg>
                                </a>
                                 <a class='button delete' href='manageproductdelete.php?code=$code'>
                                    <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='delete' d='M304.62-160q-26.85 0-45.74-18.88Q240-197.77 240-224.62V-720h-40v-40h160v-30.77h240V-760h160v40h-40v495.38q0 27.62-18.5 46.12Q683-160 655.38-160H304.62ZM680-720H280v495.38q0 10.77 6.92 17.7 6.93 6.92 17.7 6.92h350.76q9.24 0 16.93-7.69 7.69-7.69 7.69-16.93V-720ZM392.31-280h40v-360h-40v360Zm135.38 0h40v-360h-40v360ZM280-720v520-520Z'/></svg>
                                </a>

                            </div>
                        </div>";
                        $counter++;
                    }    
                echo "
            </div>";
                
                    // 페이지네이션: 이전, 다음 페이지
            echo "
            <div class='nextpage'>";
                    if (!isset($cblock) || $cblock == '') {
                        $cblock = 1;
                    }
                
                    $blockSize = 5;  // 한 블록에 표시할 페이지 수
                    $pblock = $cblock - 1;
                    $nblock = $cblock + 1;
                
                    $startPage = ($cblock - 1) * $blockSize + 1;
                    $pStartPage = $startPage - 1;
                    $nStartPage = $startPage + $blockSize;
                echo("
                <div class='pagechange'>");
                    // 이전 블록 링크
                    if ($pblock > 0) {
                        echo "<a href='manageproductsPage.php?cblock=$pblock&cpage=$pStartPage&userid=$userid'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'>
                                <path id='beforepage' d='M560-267.69 347.69-480 560-692.31 588.31-664l-184 184 184 184L560-267.69Z'/>
                            </svg>
                        </a>";
                    }
                
                    // 페이지 번호 출력
                    for ($i = $startPage; $i < $nStartPage && $i <= $totalPage; $i++) {
                        $class = ($i == $cpage) ? 'class="current"' : '';  // 현재 페이지는 스타일링
                        echo "<div class='pagenum'><a href='manageproductsPage.php?cblock=$cblock&cpage=$i' $class>$i </a></div>";

                    }
                
                    // 다음 블록 링크
                    if ($nStartPage <= $totalPage) {
                        echo "<a href='manageproductsPage.php?cblock=$nblock&cpage=$nStartPage&userid=$userid'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'>
                                <path id='afterpage' d='m531.69-480-184-184L376-692.31 588.31-480 376-267.69 347.69-296l184-184Z'/>
                            </svg>
                        </a>";
                    }
                echo("
                </div>
            </div>
        </div>
            ");
                }
                echo("
    </div>
</body>");    
mysqli_close($con);   
?>
                