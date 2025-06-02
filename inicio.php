<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$idUsuario = $_SESSION['idUsuario'];

// Obtener el nombre del usuario
$nombreUsuario = '';
$res = mysqli_query($conexion, "SELECT nombreUsuario FROM usuarios WHERE idUsuario = '$idUsuario'");
//toma el primera fila y lo conviere en un array asociativo
if ($row = mysqli_fetch_assoc($res)) {
    $nombreUsuario = $row['nombreUsuario'];
}

//ejecuta la consulta anterior y hace ootra consulta
$res = mysqli_query($conexion, "SELECT fecha_fin FROM Membresias WHERE idUsuario = '$idUsuario' AND estado = 'activo'" );
$fecha_fin = ($row = mysqli_fetch_assoc($res)) ? $row['fecha_fin'] : null;

mysqli_close($conexion)
?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- RESPONSIVO: Permite que el sitio se adapte a móviles y tablets -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Mi Gimnasio</title>
    <!-- Enlace a la librería de Bootstrap para estilos -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
        
    </style>
</head>
<body>
    <!-- menu -->

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand text-white" href="#">Mi Gimnasio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="#">Inicio</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="menuOpciones" data-toggle="dropdown">Opciones</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="actividades.php">Actividades</a>
                        <a class="dropdown-item" href="membresia.php">Membresía</a>
                      
                        
                    </div>
                </li>
                <li class="nav-item">
                    <form action="session.php" method="post">
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- mensaje de bienvenida sencillo debajo de la barra -->
    <div class="container mt-3">
        <div style="background:#fff9c4; color:#111; font-weight:bold; text-align:center; border-radius:8px; padding:10px;">
            Bienvenido: ID <?php echo $idUsuario; ?> - <?php echo htmlspecialchars($nombreUsuario); ?>
        </div>
    </div>

    <BR></BR>
    <div class="container"><!-- contenedor de boostrap RESPONSIVO: el grid de Bootstrap hace que el contenido se adapte a cualquier pantalla -->


    </div>
        <div class="row">
            <div class="col-md-6"><!-- columna de boostrap -->

               <div class="card text-center">
    <h2>Membresía</h2>
    <p class="text-success font-weight-bold">
        Activa hasta <?php echo date("d/m/Y", strtotime($fecha_fin)); ?>
    </p>
</div>

                <div class="card text-center">
                    <h2>Membresia</h2>
                    <a href="membresia.php" class="btn btn-primary">Ir a Mis Membresia</a>
                </div>
            </div>
        
            <div class="col-md-6">
                <div class="card text-center">
                    <h2>Mis Actividades</h2>
                    <a href="actividades.php" class="btn btn-primary">Ir a Mis Actividades</a>
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