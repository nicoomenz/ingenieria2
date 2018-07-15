<?php
session_start();
include ("class_funciones.php");
$fun = new funciones();
$fun->AutorizacionTitulo();
?>
<?php

include("conexion.php");

$id=$_POST['id'];

$consulta="UPDATE vehiculos SET  borrado='1' WHERE Patente='$id'";


$resultado=mysqli_query($conexion , $consulta);
if($resultado){
       $_SESSION['seBorro']=True;
       header("Location:MisAutos.php");


}
else{
  $SESSION['noSeBorro']=True;
  header("Location:MisAutos.php");
}   









?>