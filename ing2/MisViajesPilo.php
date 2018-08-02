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
                  echo "<label class='misViajes'><h2>Mis Viajes como piloto </h2></label>
                    <div class='container3'>
			    <table class='table'>
				<thead class='thead-dark'>
					<tr>
					    <th>Origen</th>
						<th>Destino</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Precio</th>
                                                <th>Postulados</th>
                                                <th>Aceptados</th>
                                                <th></th>
                                                <th></th>
					</tr>
				</thead> 
			 	<tbody>";
            $consultaPiloto="SELECT id FROM vehiculos WHERE Email_id = '$email' AND borrado='0'";
          if($resultadoConsultaPi=mysqli_query($conexion,$consultaPiloto)){
          	while($registroPilo=mysqli_fetch_array($resultadoConsultaPi)){
                    $idAuto=$registroPilo['id'];
                    $consulta="SELECT * FROM viajes WHERE auto_id= '$idAuto' AND borrado='0' ORDER BY fecha DESC";
                    $consulta2="SELECT * FROM viajes WHERE auto_id= '$idAuto' AND borrado='0' ORDER BY fecha DESC";
                    $resultadoConsulta=mysqli_query($conexion,$consulta);
                    $resultadoConsulta2=mysqli_query($conexion,$consulta2);
                    $registro2=mysqli_fetch_array($resultadoConsulta2);
                    $viaje=$registro2['id_viaje'];
                    $consulta3="SELECT COUNT(id_viaje) FROM misviajes_copiloto WHERE id_viaje = '$viaje' AND estado='aceptado'";
                    $resucon3=mysqli_query($conexion,$consulta3);
                    $arreglo_prest=mysqli_fetch_array($resucon3);
                    $aceptados=$arreglo_prest['0'];
                    $consulta4="SELECT COUNT(id_viaje) FROM misviajes_copiloto WHERE id_viaje = '$viaje' AND estado='en espera'";
                    $resucon4=mysqli_query($conexion,$consulta4);
                    $arreglo_prest2=mysqli_fetch_array($resucon4);
                    $postulados=$arreglo_prest2['0'];
                    while($registro=mysqli_fetch_array($resultadoConsulta)){	
                            $horaForm=date('g:ia', strtotime($registro['hora']));
                            if($registro['borrado'] === '0'){
				echo"<tr>
				<td>".$registro['origen']."</td>
				<td>".$registro['destino']."</td>
				<td>".$registro['fecha']."</td>
				<td>".$horaForm."</td>
				<td>$".$registro['precio']."</td>
                                <td>".$postulados."</td>
                                <td>".$aceptados."</td>
				<td>
                                    <form   method='post' action='DetallesViaje.php'>
                                        <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                        <button type='submit' value='submit' class='btn btn-primary'> Detalles </button>
                                    </form>
                                </td>";
                                
                                if($aceptados=='0'){ 
                                    echo"
                                    <td>
                                        <form   method='post' action='EliminarViaje.php'>
                                            <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                            <button type='submit' value='submit' class='btn btn-primary' Onclick='return confirmarBorrado()'> Eliminar viaje </button>
                                        </form>
                                    </td>";
                                }
                                                else{ 
                                                    echo "
                                                    <td>
                                                        <form   method='post' action='EliminarViaje.php'>
                                                            <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                                            <button type='submit' value='submit' class='btn btn-primary' Onclick='return confirmarBorradoAceptado()'> Eliminar viaje </button>
                                                        </form>
                                                    </td>";
                                                }
                                                echo"  
					</tr>
				</tbody>";

                          }
                          }
                          }   
			 echo"</table>";
             
            }
          
            if(isset($_SESSION['posdueño'])){
                        $message="¡No se puede postular, usted creo este viaje!";
                        echo "<script>
                        alert('$message') 
                        </script>";
                        unset($_SESSION['posdueño']);
                    
                }
            if(isset($_SESSION['usuarioAceptado'])){
              $message="El usuario fue aceptado, y se le envio un email de confirmacion";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['usuarioAceptado']);
            }
            
            if(isset($_SESSION['usuarioRechazado'])){
              $message="El usuario fue rechazado, y se le envio un email de aviso";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['usuarioRechazado']);
            }
            
            if(isset($_SESSION['seBorro'])){
              $message="El viaje fue eliminado correctamente";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['seBorro']);
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
                      var x = confirm("Estas seguro que quieres borrar este viaje?");
                      if(x == true)
                        return true;
                      else
                        return false;
                    }
		</script>
                <script type="text/javascript"> 
                    function confirmarBorradoAceptado(){
                      var x = confirm("Estas seguro que quieres borrar este viaje? Tienes usuarios aceptados y tu calificacion bajara");
                      if(x == true)
                        return true;
                      else
                        return false;
                    }
		</script>
                </script>
                                            <?php 
                              if(isset($_SESSION['resexitosa'])){
                                     $message="¡Se publico su respuesta correctamente!";
                    echo "<script>
                        alert('$message') 
                    </script>";
                                     unset($_SESSION['resexitosa']);
                                    }
                               ?> 
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>