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
    <title>Perfil de Usuario</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    
    <div class="navbar" id="myNavbar">
        <a href="admin.php">Inicio</a>
        <a href="historiales.php">Historiales</a>
        <a href="buscador.php">Buscador</a>
        <a href="subirFotos.php">Fotos</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin: 20px 0;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-top: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select, button {
            width: 50%;
            margin: 0 auto;
            display:block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        button {
            background-color: #f70039;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #fa1c50;
        }

        #historia, #year, #lugar{
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        #fecha_desde,#fecha_hasta{
            width: 30%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            margin-bottom: 10px;
            margin-left: 5px;
            margin-right: 5px;
        }
        #fecha_hasta{
            
        }
        .checkbox-container {
            max-height: 200px; /* Altura máxima de la lista de checkboxes */
            overflow-y: auto; /* Agrega una barra de desplazamiento vertical */
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 3px;
        }

        input[type="checkbox"] {
            margin-right: 5px;
            margin-bottom: 10px;
        }
        
        input[type="submit"]{
            background-color: #f70039;
            color: #fff;
            border: none;
            cursor: pointer;
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            margin: 0 auto;
            display: block;
        }

        input[type="submit"]:hover{
           background-color: #fa1c50;
        }

        p {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
    
    <form method="post">
        <div class="container">
        <p>Selecciona Rama:</p>
        <select name="rol" id="rol">
            <option value="0">Rama..</option>
            <?php
                // Conexión a la base de datos (reemplaza los valores con los tuyos)
                include "../conexion/conexion.php";
                $conexion = conectar2();

                // Consulta para obtener los roles
                $sql = "SELECT id_rama,nombre FROM ramas";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        if($row['id_rama']=='5' OR $row['id_rama']=='6'){
                            echo "";
                        }else{
                            echo '<option value="' . $row["id_rama"] . '">' . $row["nombre"] . '</option>';
                        }

                    }
                }
                
            ?>
        </select>
        <button type="submit" name="buscar">Buscar</button>
    </form>
    
    <?php
        if (isset($_POST['buscar'])) {
            $rolSeleccionado = $_POST['rol'];

            if ($rolSeleccionado != 0) {
                

                // Consulta para obtener usuarios por el rol seleccionado
                $sql = "SELECT integrantes_berthier.id,integrantes_berthier.nombre AS nombre_usuario,integrantes_berthier.apellido,ramas.id_rama,ramas.nombre,integrantes_berthier.rama_id 
                FROM integrantes_berthier 
                JOIN ramas ON integrantes_berthier.rama_id = ramas.id_rama 
                WHERE ramas.id_rama = '$rolSeleccionado'";

                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    echo '<p>Participaron del campamento:</p>';
                    echo '<form method="post" action="procesar.php">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="checkbox-container>"';
                        echo '<label><input type="checkbox" name="usuarios_seleccionados[]" value="' . $row['id'] . '"> ' . $row['nombre_usuario'] . ' ' . $row['apellido'] . '</label><br>';
                        echo '</div>';
                    }
                    echo '<br>';
                    echo '<label for="hist">Escriba el nombre del campamento y el año</label>';
                    echo '<input type="text" name="hist" id="historia" placeholder="Campamento.." required><br>';
                    echo '<input type="text" name="lug" id="lugar" placeholder="Lugar.." required><br>';
                    echo 'Desde:<input type="date" format="dd/MM" min="01/01" max="31/12" name="fecha_desde" id="fecha_desde" placeholder="Fecha Desde" required>';
                    echo 'Hasta:<input type="date" format="dd/MM" min="01/01" max="31/12" name="fecha_hasta" id="fecha_hasta" required><br>';
                    echo '<input type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="Año: Ej. 2023" required><br>';
                    echo '<input type="submit" name="guardar" value="Guardar selección">';
                    echo '</form>';
                } else {
                    echo '<p>No se encontraron usuarios con el rol seleccionado.</p>';
                }
                
            }
        }
    ?>

    </div>
    <script src="../js/escrito.js"></script>
    <?php
if(isset($_SESSION['insertado'])){
    echo '<h1>' .$_SESSION['insertado']. '</h2>';
    unset($_SESSION["insertado"]);
}
    ?>
</body>
</html>