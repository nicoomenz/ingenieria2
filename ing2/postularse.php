<html>
<head>
	<link rel="stylesheet" type="text/css" href="./estilo.css">
</head>
<header>
  <br/><br/><br/><div ><a href="index.php">Pagina principal</a></div><br/><br/>
</header>  	

 <body>
<?php
        session_start();
        include ("conexion.php");
        $EmailCop = $_SESSION['email'];
        $idViaje = $_POST['id'];
        $Estado = 'en espera';
        
        $consulta="SELECT * FROM viajes WHERE id_viaje = '$idViaje' AND borrado='0'";
        $consulta2="SELECT * FROM viajes WHERE id_viaje = '$idViaje' AND borrado='0'";
        if($resultadoConsulta=mysqli_query($conexion,$consulta)){
            if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
                $registro=mysqli_fetch_array($resultadoConsulta);
                $idauto=$registro['auto_id'];                
                $consulta3="SELECT Email_id FROM vehiculos WHERE id = '$idauto' AND borrado='0'";
                $resultadoConsulta3=mysqli_query($conexion,$consulta3);
                $registro3=mysqli_fetch_array($resultadoConsulta3);
                $EmailAuto=$registro3['Email_id'];                
                if($EmailAuto === $EmailCop){
                    $_SESSION['posdueño'] =false;
                    header("Location:MisViajesPilo.php");
                }
                else{
                       
                        $resultado = mysqli_query($conexion, "INSERT INTO misviajes_copiloto(id_viaje,Email_copiloto,estado) VALUES ('$idViaje','$EmailCop','$Estado')");   
                        if(!$resultado){
                            $_SESSION['posdenegado'] =false;
                             header("Location:MisViajesCopi.php");
                        }
                        else{
                             $_SESSION['posexitoso'] =false;
                             header("Location:MisViajesCopi.php");

                        }
                    }
        }
    }    
        
        
        

            
?>
 
 </body>
</html>
