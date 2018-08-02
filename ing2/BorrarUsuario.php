<?php
session_start();
include ("conexion.php");
if($conexion)
   {
        if (isset($_POST['email_usuario'])) 
        {
           $email = $_POST['email_usuario'];
           mysqli_query($conexion, "UPDATE usuarios SET borrado='1', Nombre='Usuario ', Apellido='no disponible.' WHERE Email='$email'");
           $_SESSION['borroexito'] = false;
           header("Location:index.php");        
        }
        else
        {
            echo "Hubo un error";
            header("Location:miperfil.php"); 
        }
   }
else
{
    echo "Hubo un error";
    header("Location:miperfil.php");
}
?>

