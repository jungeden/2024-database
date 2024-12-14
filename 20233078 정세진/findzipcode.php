<?php
$page=$_GET['page'];
$con = mysqli_connect("localhost", "root", "0000", "shop");

$con->set_charset("utf8");

$key = isset($_POST['key']) ? $con->real_escape_string($_POST['key']) : '';
$getaddress = mysqli_query($con,"SELECT * FROM zipcode WHERE dong LIKE '%$key%'");
echo("
<head>
    <style>
        @import url(shop.css);
        @import url(findzipcode.css);
       @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
        
    </style>
</head>
<body>
    <div class='container'>
    <div class='middle zipcodeaddress'>
        <div class='textkey'>
      
            <a class='text'><b>$key</b> 우편번호를 선택하세요.</a>
         </div><div class='list'>");
        if ($getaddress && $getaddress->num_rows > 0) {
            while ($row = $getaddress->fetch_assoc()) {
                $zip = $row["zipcode"];
                $sido = $row["sido"];
                $gugun = $row["gugun"];
                $dong = $row["dong"];
                $address = $sido . " " . $gugun . " " . $dong;
        
                echo "<div class='addresslist'><a class='ztext zipcodetext' href=\"javascript:okzip('$zip', '$address')\">$zip</a>";
                echo "<a class='ztext text2'>$address</a></div>";
            }
        } else {
            echo "<div class='addresslist'><a>검색 결과가 없습니다.</a></div>";
        }
        


     echo("  </div>
    </div>
    </div>
</body>



");



// echo "<table border=1 align=center width=420 height=130 cellpadding=3 cellspacing=0>";





echo "<script>

function okzip(zip, addr) {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page'); 

    if (opener && page === 'join' && opener.document.joinform) {
        opener.document.joinform.zipcode.value = zip;
        opener.document.joinform.address1.value = addr;
        opener.document.joinform.address2.value = '';
        opener.document.joinform.address2.focus();
        self.close();
    } else if (opener && page === 'modify' && opener.document.modifyform) {
        opener.document.modifyform.zipcode.value = zip;
        opener.document.modifyform.address1.value = addr;
        opener.document.modifyform.address2.value = '';
        opener.document.modifyform.address2.focus();
        self.close();
    } else if (opener && page === 'buy' && opener.document.buyform){
        opener.document.buyform.zipcode.value = zip;
        opener.document.buyform.address1.value = addr;
        opener.document.buyform.address2.value = '';
        opener.document.buyform.address2.focus();
        self.close(); 
    } else {
        alert('부모 창을 찾을 수 없거나 올바른 폼이 없습니다.');
    }
}

</script>";

// MySQL 연결 종료
mysqli_close($con);
?>
