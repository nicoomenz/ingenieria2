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
          $idAuto= $_GET['idAuto']; 
          $consulta = "SELECT * FROM vehiculos WHERE id= '$idAuto' ";
          if($resultadoConsulta=mysqli_query($conexion,$consulta)){
             $registro=mysqli_fetch_array($resultadoConsulta);
          } 
          

         ?>

		<h3 class="LabelRegVeh">Modificar Vehículo</h3>
		<form class="regV" action="ModVehiAct.php" method="post" enctype="multipart/form-data" onsubmit="return validacion()">
			<label><h5>Patente</h5></label>
			<p><?php echo $registro['Patente'] ?></p>
			<div class="form-group">
				<label for="texto2"><h5>Modelo</h5></label>
				<input type="text" class="form-control"  id="texto2" name="modelo" placeholder="Ingresá el modelo" value="<?php echo $registro['Modelo'] ?>">
			</div>
			<div class="form-group">
				<label for="texto3"><h5>Marca</h5></label>
				<input type="text" class="form-control"  name="marca" id="texto3" placeholder="Ingresá la marca" value="<?php echo $registro['Marca'] ?>">
			</div>
			<div class="form-group">
				<label for="texto4" ><h5>Capacidad</h5></label>
				<input type="text" class="form-control"  name="capacidad" id="texto4" placeholder="Ingresá la cantidad de asientos" value="<?php echo $registro['asientos'] ?>">
			</div>
			<input type="hidden" name="id" value="<?php echo $registro['id'] ?> ">
			<button type="submit"  value="submit" class="btn btn-primary">Modificar </button>
		</form>
		<br>
		<?php
          if(isset($_SESSION['ModvehiOk'])){
              $message="¡Se modificó correctamente!";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['ModvehiOk']);
           }
        ?> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/ModAutJava.js"></script>
		
	</body>
</html>