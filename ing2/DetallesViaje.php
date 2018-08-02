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
                    $consulta4="SELECT * FROM viajes WHERE id_viaje = '$viaje'";
                    $consulta5="SELECT * FROM viajes WHERE id_viaje = '$viaje'";
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
                    $est = $registro4['borrado'];
                    $pag = $reg['pagado'];
                    
                    if (($reg2 === 'aceptado') AND ($est === '0')){
                    echo "
                    <br><br>
                    <form  method='post' action='PerfilAceptado.php'>
                        <input type='hidden' name='usuarioEmail' value='".$registro6['Email_id']."'>
                        <button style='margin-left:100px' type='submit' value='submit' class='btn btn-primary' > perfil piloto </button>
                    </form>";
                    if ($pag === '1'){
                        echo " <br>
                            <form  method='post' action='VotarPiloto.php'>
                                <input type='hidden' name='idViaje' value='".$viaje."'>
                                <button style='margin-left:100px' type='submit' value='submit' class='btn btn-primary' > votar piloto </button>
                            </form>
                            ";
                    }
                    else {
                            echo "<br>
                            <form  method='post' action='VotarPiloto.php'>
                                <input type='hidden' name='idViaje' value='".$viaje."'>
                                <button disabled='true' style='margin-left:100px' type='submit' value='submit' class='btn btn-primary' > votar piloto </button>
                            </form>
                            <p>Debe pagar el viaje para votar</p>
                            ";
                        
                    }
                    }
                    else{
                            if($est === '1'){
                                
                                echo "<p>Este viaje fue eliminado</p>";
                            }
                    }
                ?>
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
            if (($asientosDispo>0) AND ($est === '0')){
            echo"
                <form  method='post' action='postularse.php'>
                    <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                    <button type='submit' value='submit' class='btn btn-sm btn-primary btn-block' >Postularse </button>
                </form>
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

        </div>
        <?php
        $idviaje = $_POST['id'];
        $res = mysqli_query($conexion,"SELECT auto_id FROM viajes WHERE id_viaje = '$viaje'");
        $registro = mysqli_fetch_array($res);
        $idauto = $registro['auto_id'];
        $emailusuario = $_SESSION['email'];
        $res = mysqli_query($conexion,"SELECT id FROM vehiculos WHERE Email_id = '$emailusuario'");
        $row = $res -> fetch_assoc();
        $consulta="SELECT * FROM preguntas WHERE id_viaje= '$idviaje'";
        $resultadoConsulta= mysqli_query($conexion,$consulta);
        $ok = false;
        if ($row == null)
        {
            $ok = true;
        }
        else
        {
            if (!in_array($idauto, $row))
            {
                $ok = true;
            }
        }     
        if($ok)
        { 
        echo "
            <div style='position: absolute; margin-left: -525px;'>
            <label id='titulo4' style='margin-top:50px'>Preguntas y respuestas</label>
            <form action='RegistrarPregunta.php' method='post' onsubmit='return validar_Datos();'> 
                <input type='hidden' name='Email_id' value='".$emailusuario."'>
                <input type='hidden' name='id_viaje' value='".$idviaje."'>
                <textarea type='text' name='pregunta' id='pregunta' placeholder='Ingrese una pregunta.'></textarea>
                <button class='btn btn-primary' type='submit' value='submit' id='boton-pregunta' style='margin-top:10px; margin-left:718px'>Enviar pregunta</button>
                <hr style='color: #0056b2;'/>
                </form>";  
	        $consulta="SELECT * FROM preguntas WHERE id_viaje ='$idviaje'";
                $resultadoConsulta=mysqli_query($conexion,$consulta);
                while($registro=mysqli_fetch_array($resultadoConsulta)){
                    $emailcoment = $registro['Email_id'];
                    $res = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Email = '$emailcoment'");
                    $reg = mysqli_fetch_array($res);
                    $pregunta = $registro['Descripcion'];
                    $nombre = $reg['Nombre'];
                    $apellido = $reg['Apellido'];   
                    $img = base64_encode($reg['Foto']);
                    echo "
                       <img style='vertical-align: middle; width: 90px; height: 90px; border-radius: 50%; border-style: double; margin-left: 110px;' src='data:image/jpeg;base64, $img'/>
                       <label style='text-align: center; overflow: hidden; margin-left: 66px; margin-top: 10px; font-size: 100%; width: 170px; height: 60px; border-color: #000000; border-style: double; background-color: #ff4d4d'> $nombre $apellido </label>
                       <label style='margin-left: auto; margin-right: auto; margin-top: -180px; border-color: #ff4d4d; border-style: solid; width: 500px; height: 70px; overflow: hidden;'> $pregunta </label>";
                       if (!($registro['Respuesta'] == ' ' or $registro['Respuesta'] == null or $registro['Respuesta'] == ''))
                       {
                           $respuesta = $registro['Respuesta'];
                           echo"
                           <label style='margin-left: 500px; margin-right: auto; margin-top: 30px; border-color: #8b8282; border-style: solid; width: 500px; height: 70px; overflow: hidden;'> $respuesta </label>                                 
                           <label style='margin-left: 1080px; margin-top: -60px; font-size: 130%; width: 200px; border-color: #8b8282; border-style: solid;'> Respuesta del piloto. </label>
                           <hr style='color: #0056b2; margin-top: 30px;'/>";
                       }
                       else{
                           echo "<hr style='color: #0056b2; margin-top: 110px;'/>"; 
                       }
                }                     
        }
        else{
           echo "
            <div>
            <label id='titulo3' style='margin-top:820px'>Preguntas y respuestas</label>";
            $consulta="SELECT * FROM preguntas WHERE id_viaje ='$idviaje'";
                $resultadoConsulta=mysqli_query($conexion,$consulta);
                echo "<br>";
                while($registro=mysqli_fetch_array($resultadoConsulta)){
                    $emailcoment = $registro['Email_id'];
                    $res = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Email ='$emailcoment'");
                    $reg = mysqli_fetch_array($res);
                    $pregunta = $registro['Descripcion'];
                    $nombre = $reg['Nombre'];
                    $apellido = $reg['Apellido'];   
                    $img = base64_encode($reg['Foto']);
                    echo "
                       <img style='vertical-align: middle; width: 90px; height: 90px; border-radius: 50%; border-style: double; margin-left: 110px;' src='data:image/jpeg;base64, $img'/>
                       <label style='text-align: center; overflow: hidden; margin-left: 66px; margin-top: 10px; font-size: 100%; width: 170px; height: 60px; border-color: #000000; border-style: double; background-color: #ff4d4d'> $nombre $apellido </label>
                       <label style='margin-left: auto; margin-right: auto; margin-top: -180px; border-color: #ff4d4d; border-style: solid; width: 500px; height: 70px; overflow: hidden;'> $pregunta </label>";
                       if (!($registro['Respuesta'] == ' ' or $registro['Respuesta'] == null or $registro['Respuesta'] == ''))
                       {
                           $respuesta = $registro['Respuesta'];
                           echo"
                           <label style='margin-left: 500px; margin-right: auto; margin-top: 30px; border-color: #8b8282; border-style: solid; width: 500px; height: 70px; overflow: hidden;'> $respuesta </label>                                 
                           <label style='margin-left: 1080px; margin-top: -60px; font-size: 130%; width: 200px; border-color: #8b8282; border-style: solid;'> Respuesta del piloto. </label>
                           <hr style='color: #0056b2; margin-top: 30px;'/>";
                       }
                       else{
                           echo" <form action='RegistrarRespuesta.php' method='post' onsubmit='return validar_Datos2();'> 
                                 <input type='hidden' name='Descripcion' value='".$pregunta."'>
                                 <input type='hidden' name='Email' value='".$emailcoment."'>
                                 <input type='hidden' name='id_viaje' value='".$idviaje."'>
                                 <textarea type='text' name='respuesta' id='respuesta' placeholder='Ingrese su respuesta.'></textarea>
                                 <button class='btn btn-primary' type='submit' value='submit' id='boton-pregunta' style='margin-top:-90px; margin-left:1070px'>Enviar respuesta</button>
                                 <hr style='color: #0056b2; margin-top: -10px;'/>
                                 </form>"; 
                       }
                  } 
        } echo"</div>"
        ?>
            
            <script type="text/javascript"> 
                function confirmarSalir(){
                  var x = confirm("¿Estas seguro que quieres salir del viaje? Perderá el dinero invertido y sera penalizado por 1 punto en su reputacion como copiloto.");
                  if(x == true)
                    return true;
                  else
                    return false;
                }
            </script>
            
            
             <script>
             function validar_Datos()
             {
              valor = document.getElementById("pregunta").value;
    
              if (valor == null || valor == "")
              {
               window.alert('El campo comentario esta vacio.');
               return false;
             }
              return true;
             }
            
            function validar_Datos2()
             {
              valor = document.getElementById("respuesta").value;
    
              if (valor == null || valor == "")
              {
               window.alert('El campo comentario esta vacio.');
               return false;
            }
             return true;
            }
    
            
            </script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/votacionDet.js"></script>
        </body>
</html>

