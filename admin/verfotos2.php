<!DOCTYPE html>
<html lang="es">
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Lightbox | Materialize</title>
     
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
     <link rel="stylesheet" href="../css/menu.css">
     <link rel="stylesheet" href="../css/ver2.css">
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
     <main class="container">
          <div class="row">
               <div class="col s12 center-align">
                    <h1 class="titulo">Buscar por fecha o evento</h1>
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
               </div>
          </div>

          <div class="row galeria">
               <?php
                  if (isset($_POST['buscar'])) {
                      $nombreCamp = $_POST['rama'];
                      $nombre = explode(",", $nombreCamp)[0];
                      $fecha = explode(",", $nombreCamp)[1];
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
                                          echo '<div class="col s12 m4 l3">
                                          <div class="contenedor">
                                          <a href="eliminarArch.php?id_foto='.$id_foto.'&id_rama='.$_GET['id_rama'].'"><img src="../img/eliminar.png" class="eliminar" width="25px" height="25px"></a>
                                                       <div class="material-placeholder">
                                                       
                         <video src="'.$ruta_video.'" width="500" height="300" controls>
                                          <source src="video.ogg" type="video/ogg">
                                            <source src="video.webm" type="video/webm">
                                            Tu navegador no es compatible con el elemento
                                          </video>
                                                  </div>
                                                  </div>
                                                </div>';
                                         
                                      }else{
                                          // Si no hay un video, mostrar las imágenes
                                          echo '<div class="col s12 m4 l3">
                                                  <div class="material-placeholder">
                                                  <div class="contenedor">
                                                  <a href="eliminarArch.php?id_foto='.$id_foto.'&id_rama='.$_GET['id_rama'].'"><img src="../img/eliminar.png" class="eliminar" width="25px" height="25px"></a>
                                                       <img src="'.$ruta.'" alt="" class="responsive-img materialboxed"></div>
                                                  </div>
                                                </div>';
                                      }
                                  }
                              }
                              }
               ?>
               


          </div>
     </main>
     <script src="../js/escrito.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
     <script src="../js/main.js"></script>
</body>
</html>