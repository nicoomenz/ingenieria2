<?php
session_start();
include("conexion.php");
$Email=$_POST['CopilotoEmail'];
$id_viaje=$_POST['id_viaje'];
$resultado2 = mysqli_query($conexion,"SELECT * FROM misviajes_copiloto WHERE id_viaje = '$id_viaje' AND Email_copiloto = '$Email'");
$reg =mysqli_fetch_array($resultado2);
$resultado = mysqli_query($conexion,"DELETE FROM misviajes_copiloto WHERE id_viaje = '$id_viaje' AND Email_copiloto = '$Email'");
if ($resultado){
                        if ($reg['estado'] == 'aceptado')
                        {
                            mysqli_query($conexion, "INSERT INTO `votaciones`(`id_votacion`, `piloto_copiloto`, `Email_piloto`, `Email_copiloto`, `patente`, `calificacion`, `comentario`, `id_viaje`) VALUES ('0','1','x','$Email','xxx','-1','','0')");
                        }
                        $_SESSION['usuarioEliminado']= false;
                        header("Location:MisViajesCopi.php");
                    }
                    else
                        echo "no entro";
                    
?>