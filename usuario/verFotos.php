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
    <link rel="stylesheet" href="../css/buscar.css">
    <link rel="stylesheet" href="../css/ver.css">
    <title>Perfil de Usuario</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    
    <div class="navbar" id="myNavbar">
        <a href="inicio.php">Inicio</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

	<ul class="galeria">
		<?php
                include "../conexion/conexion.php";
                $conexion = conectar2();
                $sql = "SELECT * FROM fotos WHERE id_rama =".$_GET['id_rama'];
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {  	
		                	$id_foto = $row['id_foto'];
		                	$ruta = $row['ruta'];
                            echo '<li class="galeria__item"><img src="'.$ruta.'" alt="" class="galeria__img"></li>';
                        }
                    }
            ?>
	</ul>
	<script src="../js/modal.js"></script>
	<script src="../js/escrito.js"></script>
</body>
</html>