<html>
<head>
	<link rel="stylesheet" type="text/css" href="./estilo.css">
</head>
<header>
  <br/><br/><br/><div ><a href="index.php">Pagina principal</a></div><br/><br/>
</header>  	

 <body>
<?php
            session_start();
            include ("conexion.php");

function validarTarjeta($tarjeta){
    $expreTarjeta = "/^([0-9]{4,4})([-]{1,1})([0-9]{4,4})([-]{1,1})([0-9]{4,4})([-]{1,1})([0-9]{4,4})$/";
    $nuevaT= trim($tarjeta);
    if($nuevaT == null|| $nuevaT == ""){
        $_SESSION['tarjetaesta'] = false;        
        header("Location:PagarViaje.php");
        return false;
    }
    $rta=preg_match($expreTarjeta,$nuevaT);
    if(!$rta){
        $_SESSION['tarjetacualquiera']=true;
        header("Location:PagarViaje.php");
        return false;
    }
    return true;
}

function validarCvv ($cvv){
    $expreCvv = "/^([0-9]{3,3})$/";
    $nuevaC= trim($cvv);
    if($nuevaC == null|| $nuevaC == ""){
        $_SESSION['cvvesta'] = false;        
        header("Location:PagarViaje.php");
        return false;
    }
    $rta2=preg_match($expreCvv,$nuevaC);
    if(!$rta2){
        $_SESSION['cvvcualquiera']=true;
        header("Location:PagarViaje.php");
        return false;
    }
    return true;
}

if($conexion){
    
    if(isset($_POST['tarj']) && isset($_POST['cvvname'])){
        $tarjeta = $_POST['tarj'];
        if(validarTarjeta($tarjeta)){
            $cvv = $_POST['cvvname'];
            if(validarCvv($cvv)){
                $email = $_SESSION['email'];
                $viajeId = $_POST['idv'];
                $consulta = "UPDATE misviajes_copiloto SET pagado='1' WHERE id_viaje = '$viajeId' AND Email_copiloto = '$email'";
                $resultado=mysqli_query($conexion , $consulta);
                if($resultado){
                    $_SESSION['sepago']=True;
                    header("Location:PagarViaje.php");
                }
                else{
                        $SESSION['nosepago']=True;
                        header("Location:PagarViaje.php");
                }                 
                
            }
        }
    }
    
}

 



?>
</body>
</html>
