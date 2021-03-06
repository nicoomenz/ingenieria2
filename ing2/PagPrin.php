<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="estilos.css">
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
		<form action="busquedaPorCriterio.php" method="get" >
			<!-- Buscardor-->
			<div class="form-row align-items-center">
				<div class="col-sm-3 my-1">
					<label >Origen</label>
					<input type="text" class="form-control" name="origen" id="origen"  placeholder="Ingresá desde donde viajas">
					
				</div>
				<div class="col-sm-3 my-1">
					<label>Destino</label>
					<input type="text" class="form-control" name="destino" id="destino" placeholder="Ingresá hacia dónde viajas">
					
				</div>
				<div class="col-sm-3 my-1">
					<label>Precio</label>
					<input type="number" class="form-control" name="precio"  id="precio" placeholder="Ingresá el precio máximo">
				</div>
				<div class="col-sm-3 my-1">
					<label>Fecha</label>
					<input type="date" class="form-control" name="fecha" id="fecha" placeholder="Ingresá la fecha que deseas">
					
				</div>
				<div class="col-sm-3 my-1">
				  <button type="submit" class="btn btn-primary" style="margin-top:30px;">Buscar</button>
				</div>  
			</div>
		</form>
		<!-- tabla de resultados -->
		<div >
                    <?php
                        include("conexion.php");
                        $cantresult=5;
                        if(isset($_GET['pagina'])){
                        	$pagina=$_GET['pagina'];
                        }
                        else
                          $pagina=1;

                        $empezar_desde = ($pagina-1) * $cantresult;                       
                        $consulta="SELECT * FROM viajes WHERE borrado='0' ORDER BY fecha DESC LIMIT $empezar_desde,$cantresult";
                        $consulta2="SELECT * FROM viajes WHERE borrado='0' ORDER BY fecha DESC ";
                        $consultaTotal ="SELECT * FROM viajes WHERE borrado='0' ";     
                        $resulTotal=mysqli_query($conexion,$consultaTotal);
                        $totalRegs=mysqli_num_rows($resulTotal);
                        $totPags=ceil($totalRegs / $cantresult);
                        if($resultadoConsulta=mysqli_query($conexion,$consulta)){
                            if($resultadoConsulta2=mysqli_query($conexion,$consulta2)){
                                $registro44=mysqli_fetch_row($resultadoConsulta2);
                                if($registro44[0] != ''){
                                    echo "
                                    <div class='container3'>
                                    <table class='table'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>Origen</th>
                                                <th >Destino</th>
                                                <th >Fecha</th>
                                                <th>Precio</th>
                                                <th></th>
                                            </tr>
                                        </thead> 
                                    <tbody>";
                                        while($registro=mysqli_fetch_array($resultadoConsulta)){
                                             if($registro['borrado'] === '0'){
                                            echo"<tr>
                                                    <td>".$registro['origen']."</td>
                                                    <td>".$registro['destino']."</td>
                                                    <td>".$registro['fecha']."</td>
                                                    <td>$".$registro['precio']."</td>
                                                    <td>
                                                        <form  method='post' action='DetallesViaje.php'>
                                                        <input type='hidden' name='id' value='".$registro['id_viaje']."'>
                                                        <button type='submit' value='submit' class='btn btn-primary'> Detalles </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                    </tbody>";

                                        }
                                     }

                               echo"</table>";

                  }
                  else
                        echo "<label class='noPoseeVeh'><h3> No hay viajes registrados.</h3></label>";
                 }
               }
	     ?>
			<!-- Navegador de paginas-->
	</div>
		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center">
		    <?php
		      for($i=1; $i <=$totPags ; $i++){
		        echo "<li class='page-item'><a class='page-link' href='?pagina=".$i."'>".$i."</a></li>
				</li>";
			  }  
		    ?>
			</ul>
		</nav>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
		
	</body>
</html>