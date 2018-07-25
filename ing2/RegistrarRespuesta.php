<?php
    
session_start();
include ("conexion.php");


  if($conexion)
   {
        if (isset($_POST['respuesta'])) 
        {
            $respuesta = $_POST['respuesta'];
            if (!$respuesta == "")
            {
            $descripcion = $_POST['Descripcion'];
            $emailid = $_POST['Email'];
            $id_viaje = $_POST['id_viaje'];
            $resultado = $conexion -> query("UPDATE preguntas SET Respuesta = '$respuesta' WHERE id_viaje= '$id_viaje' AND Descripcion= '$descripcion' AND Email_id= '$emailid';");
            if ($resultado)
            {
               $_SESSION['resexitosa'] = false;
               header('Location: MisViajesPilo.php');
            }
             else
            {
                 echo mysqli_error($conexion);
             echo "Ha surgido un error y no se pudo guardar su respuesta.";
            }
          }
      }                      
    }
    else{
    echo "No se pudo cargar los datos";
    header("Location:MisViajesPilo.php");
    }