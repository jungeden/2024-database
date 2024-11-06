<?php
    $num = 1234567890;
    $n = strlen((string)$num); // 숫자를 문자열로 변환 후 길이 측정

    $i = 0;
    while ($i < $n) :
        $a = substr($num, $i, 1); //0부터 1씩 자르기

        switch($a) {
            case 1:
                echo '<img src="1.png" width="35">';
                break;
            case 2:
                echo '<img src="2.png" width="50">';
                break;
            case 3:
                echo '<img src="3.png" width="50">';
                break;
            case 4:
                echo '<img src="4.png" width="50">';
                break;
            case 5:
                echo '<img src="5.png" width="50">';
                break;
            case 6:
                echo '<img src="6.png" width="50">';
                break;
            case 7:
                echo '<img src="7.png" width="50">';
                break;
            case 8:
                echo '<img src="8.png" width="50">';
                break;
            case 9:
                echo '<img src="9.png" width="50">';
                break;
            case 0:
                echo '<img src="0.png" width="50">';
                break;
        }
        
        
        // echo $a;
        // echo "<br>";
        $i++;
    endwhile;
    // echo $n;


?>
