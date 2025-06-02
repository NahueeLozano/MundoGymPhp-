<?php 
include_once 'conexion.php';

session_start();
//verifica si el formulario fue enviado por el post
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // comprueba si la variable ha sido definida 
    if(isset($_POST['nombreUsuario']) && isset($_POST['contraseña'])){

       //guarda los datos del formulario en variables
       $nombreUsuario = $_POST['nombreUsuario'];
       $contraseña= $_POST['contraseña'];

        // Consulta para verificar si el usuario existe en la base de datos
        $query = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario' AND contraseña = '$contraseña'";
        $resultado = mysqli_query($conexion, $query);
        // Verifica si se encontró algún resultado
       if(mysqli_num_rows($resultado) > 0){
            // Obtiene los datos del usuario
            $usuario = mysqli_fetch_assoc($resultado);

            // Guarda los datos del usuario en la sesión
            $_SESSION['idUsuario'] = $usuario['idUsuario'];

            // Redirige al usuario a la página de inicio
            header('Location: inicio.php');
            exit;
        } else {
            // Muestra un mensaje de error si las credenciales son incorrectas
            echo "Usuario o contraseña incorrectos";
        }
    }
    

     $conexion->close(); //cierra la conexion 
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ZonaGym</title>
    <!-- Incluye  Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <!-- Formulario de inicio de sesión con Bootstrap -->
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="nombreUsuario" required 
                                       placeholder="Ingresa tu nombre de usuario">
                            </div>
                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="contraseña" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>