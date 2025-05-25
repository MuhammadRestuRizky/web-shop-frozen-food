<?php
session_start();
  
session_destroy();
 
header("Location: ./kasir/login/login-kasir.php");
exit;
?>
