<?
echo("
<head>
    <style>
        @import url(shop.css);
        @import url(findzipcode.css);
        @import url('https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Gowun+Batang:wght@400;700&display=swap');
        
    </style>
</head>
<body>
    <div class='container'>
    <div class='middle'>
        <div class='text'>
            <a class='text'>주소를 입력해주세요.</a>
        </div>
        <form method='post' action='findreceiverzipcode.php'>
            <div class='inputid'>
                <input class='input id' type='text' name='key' placeholder='주소 입력'>
                <input class='button check'  type='submit' value='검색'>
            </div>
        </form>
    </div>
    </div>
</body>



");

?>