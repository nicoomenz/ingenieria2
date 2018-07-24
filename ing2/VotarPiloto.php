<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css boostrap -->
            <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="estilos6.css">
        <title>Un aventon</title>
    </head>
    <?php
      session_start();
            include ("conexion.php");
            include ("class_funciones.php");
            $fun = new funciones();
            $fun->AutorizacionTitulo();
      ?>
    
    <script>
        function validar_Datos()
        {
           valor = document.getElementById("cajatexto").value;
    
           if (valor == null || valor == "")
           {
              window.alert('El campo comentario esta vacio.');
              return false;
           }
    
        valor2 = document.getElementById("puntaje").value;
        if (valor2 == -2)
        {
           window.alert('No se ha seleccionado un puntaje.');
           return false;
        }
    
         return true;
       }
     </script>
    <body style="background-color: white">
        <div class="container">
        <?php
                    
                    $viaje=$_POST['idViaje'];
                    $consulta4="SELECT * FROM viajes WHERE id_viaje = '$viaje' AND borrado='0'";
                    $consulta5="SELECT * FROM viajes WHERE id_viaje = '$viaje' AND borrado='0'";
                    if($resultadoConsulta4=mysqli_query($conexion,$consulta4)){
                        if($resultadoConsulta5=mysqli_query($conexion,$consulta5)){
                            $registro4=mysqli_fetch_array($resultadoConsulta4);
                            $idauto=$registro4['auto_id'];                
                            $consulta6="SELECT Email_id FROM vehiculos WHERE id = '$idauto' AND borrado='0'";
                            $resultadoConsulta6=mysqli_query($conexion,$consulta6);
                            $registro6=mysqli_fetch_array($resultadoConsulta6);
                            $EmailAuto=$registro6['Email_id'];
                        }
                    }
                    
                    $consulta="SELECT Foto FROM usuarios WHERE Email = '$EmailAuto'";
                    if($resul=mysqli_query($conexion,$consulta)){
                      $row=mysqli_fetch_array($resul);
                    }
                    else
                        echo "no encuetra";
                    
                    if($row['Foto'] == null)
                        echo '<img id="fotoV" src="icono_users.png" class="avatarPerfil" />';
                    else
                        echo '<img id="fotoV" class="avatarPerfil"  src="data:image/jpeg;base64,'.base64_encode($row['Foto']).'" />';      
                     
                ?>   
        <form class="caja" name="f1" action="RegistrarComentarioYVotoAPiloto.php" method = "post" onsubmit="return validar_Datos()">
           <label id="comentario">Ingrese un comentario</label>
           
             <textarea name="cajatexto" value="comentario" class="textarea" id="cajatexto" aria-label="Comentario"></textarea>
             <label id="puntuacion">Seleccione una puntuacion</label>
              <select type="number" name="puntaje" value="puntaje" id="puntaje">
                <option value="-2">Seleccione una puntuacion</option>
                <option value="1">Bueno (+1)</option>
                <option value="0">Regular (0)</option>
                <option value="-1">Malo (-1)</option>
              </select>
           <?php echo"
                        <form   method='post' action='RegistrarComentarioYVotoAPiloto.php'>
                        <input type='hidden' name='id' value='".$viaje."'>
                        <button id='botonV' type='submit' value='submit' class='btn btn-primary'> Enviar Votacion </button>
                        </form>";
           ?>
        </form>
             
                 <?php
                    $consulta2="SELECT * FROM usuarios WHERE Email = '$EmailAuto'";
                    $resultadoConsulta28= mysqli_query($conexion,$consulta2);
                    $registroPi = mysqli_fetch_array($resultadoConsulta28);
                    
                 ?>
           
        
        </div>
        
     </body>
     
     
    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
</html>

