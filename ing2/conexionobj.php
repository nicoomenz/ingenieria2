<?php
class Conectar
{
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $database = "grupo38";


 public  function con(){
   $conexion = new mysqli("localhost" , "root" , "" , "grupo38");
   if ($conexion -> connect_error){
   	die ("error de conexion");
   }
   return $conexion;
 }
}

?>