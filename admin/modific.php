<?php
include "../utils/checkLogin.php";
include "../conexion/conexion.php";

$conn = conectar2();

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda desde la solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $nombre_i = $_GET['nombre_i'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $rama = $_POST['rama'];
    $insignia = $_POST['insignias'];
    $totem = $_POST['totem'];

    $sql = "SELECT * FROM insignias WHERE id_insignia = '$insignia'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        echo "La insignia no existe.";
    } else {
    $sql = "UPDATE integrantes_berthier SET nombre='$nombre' , apellido='$apellido' , rama_id='$rama' , totem='$totem', insignia_id = '$insignia'
     WHERE id = '$id'";
     if ($conn->query($sql) === TRUE) {
        $_SESSION['insertado'] = "Datos modificados correctamente!";
        header('Location: modificar.php?id='.$id.'&id_rama='.$rama.'&id_insignia='.$insignia.'&nombre_i='.$result->fetch_assoc()['nombre_i']);
      } else {
        echo "Error al insertar datos ". $conn->error;
      }
  }
}
$conn->close();
?>
