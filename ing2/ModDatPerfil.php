<?php
         session_start();
         include ("conexion.php");
         include ("class_funciones.php");
         $fun = new funciones();
         $fun->AutorizacionTitulo();

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css boostrap -->
            <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="estilos2.css">
        <link rel="stylesheet" href="estilos3.css">
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
    <div class="text-center" id="container">
        
        <img src="logo.jpg" width="100px" height="100px">
        <form class="form-signin" name="f1" action="ModDatPerfilAction.php" method = "post" onsubmit="return validacion_registro()">
            <h1 class="h3 mb-3 font-weight-normal">Ingrese sus datos</h1>
            <?php
                $email = $_SESSION['email'];
                
                $consulta = "SELECT * FROM usuarios WHERE Email = '$email'";
                if($resultadoConsulta=mysqli_query($conexion,$consulta)){
                    $registro=mysqli_fetch_array($resultadoConsulta);
                }
            
            ?>
            <label for="inputNombre" class="sr-only">Nombre</label>
            <input type="text" id="inputNombre" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $registro['Nombre']?>" autofocus="">
            <?php
                if(isset($_SESSION['nomesta'])){
                    echo "Campo de nombre vacio,vuelva a intentarlo ingresando un nombre valido.";
                    unset($_SESSION['nomesta']);
                }
            ?> 
            <br>
            
            <label for="inputApellido" class="sr-only">Apellido</label>
            <input type="text" id="inputApellido" class="form-control" name="apellido" placeholder="Apellido" value="<?php echo $registro['Apellido']?>" autofocus="">
            <?php
                if(isset($_SESSION['apesta'])){
                   echo "Campo de apellido vacio,vuelva a intentarlo ingresando un apellido valido.";
                   unset($_SESSION['apesta']);
                }
                
            ?> 
            <br>
          
            <label for="fechaNac" class="sr-only">Fecha</label>
            <input class="form-control " id="fechaNac" type="date" name="bday" value="<?php echo $registro['Fecha_Nac']?>" min="1900-01-02">
            <?php
                
                if(isset($_SESSION['fechesta'])){
                   echo "Campo de fecha vacio,vuelva a intentarlo ingresando una fecha valida.";
                   unset($_SESSION['fechesta']);
                }
                if(isset($_SESSION['modPerf'])){
                  echo "¡Se registro correctamente!";
                  unset($_SESSION['modPerf']);
                }
            ?> 
            <br>
            <button type="submit" class="btn btn-lg btn-primary btn-block" value="submit">Modificar</button>
            <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
        </form>
        
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/loginjs.js"></script>
    </div>
    </body>
</html>

