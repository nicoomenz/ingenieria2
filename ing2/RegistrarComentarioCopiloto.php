<?php
    
session_start();
include ("conexion.php");


  $mensaje;
  if($conexion)
   {
        if (isset($_POST['cajatexto']) and (isset($_POST['puntaje']))) 
        {
            $comentario = $_POST['cajatexto'];
            if (!$comentario == "")
            {
                $puntaje = $_POST['puntaje'];
                if ($puntaje != -2)
                {  
                   
                   $emailCo = $_POST['CopEmail'];
                   $idviaje = $_POST['id'];
                   $consulta = "SELECT auto_id FROM viajes WHERE id_viaje = '$idviaje' AND borrado='0'";
                   if($resultadoConsulta=mysqli_query($conexion,$consulta)){
                        $registro=mysqli_fetch_array($resultadoConsulta);
                        $idauto=$registro['auto_id'];
                        $consulta2="SELECT * FROM vehiculos WHERE id = '$idauto' AND borrado='0'";
                        $resultadoConsulta2=mysqli_query($conexion,$consulta2);
                        $registro2=mysqli_fetch_array($resultadoConsulta2);
                   }
                   $emailPi = $_SESSION['email'];
                   $patente = $registro2['Patente'];
                   $piloto_cop='1';
                   $resultado = mysqli_query($conexion, "INSERT INTO votaciones(Email_piloto,piloto_copiloto,Email_copiloto,patente,calificacion,comentario,id_viaje) VALUES ('$emailPi', '$piloto_cop', '$emailCo' , '$patente', '$puntaje', '$comentario', '$idviaje')");
                   
                   if ($resultado)
                   {
                       $_SESSION['votexitosa'] = false;
                       header("Location:MisViajesPilo.php");
                   }
                   else
                   {
                       echo "Ha surgido un error y no se pudo guardar su votacion.";
                   }
                }               
            }  
        }  
    }
    else{
    echo "No se pudo cargar los datos";
    header("Location:VotarCopiloto.php");
}

