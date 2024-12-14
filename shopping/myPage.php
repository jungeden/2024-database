<?
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
} else {
    $page='my';
    header("Location: loginPage.php?page=$page");
    exit();
} 
include('top.php');



?>

<?
echo("
<style>
        @import url(my.css);
    </style>");
// $userid = isset($_GET['userid']) ? $_GET['userid'] : '';

// if($userid=='') {
//     $page='my';
//     echo ("<meta http-equiv='Refresh' content='0; url=loginPage.php?page=$my'>");
// }



$con = mysqli_connect("localhost","root","0000","shop");
$getuserinfo=mysqli_query($con, "SELECT * from user WHERE userid='$userid'");
$row=mysqli_fetch_assoc($getuserinfo);
$username=$row['username'];
$userphone=$row['userphone'];
$useremail=$row['useremail'];
$userbirth=$row['userbirth'];
$zipcode=$row['zipcode'];
$address1=$row['address1'];
$address2=$row['address2'];
$point = $row['point'] ?? 0;
$userjoindate=$row['userjoindate'];
$pointformat=number_format($point);

$num1 = substr($userphone, 0, 3);  
$num2 = substr($userphone, 3, 4); 
$num3 = substr($userphone, 7, 4);  

$year = substr($userbirth, 0, 4);  
$month = substr($userbirth, 4, 2);  
$date = substr($userbirth, 6, 2);  



echo("
<script src='scroll.js' defer></script>

        <div class='middle'>
            <div class='left middle' id='leftmiddle'>
                <div class='usernamebox'>
                    <div class='username'>
                    <div style='z-index:1;'>
                    <a>
                    <svg xmlns='http://www.w3.org/2000/svg' height='150px' viewBox='0 -960 960 960' width='150px' ><path d='M248-250q55-37 110-58.5T480-330q67 0 122 21.5T712-250q43-45 68.5-103.09Q806-411.17 806-480q0-136-95-231t-231-95q-136 0-231 95t-95 231q0 68.83 25.5 126.91Q205-295 248-250Zm231.73-219q-47.73 0-80.23-32.77-32.5-32.76-32.5-80.5 0-47.73 32.77-80.23 32.76-32.5 80.5-32.5 47.73 0 80.23 32.77 32.5 32.76 32.5 80.5 0 47.73-32.77 80.23-32.76 32.5-80.5 32.5Zm.74 337q-73.47 0-136.68-27-63.22-27-110.5-74.5Q186-281 159-343.77q-27-62.76-27-136Q132-553 159-616q27-63 74.5-110.5T343.77-801q62.76-27 136-27Q553-828 616-801q63 27 110.5 74.5T801-615.97q27 63.03 27 135.5 0 73.47-27 136.68-27 63.22-74.5 110.5Q679-186 615.97-159q-63.03 27-135.5 27Zm-.47-22q57 0 114-20.5T694-234q-43-34-97.5-54T480-308q-62 0-117 19.5T267-234q42 39 99 59.5T480-154Zm.14-337Q519-491 545-517.14t26-65Q571-621 544.86-647t-65-26Q441-673 415-646.86t-26 65Q389-543 415.14-517t65 26Zm-.14-91Zm0 351Z'/></svg>
                    </a>
                    </div>
                    <div class='cir'></div>
                        <div class='usernametext'>
                            <a class='text name'>$userid</a>
                            <a class='text nim'>님</a>
                        </div>
                        <div class='logouttext'>
                            <a class='logouttext' href='logout.php' >LOGOUT<a>
                        </div>
                    </div>

                </div>
                <div class='menubox'>
                    <div class='menutext'>
                        <div class='mbox'>
                        <div class='mdiv'>
                            <a class='m' href='passPage.php'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='35px' viewBox='0 -960 960 960' width='35px'><path d='M500-220Zm-340 60v-94q0-38 19-65t49-41q67-30 128.5-45T480-420q38.02 0 75.01 6T630-397l-48 47q-26-5-50.9-7.5-24.89-2.5-51.1-2.5-57 0-111 11.5T252-306q-14 7-23 21.5t-9 30.5v34h280v60H160Zm400 40v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q9 9 13 20t4 22q0 11-4.5 22.5T902.09-340L683-120H560Zm300-263-37-37 37 37ZM620-180h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19ZM480-481q-63 0-106.5-43.5T330-631q0-63 43.5-106.5T480-781q63 0 106.5 43.5T630-631q0 63-43.5 106.5T480-481Zm0-60q38 0 64-26t26-64q0-38-26-64t-64-26q-38 0-64 26t-26 64q0 38 26 64t64 26Zm0-90Z'/></svg>
                            </a>
                            </div>
                             <a class='m'>
                            회원정보 수정
                            </a>
                        </div>
                        <div class='mbox'>
                            <div class='mdiv'>
                                <a class='m' href='shoppingcartPage.php'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='35px' viewBox='0 -960 960 960' width='35px' ><path d='M286.79-81Q257-81 236-102.21t-21-51Q215-183 236.21-204t51-21Q317-225 338-203.79t21 51Q359-123 337.79-102t-51 21Zm400 0Q657-81 636-102.21t-21-51Q615-183 636.21-204t51-21Q717-225 738-203.79t21 51Q759-123 737.79-102t-51 21ZM235-741l110 228h288l125-228H235Zm-30-60h589.07q22.97 0 34.95 21 11.98 21-.02 42L694-495q-11 19-28.56 30.5T627-453H324l-56 104h491v60H277q-42 0-60.5-28t.5-63l64-118-152-322H51v-60h117l37 79Zm140 288h288-288Z'/></svg>
                            </a>
                                </div>
                             <a class='m'>
                            장바구니
                            </a>
                        </div>
                        <div class='mbox'>
                            <div class='mdiv'>
                                <a class='m' href='likePage.php'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='35px' viewBox='0 -960 960 960' width='35px' ><path d='m480-121-41-37q-105.77-97.12-174.88-167.56Q195-396 154-451.5T96.5-552Q80-597 80-643q0-90.15 60.5-150.58Q201-854 290-854q57 0 105.5 27t84.5 78q42-54 89-79.5T670-854q89 0 149.5 60.42Q880-733.15 880-643q0 46-16.5 91T806-451.5Q765-396 695.88-325.56 626.77-255.12 521-158l-41 37Zm0-79q101.24-93 166.62-159.5Q712-426 750.5-476t54-89.14q15.5-39.13 15.5-77.72 0-66.14-42-108.64T670.22-794q-51.52 0-95.37 31.5T504-674h-49q-26-56-69.85-88-43.85-32-95.37-32Q224-794 182-751.5t-42 108.82q0 38.68 15.5 78.18 15.5 39.5 54 90T314-358q66 66 166 158Zm0-297Z'/></svg>
                            </a>
                                </div>
                             <a class='m'>
                            찜
                            </a>
                        </div>
                        <div class='mbox'>
                            <div class='mdiv'>
                                <a class='m' href='orderlistPage.php'>
                                <svg xmlns='http://www.w3.org/2000/svg' height='35px' viewBox='0 -960 960 960' width='35px' ><path d='M180-80q-24.75 0-42.37-17.63Q120-115.25 120-140v-530q0-24.75 17.63-42.38Q155.25-730 180-730h110q0-78 53.5-134T475-920q80.92 0 137.96 55Q670-810 670-730h110q24.75 0 42.38 17.62Q840-694.75 840-670v530q0 24.75-17.62 42.37Q804.75-80 780-80H180Zm0-60h600v-530H180v530Zm300-290q79 0 137-58t58-137h-60q0 55-40 95t-95 40q-55 0-95-40t-40-95h-60q0 79 58 137t137 58ZM350-730h260q0-55-37.5-92.5T480-860q-55 0-92.5 37.5T350-730ZM180-140v-530 530Z'/></svg>
                            </a>
                                </div>
                                 <a class='m'>
                            주문목록
                            </a>
                        </div>
                        <div class='mbox'>
                            <div class='mdiv'>
                             <a class='m' href='customerPage.php'>
                             <svg xmlns='http://www.w3.org/2000/svg' height='35px' viewBox='0 -960 960 960' width='35px' ><path d='M440-120v-60h340v-304q0-123.69-87.32-209.84Q605.36-780 480-780q-125.36 0-212.68 86.16Q180-607.69 180-484v244h-20q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v69q0 24.75-17.62 42.37Q804.75-120 780-120H440Zm-80.18-290q-12.82 0-21.32-8.68-8.5-8.67-8.5-21.5 0-12.82 8.68-21.32 8.67-8.5 21.5-8.5 12.82 0 21.32 8.68 8.5 8.67 8.5 21.5 0 12.82-8.68 21.32-8.67 8.5-21.5 8.5Zm240 0q-12.82 0-21.32-8.68-8.5-8.67-8.5-21.5 0-12.82 8.68-21.32 8.67-8.5 21.5-8.5 12.82 0 21.32 8.68 8.5 8.67 8.5 21.5 0 12.82-8.68 21.32-8.67 8.5-21.5 8.5ZM241-462q-7-106 64-182t177-76q87 0 151 57.5T711-519q-89-1-162.5-50T434.72-698Q419-618 367.5-555.5T241-462Z'/></svg>
                            </a>
                             </div>
                              <a class='m'>
                           고객센터
                           </a>

                        </div>
                    </div>
                </div>
            </div>
            <div class='right middle' id='rightmiddle'>");
            $getnotice = mysqli_query($con,"SELECT * FROM managenotice WHERE num='1'");
            $rown = mysqli_fetch_assoc($getnotice);
            $an = $rown['an'];
                if($userid == 'admin') {
                    echo("
                <div class='infotbox'>
                    <div class='infot' onclick='window.location.href=\"myPage.php\"'>공지 사항</div>
                    <div class='infot l'>&nbsp;|&nbsp;</div>
                    <div class='infot' onclick='window.location.href=\"myPagead.php\"'>베너 광고</div>

                </div>
                <div class='userinfobox'>
                    <form method='post' action='managenotice.php'>
                        <div id='editor'>$an</div>
                        <textarea class='input content' name='content' rows='12' cols='50' hidden></textarea>
                        <input class='button su' type='submit' value='등록'>
                    </form>

                </div>");
                } else {

                
                    echo("
                <div class='infotbox'>
                    <div class='infot' onclick='window.location.href=\"myPage.php\"'>회원 정보</div>
                    <div class='infot l'>&nbsp;|&nbsp;</div>
                    <div class='infot' onclick='window.location.href=\"myPagepoint.php\"'>포인트</div>

                </div>
                <div class='userinfobox'>
                    <a class='text infolabeltext'>이름<a>
                    <a class='text userinfotext'>$username<a>
                    <a class='text infolabeltext'>전화번호<a>
                    <a class='text userinfotext'>$num1-$num2-$num3<a>
                    <a class='text infolabeltext'>이메일<a>
                    <a class='text userinfotext'>$useremail<a>
                    <a class='text infolabeltext'>생년월일<a>
                    <a class='text userinfotext'>$year . $month . $date <a>
                    <a class='text infolabeltext'>주소<a>
                    <a class='text userinfotext' style='font-size:16px; margin-bottom:1px;'>($zipcode)<a>
                    <a class='text userinfotext' style='font-size:19px;'>$address1 &nbsp; $address2<a>
                </div>");
                
                }

                    
                echo("
            
        </div>
    </div>
    <script>
    const target = document.getElementById('leftmiddle');

    window.addEventListener('scroll', () => {
      // 현재 스크롤 위치와 문서 높이 확인
      const scrollPosition = window.scrollY + window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight;

      // 스크롤이 끝까지 내려갔을 때 스타일 변경
      if (scrollPosition >= documentHeight) {
        target.classList.add('scrolled');
      } else {
        target.classList.remove('scrolled');
      }
    });
    
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], 
        ['blockquote', 'code-block'],            
        [{ 'header': 1 }, { 'header': 2 }],      
        [{ 'color': [] }, { 'background': [] }],  
        [{ 'align': [] }],                        
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'font': [] }]                         
    ];

    var quill = new Quill('#editor', {
        modules: { toolbar: toolbarOptions },
        theme: 'snow'
    });

 
    const form = document.querySelector('form');
    const textarea = document.querySelector('textarea[name=\"content\"]');

    form.onsubmit = function () {
     
        textarea.value = quill.root.innerHTML;
        console.log('전송될 내용:', textarea.value); // textarea 값 확인
    return true;
    };
    </script>
<body>
");


mysqli_close($con);
?>