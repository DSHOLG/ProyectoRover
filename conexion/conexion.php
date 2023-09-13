<?php
if(!isset($_SESSION)){
session_start();
}
function conectar2()
{

$servername = "localhost";
$basedatos = "berthier";
$username = "root";
$password = "";
$ms = mysqli_connect($servername, $username, $password, $basedatos);

if (mysqli_connect_errno())
    {
        echo "Conexion Incorrecta".mysqli_connect_error();
    }

    return $ms;
}

?>