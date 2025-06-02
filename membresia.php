<?php
// INICIO DE SESIÓN Y CONEXIÓN
session_start();
include_once("conexion.php");

// Si no hay usuario logueado, redirige a login
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}
$idUsuario = $_SESSION['idUsuario']; // ID del usuario actual

//  Trae todos los planes de membresía
$query = "SELECT * FROM PlanesMembresia";
$resultado = mysqli_query($conexion, $query);

// Busca si el usuario tiene membresía activa
$queryMembresia = "SELECT fecha_fin FROM Membresias WHERE idUsuario = $idUsuario AND estado = 'activo' LIMIT 1";
$resultadoMembresia = mysqli_query($conexion, $queryMembresia);

$fecha_fin = null;

if ($resultadoMembresia) {
    //toma un resultado de una fila y la convierte en un array asociativo
    $row = mysqli_fetch_assoc($resultadoMembresia);
    $fecha_fin = $row['fecha_fin']; // Fecha de vencimiento
}

?>




<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <!-- RESPONSIVO Permite que el sitio se adapte a móviles y tablets content -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes de Membresía</title>
    <!-- Enlace a la librería de Bootstrap para estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
 
    body {
        background-color: #e0f7fa;
    }
    .navbar, .btn-primary {
        background-color: #0288d1 !important;
    }
    .dropdown-menu {
        background-color: #0288d1;
    }
    .dropdown-item {
        color: white !important;
    }
    .table thead {
        background-color: #0288d1;
        color: white;
    }
    .card {
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

        footer {
            margin-top: 40px;
            padding: 20px;
            background-color: #343a40;
            color: white;
            text-align: center;
        }
</style>
<body>
<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand text-white" href="#">Mi Gimnasio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
           
            <li class="nav-item"><a class="nav-link text-white" href="inicio.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="actividades.php">actividades</a></li>
            
            <li class="nav-item">
                <!-- Botón para cerrar sesión -->
                <form action="session.php" method="post">
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<?php

// Consulta para obtener los planes de membresía
$queryPlanes = "SELECT nombre, descripcion, precio FROM PlanesMembresia";
$resultado =  mysqli_query($conexion, $queryPlanes);

// Verificamos si hay resultados en la consulta
if ($resultado && $resultado->num_rows > 0) {
    echo '<div class="container mt-4">';
    echo '<h2 class="text-center">Planes de Membresía</h2>';
    echo '<div class="row">';

    // Iteramos sobre los resultados y mostramos cada plan
    while ($plan = $resultado->fetch_assoc()) {
        echo '<div class="col-md-4">';
        echo '<div class="card mb-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($plan['nombre']) . '</h5>';
        echo '<p class="card-text">';
        echo 'Descripción: ' . htmlspecialchars($plan['descripcion']) . '<br>';
        echo 'Precio: $' . number_format($plan['precio'], 2) . '<br>';
   
        echo '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '</div>';
} else {
    // Mensaje si no hay planes disponibles
    echo '<p class="text-center">No hay planes de membresía disponibles en este momento.</p>';
}

if ($fecha_fin) { // Solo mostrar si hay una membresía activa
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-warning text-center" role="alert"style="background-color:rgb(248, 209, 100); color: #000; font-size: 1.5rem; font-weight: bold; padding: 20px;">';
    echo 'Tienes una membresía activa hasta el día <strong>' . date("d/m/Y", strtotime($fecha_fin)) . '</strong>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<div class="container mt-4">';
    echo '<div class="alert alert-danger text-center" role="alert" style="font-size: 1.5rem; font-weight: bold;">';
    echo 'No tienes una membresía activa en este momento.';
    echo '</div>';
    echo '</div>';
}
?>



<!--  historial de pagos -->
<h2 class="text-center mt-5">Historial de Pagos</h2>
<table class="table table-bordered mt-4">
    <thead>
        <tr>
            
            <th>Monto</th>
            <th>Fecha de Pago</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Consulta para obtener el historial de pagos
        $queryPagos = "SELECT monto, fecha_pago, estado FROM pagos WHERE idUsuario = $idUsuario;";



        // Ejecutamos la consulta
        $resultado = mysqli_query($conexion, $queryPagos);

        // Verificamos si hubo un error en la consulta
        if (!$resultado) {
            die("Error en la consulta: " . $conexion->error);
        }

        // Iteramos sobre los resultados y los mostramos en la tabla
        while ($pago = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . number_format($pago['monto'], 2) . "</td>";
            echo "<td>{$pago['fecha_pago']}</td>";
            echo "<td>{$pago['estado']}</td>";
            echo "</tr>";
        }
        ?>
        
    </tbody>
</table>
</div>
        <!-- Sección de Contacto API -->
        <div class="container mt-4" style="max-width: 400px;">
    <h2 class="text-center">Contáctanos</h2>
    <!-- link de api-->
    <form action="https://formspree.io/f/xjkwdleb" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Tu nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Tu correo electrónico" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control form-control-sm" id="mensaje" name="mensaje" rows="3" placeholder="Tu mensaje" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </form>
</div>

<br>
<br>
<br>
 <footer class="footer mt-auto py-3" style="background:#343a40; color:#fff; text-align:center; position:fixed; left:0; bottom:0; width:100%; z-index:100;">
       Mundo Gym. 
    </footer>
</body>
</html>
