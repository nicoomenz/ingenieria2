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
		  $consulta="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$viaje'";
                  $consulta2="SELECT * FROM misviajes_copiloto WHERE id_viaje = '$viaje'";
          if($resultadoConsulta=mysqli_query($conexion,$consulta)){
              if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
                  $consult="SELECT * FROM viajes WHERE id_viaje = '$viaje' AND borrado='0'";
                  $resultadoConsult=mysqli_query($conexion,$consult);
                  $registro=mysqli_fetch_array($resultadoConsult);
                  $idauto=$registro['auto_id'];
                  $consulta3="SELECT asientos FROM vehiculos WHERE id = '$idauto' AND borrado='0'";
                  $resultadoConsulta3=mysqli_query($conexion,$consulta3);
                  $registroAuto=mysqli_fetch_array($resultadoConsulta3);
                  $asientos=$registroAuto['asientos'];
                  $consulta4="SELECT COUNT(id_viaje) FROM misviajes_copiloto WHERE id_viaje = '$viaje' AND estado='aceptado'";
                  $resucon4=mysqli_query($conexion,$consulta4);
                  $arreglo_prest=mysqli_fetch_array($resucon4);
                  $aceptados=$arreglo_prest['0'];
                  $asientosDispo= $asientos-$aceptados;   
          	  $registro45=mysqli_fetch_row($resultadoConsulta2);
          	  if($registro45[0] != ''){
                echo "<label class='misAutos'><h2>Postulados</h2></label>
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
					echo"<tr>
                                                <td>".$registro['Email_copiloto']."</td>
                                                <td>
                                                    <div class='stars-outer'>
                                                        <div class='stars-inner'></div>
                                                    </div>
                                                        
                                                </td>
                                                <td>".$registro['estado']."</td>";
                                                
                                                if(($registro['estado'] === 'en espera') and ($asientosDispo>0)){ echo"
                                                <td>
                                                    <form  method='post' action='AceptarPostulado.php'>
                                                        <input type='hidden' name='idViaje' value='".$registro['id_viaje']."'>
                                                        <input type='hidden' name='usuarioEmail' value='".$registro['Email_copiloto']."'>
                                                        <button type='submit' value='submit' class='btn btn-primary' Onclick='return confirmarAceptado()'> aceptar </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form  method='post' action='RechazarPostulado.php'>
                                                        <input type='hidden' name='idViaje' value='".$registro['id_viaje']."'>
                                                        <input type='hidden' name='usuarioEmail' value='".$registro['Email_copiloto']."'>
                                                        <button type='submit' value='submit' class='btn btn-primary' Onclick='return confirmarRechazado()'> rechazar </button>
                                                    </form>
                                                </td>
                                            </tr>
				</tbody>";
                                                }
                                                else {
                                                        if(($registro['estado'] === 'en espera') and ($asientosDispo<=0)){ echo" 
                                                        <td>
                                                            <form  method='post' action='AceptarPostulado.php'>
                                                                <input type='hidden' name='idViaje' value='".$registro['id_viaje']."'>
                                                                <input type='hidden' name='usuarioEmail' value='".$registro['Email_copiloto']."'>
                                                                <button disabled='true' type='submit' value='submit' class='btn btn-primary' Onclick='return confirmarAceptado()'> aceptar </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form  method='post' action='RechazarPostulado.php'>
                                                                <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                                        <input type='hidden' name='usuarioEmail' value='".$registro['Email_copiloto']."'>
                                                                <button disabled='true' type='submit' value='submit' class='btn btn-primary' Onclick='return confirmarRechazado()'> rechazar </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                            </tbody>";                 
                                                        }
                                                }
                                                if ($registro['estado'] === 'aceptado' or $registro['estado'] === 'rechazado'){
                                                    echo " <td></td> 
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
            <script type="text/javascript"> 
                function confirmarRechazado(){
                  var x = confirm("Estas seguro que quieres rechazar a este usuario?");
                  if(x == true)
                    return true;
                  else
                    return false;
                }
            </script>
            <script type="text/javascript"> 
                function confirmarAceptado(){
                  var x = confirm("Estas seguro que quieres aceptar a este usuario?");
                  if(x == true)
                    return true;
                  else
                    return false;
                }
            </script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/votacionDet.js"></script>
    </body>   
</html>

