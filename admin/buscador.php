<?php
include "../utils/checkLogin.php";
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
    <script>


document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("search");
    const resultsContainer = document.getElementById("results");

    searchInput.addEventListener("input", function() {
        const searchTerm = searchInput.value.trim();

        if (searchTerm !== "") {
            // Realiza una solicitud AJAX al servidor para buscar usuarios
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `buscar.php?query=${searchTerm}`, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    resultsContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        } else {
            resultsContainer.innerHTML = ""; // Limpia los resultados si no hay término de búsqueda
        }
    });
});

    </script>
    <h1>Busca a quien quieras ver!</h1>
    <form>
        <input type="text" id="search" placeholder="Buscar por nombre o apellido">
    </form>
    <div id="results"></div>

<script src="../js/escrito.js"></script>
</body>
</html>