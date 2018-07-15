<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="estilos4.css">
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
		  $email=$_SESSION['email'];
		  $consulta="SELECT * FROM vehiculos WHERE Email_id = '$email' AND borrado='0'";
		  $consulta2="SELECT * FROM vehiculos WHERE Email_id = '$email' AND borrado='0' ";
          if($resultadoConsulta=mysqli_query($conexion,$consulta)){
            if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
          	  $registro44=mysqli_fetch_row($resultadoConsulta2);
          	  if($registro44[0] != ''){
                echo "<label class='misAutos'><h2>Mis Autos</h2></label>
                <div class='container3'>
			    <table class='table'>
				<thead class='thead-dark'>
					<tr>
					    <th>Patente</th>
						<th >Modelo</th>
						<th >Marca</th>
						<th>Capacidad</th>
						<th></th>
					</tr>
				</thead> 
			 	<tbody>";
			  while($registro=mysqli_fetch_array($resultadoConsulta)){	
					echo"<tr>
					    <td><a href='ModAut.php?idAuto=".$registro['id']."'>".$registro['Patente']."</td>
						<td><a href='ModAut.php?idAuto=".$registro['id']."'>".$registro['Modelo']."</td>
						<td>".$registro['Marca']."</td>
						<td>".$registro['asientos']."</td>
						<td>
                                                    <form  method='post' action='deleteAct.php'>
                                                        <input type='hidden' name='id' value='".$registro['Patente']."'>
                                                        <button type='submit' value='submit' class='btn btn-primary' Onclick='return confirmarBorrado()'> Borrar </button>
                                                    </form>
                                                </td>
					</tr>
				</tbody>";

			 }
			 echo"</table>";
             
            }
            else
           	  echo "<label class='noPoseeVeh'><h3> No posee ningun vehículo registrado.</h3></label>";
           }
       }
            if(isset($_SESSION['seBorro'])){
              $message="Se borro exitosamente";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['seBorro']);
            }
	        if(isset($_SESSION['noSeBorro'])){
              $message="No se logro borrar :( ";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['noSeBorro']);
            }



	     ?>
			<!-- Navegador de paginas-->
		</div>
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
				<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1"><</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#">></a>
				</li>
			</ul>
		</nav>
		<script type="text/javascript"> 
         function confirmarBorrado(){
           var x = confirm("Estas seguro que quieres borrar este auto?");
           if(x == true)
             return true;
           else
             return false;
         }
		</script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>