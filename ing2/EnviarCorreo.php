<?php
            
   session_start();
   include ("conexion.php");
   
   if ($conexion)
   {
      if (isset($_POST['inputCorreo']))
      {
          $correo = $_POST['inputCorreo'];
          $res = mysqli_query($conexion,"SELECT Email FROM usuarios WHERE Email='$correo'");
          $registro = mysqli_fetch_row($res);
          if ($registro != null)
          {
              //ini_set("sendmail_from","UnAventonSoporteTecnico@gmail.com")
              //$WAGLOBAL_Email_Server = "" ;
              //$registro = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Email = $correo");
              //$from = "UnAventonSoporteTecnico@gmail.com";
              //$to = $correo;
              //$subject = "Recuperar contraseña";
              //$message = "Estimado " . $registro['Nombre'] . " " . $registro['Apellido'] . ", hemos recibido un pedido para recuperar la contraseña de su cuenta en Un Aventon. Su contraseña es: " . $registro['Password'] . ". Le recomendamos que cambie su contraseña a una mas facil de memorizar. ¡Que tenga un buen dia!";
              //$headers = "From:" . $from;
              //mail($to,$subject,$message, $headers);
              $_SESSION['emailEnviado'] = false;
              header("Location:index.php");
          }
          else
          {
              $_SESSION['mailEquivocado'] = false;
              header("Location:RecuperarContraseña.php");
          }
      }
   }
    else{
    echo "Ha surgido un error.";
    header("Location:RecuperarContraseña.php");
    }
       