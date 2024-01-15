<?php
session_start();

if(isset($_SESSION['UID'])){
  unset($_SESSION['UID']);
  unset($_SESSION['UNAME']);
}
header("Location:/attention_renewal/user/login.php");
die();
?>