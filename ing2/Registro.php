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
    <body class="text-center" id="container">
        <img src="logo.jpg" width="100px" height="100px">
        <form class="form-signin" name="f1" action="RegistrarAction.php" method = "post" onsubmit="return validacion_registro()">
            <h1 class="h3 mb-3 font-weight-normal">Ingrese sus datos</h1>
            
            <label for="inputNombre" class="sr-only">Nombre</label>
            <input type="text" id="inputNombre" class="form-control" name="nombre" placeholder="Nombre" required="" autofocus="">
            <?php
                
                if(isset($_SESSION['nomesta'])){
                    echo "Campo de nombre vacio,vuelva a intentarlo ingresando un nombre valido.";
                    unset($_SESSION['nomesta']);
                }
            ?> 
            <br>
            
            <label for="inputApellido" class="sr-only">Apellido</label>
            <input type="text" id="inputApellido" class="form-control" name="apellido" placeholder="Apellido"  autofocus="">
            <?php
                if(isset($_SESSION['regexitoso'])){
                    $message="¡Se registró correctamente!";
                    echo "<script>
                        alert('$message') 
                    </script>";
                    unset($_SESSION['regexitoso']);
                }
            
                if(isset($_SESSION['apesta'])){
                   $message="Campo de apellido vacio,vuelva a intentarlo ingresando un apellido valido.";
                    echo "<script>
                        alert('$message') 
                    </script>";
                    unset($_SESSION['apesta']);
                }
                
                
            ?> 
            <br>
            fecha de nacimiento
            <label for="fechaNac" class="sr-only">Fecha</label>
            <input class="form-control " id="fechaNac" type="date" name="bday"  min="1900-01-02" placeholder="Fecha de Nacimiento" required="" autofocus="">
            <?php           
              
                
                
                if(isset($_SESSION['fechesta'])){
                   $message= "Campo de fecha vacio o usted es menor de edad,vuelva a intentarlo ingresando una fecha valida.";
                   echo "<script>
                                alert('$message') 
                            </script>";
                   unset($_SESSION['fechesta']);
                }
            ?> 
            <br>
            
            <label  for="inputEmail" class="sr-only">Correo Electronico</label>
            <input  type="email" id="inputEmail" class="form-control" name="email" placeholder="Correo Electronico" required="" autofocus="">
            <?php
                if(isset($_SESSION['mailesta'])){
                    $message= "Campo de email vacio,vuelva a intentarlo ingresando un email valido.";
                    echo "<script>
                                alert('$message') 
                            </script>";
                    unset($_SESSION['mailesta']);
                }
                else
                    if(isset($_SESSION['mailesvalido'])){
                        $message= "Campo de email incorrecto,vuelva a intentarlo ingresando un email valido.";
                        echo "<script>
                                alert('$message') 
                            </script>";
                        unset($_SESSION['mailesvalido']);
                    }
            ?> 
            <br>
            
            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" id="inputPassword" class="form-control" name="contraseña1" placeholder="Contraseña" required="">
            <?php
                if(isset($_SESSION['contraesta'])){
                   echo "Campo de contraseña vacio,vuelva a intentarlo ingresando una contraseña valida.";
                   unset($_SESSION['contraesta']);
                }
                if(isset($_SESSION['contranoigual'])){
                  echo "Las contraseñas no coinciden,vuelva a intentarlo.";
                  unset($_SESSION['contranoigual']);
                }
                if(isset($_SESSION['contramenos'])){
                   echo "La contraseña debe contener al menos 6 caracteres,intentelo de nuevo.";
                   unset($_SESSION['contramenos']);
                }
                if(isset( $_SESSION['contracualquiera'])){
                  echo "La contraseña posee formato invalido,ingrese al menos un numero o caracter especial";
                   unset($_SESSION['contracualquiera']);
                }
            ?> 
            <br>
            
            <label for="inputPassword2" class="sr-only">Confirmar Contraseña</label>
            <input type="password" id="inputPassword2" class="form-control" name="contraseña2" placeholder="Confirmar Contraseña" required="">
            <?php
                if(isset($_SESSION['contraesta2'])){
                   echo "Campo de confirmacion de contraseña vacio,vuelva a intentarlo ingresando una contraseña valida.";
                   unset($_SESSION['contraesta2']);
                }
                if(isset($_SESSION['contramenos'])){
                   echo "La contraseña debe contener al menos 6 caracteres,intentelo de nuevo.";
                   unset($_SESSION['contramenos']);
                }
                if(isset( $_SESSION['contracualquiera2'])){
                  echo "La confirmacion de la contraseña posee formato invalido,ingrese al menos un numero o caracter especial";
                  unset($_SESSION['contracualquiera2']);
                }
            ?>
            <br>
            
            <button type="submit" class="btn btn-lg btn-primary btn-block" value="submit">Registrarse</button>
            <br>
            ¿Ya eres un miembro?
            <a class="btn btn-lg btn-primary btn-block" href="index.php" > Acceder </a>
            <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
        </form>


        <?php
          if(isset($_SESSION['regexitoso'])){
              $message="¡Se registró correctamente!";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['regexitoso']);
           }
            if(isset($_SESSION['userYaEsta'])){
              $message="El email ya fue registrado,intente de nuevo.";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['userYaEsta']);
           }
        
        
        ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/loginjs.js"></script>
    </body>
</html>
