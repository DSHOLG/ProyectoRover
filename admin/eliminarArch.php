<?php

// Conecta a la base de datos
include "../conexion/conexion.php";
$conexion = conectar2();

// Obtiene el nombre de la imagen o video
$id_foto = $_GET['id_foto'];
$id_rama=$_GET['id_rama'];
// Obtiene la ruta de la imagen o video
$sql = "SELECT ruta, ruta_video FROM fotos WHERE id_foto = '$id_foto'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ruta_imagen = $row['ruta'];
    $ruta_video = $row['ruta_video'];

}

// Verifica si el elemento es una imagen
if ($ruta_imagen != "") {

    // Elimina la imagen de la carpeta
    unlink($ruta_imagen);

} else if ($ruta_video != "") {

    // Elimina el video de la carpeta
    unlink($ruta_video);

}

// Elimina la imagen o video de la base de datos
$sql = "DELETE FROM fotos WHERE id_foto = '$id_foto'";
mysqli_query($conexion, $sql);

// Cierra la conexión a la base de datos
mysqli_close($conexion);

// Redirecciona al usuario a la página principal
header('Location: verfotos2.php?id_rama='.$id_rama);

?>
