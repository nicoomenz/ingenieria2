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
		

		<h3 class="LabelRegVeh">Registrá tu vehículo</h3>
		<form class="regV" action="AltaVehiAct.php" method="post" enctype="multipart/form-data" onsubmit="return validacion()">
			<div class="form-group">
				<label for="texto1"><h5>Patente</h5></label>
				<input type="text" class="form-control" id="texto1" name="patente" placeholder="Ingresá la patente">
			
			<div class="form-group">
				<label for="texto2"><h5>Modelo</h5></label>
				<input type="text" class="form-control" id="texto2"  name="modelo" placeholder="Ingresá el modelo">
			</div>
			<div class="form-group">
				<label for="texto3"><h5>Marca</h5></label>
				<input type="text" class="form-control" id="texto3" name="marca" placeholder="Ingresá la marca">
			</div>
			<div class="form-group">
				<label for="texto4" ><h5>Capacidad</h5></label>
				<input type="text" class="form-control" id="texto4" name="capacidad" placeholder="Ingresá la cantidad de asientos">
			</div>
			<button type="submit"  value="submit" class="btn btn-primary">Registrar </button>
		</form>
		<br>
		<?php
          if(isset($_SESSION['regvehiOk'])){
              $message="¡Se registró correctamente!";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['regvehiOk']);
           }
           if(isset($_SESSION['vehiRep'])){
              $message="La patente ya esta registrada";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['vehiRep']);
           }
           if(isset($_SESSION['noEntro'])){
              $message="No entro";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['noEntro']);
           }
        ?> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/RegAutJava.js"></script>
		
	</body>
</html>