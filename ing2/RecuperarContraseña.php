<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css boostrap -->
            <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="estilos2.css">
    </head>
    <?php

  session_start();
  include ("class_funciones.php");
  $fun = new funciones();


    ?> 
    <body class="text-center" id="container2">
        <img src="logo.jpg" width="100px" height="100px">
        <form class="form-signin" name="f1" action="EnviarCorreo.php" method = "post" onsubmit="return validar_Correo();">
            <h1 class="h3 mb-3 font-weight-normal" width="500px">Para poder recuperar su contraseña, debera ingresar el correo electronico correspondiente a su cuenta.</h1>        
            <br>
            <br>
            <label for="inputCorreo" class="sr-only" style="border-color: #ff4d4d; border-style: solid;">Correo electronico</label>
            <input type="text" id="inputCorreo" class="form-control" name="inputCorreo" placeholder="Correo electronico">
            <br>
            <button type="submit" class="btn btn-lg btn-primary btn-block" value="submit"> Continuar </button>
            <br>
            <a class="btn btn-lg btn-primary btn-block" href="index.php" > Regresar al inicio </a>
            <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
            <script>
            
              function validar_Correo()
              {
                value = document.getElementById("inputCorreo").value;
                
                if (value != "" && value != null && (value.indexOf('@') != -1))
                {
                    return true;
                }
                else
                {
                    if (value == "" || value == null)
                    {
                        alert('Campo de correo electronico vacio.');
                        return false;
                    }
                    else
                    {
                        alert('Correo electronico invalido.');
                        return false; 
                    }
                }
             }
               
            </script>   
        </form>     
                   <?php          
                if(isset($_SESSION['mailEquivocado'])){
                    $message = "El correo electronico ingresado no existe. Por favor, ingrese un correo electronico valido.";
                    echo "<script> alert('$message') </script>";
                    unset($_SESSION['mailEquivocado']);
                }
            ?> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/loginjs.js"></script>
    </body>
</html>

