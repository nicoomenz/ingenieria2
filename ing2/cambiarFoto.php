<?php
         session_start();
         include ("conexion.php");
         include ("class_funciones.php");
         $fun = new funciones();
         $fun->AutorizacionTitulo();

?>
<?php

if($conexion) {
    if(isset($_POST['submit'])) {
                if (!isset($_FILES['imagen'])|| $_FILES['imagen']["error"] > 0){
                   $_SESSION['fotnoexitoso'] =true;
                    header("Location:miperfil.php");
                } 
                else{
                    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
                    $limite_kb  = 16384;
                    if (in_array($_FILES["imagen"]['type'], $permitidos) && $_FILES["imagen"]['size'] <= $limite_kb * 1024){
                        $rol=1;
                        $imagen_temporal  = $_FILES['imagen']['tmp_name'];  
                        $fp   = fopen($imagen_temporal, 'r+b');
                        $data = fread($fp, filesize($imagen_temporal));
                        fclose($fp);
                        $data = mysqli_real_escape_string($conexion,$data);
                        $emailLog = $_SESSION['email'];                    
                        $resultado12 = mysqli_query($conexion, "UPDATE usuarios SET Foto = '$data' WHERE Email='$emailLog'");
                        if($resultado12){                                
                            $_SESSION['fotexitoso'] =true;
                            header("Location:miperfil.php");
                        }
                        else{ 
                                $_SESSION['fotnoexitoso'] =true;
                                header("Location:miperfil.php");
                            }
                    }
                        
                }
}      
}
?>

