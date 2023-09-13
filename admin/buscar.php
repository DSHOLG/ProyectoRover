<?php
include("../utils/checkLogin.php");

include "../conexion/conexion.php";

// Crear conexión
$conn = conectar2();

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el término de búsqueda desde la solicitud AJAX
$searchTerm = $_GET['query'];

// Consulta SQL para buscar usuarios por nombre o apellido (ajusta según tu esquema)
$sql = "SELECT * FROM integrantes_berthier WHERE nombre LIKE '%$searchTerm%' OR apellido LIKE '%$searchTerm%'";
$result = $conn->query($sql);
// Mostrar resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if($row['rama_id']=='5'){
            echo "";
        }else{
        echo "<p><a href='persona2.php?id=" . $row['id'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</a></p>";
        }
    }
} else {
    echo "<p>No se encontraron resultados.</p>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

