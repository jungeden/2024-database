
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>구매 리스트</title>
    <link rel="stylesheet" href="test.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap" rel="stylesheet">
    <style>
         @import url(test.css);
         .input-div {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .input-display {
            display: inline; /* 기본적으로 입력 값이 보임 */
            color:gray;
            font-size: 14px;
        }

        .input-div input {
            display: inline; /* 기본적으로 숨김 */
            width: 100px; /* 입력 필드의 너비 설정 */
            color:gray;
            background-color: rgb(209, 209, 209);
        }
    </style>
</head>
<body>
    <div class="container">
    <h1 >구매 리스트</h1>
    <form method="post" action="process.php">
        Name:
            <div class="input-div" onclick="this.querySelector('input').focus();">
                <span class="input-display"> </span>
                <input type="text" name="iname" size="10" onblur="this.style.display='inline'; this.previousElementSibling.style.display='inline';">
            </div>
            <br>
        Price: 
            <div class="input-div" onclick="this.querySelector('input').focus();">
                <span class="input-display"> </span>
                <input type="text" name="iprice" size="10" onblur="this.style.display='inline'; this.previousElementSibling.style.display='inline';">
            </div>
            <br>
        <input type="hidden" name="action" value="add">
        <div class="button" onclick="this.closest('form').submit();">추가</div>
        
    </form>

    </div>   
 </style>
    
    <script>
       document.querySelectorAll('.input-div').forEach(function(inputDiv) {
            inputDiv.addEventListener('click', function() {
                let input = this.querySelector('input');
                let display = this.querySelector('.input-display');
                
                input.style.display = 'inline'; // 클릭 시 입력 박스를 보임
                // input.focus(); // 입력 박스에 포커스
                // display.style.display = 'none'; // 기존 텍스트 숨김

                // input.addEventListener('blur', function() {
                //     input.style.display = 'none'; // 입력 박스 숨김
                //     display.style.display = 'inline'; // 텍스트 보임
                // });
            });
        });
    </script>
</body>
</html>
