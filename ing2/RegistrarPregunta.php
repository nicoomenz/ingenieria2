<?php
    
session_start();
include ("conexion.php");


  if($conexion)
   {
        if (isset($_POST['pregunta'])) 
        {
            $pregunta = $_POST['pregunta'];
            if (!$pregunta == "")
            {
            $emailid = $_POST['Email_id'];
            $id_viaje = $_POST['id_viaje'];
            $resultado = $conexion -> query("INSERT INTO preguntas (Email_id, Descripcion, Respuesta, id_viaje) VALUES ('$emailid','$pregunta',' ','$id_viaje')");
            if ($resultado)
            {
               $_SESSION['pregexitosa'] = false;
               header('Location: MisViajesCopi.php');
            }
             else
            {
             echo "Ha surgido un error y no se pudo guardar su pregunta.";
            }
          }
      }                      
    }
    else{
    echo "No se pudo cargar los datos";
    header("Location:MisViajesCopi.php");
    }

    //$_SERVER['HTTP_REFERER']

