<?php
$mode = $_GET['mode'];  
$board = $_GET['board']; 
$id = $_GET['id']; 
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Gowun+Batang&display=swap');
    </style>
    <form method='post' action='pass2.php?board=$board&id=$id&mode=$mode'>
        <table border='0' width='400' align='center'>
            <tr>
                <td align='center'>암호를 입력하세요</td>
            </tr>       
            <tr>
                <td align='center'>암호:</td>
            </tr>
            <tr>
                <td align='center'>
                    <input type='password' name='pass' required>
                </td>
            </tr>
            <tr>
                <td align='center'>
                    <input type='submit' value='입력'>
                </td>
            </tr>
        </table>
    </form>
");
?>
