<?php
 session_start();
 include ("conexion.php");
 function validarPatente($patente){

  $patenteNue= trim($patente);
  if($patenteNue == null||$patenteNue == "" ){
    echo "Campo de patente vacio";
    echo  "<a href='RegVehi.php'> Volver a intentar </a>";
    return false;
  }
  return true;
}

  function validarModelo($modelo){
  $modelo= trim($modelo);
  if($modelo == null||$modelo == "" ){
    echo "Campo de modelo vacio";
    echo  "<a href='RegVehi.php'> Volver a intentar </a>";
  
    return false;
  }
  return true; 
}
function validarMarca($marca){
  $sinopsis= trim($marca);
  if($marca == null||$marca == "" ){
    echo "Campo de marca vacio";
    echo  "<a href='RegVehi.php'> Volver a intentar </a>";

    return false;
  }
  return true; 
}


 function validarCap($capacidad){
    $capacidad= trim($capacidad);
    if($capacidad == null||$capacidad == "" ){
      echo "Campo de capacidad vacio";
      echo  "<a href='RegVehi.php'> Volver a intentar </a>";
      return false;
    }
    return true;
}

?>

<?php
 include ("conexion.php");

 if(!isset($_SESSION['estado'])){
   $_SESSION['noactivo'] =true;
   header("Location:index.php");   
 }
 if($conexion) {
   $resultado12=false;
   if(isset($_POST['patente']) && isset($_POST['modelo']) && isset($_POST['marca']) && isset($_POST['capacidad'])){
     $patente = $_POST['patente']; 
     if(validarPatente($patente)){
       $modelo = $_POST['modelo'];
       if(validarModelo($modelo)){
           $marca= $_POST['marca'];
           if(validarModelo($marca)){
           $capacidad= $_POST['capacidad'];
           if(validarCap($capacidad)){
             if(isset($_SESSION['email'])){
               $nomemail=$_SESSION['email'];
               $consulta13 = "SELECT * FROM vehiculos WHERE Patente='$patente' ORDER BY id DESC LIMIT 1 ";
               $result13=mysqli_query($conexion,$consulta13);
               $registro=mysqli_fetch_array($result13);
               if(mysqli_num_rows($result13)==0){
                   $resultado12 = mysqli_query($conexion , "INSERT INTO vehiculos ( Patente ,Email_id, Modelo,Marca,asientos) VALUES (  '$patente' , '$nomemail','$modelo' , '$marca','$capacidad')") ;
                   if($resultado12){
                      $_SESSION['regvehiOk'] =true;
                      header("Location:RegVehi.php");   
                   }
                   else{
                     //aca va algo como ,error en el cargado
                     header("Location:RegVehi.php");
                   }
               }     
               else 
                if($registro['borrado']==0){
                  $_SESSION['vehiRep'] =true;
                  header("Location:RegVehi.php");
                }
                else{
                   $resultado22 = mysqli_query($conexion , "INSERT INTO vehiculos ( Patente ,Email_id, Modelo,Marca,asientos) VALUES (  '$patente' , '$nomemail','$modelo' , '$marca','$capacidad')") ;
                   if($resultado22){
                      $_SESSION['regvehiOk'] =true;
                      header("Location:RegVehi.php");   
                   }
                
               }
             }  
            }
          }

          }
        }
      }
    }
    else
      echo "No se pudo conectar";


         
 ?>