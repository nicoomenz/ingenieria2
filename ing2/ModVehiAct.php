<?php
 include ("conexion.php");
  session_start();
  include ("class_funciones.php");
  $fun = new funciones();
  $fun->AutorizacionTitulo();



 function validarPatente($patente){

  $patenteNue= trim($patente);
  if($patenteNue == null||$patenteNue == "" ){
    echo "Campo de patente vacio";
    echo  "<a href='ModAut.php'> Volver a intentar </a>";
    return false;
  }
  return true;
}

  function validarModelo($modelo){
  $modelo= trim($modelo);
  if($modelo == null||$modelo == "" ){
    echo "Campo de modelo vacio";
    echo  "<a href='ModAut.php'> Volver a intentar </a>";
  
    return false;
  }
  return true; 
}
function validarMarca($marca){
  $sinopsis= trim($marca);
  if($marca == null||$marca == "" ){
    echo "Campo de marca vacio";
    echo  "<a href='ModAut.php'> Volver a intentar </a>";

    return false;
  }
  return true; 
}


 function validarCap($capacidad){
    $capacidad= trim($capacidad);
    if($capacidad == null||$capacidad == "" ){
      echo "Campo de capacidad vacio";
      echo  "<a href='ModAut.php'> Volver a intentar </a>";
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
   if(isset($_POST['modelo']) && isset($_POST['marca']) && isset($_POST['capacidad']) && isset($_POST['id']) ){ 
       $modelo = $_POST['modelo'];
       $id = $_POST['id'];
       if(validarModelo($modelo)){
           $marca= $_POST['marca'];
           if(validarMarca($marca)){
           $capacidad= $_POST['capacidad'];
           if(validarCap($capacidad)){
             if(isset($_SESSION['email'])){
               $nomemail=$_SESSION['email'];
               $resultado12 = mysqli_query($conexion ,"UPDATE vehiculos SET Email_id ='$nomemail', Modelo='$modelo',Marca='$marca',asientos='$capacidad' WHERE id='$id' ");
               if($resultado12){
                 $_SESSION['ModvehiOk'] =true;
                 header("Location:ModAut.php?idAuto=$id");   
                } 
                else 
                     echo "No se pudo guardar";
                  
               }
               else
                echo "noononoo";
                 
            }
          }

          }
        }
        else
          echo "No entro";
      }
    else
      echo "No se pudo conectar";


         
 ?>