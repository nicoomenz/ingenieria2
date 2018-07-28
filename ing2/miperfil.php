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
                    $email = $_SESSION['email'];
                    $consulta="SELECT Foto FROM usuarios WHERE Email = '$email'";
                    if($resul=mysqli_query($conexion,$consulta)){
                      $row=mysqli_fetch_array($resul);
                    }
                    else
                        echo "no encuetra";
                    
                    if($row['Foto'] == null)
                        echo '<img src="icono_users.png" class="avatarPerfil" />';
                    else
                        echo '<img class="avatarPerfil" src="data:image/jpeg;base64,'.base64_encode($row['Foto']).'" />';
                    
                    
                    
                ?>   
                    <br>
                    <br>
                    <div style="display: block;">
                    <div class="seccionFile">
                        <div class="seccionFile2">
                            <p class="parrafButton text-center">Elegir Foto</p>
                            <div class="divFile">
                                <form class="form-control" action="cambiarFoto.php" method = "post" enctype="multipart/form-data">
                                    <input class="inputFile" type="file"  name="imagen" id="imagen">
                            </div>
                        </div>
                    </div>
                    <div class="seccionSubmit">
                        <div class="seccionSubmit2">
                            <p class="parrafButton text-center">Subir Foto</p>
                            <div class="divFile">
                                <input class="inputSubmit divSubmit" type="submit" value="Upload Image" name="submit">
                            </div>                 
                        </div>       
                    </div>
                                </form>
                    </div>       
                            
                        
                    
                    <?php
                        if(isset($_SESSION['fotexitoso'])){
                            
                            echo "¡se subio la foto correctamente!";
                            unset($_SESSION['fotexitoso']);
                          }
                        if(isset($_SESSION['fotnoexitoso'])){
                            $message= "Archivo no permitido, es un tipo de archivo prohibido o excede el tamano de Kilobytes";
                            echo "<script>
                                alert('$message') 
                            </script>";
                            unset($_SESSION['fotnoexitoso']);
                          }
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
                                    $nombre = $registro28['Nombre'];
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
                                    $apellido = $registro28['Apellido'];
                                        echo "$apellido";
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
                                    echo "$email";
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
                    </table>
                    <a class="btn btn-sm btn-primary btn-block" id="boton2" href="ModDatPerfil.php" >Modificar mis datos </a>
                </div> 
        </div>
        
        
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>