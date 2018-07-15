<?php
session_start();
include ("class_funciones.php");
$fun = new funciones();
$fun->AutorizacionTitulo();
?>
<?php

include("conexion.php");

$id=$_POST['id'];
$cant_aceptados = 0;
$consulta="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$id' AND estado = 'aceptado'";
$consulta2="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$id' AND estado = 'aceptado'";

if($resultadoConsulta=mysqli_query($conexion,$consulta)){ //esta consulta es por si hay usuarios copilotos aceptados
    if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
        while($registro=mysqli_fetch_array($resultadoConsulta)){
            $cant_aceptados++; //puntos que hay que restar de la puntuacion de calificacion del piloto
        }
    
    }
}
$consulta3="UPDATE viajes SET  borrado='1' WHERE id_viaje='$id'";

$resultado=mysqli_query($conexion , $consulta3);
if($resultado){
       $_SESSION['seBorro']=True;
       header("Location:MisViajesPilo.php");


}
else{
  $SESSION['noSeBorro']=True;
  header("Location:MisViajesPilo.php");
}   


