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
    <script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
    <title>Perfil de Usuario</title>
</head>
<body>
    <script type="text/javascript">
                    function muestraselect(str){
                        var conexion;
                        if(str == ""){
                            document.getElementById("txtHint").innerHTML="";
                            return;
                        }
                        if(window.XMLHttpRequest){
                            conexion = new XMLHttpRequest();
                        }
                        conexion.onreadystatechange = function(){
                            if(conexion.readyState == 4 && conexion.status == 200){
                                document.getElementById("div").innerHTML=conexion.responseText;
                            }    
                        }
                        conexion.open("GET","insignias.php?id_rama="+str, true);
                        conexion.send();
                    }
                </script>
    <div class="navbar" id="myNavbar">
        <a href="admin.php">Inicio</a>
        <a href="#services">Servicios</a>
        <a href="#contact">Contacto</a>
        <a href="../logout.php" class="logout-button">Cerrar sesión</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
    <?php
        include "../conexion/conexion.php";
        $conn = conectar2();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        } else {
            echo "No se proporcionó el nombre.";
        }
        $sql = "SELECT integrantes_berthier.nombre, apellido, ramas.id_rama, totem, ramas.nombre AS nombre_rama, 
        DATE_FORMAT(fecha_ingreso, '%d-%m-%Y') AS fecha_formateada 
        FROM integrantes_berthier,ramas WHERE id = '$id' AND integrantes_berthier.rama_id = ramas.id_rama";
        $result = $conn->query($sql);
            if (!$result){
                    die("Error en la consulta: " . $conn->error);
            }
    ?>

    <a href="persona2.php?id=<?php echo $_GET['id']; ?>" id="hist">Volver</a>
    <div class="contenedor-padre">
    <div class="container">
    <form action="modific.php?id=<?php echo $_GET['id']; ?>&nombre_i=<?php echo $_GET['nombre_i'] ?>" method="post">

    <?php    
    if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
    $idrama = $row['id_rama'];
    ?>

                    
                <p style="font-size:14pt">Nombre</p>
                <input type="text" id="search" value="<?php echo  $row['nombre'];?>" name="nombre">

                
                <p style="font-size:14pt">Apellido</p>
                <input type="text" id="search" value="<?php echo  $row['apellido'];?>" name="apellido">


               
                <p style="font-size:14pt">Totem</p>
                <input type="text" id="search" value="<?php echo  $row['totem'];?>" name="totem">



                <p style="font-size:14pt">Rama</p>
                <select name="rama" id="rama" onclick="muestraselect(this.value)">
                    <option value="<?php echo $idrama ?>"><?php echo $row['nombre_rama'] ?></option>
                    <?php
                        $sql = "SELECT id_rama,nombre FROM ramas";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if($row['id_rama']=='5'){
                                    echo "";
                                }else{
                                    if($row['id_rama']==$idrama){
                                        echo "";
                                    }else{
                                    echo '<option value="' . $row["id_rama"] . '">' . $row["nombre"] . '</option>';
                                    }
                                }
                                
                            }
                        }
                    ?>
                    </select>


                    <p style="font-size:14pt">Progresión</p>
                    <div id="div">
                        <select name="insignias" id="insignias">
                          
                                <option value="<?php echo $_GET['id_insignia']; ?>"><?php echo $_GET['nombre_i']; ?></option>
                         

                            
                            <?php
                                if(isset($_GET['id_rama'])){
                                     $id_rama = $_GET['id_rama'];
                                     
                                } else {
                                echo "No se proporcionó el nombre.";
                                }
                                $sql = "SELECT * FROM insignias WHERE id_rama = '$id_rama'";
                                $result = $conn->query($sql);
                        
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        if($row["nombre_i"]==$_GET['nombre_i']){
                                            echo "";
                                        }else{
                                        echo '<option value="' . $row["id_insignia"] . '">' . $row["nombre_i"] . '</option>';
                                    }
                                        }

                                }

                            ?>
                        </select>
                    </div>

                     
                <input type="submit" value="Enviar Datos" name="guardar">
            
        </form>
                

    <?php
    if(isset($_SESSION['insertado'])){
        echo '<h1>' .$_SESSION['insertado']. '</h2>';
        unset($_SESSION["insertado"]);
    }
    ?>

    </div>
    </div>
</body>
</html>