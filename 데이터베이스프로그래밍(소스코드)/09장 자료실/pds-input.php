<?

echo("
   <table border=0 width=600>
   <tr><td align=center   colspan=2><h1>�ڷ��</h1></td></tr>
   <form method=post action=pds-process.php?board=$board enctype='multipart/form-data'>
   <tr>
   <td align=right><font size=2>�����</font></td>
   <td><input type=text name=writer size=15></td>
   </tr>
   <tr>
   <td align=right><font size=2>Ÿ��Ʋ</font></td>
   <td><input type=text name=title size=60 maxsize=100></td>
   </tr>
   <tr>
   <td align=right><font size=2>÷��ȭ��</font></td>
   <td><input type=file name='userfile' size=45 maxlength=80></td>
   </tr>
   <tr>
   <td align=right><font size=2>�� ȣ</font></td>
   <td><input type=password name=passwd size=15></td>
   </tr>
   <tr align=center>
   <td colspan=2><input type=submit value=���>
   <input type=reset value=�����></td>
   </tr>
   </table>
   </form>
");

?>
