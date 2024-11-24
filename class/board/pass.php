<? //pass.php
$mode = $_GET['mode'];  
$board = $_GET['board']; 
$id = $_GET['id']; 
echo("
<link rel='stylesheet' href='style.css'>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Do+Hyeon&family=Gasoek+One&family=Gowun+Batang&display=swap');
    </style>
    <div class='container pass'>
    <div>
    <form method='post' action='pass2.php?board=$board&id=$id&mode=$mode'>
        <table border='0' width='400' align='center'>
            <tr>
                <td align='center'>암호를 입력하세요</td>
            </tr>       
           
            <tr>
                <td align='center'>
                    <input class='input input1' type='password' name='pass' required placeholder='암호 입력'>
                </td>
            </tr>
            <tr>
                <td align='center'>
                    <input class='button button1' type='submit' value='입력'>
                </td>
            </tr>
        </table>
    </form>
    </div>
    </div>
");
?>
