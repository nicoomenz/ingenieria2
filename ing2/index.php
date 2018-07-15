<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css boostrap -->
            <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="estilos2.css">
        <title>Un aventon</title>
    </head>
    <body >
        <?php
          session_start();
          include ("class_funciones.php");
        ?>
            <div class="text-center" id="container"  >
                <img src="logo.jpg" width="100px" height="100px">
                <form class="form-signin"  action="class_login.php" method="post" onsubmit="validacion_inicioDeSesion()">
                    <h1 class="h3 mb-3 font-weight-normal">Ingrese a Un Aventon</h1>
                    <label for="inputEmail" class="sr-only">Correo Electronico</label>
                    <input  type="email" id="email" class="form-control" name="email" placeholder="Correo Electronico" autocomplete="on" required="" autofocus="">
                    <br>
                    <label for="inputPassword" class="sr-only">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required="">
                    <div class="checkbox mb-3">
                        <br>
                      <label>
                        <input type="checkbox" value="remember-me"> Recordar nombre de usuario
                      </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
                    <br>
                    ¿No eres miembro todavía?
                    <a class="btn btn-lg btn-primary btn-block" href="Registro.php" > Registrarse </a>
                    <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
                </form>
            </div>
            <?php
            if(isset($_SESSION['iniciose'])){
              $message="No existe ese usuario,Intentelo de nuevo";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['iniciose']);
            }
            ?>
        <!--js boostrap -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/loginjs.js"></script>
    </body>   
</html>

