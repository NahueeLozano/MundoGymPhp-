<?php
session_start();
// CONEXIÓN A LA BASE DE DATOS
include 'conexion.php';
//  Si no hay usuario logueado, redirige a login
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Actividades</title>
    <!-- Incluir el framework Bootstrap para estilos -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        body {
            background-color: #e0f7fa; /* Color de fondo claro */
        }
        .navbar, .btn-primary {
            background-color: #0288d1 !important; /* Color azul para la barra de navegación y botones */
        }
        .dropdown-menu {
            background-color: #0288d1; /* Color azul para el menú desplegable */
        }
        .dropdown-item {
            color: white !important; /* Texto blanco para los elementos del menú */
        }
        .table thead {
            background-color: #0288d1; /* Encabezado de tabla en azul */
            color: white; /* Texto blanco */
        }
        .card {
            border-radius: 10px; /* Bordes redondeados para las tarjetas */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); /* Sombra para las tarjetas */
            padding: 20px; /* Espaciado interno */
            margin-bottom: 20px; /* Espaciado inferior */
        }
    </style>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand text-white" href="#">Mi Gimnasio</a> <!-- Título de la barra de navegación -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span> <!-- Icono para dispositivos móviles -->
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Enlaces de navegación -->
                <li class="nav-item"><a class="nav-link text-white" href="inicio.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="membresia.php">Membresía</a></li>
                <li class="nav-item">
                    <!-- Botón para cerrar sesión -->
                    <form action="session.php" method="post">
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">

        <h2 class="text-center">Actividades Disponibles</h2> <!-- Título principal -->
    <div class="row">
        <!-- Tarjeta para Yoga Mañana -->
        <div class="col-md-4">
            <div class="card">
                <img src="sport-lifestyle-fitness-male-training.jpg" class="card-img-top" alt="Yoga Mañana"> <!-- Imagen de la actividad -->
                <div class="card-body">
                    <h5 class="card-title">Yoga Mañana</h5>
                    <p class="card-text">Día: Lunes<br>Hora: 08:00 AM</p>
                    
                </div>
            </div>
        </div>

        <!-- Tarjeta para CrossFit HIIT -->
        <div class="col-md-4">
            <div class="card">
                <img src="close-up-man-doing-crossfit-workout.jpg" class="card-img-top" alt="CrossFit HIIT">
                <div class="card-body">
                    <h5 class="card-title">CrossFit HIIT</h5>
                    <p class="card-text">Día: lunas a viernes<br>Hora: 10:00 AM a 11:00 AM y 16:30pm a 17:30pm</p>
                    
                </div>
            </div>
        </div>

        <!-- Tarjeta para Musculación Básica -->
        <div class="col-md-4">
            <div class="card">
                <img src="gym.png" class="card-img-top" alt="Musculación Básica">
                <div class="card-body">
                    <h5 class="card-title">Musculación </h5>
                    <p class="card-text">Día: lunes a sabado<br>Hora:08:00 AM a 22:30 PM</p>
                   
                </div>
            </div>
        </div>
    </div>
</div>


 <footer class="footer mt-auto py-3" style="background:#343a40; color:#fff; text-align:center; position:fixed; left:0; bottom:0; width:100%; z-index:100;">
       Mundo Gym. 
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</body>
</html>