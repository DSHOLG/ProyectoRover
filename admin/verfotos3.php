<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../css/ver3.css">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Document</title>
    <script src="../js/main.js" defer></script>
    
</head>
<body>
     <div class="navbar" id="myNavbar">
        <a href="admin.php">Inicio</a>
        <a href="historiales.php">Historiales</a>
        <a href="buscador.php">Buscador</a>
        <a href="subirFotos.php">Insertar Fotos</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
<div class="overlay">
    <div class="slideshow">
            <span class="btn_cerrar">&times;</span>
            <div class="botones adelante">
                <i class="mdi mdi-arrow-right-circle-outline"></i>
            </div>
            <div class="botones atras">
                <i class="mdi mdi-arrow-left-circle-outline"></i>
            </div>
            <img id="img_slideshow">
    </div>
</div>
    <form method="post">
        <?php
        // Conexión a la base de datos (reemplaza los valores con los tuyos)
        include "../conexion/conexion.php";
        $conexion = conectar2();
        // Consulta para obtener los roles
        $sql = "SELECT DISTINCT nombreCamp,lugarCamp,DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha_formateada FROM fotos WHERE id_rama =".$_GET['id_rama'];
        $result = $conexion->query($sql);
        if ($result->num_rows > 0) {
            // Creamos el select
            echo '<select name="rama" id="rama" class="form__input" style="margin-top:10px;">';
            echo '<option value="0">Seleccionar..</option>';
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["nombreCamp"] . ','. $row["fecha_formateada"] .'">' . $row["nombreCamp"] . ", " . $row["lugarCamp"] . ", " . $row["fecha_formateada"] . '</option>';
            }
                echo '</select>';
                echo '<input type="submit" class="enviarBtn" name="buscar" value="Buscar">';
        }else{
            echo "<h2>No se encontraron fotos en la base de datos</h2>";
            echo '<input type="submit" name="buscar" value="Buscar" style="display:none">';
        }
        ?>
    </form>

<section class="galeria">

        <div class="columna">

            <?php
                if (isset($_POST['buscar'])) {
                    $nombreCamp = $_POST['rama'];
                    $nombre = explode(",", $nombreCamp)[0];
                    $fecha = explode(",", $nombreCamp)[1];
                    $i = 0;
                    $divs = array();
                    $fechaFormateada = date("Y-m-d", strtotime($fecha));
                    $sql = "SELECT * FROM fotos WHERE nombreCamp = '$nombre' AND fecha = '$fechaFormateada' AND id_rama =".$_GET['id_rama'];
                    $result = $conexion->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {      
                            $id_foto = $row['id_foto'];
                            $ruta = $row['ruta'];
                            $ruta_video = $row['ruta_video'];
                            if ($ruta_video != "") {
                                // Si hay un video, mostrarlo
                                echo '<video src="'.$ruta_video.'" width="500" height="300" controls>
                                          <source src="video.ogg" type="video/ogg">
                                            <source src="video.webm" type="video/webm">
                                            Tu navegador no es compatible con el elemento
                                        </video>';
                                         
                                      }else{
                                          // Si no hay un video, mostrar las imágenes
                                          echo '
                                                <img src="'.$ruta.'" alt="" class="imagen" data-imag-mostrar="'.$i.'">';
                                          $i++;
                                        if($i == 5 OR $i == 10 OR $i == 15 OR $i == 20 OR $i == 25){
                                            echo '</div>';
                                            echo '<div class="columna">';
                                        }
                            }
                        }
                    }
                }
            ?>
            
        </div>

    
</section>
<!-- <a href="eliminarArch.php?id_foto='.$id_foto.'&id_rama='.$_GET['id_rama'].'">
    <img src="../img/eliminar.png" class="eliminar" width="25px" height="25px"></a> -->
    <script src="../js/escrito.js"></script>
</body>
</html>