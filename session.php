<?php 

session_start();
session_destroy(); //destruye la session
$_SESSION = array(); // Vaciar la variable $_SESSION

// Redirigir al login
header("Location: /ZONAGYMPHP/login.php");
exit(); 
?>