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
			</div>
			<button type="submit"  value="submit" class="btn btn-primary">Registrar </button>
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
              unset($_SESSION['fecahOk']);
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
            if(isset($_SESSION['viajeImpo'])){
              $message="El viaje no puede realizarse en la misma fecha y hora que otro";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpo']);
           }
            if(isset($_SESSION['viajeImpoSemanal'])){
              $message="El viaje no puede realizarse, porque ya tenes viajes creados dentro de las proximas semanas a este horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoSemanal']);
           }
           if(isset($_SESSION['viajeImpoDiario'])){
              $message="El viaje no puede realizarse, porque ya tenes viajes creados dentro de los proximos dias a ese horario";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['viajeImpoDiario']);
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