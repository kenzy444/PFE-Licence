<?php 
session_start();

session_unset();

session_destroy();

header("Location: ../LOGIN_FORM/main.php");


?>
