<?php
session_start();
  
session_destroy();
 
header("Location: ./pembeli/login/login_pembeli.php");
exit;
?>
