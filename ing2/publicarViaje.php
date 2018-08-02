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
		

		<h3 class="LabelRegVeh">Publica tu viaje</h3>
		<form class="regV" action="AltaViaje.php" method="post" enctype="multipart/form-data" onsubmit="return validacion()">
			<div class="form-group">
				<label for="texto1"><h5>Origen</h5></label>
				<input type="text" class="form-control" id="texto1" name="origen" placeholder="Ingresá el origen">
			
			<div class="form-group">
				<label for="texto2"><h5>Destino</h5></label>
				<input type="text" class="form-control" id="texto2"  name="destino" placeholder="Ingresá el destino">
			</div>

			<!--Tab para el tipo de viaje -->
			<div class="tab">
              <a class="tablinks" onclick="openType(event, 'ocacional')" >Ocacional</a>
              <a class="tablinks" onclick="openType(event, 'semanal')">Semanal</a>
              <a class="tablinks" onclick="openType(event, 'diario')">Diaro</a>
            </div>
         
          <div id="ocacional" class="tabcontent">
                <label for="texto3"><h5>Fecha</h5></label>
			 	  <input type="date" class="form-control" id="texto3"  name="fecha1" placeholder="Ingresá la fecha en la que viajas">                     
				<label for="texto4" ><h5>Hora de salida</h5></label>
			      <input type="time" class="form-control" id="texto4" name="hora1" placeholder="Ingresá la hora en la que viajas">
			      <label for="horaLLegada1" ><h5>Hora de llegada</h5></label>
	              <input type="time" class="form-control" id="horallegadaId1" name="horaLLegada1" placeholder="Ingresá la hora aproximada de llegada">
			  
           </div>
           
           
           <div id="semanal" class="tabcontent" ">
             <label for="texto5"><h5>Fecha</h5></label>
		       <input type="date" class="form-control" id="texto5"  name="fecha2" placeholder="Ingresá la fecha en la que viajas">
		     <label for="textoNume"><h5>Cantidad de semanas</h5></label>     
		       <input type="number" class="form-control" id="textoNume1"  name="cantSemanas" placeholder="Ingresá la cantidad de semanas que viajaras"  min="0" max="24">                     
			 <label for="texto6" ><h5>Hora de salida</h5></label>
			  <input type="time" class="form-control" id="texto6" name="hora2" placeholder="Ingresá la hora en la que viajas">
			  <label for="horaLLegada2" ><h5>Hora de llegada</h5></label>
	           <input type="time" class="form-control" id="horallegadaId2" name="horaLLegada2" placeholder="Ingresá la hora aproximada de llegada">
	       </div>
	       
           <div id="diario" class="tabcontent" class="diario">
             <label for="texto7"><h5>Fecha</h5></label>
		       <input type="date" class="form-control" id="texto7"  name="fecha3" placeholder="Ingresá la fecha en la que viajas">
		     <label for="textoNume"><h5>Cantidad de dias</h5></label>     
		       <input type="number" class="form-control" id="textoNume2"  name="cantDias" placeholder="Ingresá la cantidad de dias que viajaras" min="0" max="90">
		     <label for="texto8" ><h5>Hora de salida</h5></label>
	           <input type="time" class="form-control" id="texto8" name="hora3" placeholder="Ingresá la hora en la que viajas">
	           <label for="horallegada3" ><h5>Hora de llegada</h5></label>
	           <input type="time" class="form-control" id="horallegadaId3" name="horaLLegada3" placeholder="Ingresá la hora aproximada de llegada">
			  
           </div>
         
	       <div class="form-group">
				<label for="texto9"><h5>Precio</h5></label>
				<input type="number" class="form-control" id="texto9" name="precio" placeholder="Ingresá el precio">
			</div>	
			

			<label for="texto10" ><h5>Vehiculo</h5></label>
			<br>
			<?php
			 include("conexion.php");
             $aut_mail=$_SESSION['email']; 
             $consulta2="SELECT * FROM  vehiculos WHERE Email_id='$aut_mail'AND borrado='0' ";
             $consulta8="SELECT * FROM  vehiculos WHERE Email_id='$aut_mail'AND borrado='0' ";
             if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
               $resultadoConsulta8=mysqli_query($conexion,$consulta8);
               if($registro8=mysqli_fetch_row($resultadoConsulta8) >'1'){
                 echo "<select id='texto10' name='vehiculo'>"; 
                 while($registro2=mysqli_fetch_array($resultadoConsulta2)){
                   echo "<option value=".$registro2['id'].">".$registro2['Marca']." ".$registro2['Modelo']."/".$registro2['Patente']."</option>";
                 }
                 echo "</select>&nbsp&nbsp";
               }
               else
                 echo "<h5>No posee ningun vehículo registrado</h5>";
             }	
             ?>
                        
                 <?php //30 dias
                    
                    
                    //$consulta10= "SELECT * FROM viajes WHERE auto_id = '$autoid10' AND borrado = '0' AND fecha < '$hoy' AND id_viaje IN (SELECT id_votacion FROM votaciones WHERE patente = '$autop10' AND piloto_copiloto = '1')";
                    //if($registroConsulta10=mysqli_query($conexion,$consulta10)){
                        
                    //}
                    //else{
                       // $consulta11="SELECT " FECHAVIAJE+30 = IF NO PUEDE VOTAR
                    //}
                 
                   
                    //para piloto
                   $autoid10 = $registro8['id'];
                   $autop10=$registro8['Patente'];
                   $hoy2= date("Y-m-d");// SI EL ID DEL VIAJE NO ESTA EN VOTACIONES NO VOTO!
                   $ok2=false; 
                   $email202 = $_SESSION['email'];
                   $hoy2= date("Y-m-d");
                   $consulta202 = "SELECT id_viaje FROM viajes WHERE auto_id = '$autoid10' AND borrado = '0' AND id_viaje NOT IN (SELECT id_viaje FROM votaciones WHERE patente = '$autop10' AND piloto_copiloto = '1')"; 
                   if($registroConsulta202=mysqli_query($conexion,$consulta202)){
                       
                       while (($registro202=mysqli_fetch_array($registroConsulta202)) and ($ok2==false)){
                           $v2=$registro20['id_viaje'];
                           $consulta212="SELECT * FROM viajes WHERE id_viaje = '$v'";
                           if($registroConsulta212=mysqli_query($conexion,$consulta212)){
                               $registro212=mysqli_fetch_array($registroConsulta212);
                               $fechaViaje2=$registro212['fecha'];                                
                               $fecha30dias2=date( 'Y-m-d',strtotime($fechaViaje2. ' + 30 days'));
                               if($fecha30dias2<$hoy2){
                                   $ok2=true;
                                   $idFaltaVoto2=$registro212['id_viaje'];
                               }
                           }
                       }
                        
                    }
                    
                 
                    
                    
                    
                    
                   //para copiloto
                   $ok=false; 
                   $email20 = $_SESSION['email'];
                   $hoy= date("Y-m-d");
                   $consulta20 = "SELECT id_viaje FROM misviajes_copiloto WHERE estado = 'aceptado' AND Email_copiloto = '$email20' AND id_viaje NOT IN (SELECT id_viaje FROM votaciones WHERE Email_copiloto = '$email20' AND piloto_copiloto = 0)"; 
                   if($registroConsulta20=mysqli_query($conexion,$consulta20)){
                       
                       while (($registro20=mysqli_fetch_array($registroConsulta20)) and ($ok==false)){
                           $v=$registro20['id_viaje'];
                           $consulta21="SELECT * FROM viajes WHERE id_viaje = '$v'";
                           if($registroConsulta21=mysqli_query($conexion,$consulta21)){
                               $registro21=mysqli_fetch_array($registroConsulta21);
                               $fechaViaje=$registro21['fecha'];                                
                               $fecha30dias=date( 'Y-m-d',strtotime($fechaViaje. ' + 30 days'));
                               if($fecha30dias<$hoy){
                                   $ok=true;
                                   $idFaltaVoto=$registro21['id_viaje'];
                               }
                           }
                       }
                        
                    }
                    
                
                
                
                ?>
               
                        
			</div>
                        <?php
                            if(($ok==false) and ($ok2==false)){
                                echo 
                                    "
                                    <form  method='post' action='AltaViaje.php'>
                                    <button  type='submit' value='submit' class='btn btn-primary' > Registrar </button>
                                    </form>
                                    ";
                                
                            }
                            else{
                                echo 
                                    "
                                    <form  method='post' action='AltaViaje.php'>
                                    <button disabled='true' type='submit' value='submit' class='btn btn-primary' > Registrar </button>
                                    Adeuda votaciones de viajes hace mas de 30 dias
                                    </form> 
                                    ";
                            }
                              
                              
                        ?>
		</form>

		<br>
		<?php
          if(isset($_SESSION['regViaOk'])){
              $message="¡Se registró correctamente!";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['regViaOk']);
           }
           if(isset($_SESSION['fechaOk'])){
              $message="Ingrese una fecha";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['fechaOk']);
           }
           if(isset($_SESSION['horaOk'])){
              $message="Ingrese una hora";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['horaOk']);
           }
           if(isset($_SESSION['fechaMayOk'])){
              $message="Los viajes deben ser programados con una fecha posterior a la de hoy,intente otra vez";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['fechaMayOk']);
           }
           if(isset($_SESSION['noEntro'])){
              $message="No entro";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['noEntro']);
           }
            if(isset($_SESSION['viajeImpo1'])){
              $message="La hora de salida y la hora de llegada estan en la misma hora que otro viaje";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpo1']);
           }
           if(isset($_SESSION['viajeImpo2'])){
              $message="La hora de salida es correcta, pero la de llegada intercepta con otro viaje";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpo2']);
           }
           if(isset($_SESSION['viajeImpo3'])){
              $message="La hora de salida intercepta con otro viaje";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpo3']);
           }
           if(isset($_SESSION['viajeImpo4'])){
              $message="Hay un viaje entre esos 2 horarios";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpo4']);
           }
            if(isset($_SESSION['viajeImpoSemanal1'])){
              $message="La hora de salida y la hora de llegada estan en la misma hora que otro viaje y ya tenes viajes creados dentro de las proximas semanas a este horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoSemanal1']);
           }
           if(isset($_SESSION['viajeImpoSemanal2'])){
              $message="La hora de salida es correcta, pero la de llegada intercepta con otro viaje y ya tenes viajes creados dentro de las proximas semanas a este horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoSemanal2']);
           }
           if(isset($_SESSION['viajeImpoSemanal3'])){
              $message="La hora de salida intercepta con otro viaje y ya tenes viajes creados dentro de las proximas semanas a este horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoSemanal3']);
           }
           if(isset($_SESSION['viajeImpoSemanal4'])){
              $message="hay un viaje entre esos 2 horarios y ya tenes viajes creados dentro de las proximas semanas a este horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoSemanal4']);
           }
           if(isset($_SESSION['viajeImpoDiario1'])){
              $message="1 El viaje no puede realizarse, porque ya tenes viajes creados dentro de los proximos dias a ese horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoDiario1']);
           }
           if(isset($_SESSION['viajeImpoDiario2'])){
              $message="2 El viaje no puede realizarse, porque ya tenes viajes creados dentro de los proximos dias a ese horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoDiario2']);
           }
           if(isset($_SESSION['viajeImpoDiario3'])){
              $message="3 El viaje no puede realizarse, porque ya tenes viajes creados dentro de los proximos dias a ese horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoDiario3']);
           }
           if(isset($_SESSION['viajeImpoDiario4'])){
              $message="4 El viaje no puede realizarse, porque ya tenes viajes creados dentro de los proximos dias a ese horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoDiario4']);
           }
        ?> 
        <script type="text/javascript">
        	function openType(evt, tipo) {
               // Declare all variables
               var i, tabcontent, tablinks;

    			// Get all elements with class="tabcontent" and hide them
    			tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                  tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tipo).style.display = "block";
            evt.currentTarget.className += " active";
            }
        </script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/RegViaJava.js"></script>
	</body>
</html>