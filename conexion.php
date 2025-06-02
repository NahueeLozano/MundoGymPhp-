<?php
    
    $host = 'localhost'; // Cambia esto si tu servidor de base de datos está en otro host
    $usuario = 'root'; //
    $bd ='gymf';
    $contraseña = '';
    //obtenemos la conexion mediante de la clase mysqli
$conexion = new mysqli($host, $usuario, $contraseña, $bd);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} 


?>