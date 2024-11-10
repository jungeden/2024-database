<?

echo("
   <table border=0 width=600>
   <tr><td align=center   colspan=2><h1>ÀÚ·á½Ç</h1></td></tr>
   <form method=post action=pds-process.php?board=$board enctype='multipart/form-data'>
   <tr>
   <td align=right><font size=2>µî·ÏÀÚ</font></td>
   <td><input type=text name=writer size=15></td>
   </tr>
   <tr>
   <td align=right><font size=2>Å¸ÀÌÆ²</font></td>
   <td><input type=text name=title size=60 maxsize=100></td>
   </tr>
   <tr>
   <td align=right><font size=2>Ã·ºÎÈ­ÀÏ</font></td>
   <td><input type=file name='userfile' size=45 maxlength=80></td>
   </tr>
   <tr>
   <td align=right><font size=2>¾Ï È£</font></td>
   <td><input type=password name=passwd size=15></td>
   </tr>
   <tr align=center>
   <td colspan=2><input type=submit value=µî·Ï>
   <input type=reset value=Áö¿ì±â></td>
   </tr>
   </table>
   </form>
");

?>