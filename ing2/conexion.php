<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "grupo38";

$conexion = mysqli_connect($servername, $username, $password,$database);

if (!$conexion) {
    die("Conexion fallida");
}
?>