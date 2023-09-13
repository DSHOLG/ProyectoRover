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
    <link rel="stylesheet" href="../css/fotos.css">
    <title>Subir Imágenes</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
    <style type="text/css">
    	select{
    		border: none;
    		border-radius: 0px;
    	}
    </style>
    <div class="navbar" id="myNavbar">
        <a href="admin.php">Inicio</a>
        <a href="historiales.php">Historiales</a>
        <a href="buscador.php">Buscador</a>
        <a href="subirFotos.php">Fotos</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

<body>
	<div class="contenedor">
	<form action="fotosInsertar.php" class="formulario" method="POST" enctype="multipart/form-data" id="formSubir">
		<h1 class="form__title">Completa los campos para subir imagen</h1>
		<div class="container--50">
			<label for="" class="form__label">Nombre Campamento</label>
            <p style="font-size:10pt">(Si es un sabado de actividades normal solo poner "Sabado")</p>
			<input type="text" class="form__input" name="nombre_camp" required>
		</div>
		<div class="container--50" style="margin-top:35px;">
			<label for="" class="form__label">Lugar</label>
			<input type="text" class="form__input" name="lugar_camp" required>
		</div>
		<div class="container--50">
			<label for="" class="form__label">Año</label>
			<input type="number" class="form__input" id="year" name="year" min="1900" max="2099" step="1" placeholder="Año: Ej. 2023" required>
		</div>
		<div class="container--50">
			<label for="" class="form__label">Fecha</label>
			<input type="date" class="form__input" name="fecha" required>
		</div>
		<div class="container--50">
		<label for="" class="form__label"> Seleccioná la Rama que aparece en la foto: </label>
        
        <select name="rama" id="rama" class="form__input">
            <option value="0">..</option>
            <?php
                // Conexión a la base de datos (reemplaza los valores con los tuyos)
                include "../conexion/conexion.php";
                $conexion = conectar2();

                // Consulta para obtener los roles
                $sql = "SELECT id_rama,nombre FROM ramas";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if($row['id_rama']=='5'){
                            echo "";
                        }else{
                            echo '<option value="' . $row["id_rama"] . '">' . $row["nombre"] . '</option>';
                        }
                        
                    }
                }
            ?>
        </select>
        <p style="font-size:10pt">(Berthier quiere decir fotos de grupo o si hay una foto donde esten las ramas mezcladas)</p>
        </div>

        <div class="container--file">
        	<input type="text" id="fileText" placeholder="Seleccione imagenes." class="file__txt" readonly>
        	<label for="inputFile" class="form__file-btn">&#128193; Subir Imagenes</label>
		<input type="file" name="archivos[]" class="form__file" id="inputFile" required multiple>
		</div>
		<progress id="progressBar" value="0" max="100" class="progressBar"></progress>
		<input type="submit" value="Enviar" class="form__submit">

	</form>
	</div>
	<script src="../js/obtenerTexto.js"></script>
	<script src="../js/progressbar.js"></script>
	<script src="../js/escrito.js"></script>
</body>
</html>