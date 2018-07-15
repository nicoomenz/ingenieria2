<?php
include ("conexion.php");
 

$idFoto=$_GET["idfoto"];
# Buscamos la imagen a mostrar
$consulta = "SELECT Foto FROM usuarios WHERE Email= '$idFoto' ";
$result=mysqli_query($conexion,$consulta);

$row=mysqli_fetch_array($result);
 
 
# Mostramos la imagen
header('Content-Type: image/jpeg');
echo $row["Foto"];
?>
