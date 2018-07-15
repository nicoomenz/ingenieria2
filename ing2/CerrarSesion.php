<html>
<head>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<header>
<div id='menu'>
<?php
  session_start();
  session_unset();
  session_destroy();
  include ("class_funciones.php");
  $fun = new funciones();
  $fun->AutorizacionTitulo();
?>
 </div> 


</header>  	


<?php

setcookie("cerro", 1);
header("Location:PagPrin.php");
?>

<body> 
 </body>

