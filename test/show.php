<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>구매리스트</title>
    <link rel="stylesheet" href="test.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Batang:wght@400;700&display=swap" rel="stylesheet">
    <style>
         @import url(test.css);
        
    </style>
</head>
<body>
    <div class="container">
    <h1>구매 리스트</h1>
    <form method="post" action="process.php">
        
    </form>
    <?
    $con = mysqli_connect("localhost", "root", "024120", "class");


    $sql = "SELECT * from buy";
    $result = mysqli_query($con,$sql);
    $total = mysqli_num_rows($result);

    echo ("
    <table border=1 width=500 align=center style='border-collapse:collapse;'>
    <tr>
    <td width = 100 align=center>이름</td>
    <td width = 150 align=center>가격</td>
    </tr>
    ");

    while ($row = mysqli_fetch_assoc($result)) {
        $oname = $row['name'];
        $oprice = $row['price'];
        echo ("
        <tr>
        <td align=center>$oname</td>  
        <td align=center>$oprice</td>  
        <td align=center>O/<a href=delete.php?dname=$oname>X</a></td>
        </tr><br>
        ");
    }
    echo "</table>";
  
    
    mysqli_close($con);
   
    ?>
    <div class="button" onclick="location.href='input.php'">추가</div>
</body>
</html>