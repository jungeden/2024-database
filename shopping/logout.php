<? //logoutPage.php

setcookie('userid', '', time() - 3600, "/");
setcookie('session_id', '', time() - 3600, "/");
session_unset();
session_destroy();
echo ("<meta http-equiv='Refresh' content='0; url=startPage.php'>");

?>