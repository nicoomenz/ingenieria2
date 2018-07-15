<html>
<head>
  <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<?php
  session_start();
  include ("class_funciones.php");
  $fun = new funciones();
  ?>

<?php  
require_once('conexionobj.php');
$email = $_POST['email'];
$password = $_POST['password'];
$fun->Autenticacion($email,$password);
?>


<body> 
</body>
</html>