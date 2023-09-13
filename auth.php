<?php
// Inicia la sesión
require 'conexion/conexion.php';

// Verifica si el formulario de inicio de sesión se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $conn = conectar2();
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verifica si la conexión a la base de datos fue exitosa
    if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
    }


// Consultar la base de datos para encontrar al usuario
$query = "SELECT * FROM integrantes_berthier,ramas WHERE usuario = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);
// Si el usuario existe, establecer la sesión
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $rol = $user['rama_id'];
    if($rol == '5'){
        $_SESSION['username'] = $user['usuario'];
        $_SESSION['id'] = $user['id'];   
        header('Location: admin/admin.php');
    }else{
        $_SESSION['username'] = $user['usuario'];
        $_SESSION['id'] = $user['id'];
        header('Location: usuario/inicio.php');
    }
} else {
    // El usuario no existe
    $_SESSION["error_message"] = "El usuario o la contraseña no son correctos.";
    header('Location: login.php');
}
}
// Cerrar la conexión a la base de datos
mysqli_close($conn);

?>
