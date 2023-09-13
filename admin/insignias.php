<?php
include "../conexion/conexion.php";
$conexion = conectar2();

$query = "SELECT * FROM insignias";
$resultado = mysqli_query($conexion, $query);

echo '<select name="insignias" id="insignias">';
  while($fila = mysqli_fetch_array($resultado)){
      if($fila['id_rama']==$_GET['id_rama']){
          echo "<option value='".$fila['id_insignia']."'>".$fila['nombre_i']."</option>";
      }
  }
echo '</select>';
?>