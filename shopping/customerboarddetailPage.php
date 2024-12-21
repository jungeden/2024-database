<?
session_start();

if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
} else {
    header("Location: loginPage.php");
    exit();
} 
$con = mysqli_connect("localhost","root", "0000", "shop");

$id=$_GET['id'];
echo("
<head>
<link href='https://cdn.quilljs.com/1.3.6/quill.snow.css' rel='stylesheet'>
<title> </title>
<style>
      @import url(bottom.css);
        @import url(shop.css);
        @import url(customerboarddetail.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');

 
    </style>
    <script src='scroll.js' defer></script>
    <script src='https://cdn.quilljs.com/1.3.6/quill.min.js'></script>
</head>
<body>
    <div class='container'>
        <div class='top start'>
            <div class='left top'>
                <a class='title'>
                    ZAUM
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
                        <a href='manageproductsPage.php?userid=$userid'>");
                        echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path class='icon' d='M160-240v-480 480Zm12.31 60Q142-180 121-201q-21-21-21-51.31v-455.38Q100-738 121-759q21-21 51.31-21h219.61l80 80h315.77Q818-700 839-679q21 21 21 51.31v113.15q-14.39-5.69-29.69-7.42-15.31-1.73-30.31.11v-105.84q0-4.62-3.85-8.46-3.84-3.85-8.46-3.85H447.38l-80-80H172.31q-5.39 0-8.85 3.46t-3.46 8.85v455.38q0 4.62 3.85 8.46 3.84 3.85 8.46 3.85h307.07l-2.46 2.46V-180H172.31Zm392.31 80v-105.69l217.15-216.16q7.46-7.46 16.15-10.5 8.69-3.03 17.39-3.03 9.3 0 18.19 3.53 8.88 3.54 15.96 10.62l37 37.38q6.46 7.47 10 16.16Q900-359 900-350.31t-3.23 17.69q-3.23 9-10.31 16.46L670.31-100H564.62Zm287.69-250.31-37-37.38 37 37.38Zm-240 202.62h38l129.84-130.47-18.38-19-18.62-18.76-130.84 130.23v38Zm149.46-149.47-18.62-18.76 37 37.76-18.38-19Z'/></svg>");
                        //    echo(" <svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='manageproducts' d='M160-240v-480 480Zm24.62 40q-27.62 0-46.12-18.5Q120-237 120-264.62v-430.76q0-27.62 18.5-46.12Q157-760 184.62-760h199.23l80 80h311.53q27.62 0 46.12 18.5Q840-643 840-615.38v94.3q-9.77-3.38-19.88-4.34-10.12-.96-20.12-.27v-89.69q0-9.24-7.69-16.93-7.69-7.69-16.93-7.69H447.77l-80-80H184.62q-10.77 0-17.7 6.92-6.92 6.93-6.92 17.7v430.76q0 9.24 7.69 16.93 7.69 7.69 16.93 7.69h290.15l-.92.92V-200H184.62Zm384.61 80v-88.38l213.31-212.31q5.92-5.93 12.31-8 6.38-2.08 12.77-2.08 6.61 0 13.38 2.58 6.77 2.57 11.92 7.73l37 37.77q4.93 5.92 7.5 12.31Q880-364 880-357.62q0 6.39-2.46 12.89-2.46 6.5-7.62 12.42L657.62-120h-88.39Zm275.39-237.62-37-37.76 37 37.76Zm-240 202.24h38l138.69-138.93-18.77-19-18.23-19.54-139.69 139.47v38Zm157.92-157.93-18.23-19.54 37 38.54-18.77-19Z'/></svg>");
                        echo("</a>
                        <a href='manageaccountsPage.php?userid=$userid'>");
                        echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path class='icon' d='M400-492.31q-57.75 0-98.87-41.12Q260-574.56 260-632.31q0-57.75 41.13-98.87 41.12-41.13 98.87-41.13 57.75 0 98.87 41.13Q540-690.06 540-632.31q0 57.75-41.13 98.88-41.12 41.12-98.87 41.12ZM100-187.69v-88.93q0-30.3 15.46-54.88 15.46-24.58 43.16-38.04 49.84-24.84 107.69-41.5 57.84-16.65 133.69-16.65h11.69q4.85 0 10.46 1.23-6.07 14.15-10.03 28.84-3.97 14.7-6.58 29.93H400q-69.08 0-122.31 15.88-53.23 15.89-91.54 35.81-13.61 7.31-19.88 17.08t-6.27 22.3v28.93h252q4.46 15.23 11.58 30.92 7.11 15.69 15.65 29.08H100Zm544.23 29.61-8.92-53.08q-14.31-4.23-26.93-11.07-12.61-6.85-24-17.16l-50.69 17.62-28.46-48.39L546.62-304q-4.31-15.54-4.31-30.62 0-15.07 4.31-30.61l-41-34.62 28.46-48.38 50.3 18q11-10.31 23.81-16.96 12.81-6.66 27.12-10.89l8.92-53.07h56.92l8.54 53.07q14.31 4.23 27.12 11.2 12.8 6.96 23.8 17.88l50.31-19.23 28.46 49.61-41 34.62q4.31 14.43 4.31 30.06 0 15.63-4.31 29.94l41.39 33.84-28.46 48.39-50.7-17.62q-11.38 10.31-24 17.16-12.61 6.84-26.92 11.07l-8.54 53.08h-56.92Zm28.11-100.38q31.43 0 53.77-22.38 22.35-22.38 22.35-53.81 0-31.43-22.38-53.77-22.38-22.35-53.81-22.35-31.42 0-53.77 22.38t-22.35 53.81q0 31.42 22.38 53.77t53.81 22.35ZM400-552.31q33 0 56.5-23.5t23.5-56.5q0-33-23.5-56.5t-56.5-23.5q-33 0-56.5 23.5t-23.5 56.5q0 33 23.5 56.5t56.5 23.5Zm0-80Zm12 384.62Z'/></svg>");
                            //  echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='manageaccounts' d='M400-504.62q-49.5 0-84.75-35.25T280-624.62q0-49.5 35.25-84.75T400-744.62q49.5 0 84.75 35.25T520-624.62q0 49.5-35.25 84.75T400-504.62ZM120-215.38v-65.85q0-27.62 13.92-47.77 13.93-20.15 39.31-32.08 48.69-23.69 100.39-39 51.69-15.3 126.38-15.3h9.38q3.7 0 8.93.46-4.16 10.3-6.58 20.19-2.42 9.88-4.65 19.35H400q-67.15 0-117.12 13.76-49.96 13.77-90.57 35.62-18.23 9.62-25.27 20.15-7.04 10.54-7.04 24.62v25.85h252q2.92 9.46 7.15 20.34 4.23 10.89 9.31 19.66H120Zm528.46 19.23-5.84-46.16q-16.62-3.46-31.35-11.65-14.73-8.19-26.5-20.81l-43.39 17.23-16.92-28.77L561.23-314q-6.61-17.08-6.61-35.23t6.61-35.23l-36-29.23 16.92-28.77 42.62 18q11-12.62 26.11-20.42 15.12-7.81 31.74-11.27l5.84-46.16h33.85l5.07 46.16q16.62 3.46 31.74 11.38 15.11 7.92 26.11 20.77l42.62-18.46 16.92 29.23-36 29.23q6.61 16.86 6.61 35.12 0 18.26-6.61 34.88l36.77 27.69-16.92 28.77-43.39-17.23q-11.77 12.62-26.5 20.81t-31.35 11.65l-5.07 46.16h-33.85Zm16.22-80.77q29.86 0 51.05-21.26 21.19-21.26 21.19-51.12 0-29.85-21.26-51.05-21.26-21.19-51.11-21.19-29.86 0-51.05 21.26-21.19 21.26-21.19 51.12 0 29.85 21.26 51.04 21.26 21.2 51.11 21.2ZM400-544.62q33 0 56.5-23.5t23.5-56.5q0-33-23.5-56.5t-56.5-23.5q-33 0-56.5 23.5t-23.5 56.5q0 33 23.5 56.5t56.5 23.5Zm0-80Zm12 369.24Z'/></svg>");
                         echo("</a>");
                        
                    }
                        echo("
                        <a href='shoppingcartPage.php'>");
                        echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path class='icon' d='M286.15-97.69q-29.15 0-49.57-20.43-20.42-20.42-20.42-49.57 0-29.16 20.42-49.58 20.42-20.42 49.57-20.42 29.16 0 49.58 20.42 20.42 20.42 20.42 49.58 0 29.15-20.42 49.57-20.42 20.43-49.58 20.43Zm387.7 0q-29.16 0-49.58-20.43-20.42-20.42-20.42-49.57 0-29.16 20.42-49.58 20.42-20.42 49.58-20.42 29.15 0 49.57 20.42t20.42 49.58q0 29.15-20.42 49.57Q703-97.69 673.85-97.69ZM240.61-730 342-517.69h272.69q3.46 0 6.16-1.73 2.69-1.73 4.61-4.81l107.31-195q2.31-4.23.38-7.5-1.92-3.27-6.54-3.27h-486Zm-28.76-60h555.38q24.54 0 37.11 20.89 12.58 20.88 1.2 42.65L677.38-494.31q-9.84 17.31-26.03 26.96-16.2 9.66-35.5 9.66H324l-46.31 84.61q-3.08 4.62-.19 10 2.88 5.39 8.65 5.39h457.69v60H286.15q-40 0-60.11-34.5-20.12-34.5-1.42-68.89l57.07-102.61L136.16-810H60v-60h113.85l38 80ZM342-517.69h280-280Z'/></svg>");

                            //  echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='shoppingcart' d='M292.31-115.38q-25.31 0-42.66-17.35-17.34-17.35-17.34-42.65 0-25.31 17.34-42.66 17.35-17.34 42.66-17.34 25.31 0 42.65 17.34 17.35 17.35 17.35 42.66 0 25.3-17.35 42.65-17.34 17.35-42.65 17.35Zm375.38 0q-25.31 0-42.65-17.35-17.35-17.35-17.35-42.65 0-25.31 17.35-42.66 17.34-17.34 42.65-17.34t42.66 17.34q17.34 17.35 17.34 42.66 0 25.3-17.34 42.65-17.35 17.35-42.66 17.35ZM235.23-740 342-515.38h265.38q6.93 0 12.31-3.47 5.39-3.46 9.23-9.61l104.62-190q4.61-8.46.77-15-3.85-6.54-13.08-6.54h-486Zm-19.54-40h520.77q26.08 0 39.23 21.27 13.16 21.27 1.39 43.81l-114.31 208.3q-8.69 14.62-22.58 22.93-13.88 8.31-30.5 8.31H324l-48.62 89.23q-6.15 9.23-.38 20 5.77 10.77 17.31 10.77h435.38v40H292.31q-35 0-52.23-29.5-17.23-29.5-.85-59.27l60.15-107.23L152.31-820H80v-40h97.69l38 80ZM342-515.38h280-280Z'/></svg>");
                         echo("</a>
                        <a href='searchPage.php?userid=$userid'>");
                        echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path class='icon' d='M781.69-136.92 530.46-388.16q-30 24.77-69 38.77-39 14-80.69 14-102.55 0-173.58-71.01-71.03-71.01-71.03-173.54 0-102.52 71.01-173.6 71.01-71.07 173.54-71.07 102.52 0 173.6 71.03 71.07 71.03 71.07 173.58 0 42.85-14.38 81.85-14.39 39-38.39 67.84l251.23 251.23-42.15 42.16ZM380.77-395.38q77.31 0 130.96-53.66 53.66-53.65 53.66-130.96t-53.66-130.96q-53.65-53.66-130.96-53.66t-130.96 53.66Q196.15-657.31 196.15-580t53.66 130.96q53.65 53.66 130.96 53.66Z'/></svg>");

                            //  echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='search'  d='M779.38-153.85 528.92-404.31q-30 25.54-69 39.54t-78.38 14q-96.1 0-162.67-66.53-66.56-66.53-66.56-162.57 0-96.05 66.53-162.71 66.53-66.65 162.57-66.65 96.05 0 162.71 66.56Q610.77-676.1 610.77-580q0 41.69-14.77 80.69t-38.77 66.69l250.46 250.47-28.31 28.3ZM381.54-390.77q79.61 0 134.42-54.81 54.81-54.8 54.81-134.42 0-79.62-54.81-134.42-54.81-54.81-134.42-54.81-79.62 0-134.42 54.81-54.81 54.8-54.81 134.42 0 79.62 54.81 134.42 54.8 54.81 134.42 54.81Z'/></svg>");
                         echo("</a>
                        <a href='myPage.php?userid=$userid'>");
                        echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path class='icon' d='M240.92-268.31q51-37.84 111.12-59.77Q412.15-350 480-350t127.96 21.92q60.12 21.93 111.12 59.77 37.3-41 59.11-94.92Q800-417.15 800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 62.85 21.81 116.77 21.81 53.92 59.11 94.92ZM480.01-450q-54.78 0-92.39-37.6Q350-525.21 350-579.99t37.6-92.39Q425.21-710 479.99-710t92.39 37.6Q610-634.79 610-580.01t-37.6 92.39Q534.79-450 480.01-450ZM480-100q-79.15 0-148.5-29.77t-120.65-81.08q-51.31-51.3-81.08-120.65Q100-400.85 100-480t29.77-148.5q29.77-69.35 81.08-120.65 51.3-51.31 120.65-81.08Q400.85-860 480-860t148.5 29.77q69.35 29.77 120.65 81.08 51.31 51.3 81.08 120.65Q860-559.15 860-480t-29.77 148.5q-29.77 69.35-81.08 120.65-51.3 51.31-120.65 81.08Q559.15-100 480-100Zm0-60q54.15 0 104.42-17.42 50.27-17.43 89.27-48.73-39-30.16-88.11-47Q536.46-290 480-290t-105.77 16.65q-49.31 16.66-87.92 47.2 39 31.3 89.27 48.73Q425.85-160 480-160Zm0-350q29.85 0 49.92-20.08Q550-550.15 550-580t-20.08-49.92Q509.85-650 480-650t-49.92 20.08Q410-609.85 410-580t20.08 49.92Q450.15-510 480-510Zm0-70Zm0 355Z'/></svg>");

                            //  echo("<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 -960 960 960' width='24px' fill='#181818'><path id='my'  d='M247.85-260.62q51-36.69 108.23-58.03Q413.31-340 480-340t123.92 21.35q57.23 21.34 108.23 58.03 39.62-41 63.73-96.84Q800-413.31 800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 66.69 24.12 122.54 24.11 55.84 63.73 96.84ZM480.02-460q-50.56 0-85.29-34.71Q360-529.42 360-579.98q0-50.56 34.71-85.29Q429.42-700 479.98-700q50.56 0 85.29 34.71Q600-630.58 600-580.02q0 50.56-34.71 85.29Q530.58-460 480.02-460ZM480-120q-75.31 0-141-28.04t-114.31-76.65Q176.08-273.31 148.04-339 120-404.69 120-480t28.04-141q28.04-65.69 76.65-114.31 48.62-48.61 114.31-76.65Q404.69-840 480-840t141 28.04q65.69 28.04 114.31 76.65 48.61 48.62 76.65 114.31Q840-555.31 840-480t-28.04 141q-28.04 65.69-76.65 114.31-48.62 48.61-114.31 76.65Q555.31-120 480-120Zm0-40q55.31 0 108.85-19.35 53.53-19.34 92.53-52.96-39-31.31-90.23-49.5Q539.92-300 480-300q-59.92 0-111.54 17.81-51.61 17.81-89.84 49.88 39 33.62 92.53 52.96Q424.69-160 480-160Zm0-340q33.69 0 56.85-23.15Q560-546.31 560-580t-23.15-56.85Q513.69-660 480-660t-56.85 23.15Q400-613.69 400-580t23.15 56.85Q446.31-500 480-500Zm0-80Zm0 350Z'/></svg>");
                        echo("
                         </a> 
                </div>
            </div>
        </div>
        <div class='line'></div>");
        $getcustomerboard = mysqli_query($con, "SELECT * FROM customerboard WHERE id='$id'");
        $row=mysqli_fetch_assoc($getcustomerboard);
        $num=$row['num'];
        $writer=$row['userid'];
        $class=$row['class'];
        $topic=$row['topic'];
        $content=$row['content'];
        $customerfile=isset($row['customerfile']) ? $row['customerfile'] : '';
        $wdate=$row['wdate'];
        $parentid=isset($row['parentid']) ? $row['parentid'] : '';
        $hit=$row['hit']+1;
     
        
        mysqli_query($con, "UPDATE customerboard SET hit = $hit WHERE id = '$id'");

        if(!empty($parentid)) {
            $parentfile = mysqli_query($con, "SELECT * FROM customerboard WHERE id = '$parentid'");
            $filerow = mysqli_fetch_assoc($parentfile);
            if(!empty($filerow)){
                $customerfile = htmlspecialchars($filerow['customerfile']);
            }
        }
        
        
    
         
    
             echo("
        <div class='middle'>
            <div class='box' style='margin-top:100px;'>
                <div class='menuiconsbox'>");
                    if($userid=='admin') {
                            echo("
                        <a class='menuicon' href='customerreplyPage.php?id=$id'>
                            <svg xmlns='http://www.w3.org/2000/svg' height='20px' viewBox='0 -960 960 960' width='20px' ><path class='icon' d='M240-384h336v-72H240v72Zm0-132h480v-72H240v72Zm0-132h480v-72H240v72ZM87.87-87.87v-701.26q0-34.48 24.26-58.74 24.26-24.26 58.74-24.26h618.26q34.48 0 58.74 24.26 24.26 24.26 24.26 58.74v474.26q0 34.48-24.26 58.74-24.26 24.26-58.74 24.26H231.87l-144 144Zm114-227h587.26v-474.26H170.87v505.5l31-31.24Zm-31 0v-474.26 474.26Z'/></svg>
                        </a>
                        ");
                    }
                    if($writer==$userid ) {
                        echo("
                    <a class='menuicon' href='customermodifyPage.php?id=$id'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='19px' viewBox='0 -960 960 960' width='19px' ><path class='icon' d='M363.35-600.48v-86.22h354.02v86.22H363.35Zm0 126.22v-86.22h354.02v86.22H363.35Zm115.22 311.39h-275.7 275.7Zm0 91h-235.7q-54.58 0-92.79-38.21-38.21-38.21-38.21-92.79v-130.52h120.48v-554.74h616.02v368.65q-22.87-3.43-46.24.43-23.37 3.85-44.76 15.25v-293.33H323.35v463.74h250.76l-91 91H202.87v39.52q0 17 11.5 28.5t28.5 11.5h235.7v91Zm80 0v-129.7L781-423q9.72-9.76 21.59-14.1 11.88-4.33 23.76-4.33 12.95 0 24.8 4.85Q863-431.72 872.7-422l37 37q8.67 9.72 13.55 21.59 4.88 11.88 4.88 23.76 0 12.19-4.36 24.41T909.7-293.3L688.26-71.87H558.57Zm304.78-267.78-37-37 37 37Zm-240 203h38L781.39-257.7l-18-19-19-18-121.04 120.05v38ZM763.39-276.7l-19-18 37 37-18-19Z'/></svg>
                     </a>
                    <a class='menuicon' href='customerdelete.php?id=$id'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='20px' viewBox='0 -960 960 960' width='20px' ><path class='icon' d='M277.37-111.87q-37.78 0-64.39-26.61t-26.61-64.39v-514.5h-45.5v-91H354.5v-45.5h250.52v45.5h214.11v91h-45.5v514.5q0 37.78-26.61 64.39t-64.39 26.61H277.37Zm405.26-605.5H277.37v514.5h405.26v-514.5ZM355.7-280.24h85.5v-360h-85.5v360Zm163.1 0h85.5v-360h-85.5v360ZM277.37-717.37v514.5-514.5Z'/></svg>
                     </a>
                        ");
                    }
                    
                        echo("
                    <a class='menuicon' href='customerPage.php'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='21px' viewBox='0 -960 960 960' width='21px' ><path class='icon' d='M323.79-289.43q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.28-10.5 10.29-10.5 25.5 0 15.22 10.29 25.72 10.29 10.5 25.5 10.5Zm0-154.57q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5Zm0-154.57q15.21 0 25.71-10.28 10.5-10.29 10.5-25.5 0-15.22-10.29-25.72-10.29-10.5-25.5-10.5t-25.71 10.29q-10.5 10.29-10.5 25.5t10.29 25.71q10.29 10.5 25.5 10.5ZM432-289.43h240v-72H432v72ZM432-444h240v-72H432v72Zm0-154.57h240v-72H432v72Zm-213.13 462.7q-34.48 0-58.74-24.26-24.26-24.26-24.26-58.74v-522.26q0-34.48 24.26-58.74 24.26-24.26 58.74-24.26h522.26q34.48 0 58.74 24.26 24.26 24.26 24.26 58.74v522.26q0 34.48-24.26 58.74-24.26 24.26-58.74 24.26H218.87Zm0-83h522.26v-522.26H218.87v522.26Zm0-522.26v522.26-522.26Z'/></svg>
                    </a>
                    
                    ");
                    if($writer=='admin') {
                        $writer='관리자';
                    }
                    echo("    
                </div>
                <div class='infobox'>
                    <div class='info'>
                        <div class='infotext' style='width:30%;'><div style='font-size:15px;'>문의 유형: &nbsp;</div> $class</div>");
                        echo("
                        <div class='infotext'  style='width:30%;'><div style='font-size:15px;'>작성자:&nbsp;</div> $writer</div>");
                        echo("
                        <div class='infotext'  style='width:30%;'><div style='font-size:15px;'>날짜:&nbsp;</div> $wdate</div>
                        <div class='infotext'  style='width:10%; border:0;'><div style='font-size:15px;'>조회수:&nbsp;</div> $hit</div>
                    </div>
                    <div class='infotext to'>
                        <div style='font-size:15px;'>제목:&nbsp;</div> $topic
                    </div>
                </div>
                <div class='contentsbox'>");
                    if($customerfile != '') {
                        if(!empty($parentid)) {
                            $delimiter = "<p>----------&lt;원본글&gt;----------</p>";
                            list($content1, $content2) = explode($delimiter, $content, 2);
                            echo(" 
                          
                            <div class='ql-editor content'>$content1</div>
                            <div>\n- - - - - - - - - - - - - - - - - - - - <원본글> - - - - - - - - - - - - - - - - - - - -\n\n\n\n</div>");
                            $getproductfile=mysqli_query($con, "SELECT customerfile from customerboard WHERE id='$parentid'");

                            while ($file = mysqli_fetch_assoc($getproductfile)) {
                                // detailfile 필드가 여러 파일을 저장한 경우, 콤마로 구분된 파일 이름을 배열로 나눔
                                $customerfiles = explode(',', $file['customerfile']); 
                                
                                foreach ($customerfiles as $customerfile) {
                                    // $detailfile = trim($detailfile); // 공백 제거 (필요시)
                                    echo("
                                    <div class='photobox'>
                                        <div class='photo'>
                                            <a href='#' onclick=\"window.open('./customerfiles/$customerfile','_new')\">
                                                <img class='photo' src='./customerfiles/$customerfile' alt='Product Image'>
                                            </a>
                                        </div>
                                    </div>
                                    ");
                                }
                            }
                            echo("
                            <div class='ql-editor content'> $content2</div>
        
                            ");
                        } else {
                            echo(" 
                            ");
                            $getproductfile=mysqli_query($con, "SELECT customerfile from customerboard WHERE id='$id'");

                            while ($file = mysqli_fetch_assoc($getproductfile)) {
                                // detailfile 필드가 여러 파일을 저장한 경우, 콤마로 구분된 파일 이름을 배열로 나눔
                                $customerfiles = explode(',', $file['customerfile']); 
                                
                                foreach ($customerfiles as $customerfile) {
                                    // $detailfile = trim($detailfile); // 공백 제거 (필요시)
                                    echo("
                                    <div class='photobox'>
                                        <div class='photo'>
                                            <a href='#' onclick=\"window.open('./customerfiles/$customerfile','_new')\">
                                                <img class='photo' src='./customerfiles/$customerfile' alt='Product Image'>
                                            </a>
                                        </div>
                                    </div>
                                    ");
                                }
                            }
                            echo("
                            <div class='ql-editor content'>$content</div>
        
                            ");
                        }
                    } else {
                            echo(" 
                            <div class='ql-editor content'>$content</div>");
                    }
                    echo("    
                </div>
            </div>");
            $beforeQuery = "SELECT * FROM customerboard WHERE num < $num AND class='$class' ORDER BY num DESC LIMIT 1";
            $beforeResult = mysqli_query($con, $beforeQuery);
            $beforeRow = mysqli_fetch_assoc($beforeResult);

            

            $afterQuery = "SELECT * FROM customerboard WHERE num > $num AND class='$class' ORDER BY num ASC LIMIT 1";
            $afterResult = mysqli_query($con, $afterQuery);
            $afterRow = mysqli_fetch_assoc($afterResult);
            
            echo("
            <div class='pagechangebox'>");

                // 이전 게시글 출력
                if ($beforeRow) {
                    $bwriter=$beforeRow['userid'];
                    if($bwriter=='admin') {
                        $bwriter='관리자';
                    }
                    if($beforeRow['issecret']=='n') {
                        echo "
                    <div class='tonext'>
                        <div style=' width:90px; padding-left:10px;' ><a class='atext h' >이전 게시글: </a></div>
                        <div style=' width:130px'><a class='atext' href='customerboarddetailPage.php?id={$beforeRow['id']}'>{$beforeRow['topic']}</a></div>
                        <div style=' width:100px'><a class='atext h' >{$bwriter}</a></div>
                        <div style=' width:130px'><a class='atext h' >{$beforeRow['wdate']}</a></div>
                        <div style=' width:40px'><a class='atext h' >{$beforeRow['hit']}</a></div>
                    </div>
                    <div class='line2'></div>";
                    }
                    
                }

                // 다음 게시글 출력
                if ($afterRow) {
                    $awriter=$afterRow['userid'];
                    if($awriter=='admin') {
                        $awriter='관리자';
                    }
                    if($afterRow['issecret']=='n') {
                        echo "
                        <div class='tonext'>
                            <div style=' width:90px; padding-left:10px; '><a class='atext h' >다음 게시글: </a></div>
                            <div style=' width:130px'><a class='atext' href='customerboarddetailPage.php?id={$afterRow['id']}'>{$afterRow['topic']}</a></div>
                            <div style=' width:100px'><a class='atext h' >$awriter</a></div>
                            <div style=' width:130px'><a class='atext h' >{$afterRow['wdate']}</a></div>
                            <div style=' width:40px'><a class='atext h' >{$afterRow['hit']}</a></div>
                        </div>";
                    }

                   
                }


                echo("
            </div>
        </div>
        <div class='bottom' id='bottom' >");
?>
<?
  include('bottom.php');
?>
<?
    echo("
  </div>
        
    </div>
<body>    
");
?>