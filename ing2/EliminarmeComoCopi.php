<?php
session_start();
include("conexion.php");

$Email=$_POST['CopilotoEmail'];
$id_viaje=$_POST['id_viaje'];

$resultado = mysqli_query($conexion,"DELETE FROM misviajes_copiloto WHERE id_viaje = '$id_viaje' AND Email_copiloto = '$Email'");
if ($resultado){
                        $_SESSION['usuarioEliminado']= false;
                        header("Location:MisViajesCopi.php");
                    }
                    else
                        echo "no entro";
                    
?>