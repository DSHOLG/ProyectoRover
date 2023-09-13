<?php
include("../utils/checkLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/persona.css">
    <link rel="stylesheet" href="../css/menu.css"> 
    <title>Perfil de Usuario</title>
</head>
<body>
    
    <div class="navbar" id="myNavbar">
        <a href="admin.php">Inicio</a>
        <a href="#services">Servicios</a>
        <a href="#contact">Contacto</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
    <a href="buscador.php" id="hist">Volver</a>
    <div class="contenedor-padre">
    <div class="container">
        <h2>Datos Personales</h2>
        <table>

            <tr>
                <th>Nombre</th>
                <?php
                include "../conexion/conexion.php";
                $conn = conectar2();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } else {
                    echo "No se proporcionó el nombre.";
                }
                $sql = "SELECT integrantes_berthier.nombre, apellido, totem, ramas.nombre AS nombre_rama, DATE_FORMAT(fecha_ingreso, '%d-%m-%Y') AS fecha_formateada, insignias.nombre_i,integrantes_berthier.rama_id,integrantes_berthier.insignia_id
                FROM integrantes_berthier,ramas,insignias
                WHERE id = '$id' AND integrantes_berthier.rama_id = ramas.id_rama AND integrantes_berthier.insignia_id = insignias.id_insignia";
                $result = $conn->query($sql);
                    if (!$result){
                            die("Error en la consulta: " . $conn->error);
                    }
                    if ($result->num_rows > 0) {
                        // Mostrar los datos del usuario
                        $row = $result->fetch_assoc();
                        $id_rama = $row['rama_id'];
                        $id_insignia = $row['insignia_id'];
                        $nombre_i = $row['nombre_i'];
                        echo "<td>" . $row['nombre'] . "</td>";
                    
            ?>
            </tr>
            <tr>
                <th>Apellido</th>
                <?php echo "<td>" . $row['apellido'] . "</td>"; ?>
            </tr>
            <tr>
                <th>Rama</th>
                <?php echo "<td>" . $row['nombre_rama'] . "</td>"; ?>
            </tr>
            <tr>
                <th>Progresión</th>
                <?php echo "<td>" . $row['nombre_i'] . "</td>"; ?>
            </tr>
                <?php
                if($row['totem'] == ""){ 
                    echo "";
                }else{
                    echo '<tr>';
                    echo '<th>Tótem</th>';
                    echo "<td>" . $row['totem'] . "</td>";
                    echo '</tr>'; 
                }
                ?>
        </table>
        <a href="modificar.php?id=<?php echo $id; ?>&id_rama=<?php echo $id_rama; ?>&id_insignia=<?php echo $id_insignia; ?>&nombre_i=<?php echo $nombre_i; ?>"><h2>Modificar <img src="../img/modificar.png" alt="Modificar" width="20px" height="20px"></a></h2>
        
    </div>
    
    <?php
        } else {
        echo "No se encontraron resultados.";
        }
    ?>
    
    <div class="container" id="cont">
    <h2>Historial en el Movimiento Scout</h2>
    <p>Ingresó al grupo el <?php echo "<td>" . $row['fecha_formateada'] . "</td>"; ?></p>
    <table>
        <tr>
            <th>Rama</th>
            <th>Campamento</th>
            <th>Lugar</th>
            <th>Año</th>
        </tr>
        <?php
        // Consulta SQL para seleccionar dato
        $sql2 = "SELECT historial.id_historial,campamento, lugar, anio, ramas.id_rama,ramas.nombre AS nombre_rama
        FROM integrantes_berthier,historial,ramas 
        WHERE integrantes_berthier.id = '$id' AND historial.id_joven = '$id' AND integrantes_berthier.rama_id = ramas.id_rama";
        $resulta = $conn->query($sql2);
        // Verifica si se obtuvieron resultados
        if ($resulta->num_rows > 0) {
            // Itera a través de los resultados y crea las filas de la tabla
            while ($row = $resulta->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre_rama"] . "</td>";
                echo "<td>" . $row["campamento"] . "</td>";
                echo "<td>" . $row["lugar"] . "</td>";
                echo "<td>" . $row["anio"] . "</td>";
                echo "<td><a href='eliminar.php?id_historial=". $row['id_historial'] ."&id=". $id ."'><img src='../img/eliminar.png' width='25px' height='25px'></a></td>";
                echo "</tr>";
            }
        } else {
            echo "No se encontraron registros en la base de datos.";
        }

        // Cierra la conexión a la base de datos
        $conn->close();

        ?>
    </table>
    </div>
    <?php

if(isset($_SESSION['eliminado'])){
    echo '<h1>' .$_SESSION['eliminado']. '</h2>';
    unset($_SESSION["eliminado"]);
}

    ?>
    <script src="../js/escrito.js"></script>
</body>
</html>
