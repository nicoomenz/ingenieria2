<?php
 session_start();
 include ("conexion.php");
 
 

 function validarOrigen($origen){
  $origenNue= trim($origen);
  if($origenNue == null||$origenNue == "" ){
    echo "Campo de origen vacio";
    echo  "<a href='publicarViaje.php'> Volver a intentar </a>";
    return false;
  }
  return true;
 }

  function validarDestino($destino){
   $destino= trim($destino);
   if($destino == null||$destino == "" ){
     echo "Campo de destino vacio";
     echo  "<a href='publicarViaje.php'> Volver a intentar </a>";
     return false;
   }
   return true;
  }

function validarFecha($fecha){
  $fecha= trim($fecha);
  if($fecha == null||$fecha == "" ){
    $_SESSION['fechaOk'] =true;
    header("Location:publicarViaje.php"); 
    return false;
  }
  else{
    $hoy= date("Y-m-d");
    if($hoy>$fecha){
      $_SESSION['fechaMayOk'] =true;
      header("Location:publicarViaje.php");
      return false;    
    }

  }
  return true;
 } 

 function validarHora($hora){
    $hora= trim($hora);
    if($hora == null||$hora == "" ){
      $_SESSION['horaOk'] =true;
      echo  "<a href='publicarViaje.php'> Volver a intentar </a>";
      return false;
    }
    return true;
 }
function validarPrecio($precio){
    $precio= trim($precio);
    if($precio == null||$precio == "" ){
      echo "Campo de precio vacio";
      echo  "<a href='publicarViaje.php'> Volver a intentar </a>";
      return false;
    }
    return true;
}

if(!empty($_POST['fecha1'])){
  $f1=$_POST['fecha1'];
}
if(!empty($_POST['fecha2'])){
  $f2=$_POST['fecha2'];

}

if(!empty($_POST['fecha3'])){
  $f3=$_POST['fecha3'];
}

if(!empty($_POST['hora1'])){
  $h1=$_POST['hora1'];  
}
if(!empty($_POST['hora2'])){
  $h2=$_POST['hora2'];
}
if(!empty($_POST['hora3'])){ 
  $h3=$_POST['hora3'];
}


if(!empty($_POST['horaLLegada1'])){ 
  $hll1=$_POST['horaLLegada1'];
}
if(!empty($_POST['horaLLegada2'])){ 
  $hll2=$_POST['horaLLegada2'];
}
if(!empty($_POST['horaLLegada3'])){ 
  $hll3=$_POST['horaLLegada3'];
}



if(!empty($f1)){
  $fecha=$f1;
  $hora=$h1;
  $horaLlegada=$hll1;
} 
else{
  if(!empty($f2)){
    $fecha=$f2;
    $hora=$h2;
    $cS=$_POST['cantSemanas'];
    $horaLlegada=$hll2;
  }
  else{
    $fecha=$f3;
    $hora=$h3;
    $cDias=$_POST['cantDias'];
    $horaLlegada=$hll3;
  }
}


 if($conexion){
   $resultado12=false;
   if(isset($_POST['origen']) && isset($_POST['destino']) && isset($_POST['precio']) ){
     $origen = $_POST['origen']; 
     if(validarOrigen($origen)){
       $destino = $_POST['destino'];
       if(validarDestino($destino)){
         if(validarFecha($fecha)){
           if(validarHora($hora)){
             $precio=$_POST['precio'];
             if(validarPrecio($precio)){
               $id_auto=$_POST['vehiculo'];
               if(isset($id_auto)){
                 $nomemail=$_SESSION['email'];
                 $cant_sem=$cS;
                 if($fecha == $f1){
                   $query1="SELECT hora FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto'";
                   $resultquery1=mysqli_query($conexion,$query1);
                   $registro1=mysqli_fetch_row($resultquery1);
                   $horaBD=$registro1['0'];
                   $horaBD;
                   $query2="SELECT horaLlegada FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto'";
                   $resultquery2=mysqli_query($conexion,$query2);
                   $registro2=mysqli_fetch_row($resultquery2);
                   $horaLlegadaBD=$registro2['0'];
                   if(($hora<$horaBD) and ($horaLlegada<$horaBD)){
                                $resultado12 = mysqli_query($conexion ,"INSERT INTO viajes ( auto_id,hora,horaLlegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')") ;
                                if($resultado12){
                                    $_SESSION['regViaOk'] =true;
                                    header("Location:publicarViaje.php"); 
                                }
                        }
                            else {
                                    if(($hora>$horaLlegadaBD) and ($horaLlegada>$horaLlegadaBD)){
                                            $resultado12 = mysqli_query($conexion ,"INSERT INTO viajes ( auto_id,hora,horaLlegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')") ;
                                            if($resultado12){
                                                $_SESSION['regViaOk'] =true;
                                                header("Location:publicarViaje.php"); 
                                            }
                                        }                                    
                                    else{
                                            if(($hora>$horaBD) and ($horaLlegada<$horaLlegadaBD)){ //la hora beetwen
                                                $_SESSION['viajeImpo1'] =true; 
                                                header("Location:publicarViaje.php");
                                            }
                                            else{
                                                if(($hora<$horaBD) and ($horaLlegada<$horaLlegadaBD)){ //la hora de salida esta bien pero la de llegada esta mal
                                                        $_SESSION['viajeImpo2'] =true; 
                                                        header("Location:publicarViaje.php");
                                                }
                                                else{
                                                    if(($hora>$horaBD) and ($horaLlegada>$horaLlegadaBD) and ($horaBD != null)){ //la hora de salida esta mal
                                                        $_SESSION['viajeImpo3'] =true; 
                                                        header("Location:publicarViaje.php");
                                                    }
                                                    else{
                                                        if(($horaBD>$hora) and ($horaBD<$horaLlegada)) { //la hora de salida esta mal
                                                            $_SESSION['viajeImpo4'] =true; 
                                                            header("Location:publicarViaje.php");
                                                        }
                                                        else{
                                                            $resultado12 = mysqli_query($conexion ,"INSERT INTO viajes ( auto_id,hora,horaLlegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')") ;
                                                            if($resultado12){
                                                                $_SESSION['regViaOk'] =true;
                                                                header("Location:publicarViaje.php"); 
                                                            }
                                                        }
                                                    
                                                        
                                                        }
                                                    
                                            }
                                    }                                
                            }
                        }
                 }
                  else{
                    if($fecha == $f2){   
                        $query1="SELECT hora FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto'";
                        $resultquery1=mysqli_query($conexion,$query1);
                        $registro1=mysqli_fetch_row($resultquery1);
                        echo $horaBD=$registro1['0'];
                        $query2="SELECT horaLlegada FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto'";
                        $resultquery2=mysqli_query($conexion,$query2);
                        $registro2=mysqli_fetch_row($resultquery2);
                        $horaLlegadaBD=$registro2['0'];
                        if(($hora<$horaBD) and ($horaLlegada<$horaBD)){
                                $fecha_act=$fecha;
                                $query="SELECT * FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto' AND hora BETWEEN '$hora' AND '$horaLlegada'";
                                $resultquery=mysqli_query($conexion,$query);
                                $registro=mysqli_fetch_row($resultquery);                                
                                if(empty($registro['0'])){
                                    $registro=mysqli_fetch_row($resultquery);
                                    for ($i =1; $i<=$cant_sem; $i++){
                                        $resultado12 = mysqli_query($conexion , "INSERT INTO viajes ( auto_id,hora,horaLlegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')");
                                        $fecha=date( 'Y-m-d',strtotime($fecha. ' + 7 days'));
                                    }
                                    $_SESSION['regViaOk'] =true;
                                    header("Location:publicarViaje.php");
                                }
                        }
                            else {
                                    if(($hora>$horaLlegadaBD) and ($horaLlegada>$horaLlegadaBD)){
                                        
                                        $fecha_act=$fecha;
                                        $query="SELECT * FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto' AND hora BETWEEN '$hora' AND '$horaLlegada'";
                                        $resultquery=mysqli_query($conexion,$query);
                                        $registro=mysqli_fetch_row($resultquery);
                                        echo var_dump($registro['0']);
                                        if(empty($registro['0'])){
                                            echo "gola";
                                            $registro=mysqli_fetch_row($resultquery);
                                            for ($i =1; $i<=$cant_sem; $i++){
                                                $resultado12 = mysqli_query($conexion , "INSERT INTO viajes ( auto_id,hora,horaLlegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')");
                                                $fecha=date( 'Y-m-d',strtotime($fecha. ' + 7 days'));
                                              }
                                            $_SESSION['regViaOk'] =true;
                                            header("Location:publicarViaje.php");
                                        }
                                    }
                                    else{
                                            if(($hora>$horaBD) and ($horaLlegada<$horaLlegadaBD)){ //la hora beetwen
                                                 
                                                $_SESSION['viajeImpoSemanal1'] =true; 
                                                header("Location:publicarViaje.php");
                                            }
                                            else{
                                                if(($hora<$horaBD) and ($horaLlegada<$horaLlegadaBD)){ //la hora de salida esta bien pero la de llegada esta mal
                                                   
                                                    $_SESSION['viajeImpoSemanal2'] =true; 
                                                        header("Location:publicarViaje.php");
                                                }
                                                else{
                                                    if(($hora>$horaBD) and ($horaLlegada>$horaLlegadaBD)){ //la hora de salida esta mal
                                                        
                                                        $_SESSION['viajeImpoSemanal3'] =true; 
                                                        header("Location:publicarViaje.php");
                                                    }
                                                    else{
                                                        if(($horaBD>$hora) and ($horaBD<$horaLlegada)){ //la hora de salida esta mal
                                                            echo "hola6";
                                                            $_SESSION['viajeImpoSemanal4'] =true; 
                                                            header("Location:publicarViaje.php");
                                                        }
                                                        else{
                                                            
                                                            $fecha_act=$fecha;
                                                            $query="SELECT * FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto' AND hora BETWEEN '$hora' AND '$horaLlegada'";
                                                            $resultquery=mysqli_query($conexion,$query);
                                                            $registro=mysqli_fetch_row($resultquery);
                                                            if(empty($registro['0'])){
                                                                $registro=mysqli_fetch_row($resultquery);
                                                                for ($i =1; $i<=$cant_sem; $i++){
                                                                    $resultado12 = mysqli_query($conexion , "INSERT INTO viajes ( auto_id,hora,horaLlegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')");
                                                                    $fecha=date( 'Y-m-d',strtotime($fecha. ' + 7 days'));
                                                                }
                                                                $_SESSION['regViaOk'] =true;
                                                                header("Location:publicarViaje.php");
                                                            }
                                                        }
                                                        
                                                    }
                                                    
                                                        
                                                    
                                            }
                                    }                                
                            }
                        }
                    
                    }
                  else{
                    if($fecha=$f3){
                        $query1="SELECT hora FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto'";
                        $resultquery1=mysqli_query($conexion,$query1);
                        $registro1=mysqli_fetch_row($resultquery1);
                        $horaBD=$registro1['0'];
                        $query2="SELECT horaLlegada FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto'";
                        $resultquery2=mysqli_query($conexion,$query2);
                        $registro2=mysqli_fetch_row($resultquery2);
                        $horaLlegadaBD=$registro2['0'];
                        
                        if(($hora<$horaBD) and ($horaLlegada<$horaBD) and ($horaBD != null)){
                                
                                $fecha_act=$fecha;
                                $query="SELECT * FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto' AND hora BETWEEN '$hora' AND '$horaLlegada'";
                                $resultquery=mysqli_query($conexion,$query);
                                $registro=mysqli_fetch_row($resultquery);
                                if(empty($registro['0'])){
                                    for($i =1; $i<=$cDias; $i++){
                                        $resultado12 = mysqli_query($conexion , "INSERT INTO viajes ( auto_id,hora,horaLLegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')");
                                        $fecha=date( 'Y-m-d',strtotime($fecha. ' + 1 days'));
                                    }   
                                    $_SESSION['regViaOk'] =true;
                                    header("Location:publicarViaje.php"); 
                                }
                        }
                            else {
                                    if(($hora>$horaLlegadaBD) and ($horaLlegada>$horaLlegadaBD) and ($horaBD != null)){
                                            
                                            $fecha_act=$fecha;
                                            $query="SELECT * FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto' AND hora BETWEEN '$hora' AND '$horaLlegada'";
                                            $resultquery=mysqli_query($conexion,$query);
                                            $registro=mysqli_fetch_row($resultquery);
                                            if(empty($registro['0'])){
                                            for($i =1; $i<=$cDias; $i++){
                                                $resultado12 = mysqli_query($conexion , "INSERT INTO viajes ( auto_id,hora,horaLLegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')");
                                                $fecha=date( 'Y-m-d',strtotime($fecha. ' + 1 days'));
                                            }   
                                            $_SESSION['regViaOk'] =true;
                                            header("Location:publicarViaje.php"); 
                                    }
                                        }                                    
                                    else{
                                            if(($hora>$horaBD) and ($horaLlegada<$horaLlegadaBD) and ($horaBD != null)){ //la hora beetwen
                                              
                                                $_SESSION['viajeImpoDiario1'] =true; 
                                                header("Location:publicarViaje.php");
                                            }
                                            else{
                                                if(($hora<$horaBD) and ($horaLlegada<$horaLlegadaBD) and ($horaBD != null)){ //la hora de salida esta bien pero la de llegada esta mal
                                                        
                                                        $_SESSION['viajeImpoDiario2'] =true; 
                                                        header("Location:publicarViaje.php");
                                                }
                                                else{
                                                    if(($hora>$horaBD) and ($horaLlegada>$horaLlegadaBD) and ($horaBD != null)){ //la hora de salida esta mal
                                                       
                                                        $_SESSION['viajeImpoDiario3'] =true; 
                                                        header("Location:publicarViaje.php");
                                                    }
                                                    else{
                                                        if(($horaBD>$hora) and ($horaBD<$horaLlegada)) { //la hora de salida esta mal
                                                            
                                                            $_SESSION['viajeImpoDiario4'] =true; 
                                                            header("Location:publicarViaje.php");
                                                        }
                                                        else{
                                                            echo $fecha_act=$fecha;
                                                            $query="SELECT * FROM viajes WHERE fecha='$fecha' AND auto_id='$id_auto' AND hora BETWEEN '$hora' AND '$horaLlegada'";
                                                            $resultquery=mysqli_query($conexion,$query);
                                                            $registro=mysqli_fetch_row($resultquery);
                                                            if(empty($registro['0'])){
                                                              echo "if";
                                                              for($i =1; $i<=$cDias; $i++){
                                                                echo "for";
                                                                $resultado12 = mysqli_query($conexion , "INSERT INTO viajes ( auto_id,hora,horaLLegada, precio,destino,origen,fecha,borrado) VALUES ( '$id_auto','$hora','$horaLlegada','$precio','$destino','$origen','$fecha','0')");
                                                                $fecha=date( 'Y-m-d',strtotime($fecha. ' + 1 days'));
                                                              }   
                                                              $_SESSION['regViaOk'] =true;
                                                              header("Location:publicarViaje.php"); 
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                    }                                
                            }
                    }
                }
                   
               }   
             }
           }
     
         }
       }  
     }
   
   }       
 }
}
 ?>