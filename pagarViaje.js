function validacion_pago(){
    
     $exprecont=/^\s*$/;
    
    valor1 = document.getElementById("cardNumber").value;
    expreTarjeta = /^([0-9])\(([0-9])\)([0-9])+$/;
    if(valor1 == null||valor1.length == 0 || $exprecont.test(valor1) ){
        alert('[ERROR] Ingrese un nombre');
        return false;
    }
    
    
}

