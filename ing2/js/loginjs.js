function validacion_registro() {

            $exprecont=/^\s*$/;
            $expreusu=/\w/;

    valor1 = document.getElementById("inputNombre").value;
    if(valor1 == null||valor1.length == 0 || $exprecont.test(valor1) ){
        alert('[ERROR] Ingrese un nombre');
        return false;
    }



    valor2 = document.getElementById("inputApellido").value;
    if(valor2 == null || valor2.length == 0 || $exprecont.test(valor2)){
        alert('[ERROR] Ingrese un apellido');
        return false;
    }

    
    valor3 = document.getElementById("inputEmail").value;
    $expremail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if( valor3 == null || valor3.length == 0 || $exprecont.test(valor3) ) {
        alert('[ERROR] No ingresaste email');
        return false;
    }
    else{
            if(!$expremail.test(valor3)){
                alert('[ERROR] El email posee formato incorrecto');
                return false;
            }
    }      

    valor4 = document.getElementById("inputPassword").value;
    $expreconte=/^([a-zA-Z]|[@$.,!¡¿?+-]|[0-9])+([0-9]|[@$.,!¡¿?+-])+([a-zA-Z0-9@$.,!¡¿?+-])*$/;
    if( valor4 == null || valor4.length == 0 ) {
        alert('[ERROR] No ingresaste la contraseña');
        return false;
    }
    else{
            if(!$expreconte.test(valor4)){
            alert('[ERROR] La primer contraseña posee formato incorrecto,ingrese al menos un caracter especial o un numero');
            return false;
            }
    }
    if(valor4.length<6){
        alert('[ERROR] Ingrese una clave con al menos 6 caracteres');
        return false;
    }
  
    valor5 = document.getElementById("inputPassword2").value;
    if( valor5 == null || valor5.length == 0) {
        alert('[ERROR] No confirmaste  la contraseña');
        return false;
    }
    else{
            if(!$expreconte.test(valor5)){
                alert('[ERROR] La confirmacion de contraseña posee formato incorrecto,ingrese al menos un caracter especial o un numero');
                return false;
            }

    }
    if(valor5.length<6){
        alert('[ERROR] Ingrese una confirmacion de la clave con al menos 6 caracteres');
        return false;
    }  
  
    if(valor5!=valor6){
        alert('[ERROR] Las contraseñas no coinciden');
        return false;
    }
  
    return true;
}

//fin de validacion de registro

//validacion de inicio de sesion

function validacion_inicioDeSesion() {
  valor = document.getElementById("email").value;

  $expremail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  $exprecont=/^\s*$/;

  if( valor == null || valor.length == 0  ) {
    alert('[ERROR] No ingresaste email');
    return false;
  }
  else{
    if(!$expremail.test(valor)){
      alert('[ERROR] El email posee formato incorrecto');
      return false;
    }
  }      

  valor2 = document.getElementById("password").value;

  if( valor2 == null || valor2.length == 0 ) {
    alert('[ERROR] No ingresaste contraseña');
    return false;
  }
  else{
    if($exprecont.test(valor2)){
      alert('[ERROR] La contraseña posee formato incorrecto');
      return false;
    }
  }    
  
  return true;
}


