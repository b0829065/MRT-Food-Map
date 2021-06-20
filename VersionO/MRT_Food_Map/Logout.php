<?php
session_start();
/*刪除session*/
setcookie("LoginState", '', time()-3600);
setcookie("UserName", '', time()-3600);

header('location:index.php');

?>
