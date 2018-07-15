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

 function validarNombre($nombre){
  $nuevonom= trim($nombre);
  if( $nuevonom == null||$nuevonom == "" ){
     $_SESSION['nomesta'] =false;
     header("Location:Registro.php");
    return false;
}return true;
}
 
 function validarApe($apellido){
  $nuevoap= trim($apellido);
  if($nuevoap == null||$nuevoap == "" ){
     $_SESSION['apesta'] =false;
     header("Location:Registro.php");
    return false;
  }
  return true;
}

function validarFech($fechaNac){
    $nuevoFech= trim($fechaNac);
    date_default_timezone_set("America/Buenos_Aires");
    list($Y,$m,$d) = explode("-",$fechaNac);
    $año=( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    $año = $año +0;
  if($nuevoFech == "0000/00/00" ||$nuevoFech == "" || $año<18){
     
      $_SESSION['fechesta'] =false;
     header("Location:Registro.php");
    return false;
  }
  
  return true;
}

function validarEmail($email){
   $nuevoem= trim($email);
   if( $nuevoem == null || $nuevoem == ""  ) {
    $_SESSION['mailesta'] =false;
     header("Location:Registro.php");
    return false;
  }
  else{
    if (!filter_var($nuevoem, FILTER_VALIDATE_EMAIL)) {
      $_SESSION['mailesvalido'] =false;
     header("Location:Registro.php");
      return false;
    }
 }return true;
}


 function validarContraseña($clave){
  $expreconte="/^([0-9]|[a-zA-Z]|[@$.,!¡¿?+-])+([0-9]|[@$.,!¡¿?+-])+([a-zA-Z0-9@$.,!¡¿?+-])*$/";
  $nuevac= trim($clave);
  if( $nuevac == null || $nuevac == ""  ) {
     $_SESSION['contraesta'] =false;
     header("Location:Registro.php");
    return false;
  }
  else{
    if(strlen($nuevac)<6){
       $_SESSION['contramenos'] =false;
       header("Location:Registro.php");
       return false;
    }
  }
  $rta=preg_match($expreconte,$nuevac);
  if(!$rta){
       $_SESSION['contracualquiera']=true;
       header("Location:Registro.php");
       return false;
  }
  return true;
 }

 function validarContraseña2($clave2){
 $expreconte="/^([0-9]|[a-zA-Z]|[@$.,!¡¿?+-])+([0-9]|[@$.,!¡¿?+-])+([a-zA-Z0-9@$.,!¡¿?+-])*$/";
 $nuevac2= trim($clave2); 
  if($nuevac2 == null || $nuevac2 == "") {
     $_SESSION['contraesta2']=false;
     header("Location:Registro.php");
    return false;
  }
  else{
    if(strlen($nuevac2)<6){
       $_SESSION['contramenos']=false;
       header("Location:Registro.php");
       return false;
    }
  }
  $rta2=preg_match($expreconte,$nuevac2);
  if(!$rta2){
       $_SESSION['contracualquiera2']=true;
       header("Location:Registro.php");
       return false;
  }
  return true;
}

    function validarcontraseñas($clave1,$clave2){
      if($clave1!=$clave2){
         $_SESSION['contranoigual'] =false;
         header("Location:Registro.php");
         return false;
      }
      return true;
    }


?>   
   </div>  

  
   <?php 


if($conexion) {

  if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['bday']) && isset($_POST['email'])&& isset($_POST['contraseña1'])&& isset($_POST['contraseña2'])){
      $nombre = $_POST['nombre'];
      if(validarNombre($nombre)){
        $apellido  = $_POST['apellido'];
        if(validarApe($apellido)){
            $fechaNac = $_POST['bday'];
            if(validarFech($fechaNac)){    
                $email= $_POST['email'];
                if(validarEmail($email)){        
                    $clave = $_POST['contraseña1'];
                    if(validarContraseña($clave)){
                      $clave2=$_POST['contraseña2'];
                      if(validarContraseña2($clave2)){
                        if(validarcontraseñas($clave,$clave2)){ 
                          $consulta20 = "SELECT * FROM usuarios WHERE email='$email'";
                          if($resultadoConsulta20=mysqli_query($conexion,$consulta20)){
                            if($registro20=mysqli_fetch_array($resultadoConsulta20)){
                              echo "El usuario ".$email." ya existe";
                            }
                            else{
                              $resultado = mysqli_query($conexion, "INSERT INTO usuarios(password,email,nombre,apellido,Fecha_Nac) VALUES ('$clave', '$email' , '$nombre', '$apellido', '$fechaNac')"); 
                              if(!$resultado){
                                echo "No se pudo agregar";
                              }
                              else{
                                $_SESSION['regexitoso'] =false;
                               header("Location:Registro.php");

                              }
                            }
                          }
                          else{
                            echo "No se pudo acceder a la Base de Datos";
                          }
 }
}
}
}
}
}
}
}
}
else{
    echo  "No se pudo cargar los datos";
    echo  "<a href='InicioSesion.php'> Volver a intentar </a>";
    echo  "<a href='index.php'> Volver a la pagina principal</a>";
  }






 ?>


</body>
</html>

