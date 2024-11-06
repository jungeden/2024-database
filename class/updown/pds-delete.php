<?
$id = $_GET['id'];

echo("
<form method='post' action='pds-delete2.php?board=" . htmlspecialchars('updown') . "&id=" . htmlspecialchars($id) . "'>
    <table border='0' width='400' align='center'>
        <tr>
            <td align='center'>비밀번호를 입력하세요</td>
        </tr>
        <tr>
            <td align='center'>
                비밀번호: <input type='password' size='15' name='pass'>
                <input type='submit' value='입력'>
            </td>
        </tr>
    </table>
</form>
");








?>