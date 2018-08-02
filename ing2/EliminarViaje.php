<?php
session_start();
include ("class_funciones.php");
$fun = new funciones();
$fun->AutorizacionTitulo();
?>
<?php
include("conexion.php");
$id=$_POST['id'];
$consulta="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$id' AND estado = 'aceptado'";
$consulta2="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$id' AND estado = 'aceptado'";
$consulta4="SELECT * FROM viajes WHERE id_viaje = '$id'";
if($resultadoConsulta=mysqli_query($conexion,$consulta)){ //esta consulta es por si hay usuarios copilotos aceptados
    $resultadoConsulta4=mysqli_query($conexion,$consulta4);
    $registro2=mysqli_fetch_array($resultadoConsulta4);
    $autoid = $registro2['auto_id'];
    $consulta5 = "SELECT * FROM vehiculos WHERE id = '$autoid'";
    $resultadoConsulta5=mysqli_query($conexion,$consulta5);
    $reg = mysqli_fetch_array($resultadoConsulta5);
    $mailid = $reg['Email_id'];
    $consulta6 = "SELECT * FROM usuarios WHERE Email = '$mailid'";
    $resultadoConsulta6=mysqli_query($conexion,$consulta6);
    $regusuario = mysqli_fetch_array($resultadoConsulta6);
    if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
        while($registro=mysqli_fetch_array($resultadoConsulta)){
            mysqli_query($conexion, "INSERT INTO`votaciones`(`id_votacion`, `piloto_copiloto`, `Email_piloto`, `Email_copiloto`, `patente`, `calificacion`, `comentario`, `id_viaje`) VALUES ('0', '0' , '$mailid', 'x', 'xxx', '-1', '', '0')"); 
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
?>  


