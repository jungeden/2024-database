<?
// $board = isset($_GET['board']) ? $_GET['board'] : ''; 
echo("
<?php
// PHP 코드 블록 (필요한 경우 여기에 서버 측 로직을 추가할 수 있습니다)
?>

<table border='0' width='600'>
    <tr>
        <td align='center' colspan='2'><h1>자료실</h1></td>
    </tr>
    <form method='post' action='pds-process.php?board=<?php echo updown; ?>' enctype='multipart/form-data'>
        <tr>
            <td align='right'><font size='2'>등록자</font></td>
            <td><input type='text' name='writer' size='15'></td>
        </tr>
        <tr>
            <td align='right'><font size='2'>제목</font></td>
            <td><input type='text' name='title' size='60' maxlength='100'></td>
        </tr>
        <tr>
            <td align='right'><font size='2'>첨부 파일</font></td>
            <td><input type='file' name='userfile' size='45' maxlength='80'></td>
        </tr>
        <tr>
            <td align='right'><font size='2'>비밀번호</font></td>
            <td><input type='password' name='passwd' size='15'></td>
        </tr>
        <tr align='center'>
            <td colspan='2'>
                <input type='submit' value='등록'>
                <input type='reset' value='초기화'>
            </td>
        </tr>
    </form>
</table>


");

?>