<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Grupo Scout J.B.Berthier</title>
</head>
<body>
    
   <div class="login-container">
   <h2>Bienvenido/a!</h2>
        <h1>Inicio de Sesión</h1>
        <form action="auth.php" method="POST">
            <input type="text" name="username" placeholder="Nombre de Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

<?php
//MENSAJE DE ERROR AL INICIAR SESION
require 'conexion/conexion.php';
if (isset($_SESSION["error_message"])) {
    echo '<h2 style="color:red;font-size:11pt;text-align:center;">' . $_SESSION["error_message"] . '</h2>';
    unset($_SESSION["error_message"]);
}
?>
</div>

<div class="image-container" id="image-container"> 
        <img src="img/scoutarg.png" alt="Imagen 1">
        <img src="img/manada.png" alt="Imagen 2">
        <img src="img/unidad.png"alt="Imagen 3">
        <img src="img/caminante.png" alt="Imagen 4">
        <img src="img/rover.png" alt="Imagen 5">
        <img src="img/flor.png" alt="Imagen 6">
        <img src="img/berthier.png" alt="Imagen 7">
</div>
<script src="js/script.js"></script>
</body>
</html>