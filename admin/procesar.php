<?php
include("../utils/checkLogin.php");
?>

<?php
include "../conexion/conexion.php";
$conexion = conectar2();
$usuarios_seleccionados = $_POST['usuarios_seleccionados'];
$historia = $_POST['hist'];
$lugar = $_POST['lug'];
$year = $_POST['year'];

// Insertar los datos en la base de datos
foreach ($usuarios_seleccionados as $usuario_seleccionado){
$query = "INSERT INTO historial (campamento, lugar, anio, id_joven) VALUES ('$historia', '$lugar', $year, '$usuario_seleccionado')";
$result = $conexion->query($query);
}

if ($result) {
  $_SESSION['insertado'] = "Datos Ingresados correctamente!";
  header('Location: historiales.php');
} else {
  echo "Error al insertar datos";
}

mysqli_close($conexion);
?>
