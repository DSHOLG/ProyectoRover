<?php
include("../utils/checkLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="stylesheet" href="../css/menu.css">
    <title>Grupo Scout J.B.Berthier</title>
</head>
<body>


    <div class="navbar" id="myNavbar">
        <a href="#home">Inicio</a>
        <a href="#services">Servicios</a>
        <a href="#contact">Contacto</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
    

    <section class="articles">

        <article class="article" id="persona">
            <?php
                        include ("../conexion/conexion.php");
                        $conn = conectar2();
                        $usuario = $_SESSION["username"];
                        $id = $_SESSION["id"];
                        $sql = "SELECT nombre, apellido FROM integrantes_berthier WHERE usuario = '$usuario'";
                        $result = $conn->query($sql);
                        if (!$result){
                            die("Error en la consulta: " . $conn->error);
                        }
                        if ($result->num_rows > 0) {
                            // Mostrar los datos del usuario
                            $row = $result->fetch_assoc();
                            echo "<br><h4 style='font-size: 26pt;margin:0px'>Bienvenido/a " . $row["nombre"] . "!<br>";
                        } else {
                            echo "No se encontraron resultados.";
                        }
            ?>
            <h3 style='margin: 0px'>Mi Historial y Más sobre mi</h3>
            <a href="persona.php?id=<?php echo $id ?>">Ver más</a>
            
        </article>

        <article class="article" id="berthier">
            <img src="../img/berthier.png" alt="Artículo 1" width="250px">
            <h3>Grupo Scout Juan Bautista Berthier</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla mauris a justo vestibulum, eu lacinia justo bibendum.</p>
            <a href="#">Ver Fotos!</a>
        </article>

        <article class="article" id="manada">
            <img src="../img/manada.png" alt="Artículo 1" width="250px">
            <h3>Manada "Flor Roja"</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla mauris a justo vestibulum, eu lacinia justo bibendum.</p>
            <a href="#">Ver Fotos!</a>
        </article>

        <article class="article" id="unidad">
            <img src="../img/unidad.png" alt="Artículo 2" width="250px">
            <h3>Unidad Scout "Emilio Frey"</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla mauris a justo vestibulum, eu lacinia justo bibendum.</p>
            <a href="#">Ver Fotos!</a>
        </article>

        <article class="article" id="caminantes">
            <img src="../img/caminante.png" alt="Artículo 3" width="250px">
            <h3>Comunidad Caminantes "Perez Esquivel"</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla mauris a justo vestibulum, eu lacinia justo bibendum.</p>
            <a href="#">Ver Fotos!</a>
        </article>

        <article class="article" id="rover">
            <img src="../img/rover.png" alt="Artículo 2" width="250px">
            <h3>Comunidad Rover "Ceferino Namuncura"</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla fringilla mauris a justo vestibulum, eu lacinia justo bibendum.</p>
            <a href="#">Ver Fotos!</a>
        </article>
    </section>



    <section class="about">
        <h2>Sobre Nosotros</h2>
        <p>Somos una organización dedicada a la educación y desarrollo de jóvenes a través de actividades al aire libre y programas educativos.</p>
        <p>&copy; 2023 Scouts de Argentina</p>
    </section>


    <footer>
       
    </footer>
    <script src="../js/escrito.js"></script>
</body>
</html>
