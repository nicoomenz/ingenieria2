<?php
            session_start();
            include ("conexion.php");
            include ("class_funciones.php");
            $fun = new funciones();
            $fun->AutorizacionTitulo();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css boostrap -->
            <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="estilos5.css">
    </head>
    
    <body>
        
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
        
        <div class="container">
            <div>
                <?php
                    $email = $_POST['usuarioEmail'];
                    $consulta="SELECT Foto FROM usuarios WHERE Email = '$email'";
                    if($resul=mysqli_query($conexion,$consulta)){
                      $row=mysqli_fetch_array($resul);
                      $consulta2="SELECT * FROM usuarios WHERE Email = '$email'";
                      if($resul2=mysqli_query($conexion,$consulta2)){
                         $row2=mysqli_fetch_array($resul2);
                      }
                    }
                    else
                        echo "no encuetra";
                    
                    if($row['Foto'] == null || $row2['borrado'] == 1)
                        echo '<img src="icono_users.png" class="avatarPerfil" />';
                    else
                        echo '<img class="avatarPerfil" src="data:image/jpeg;base64,'.base64_encode($row['Foto']).'" />';
                    
                    
                    
                ?>  
                <br>
                <br>
            </div>
                <?php
                    
                    $consulta2="SELECT * FROM usuarios WHERE Email = '$email'";
                    $resultadoConsulta28= mysqli_query($conexion,$consulta2);
                    $registro28 = mysqli_fetch_array($resultadoConsulta28);
                
                ?>
                <div class="formulario">
                    <table class="table table-user-information">
                        <tr>
                            <td>
                                <label>Nombre: 
                            </td>
                            <td>
                                <?php 
                                        if ($row2['borrado'] == 1)
                                        {
                                            echo "-";
                                        }
                                        else {
                                           $nombre = $registro28['Nombre'];
                                           echo "$nombre";
                                        }
                                    
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
                                      if ($row2['borrado'] == 1)
                                      {
                                          echo "-";
                                      }
                                      else
                                      {
                                        $apellido = $registro28['Apellido'];
                                        echo "$apellido";
                                      }                                   
                                ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Correo Electronico: 
                            </td>
                            <td>                          
                                <?php 
                                        if ($row2['borrado'] == 1)
                                        {
                                            echo "-";
                                        }
                                        else {
                                            echo "$email";                                 
                                        }
                                ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Fecha de Nacimiento: 
                            </td>
                            <td>
                                <?php 
                                    
                                        $fecha = $registro28['Fecha_Nac'];
                                        echo "$fecha";
                                    
                                ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Su reputacion como piloto: 
                            </td>
                            <td>
                                <?php 
                                   $consulta3 = "SELECT SUM(calificacion) as total FROM votaciones WHERE Email_piloto = '$email' AND piloto_copiloto= 0";
                                   $resultado = $conexion -> query($consulta3);
                                   $row = $resultado -> fetch_assoc();
                                   if ($row["total"] < 0 || $row["total"] == null)
                                   {
                                       echo 0;
                                   }
                                   else
                                   {
                                       echo $row["total"];
                                   }
                                ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Su reputacion como copiloto: 
                            </td>
                            <td>
                                <?php 
                                   $consulta4 = "SELECT SUM(calificacion) as total FROM votaciones WHERE Email_copiloto = '$email' AND piloto_copiloto= 1";
                                   $resultado2 = $conexion -> query($consulta4);
                                   $row2 = $resultado2 -> fetch_assoc();
                                   if ($row2["total"] < 0 || $row2["total"] == null)
                                   {
                                       echo 0;
                                   }
                                   else
                                   {
                                       echo $row2["total"];
                                   }
                                ?>
                                </label>
                            </td>
                        </tr>
                    </table>
                    
                </div> 
        </div>

        <?php
            echo "
            <div>
            <label id='titulo3' style='margin-top:360px'>Votaciones recibidas como piloto</label>";
            $email = $_POST['usuarioEmail'];
            $consulta="SELECT * FROM votaciones WHERE Email_piloto = '$email' AND piloto_copiloto = 0";
            $resultadoConsulta=mysqli_query($conexion,$consulta);
            echo "<br>";
            while($registro=mysqli_fetch_array($resultadoConsulta)){
                    $comentario = $registro['comentario'];
                    $emailcopi = $registro['Email_copiloto'];
                    $res = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Email = '$emailcopi'");
                    $reg = $res -> fetch_assoc();
                    $nombre = $reg['Nombre'];
                    $apellido = $reg['Apellido'];   
                    if ($reg['borrado'] == 0)
                    {
                       $img = base64_encode($reg['Foto']);
                    }
                    else
                    {
                        
                       $img = base64_encode(file_get_contents('icono_users.png'));
                    }
                    $puntuacion = $registro['calificacion'];
                    echo "
                       <img style='vertical-align: middle; width: 90px; height: 90px; border-radius: 50%; border-style: double; margin-left: 110px; margin-bottom: 10px;' src='data:image/jpeg;base64,$img'/>
                       <label style='text-align: center; overflow: hidden; margin-left: 66px; margin-top: 10px; font-size: 100%; width: 170px; height: 50px; border-color: #000000; border-style: double; background-color: #ff4d4d'> $nombre $apellido </label>
                       <label style='margin-left: auto; margin-right: auto; margin-top: -100px; border-color: #ff4d4d; border-style: solid; width: 500px; height: 70px; overflow: hidden;'> $comentario </label>
                       <label style='margin-left: 1000px; margin-top: -76px; font-size: 130%; width: 200px; border-color: #8b8282; border-style: solid;'> Puntuacion del copiloto: $puntuacion </label>    
                       <hr style='color: #0056b2; margin-top: 70px;'/>";
                  }
            echo"</div>";
            echo "
            <div>
            <label id='titulo3' style='margin-top:30px'>Votaciones recibidas como copiloto</label>";
            $consulta="SELECT * FROM votaciones WHERE Email_copiloto = '$email' AND piloto_copiloto = 1";
            $resultadoConsulta=mysqli_query($conexion,$consulta);
            echo "<br>";
            while($registro=mysqli_fetch_array($resultadoConsulta)){
                    $comentario = $registro['comentario'];
                    $emailpilo = $registro['Email_piloto'];
                    $res = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Email = '$emailpilo'");
                    $reg = $res -> fetch_assoc();
                    $nombre = $reg['Nombre'];
                    $apellido = $reg['Apellido'];   
                    if ($reg['borrado'] == 0)
                    {
                       $img = base64_encode($reg['Foto']);
                    }
                    else
                    {
                        
                       $img = base64_encode(file_get_contents('icono_users.png'));
                    }
                    $puntuacion = $registro['calificacion'];
                    if ($comentario != null || $comentario != '')
                    {
                    echo "
                       <img style='vertical-align: middle; width: 90px; height: 90px; border-radius: 50%; border-style: double; margin-left: 110px; margin-bottom: 10px;' src='data:image/jpeg;base64,$img'/>
                       <label style='text-align: center; overflow: hidden; margin-left: 66px; margin-top: 10px; font-size: 100%; width: 170px; height: 50px; border-color: #000000; border-style: double; background-color: #ff4d4d'> $nombre $apellido </label>
                       <label style='margin-left: auto; margin-right: auto; margin-top: -100px; border-color: #ff4d4d; border-style: solid; width: 500px; height: 70px; overflow: hidden;'> $comentario </label>
                       <label style='margin-left: 1000px; margin-top: -76px; font-size: 130%; width: 200px; border-color: #8b8282; border-style: solid;'> Puntuacion del piloto: $puntuacion </label>    
                       <hr style='color: #0056b2; margin-top: 70px;'/>";
                    }
                  }
            echo"</div>";
        ?>
        
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

