<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<header>
  <br/><br/><br/><div ><a href="index.php">Pagina principal</a></div><br/><br/>
</header>  	

 <body>
<?php
session_start();
 include ("conexion.php");
 include ("class_funciones.php");


 function validarNombre($nombre){
  $nuevonom= trim($nombre);
  if( $nuevonom == null||$nuevonom == "" ){
     $_SESSION['nomesta'] =false;
     header("Location:ModDatPerfil.php");
    return false;
}return true;
}
 
 function validarApe($apellido){
  $nuevoap= trim($apellido);
  if($nuevoap == null||$nuevoap == "" ){
     $_SESSION['apesta'] =false;
     header("Location:ModDatPerfil.php");
    return false;
  }
  return true;
}

function validarFecha ($fechaNac){
    $nuevoFech = trim($fechaNac);
    if($nuevoFech == null || $nuevoFech == "" ){
        $_SESSION['fechesta'] =false;
        header("Location:ModDatPerfil.php");
        return false;
  }
  return true;
}



?>   

  
<?php 


if($conexion) {
  if(isset($_POST['nombre']) && isset($_POST['apellido'] )&& isset($_POST['bday'])){
    $nombre = $_POST['nombre'];
    if(validarNombre($nombre)){
        $apellido = $_POST['apellido'];
        if(validarApe($apellido)){
            $fechaNac =$_POST['bday'];
                if(validarFecha($fechaNac)){
                    $emailLog = $_SESSION['email'];                    
                    $resultado = mysqli_query($conexion, "UPDATE usuarios SET Nombre = '$nombre' , Apellido = '$apellido' , Fecha_Nac = '$fechaNac' WHERE Email='$emailLog'"); 
                    if ($resultado){
                        $_SESSION['modPerf']= true;
                        header("Location:ModDatPerfil.php");
                    }
                    else
                        echo "no entro";
                    
                }
        }
    }
}
}
 ?>


</body>
</html>



