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
  <?php
    $viaje=$_GET['id_viaje'];
  ?>
  <div class="contenido">
    <div class="heading">
        <h1 class="h3 mb-3 font-weight-normal">Confirmar pago</h1>
    </div>
    <div class="payment">
        <form class="form-signin" action="PagarViajeAction.php" method = "post" onsubmit="return validacion_pago()">
            
            <div class="form-group" id="card-number-field">
                <label for="cardNumber" class="sr-only">Numero de la tarjeta</label>
                <input type="text" name="tarj" class="form-control" id="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx"  required="" autofocus="">
            </div>
            <div class="form-group CVV">
                <label for="cvv" class="sr-only">CVV</label>
                <input type="text" name="cvvname" class="form-control" id="cvv" placeholder="CVV" required="" autofocus="">
            </div>
            <div class="form-group" id="expiration-date">
                <label>Fecha de vencimiento</label>
                <select>
                    <option value="01">Enero</option>
                    <option value="02">Febrero </option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <select>
                    <option value="16"> 2019</option>
                    <option value="17"> 2020</option>
                    <option value="18"> 2021</option>
                    <option value="19"> 2022</option>
                    <option value="20"> 2023</option>
                    <option value="21"> 2024</option>
                </select>
            </div>
            
            <?php
                
            echo "
                <form  method='post' action='PagarViajeAction.php'>    
                    <input type='hidden' name='idv' value='".$viaje."'>
                    <button type='submit' value='submit' class='btn btn-lg btn-primary btn-block'> Confirmar </button>
                </form>   
                ";
            
            ?>
        </form>
    </div>
</div>
        
        <?php
                
            if(isset($_SESSION['tarjetaesta'])){
                        $message="Ingrese una tarjeta";
                        echo "<script>
                        alert('$message') 
                        </script>";
                        unset($_SESSION['tarjetaesta']);
                    
                }
            if(isset($_SESSION['tarjetacualquiera'])){
              $message="La tarjeta es incorrecta";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['tarjetacualquiera']);
            }
            
            if(isset($_SESSION['cvvesta'])){
              $message="Ingrese el cvv (detras de la tarjeta de credito)";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['cvvesta']);
            }
            
            if(isset($_SESSION['cvvcualquiera'])){
              $message="El cvv es incorrecto";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['cvvcualquierao']);
            }
            
            if(isset($_SESSION['sepago'])){
              $message="El viaje se pago correctamente";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['sepago']);
            }
            
            if(isset($_SESSION['nosepago'])){
              $message="Hubo un error en el pago del viaje";
              echo "<script>
               alert('$message') 
               </script>";
              unset($_SESSION['nosepago']);
            }



	     ?>
            
            
            
            
            
            
            
            
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/pagarViaje.js"></script>
        </body>
</html>

