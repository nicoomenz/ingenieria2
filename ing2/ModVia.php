<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="estilos3.css">
	</head>
	<body>
     <?php
         session_start();
         include ("class_funciones.php");
         $fun = new funciones();
         $fun->AutorizacionTitulo();

		?>
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
		<?php
          include("conexion.php");
          if(isset($_GET['idviajeget'])){
                            $viaje=$_GET['idviajeget'];
                    }
                    
          $consulta = "SELECT * FROM viajes WHERE id_viaje = '$viaje' ";
          $consulta2 = "SELECT * FROM viajes WHERE id_viaje = '$viaje' ";
          if($resultadoConsulta=mysqli_query($conexion,$consulta)){
            if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
             $registro=mysqli_fetch_array($resultadoConsulta2);
            } 
          }

         ?>     <h3 class="LabelRegVeh">Modificar viaje</h3>
         <form class="regV" action="ModViaAct.php" method="post" enctype="multipart/form-data" onsubmit="return verificar_Campos();">
			<div class="form-group">
				<label for="texto1"><h5>Origen</h5></label>
				<input type="text" class="form-control" id="texto1" name="origen" placeholder="Ingresá el origen" value="<?php echo $registro['origen'] ?>">
                        </div>
			<div class="form-group">
				<label for="texto2"><h5>Destino</h5></label>
				<input type="text" class="form-control" id="texto2"  name="destino" placeholder="Ingresá el destino" value="<?php echo $registro['destino'] ?>">
			</div>
			<div class="form-group">
				<label for="texto3" ><h5>Fecha</h5></label>
                                <p><?php echo $registro['fecha'] ?></p>
				<input type="hidden" class="form-control" id="texto3" name="fecha" placeholder="Ingresá la fecha en la que viajas" value="<?php echo $registro['fecha'] ?>">
			</div>
				<div class="form-group">
				<label for="texto4" ><h5>Hora de salida</h5></label>
                                <?php $date = date_create($registro['hora']);
                                      $date2 = date_format($date, 'H:i');?>
				<input type="time" class="form-control" id="texto4" name="hora" placeholder="Ingresá la fecha en la que viajas" value="<?php echo $date2 ?>">
			</div>
                        </div>
				<div class="form-group">
				<label for="texto5" ><h5>Hora de llegada</h5></label>
                                <?php $date3 = date_create($registro['horaLlegada']);
                                      $date4 = date_format($date3, 'H:i');?>
				<input type="time" class="form-control" id="texto5" name="hora2" placeholder="Ingresá la fecha en la que viajas" value="<?php echo $date4 ?>">
			</div>
			<div class="form-group">
				<label for="texto6"><h5>Precio</h5></label>
				<input type="text" class="form-control" id="texto6" name="precio" placeholder="Ingresá el precio" value="<?php echo $registro['precio'] ?>">
			</div>
			<div class="form-group">
				<label for="texto7" ><h5>Vehiculo</h5></label>
                                <br>
				<?php
                                    $aut_mail=$_SESSION['email']; 
                                    $consulta2="SELECT * FROM  vehiculos WHERE Email_id='$aut_mail'AND borrado='0' ";
                                    $consulta8="SELECT * FROM  vehiculos WHERE Email_id='$aut_mail'AND borrado='0' ";
                                    if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
                                      $resultadoConsulta8=mysqli_query($conexion,$consulta8);
                                      if($registro8=mysqli_fetch_row($resultadoConsulta8) >'1'){
                                        echo "<select id='texto7' name='vehiculo'>"; 
                                        while($registro2=mysqli_fetch_array($resultadoConsulta2)){
                                          echo "<option value=".$registro2['id'].">".$registro2['Patente']."</option>";
                                        }
                                        echo "</select>&nbsp&nbsp";
                                      }
                                      else
                                        echo "<h5>No posee ningun vehículo registrado</h5>";
                                    }	
                                ?>
                                
			</div>
                        <input type="hidden" name="id" value="<?php echo $registro['id_viaje'] ?> ">
                        <button type="submit"  value="submit" class="btn btn-primary">Modificar </button>
		</form>
		<br>

		<?php
          if(isset($_SESSION['origenOk'])){
              $message="ingrese un origen";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['origenOk']);
           }
          if(isset($_SESSION['destinoOk'])){
              $message="ingrese un origen";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['destinoOk']);
           }
          if(isset($_SESSION['fechaOk'])){
              $message="Ingrese una fecha";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['fechaOk']);
           }
           if(isset($_SESSION['fechaMayOk'])){
              $message="Los viajes deben ser programados con una fecha posterior a la de hoy,intente otra vez";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['fechaMayOk']);
           }
           if(isset($_SESSION['horaOk'])){
              $message="Ingrese una hora";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['horaOk']);
           }
          if(isset($_SESSION['ModViaOk'])){
              $message="¡Se modificó correctamente!";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['ModViaOk']);
           }
           if(isset($_SESSION['ModViaNotOk'])){
              $message="¡No se pudo modificar el viaje!";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['ModViaNotOk']);
           }
           if(isset($_SESSION['viajeImpo'])){
              $message="El viaje no puede realizarse en la misma fecha y hora que otro";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpo']);
           }
        ?> 
                <script>
                    function verificar_Campos()
                    {
                        ok = true;
                        value = document.getElementById("texto1").value;
                        if (value == null || value == "")
                        {
                            alert("Hay campos que estan vacios.");
                            return false;
                        }
                        value = document.getElementById("texto2").value;
                        if (value == null || value == "")
                        {
                            alert("Hay campos que estan vacios.");
                            ok = false;
                        }
                        value = document.getElementById("texto3").value;
                        if (value == null || value == "")
                        {
                            alert("Hay campos que estan vacios.");
                            ok = false;
                        }
                        value = document.getElementById("texto4").value;
                        if (value == null || value == "")
                        {
                            alert("Hay campos que estan vacios.");
                            ok = false;
                        }
                        value = document.getElementById("texto5").value;
                        if (value == null || value == "")
                        {
                            alert("Hay campos que estan vacios.");
                            ok = false;
                        }
                        value = document.getElementById("texto6").value;
                        if (value == null || value == "")
                        {
                            alert("Hay campos que estan vacios.");
                            ok = false;
                        }
                        return ok;
                    }
                </script>    
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
		
	</body>
</html>