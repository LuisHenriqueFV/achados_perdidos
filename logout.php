<?php 
  session_start();
  session_destroy();  
  unset($_SESSION["logged"]);
  unset($_SESSION["codpessoa"]);
  header("Location:index.php");   
?>