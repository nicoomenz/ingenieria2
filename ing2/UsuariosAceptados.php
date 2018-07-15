<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- css boostrap -->
            <link rel="stylesheet" href="css/bootstrap.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="estilos4.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <title>Un aventon</title>
    </head>
    <?php
          session_start();
          include ("class_funciones.php");
          $fun = new funciones();
          $fun->AutorizacionTitulo();
          if(isset($_SESSION['iniciose'])){
            echo "No existe ese usuario,Intentelo de nuevo";
            unset($_SESSION['iniciose']);
           }
    ?>
    <body >
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
		  //ENVIAR ID DEL VIAJE, COMO ?
                  
                  $viaje= $_POST['id'];                  
		  $consulta="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$viaje' AND estado = 'aceptado'";
                  $consulta2="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$viaje' AND estado = 'aceptado'";
          if($resultadoConsulta=mysqli_query($conexion,$consulta)){
              if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
          	  $registro45=mysqli_fetch_row($resultadoConsulta2);
          	  if($registro45[0] != ''){
                echo "<label class='misAutos'><h2>Usuarios Aceptados</h2></label>
                <div class='container3'>
			    <table class='table'>
				<thead class='thead-dark'>
					<tr>
					    <th>Nombre</th>
                                            <th>Calificacion</th>
                                            <th>Estado</th>
                                            <th></th>
                                            <th></th>
					</tr>
				</thead> 
			 	<tbody>";
			  while($registro=mysqli_fetch_array($resultadoConsulta)){
                              if ($registro['estado'] === 'aceptado'){
					echo"<tr>
                                                <td>".$registro['Email_copiloto']."</td>
                                                <td>
                                                    <div class='stars-outer'>
                                                        <div class='stars-inner'></div>
                                                    </div>
                                                        
                                                </td>
                                                <td>".$registro['estado']."</td>
                                                <td>
                                                    <form  method='post' action='PerfilAceptado.php'>
                                                        <input type='hidden' name='usuarioEmail' value='".$registro['Email_copiloto']."'>
                                                        <button type='submit' value='submit' class='btn btn-primary'> perfil </button>
                                                    </form>
                                                </td>
                                                <td></td>
                                                ";
                                                
                                                  
                                                        
                                                
                                               
                                                }
			 }
			 echo"</table>";
                         
                  }
                  else{
           	  echo "<label class='noPoseeVeh'><h3> No hay usuarios postulados.</h3></label>";
           }
       }
          }
            
	             



	     ?> 
        
        
        
        <!--js boostrap -->
            
            
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/votacionDet.js"></script>
    </body>   
</html>



