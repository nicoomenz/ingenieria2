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
        <header>
			<!-- Barra Navegador -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<a class="navbar-brand" href="PagPrin.php"><img class="avatar" src="logo.jpg"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="publicarViaje.php">Publicar viaje <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Vehiculos
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="RegVehi.php">Registrar Vehiculo</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="MisAutos.php">Ver mis Vehiculos</a>				
							</div>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="miperfil.php">Mi Perfil <span class="sr-only">(current)</span></a>
						</li>
                         <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Mis viajes
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="MisViajesPilo.php">Como Piloto</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="MisViajesCopi.php">Como copiloto</a>				
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>
        <br>
        <div class="container">
        <?php
                    
                    $viaje=$_POST['idViaje'];
                    $EmailCop=$_POST['CopilotoEmail'];        
                    
                    $consulta="SELECT Foto FROM usuarios WHERE Email = '$EmailCop'";
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
            <form class="caja" name="f1" action="RegistrarComentarioCopiloto.php" method = "post" onsubmit="return validar_Datos()">
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
                        <form   method='post' action='RegistrarComentarioCopiloto.php'>
                        <input type='hidden' name='CopEmail' value='".$EmailCop."'>
                        <input type='hidden' name='id' value='".$viaje."'>
                        <button id='botonV' type='submit' value='submit' class='btn btn-primary'> Enviar Votacion </button>
                        </form>";
           ?>
        </form>
             
                 
           
        <table class="table table-user-information" id="grilla">
                 <?php
                    $consulta2="SELECT * FROM usuarios WHERE Email = '$EmailCop'";
                    $resultadoConsulta28= mysqli_query($conexion,$consulta2);
                    $registroPi = mysqli_fetch_array($resultadoConsulta28);
                    
                 ?>
                        <tr>
                            <td>
                                <label>Nombre: 
                            </td>
                            <td>
                                <?php 
                                    $nombre = $registroPi['Nombre'];
                                        echo "$nombre";
                                ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Apellido: 
                            </td>
                            <td>
                                <?php 
                                    $apellido = $registroPi['Apellido'];
                                        echo "$apellido";
                                ?>
                                </label>
                            </td>
                        </tr>
             </table>
        </div>
        
     </body>
     
     
    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
</html>

