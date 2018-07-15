<?php
class funciones extends Exception{ 

  public function AutorizacionTitulo(){
  	try{
      if (isset($_COOKIE['cerro'])){
        setcookie("cerro", "", time() - 3600);
      	throw new Exception (header("Location:index.php"));
      }
        $email=$_SESSION['email'];
        echo "$email";
        echo "<a href='CerrarSesion.php'> Cerrar Sesion </a> ";
       }
             
    catch(Exception $e){
    	echo $e->getMessage();
      	
  	}
  
  }






  public function Autenticacion($email,$password){
  	  require_once('conexionobj.php');
      $conexion= new conectar();
      $consulta = "SELECT * FROM usuarios WHERE Email='$email' AND Password='$password'";
      
      try{
      	if( $resultado = $conexion->con()->query($consulta)){
          if(! $reg=mysqli_fetch_array($resultado)){
            $_SESSION['iniciose'] =false;
            throw new Exception(header("Location:index.php"));
            }

          $_SESSION['email']=$reg['Email'];
          $_SESSION['estado'] = "logeado";
          $_SESSION['nombre'] = $reg['Nombre'];
          $_SESSION['apellido'] = $reg['Apellido'];
          $_SESSION['password'] = $reg['Password'];
          $_SESSION['foto'] = $reg['Foto'];
          $_SESSION['fecha_nac'] = $reg['Fecha_Nac'];

          header("Location:PagPrin.php");
        }
      
      }


      catch(Exception $e){
    	   echo $e->getMessage();
      } 

     
  }
  
  }










   
  


 
























  ?>

