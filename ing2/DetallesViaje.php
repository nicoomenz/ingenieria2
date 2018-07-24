<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="estilos6.css">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	</head>
        <?php
        
            session_start();
            include ("conexion.php");
            include ("class_funciones.php");
            $fun = new funciones();
            $fun->AutorizacionTitulo();
        ?>
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
            <br>
            <div class="contenido">
                <?php
                    $viaje=$_POST['id'];
                    $consulta4="SELECT * FROM viajes WHERE id_viaje = '$viaje' AND borrado='0'";
                    $consulta5="SELECT * FROM viajes WHERE id_viaje = '$viaje' AND borrado='0'";
                    if($resultadoConsulta4=mysqli_query($conexion,$consulta4)){
                        if($resultadoConsulta5=mysqli_query($conexion,$consulta5)){
                            $registro4=mysqli_fetch_array($resultadoConsulta4);
                            $idauto=$registro4['auto_id'];                
                            $consulta6="SELECT Email_id FROM vehiculos WHERE id = '$idauto' AND borrado='0'";
                            $resultadoConsulta6=mysqli_query($conexion,$consulta6);
                            $registro6=mysqli_fetch_array($resultadoConsulta6);
                            $EmailAuto=$registro6['Email_id'];
                        }
                    }
                    $consulta="SELECT Foto FROM usuarios WHERE Email = '$EmailAuto'";
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
                <?php
                    //boton de ver perfil del dueño del viaje, si y solo si el usuario copiloto esta aceptado
                    $EmailAct = $_SESSION['email'];
                    $consulta99 = "SELECT * FROM misviajes_copiloto WHERE id_viaje = '$viaje' AND Email_copiloto = '$EmailAct' ";
                    $resCon99 = mysqli_query($conexion, $consulta99);
                    $reg = mysqli_fetch_array($resCon99);
                    $reg2 =  $reg['estado'];
                    if ($reg2 === 'aceptado'){
                    echo "
                    <br><br>
                    <form  method='post' action='PerfilAceptado.php'>
                        <input type='hidden' name='usuarioEmail' value='".$registro6['Email_id']."'>
                        <button style='margin-left:100px' type='submit' value='submit' class='btn btn-primary' > perfil piloto </button>
                    </form>
                    <form  method='post' action='VotarPiloto.php'>
                        <input type='hidden' name='idViaje' value='".$viaje."'>
                        <button style='margin-left:100px' type='submit' value='submit' class='btn btn-primary' > votar piloto </button>
                    </form>
                    ";
                    }
                ?>
                <br>
                <br>
                <div class="sony">
                        <div class="stars-outer">
                            <div class="stars-inner"></div>
                        </div>
                        <span class="number-rating"></span>
                </div> 
                <br>
                <br>
                <?php
                    //datos del viaje
                    include("conexion.php");
                    if(isset($_GET['idviajeget'])){
                            $viaje=$_GET['idviajeget'];
                    }
                    else{
                            if(isset($_POST['id'])){
                                $viaje=$_POST['id'];
                            }
                    }
                    
                    $consulta="SELECT * FROM viajes WHERE id_viaje = '$viaje'";
                    $consulta2="SELECT * FROM viajes WHERE id_viaje = '$viaje'";
                    if($resultadoConsulta=mysqli_query($conexion,$consulta)){
                        if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
                            $registro44=mysqli_fetch_row($resultadoConsulta2);
                            if($registro44[0] != ''){
                                $registro=mysqli_fetch_array($resultadoConsulta);
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
                                
                                echo "
                                <div class='container3'>
                                    <table class='table'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Origen</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr>
						<td>".$registro['origen']."</td>
                                            </tr>
                                        </tbody>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Destino</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr>
						<td>".$registro['destino']."</td>
                                            </tr>
                                        </tbody>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr>
						<td>".$registro['fecha']."</td>
                                            </tr>
                                        </tbody>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Horario de salida</th>
                                            </tr>
                                        </thead> 
                                        <tbody>";
                                            $date = date_create($registro['hora']);
                                            $date2 = date_format($date, 'H:i A');
                                            echo "
                                            <tr>
						<td>".$date2."</td>
                                            </tr>
                                        </tbody>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Horario de llegada</th>
                                            </tr>
                                        </thead> 
                                        <tbody>";
                                            $date = date_create($registro['horaLlegada']);
                                            $date2 = date_format($date, 'H:i A');
                                            echo "
                                            <tr>
						<td>".$date2."</td>
                                            </tr>
                                        </tbody>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Precio</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr>
						<td>$".$registro['precio']."</td>
                                            </tr>
                                        </tbody>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Asientos disponibles</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr>
						<td>".$asientosDispo."</td>
                                            </tr>
                                        </tbody>
                                        
                                        
                                
			 </table>";
                                               
                  }
          }
     }      
            if ($asientosDispo>0){
            echo"
                <form  method='post' action='postularse.php'>
                    <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                    <button type='submit' value='submit' class='btn btn-sm btn-primary btn-block' >Postularse </button>
                </form>
            ";
            }
            else{
                
                echo"
                <form  method='post' action='postularse.php'>
                    <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                    <button disabled='true' type='submit' value='submit' class='btn btn-sm btn-primary btn-block' >Postularse </button>
                </form>
                <p>no hay asientos disponibles</p>
                ";
            }
                  
               ?>
            
            <?php
                //boton de usuarios postulados y aceptados, aparece si y solo si soy el dueño del viaje
                $EmailPilot = $_SESSION['email'];
                $consulta4="SELECT * FROM viajes WHERE id_viaje = '$viaje' AND borrado='0'";
                $consulta5="SELECT * FROM viajes WHERE id_viaje = '$viaje' AND borrado='0'";
                if($resultadoConsulta4=mysqli_query($conexion,$consulta4)){
                    if($resultadoConsulta5=mysqli_query($conexion,$consulta5)){
                        $registro4=mysqli_fetch_array($resultadoConsulta4);
                        $idauto=$registro4['auto_id'];                
                        $consulta6="SELECT Email_id FROM vehiculos WHERE id = '$idauto' AND borrado='0'";
                        $resultadoConsulta6=mysqli_query($conexion,$consulta6);
                        $registro6=mysqli_fetch_array($resultadoConsulta6);
                        $EmailAuto=$registro6['Email_id'];        
                        $consulta7="SELECT COUNT(id_viaje) FROM misviajes_copiloto WHERE id_viaje = '$viaje'";
                        $resucon7=mysqli_query($conexion,$consulta7);
                        $arreglo_prest=mysqli_fetch_array($resucon7);
                        $postAcep=$arreglo_prest['0'];
                        if($EmailAuto === $EmailPilot){
                            echo "
                                    <br><br>
                                    <form  method='post' action='usuariosPostulados.php'>
                                        <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                        <button type='submit' value='submit' class='btn btn-sm btn-primary btn-block' >Usuarios Postulados</button>
                                    </form> 
                                    <br><br>
                                    <form  method='post' action='usuariosAceptados.php'>
                                        <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                        <button type='submit' value='submit' class='btn btn-sm btn-primary btn-block'>Usuarios Aceptados</button>
                                    </form>
                                    <br><br>";
                                    if($postAcep === '0'){ echo"
                                    <form  method='post' action='ModVia.php'>
                                        <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                        <button type='submit' value='submit' class='btn btn-sm btn-primary btn-block'>Modificar viaje</button>
                                    </form></div>";
                                    }
                                    else{ echo "
                                        <form  method='post' action='ModVia.php'>
                                            <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                            <button disabled='true' type='submit' value='submit' class='btn btn-sm btn-primary btn-block'>Modificar viaje</button>
                                        </form>
                                        <p>Hay usuarios postulados</p></div>";
                                        
                                    }
                        }
                        
                        if ($reg2 === 'aceptado'){
                            echo "
                            <br><br>
                            <form  method='post' action='EliminarmeComoCopi.php'>
                                <input type='hidden' name='CopilotoEmail' value='".$EmailAct."'>
                                <input type='hidden' name='id_viaje' value='".$viaje."'>
                                <button type='submit' value='submit' class='btn btn-sm btn-primary btn-block' Onclick='return confirmarSalir()' > Salir del viaje </button>
                            </form>
                            ";
                        }
                    }
                }
            ?>
                
                
            
            <br>
            <br>
            
           
            </div>
            
            <div style="margin-top:800px" >
                <div class="pregResp">
                <h4>Preguntas y respuestas</h4>
                <textarea type="text" placeholder="Escribí una pregunta" maxlength="2000"></textarea>
                </div>
                <div class="pregResp">
                    <input class='btn btn-sm btn-primary btn-block' type="submit" value="preguntar">
                </div>
            </div>
            <br>
            <br>
            
            
            <script type="text/javascript"> 
                function confirmarSalir(){
                  var x = confirm("Estas seguro que quieres salir del viaje? Perderá el dinero invertido");
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

