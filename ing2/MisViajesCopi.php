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
          if(isset($_SESSION['iniciose'])){
            echo "No existe ese usuario,Intentelo de nuevo";
            unset($_SESSION['iniciose']);
           }
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
		<!-- tabla de resultados -->
		<?php
		  include("conexion.php");
		  $email=$_SESSION['email'];
                  echo "<label class='misViajes'><h2>Mis Viajes como copiloto </h2></label>
                  <div class='container3'>
			    <table class='table'>
				<thead class='thead-dark'>
					<tr>
					    <th>Origen</th>
						<th>Destino</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Precio</th>
                                                <th>Estado</th>
                                                <th></th>
                                                <th></th>
					</tr>
				</thead> 
			 	<tbody>";
		  $consultaCoPiloto="SELECT * FROM misviajes_copiloto WHERE Email_copiloto ='$email'";
          if($resultadoConsultaCoPi=mysqli_query($conexion,$consultaCoPiloto)){
            while($registroCoPilo=mysqli_fetch_array($resultadoConsultaCoPi)){
          	$idViaCopi=$registroCoPilo['id_viaje'];
                $estadoCopi=$registroCoPilo['estado'];
                $consulta="SELECT * FROM viajes WHERE id_viaje= '$idViaCopi'";
                $resultadoConsulta=mysqli_query($conexion,$consulta);
                while($registro=mysqli_fetch_array($resultadoConsulta)){	
                        $horaForm=date('g:ia', strtotime($registro['hora']));
                                                
                                                  echo"<tr>
                                                          <td>".$registro['origen']."</td>
                                                          <td>".$registro['destino']."</td>
                                                          <td>".$registro['fecha']."</td>
                                                          <td>".$horaForm."</td>
                                                          <td>$".$registro['precio']."</td>
                                                          <td>".$estadoCopi."</td>                                                  
                                                          <td>
                                                            <form  method='post' action='DetallesViaje.php'>
                                                                <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                                                <button type='submit' value='submit' class='btn btn-primary'> Detalles </button>
                                                            </form>
                                                          </td>";
                                                          if ($estadoCopi === 'aceptado'){
                                                              echo "<td><a href='PagarViaje.php?id_viaje=".$registro['id_viaje']."'>Pagar viaje</a></td>
                                                                  
                                                                  ";
                                                          }
                                                           echo "
                                                      </tr>
                                                  
				</tbody>";

                                }
                                }
			 echo"</table>";    
       }
            if(isset($_SESSION['posexitoso'])){
                    $message="¡Se postulo correctamente!";
                    echo "<script>
                        alert('$message') 
                    </script>";
                    unset($_SESSION['posexitoso']);
                }
                if(isset($_SESSION['posdenegado'])){
                   $message="¡ya esta postulado!";
                    echo "<script>
                        alert('$message') 
                    </script>";
                    unset($_SESSION['posdenegado']);
                }
                if(isset($_SESSION['usuarioEliminado'])){
                   $message="¡Usted ha salido del viaje, y se le notifico al Piloto del mismo!";
                    echo "<script>
                        alert('$message') 
                    </script>";
                    unset($_SESSION['usuarioEliminado']);
                }   
            
                if(isset($_SESSION['votexitosa'])){
                    $message="Su voto fue registrado";
                    echo "<script>
                    alert('$message') 
                    </script>";
                    unset($_SESSION['votexitosa']);
                }
                
                 if(isset($_SESSION['pregexitosa'])){
                    $message="Se registro su pregunta";
                    echo "<script>
                    alert('$message') 
                    </script>";
                    unset($_SESSION['pregexitosa']);
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
                                            <?php 
                               ?> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>