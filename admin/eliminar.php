<?php
include("../utils/checkLogin.php");
include "../conexion/conexion.php";
$conn = conectar2();
        if(isset($_GET['id_historial'])){
        $idhist = $_GET['id_historial'];
        $id = $_GET['id'];
        $sql = "DELETE FROM historial WHERE id_historial = '$idhist'";
        $result = $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            $_SESSION['eliminado'] = "Fila eliminada correctamente!";
            header('Location: persona2.php?id='.$id);
          } else {
            echo "Error al insertar datos ". $conn->error;
          }
        }
    ?>