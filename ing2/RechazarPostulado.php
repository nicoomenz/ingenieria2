<?php
    session_start();
    include ("conexion.php");
    $idViaje = $_POST['idViaje'];
    $emailCop = $_POST['usuarioEmail'];
    $estado = 'rechazado';
    $resultado = mysqli_query($conexion, "UPDATE misviajes_copiloto SET estado = '$estado' WHERE id_viaje= '$idViaje' AND Email_copiloto='$emailCop'");
    if ($resultado){
                        $_SESSION['usuarioRechazado']= false;
                        header("Location:MisViajesPilo.php");
                    }
                    else
                        echo "no entro";
                    
                    

?>

