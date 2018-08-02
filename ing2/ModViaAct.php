<?php
 include ("conexion.php");
  session_start();
  include ("class_funciones.php");
  $fun = new funciones();
  $fun->AutorizacionTitulo();



function validarOrigen($origen){
  $origenNue= trim($origen);
  if($origenNue == null||$origenNue == "" ){
    $_SESSION['origenOk'] =true;
      header("Location:ModVia.php?idviajeget=$idviaje");
    return false;
  }
  return true;
 }

  function validarDestino($destino){
   $destino= trim($destino);
   if($destino == null||$destino == "" ){
     $_SESSION['destinoOk'] =true;
      header("Location:ModVia.php?idviajeget=$idviaje");
     return false;
   }
   return true;
  }

function validarFecha($fecha){
  $fecha2= trim($fecha);
  if($fecha2 == null||$fecha2 == "" ){
    $_SESSION['fechaOk'] =true;
    header("Location:ModVia.php?idviajeget=$idviaje"); 
    return false;
  }
  else{
    $hoy= date("Y-m-d");
    if($hoy>$fecha){
      $_SESSION['fechaMayOk'] =true;
      header("Location:ModVia.php?idviajeget=$idviaje");
      return false;    
    }

  }
  return true;
 } 

 function validarHora($hora){
   $hora3= trim($hora);
   if($hora3 == null||$hora3 == "" ){
     $_SESSION['horaOk'] =true;
      header("Location:ModVia.php?idviajeget=$idviaje");
     return false;
   }
   return true;
  }
  
  function validarHora2($hora2){
   $hora4= trim($hora2);
   if($hora4 == null||$hora4 == "" ){
     $_SESSION['horaOk'] =true;
      header("Location:ModVia.php?idviajeget=$idviaje");
     return false;
   }
   return true;
  }

function validarPrecio($precio){
    $precio= trim($precio);
    if($precio == null||$precio == "" ){
      echo "Campo de precio vacio";
      echo  "<a href='publicarViaje.php'> Volver a intentar </a>";
      return false;
    }
    return true;
}

?>

<?php
 include ("conexion.php");


 
   if($conexion){
   $idviaje=$_POST['id'];
   $resultado12=false;
   echo $fecha=$_POST['fecha'];
   if(isset($_POST['origen']) && isset($_POST['destino']) && isset($_POST['fecha']) && isset($_POST['precio']) && isset($_POST['id'])){
     $origen = $_POST['origen']; 
     if(validarOrigen($origen)){
       $destino = $_POST['destino'];
       if(validarDestino($destino)){
           $fecha = $_POST['fecha'];
         if(validarFecha($fecha)){
             $hora = $_POST['hora'];
          if(validarHora($hora)){
              $hora2= $_POST['hora2'];
            if(validarHora2($hora2)){
             $precio=$_POST['precio'];
             if(validarPrecio($precio)){
               $id_auto=$_POST['vehiculo'];
               if(isset($id_auto)){               
                   $resultado = mysqli_query($conexion ,"UPDATE viajes SET auto_id='$id_auto', hora='$hora', horaLlegada='$hora2', precio='$precio', destino='$destino', origen='$origen', fecha='$fecha' WHERE id_viaje='$idviaje' ");
                   if($resultado){
                     $_SESSION['ModViaOk'] =true;
                     header("Location:ModVia.php?idviajeget=$idviaje");   
                   }
                   else{
                       $_SESSION['ModViaNotOk'] =true;
                     header("Location:ModVia.php?idviajeget=$idviaje"); 
                   }
                               
   }}}}}}}}}
         
 ?>
