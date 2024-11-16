<? //logoutPage.php

setcookie('userid', '', time() - 3600, "/"); 

echo ("<meta http-equiv='Refresh' content='0; url=startPage.php'>");

?>