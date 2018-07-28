function validacion_pago(){
    
     $exprecont=/^\s*$/;
    
    valor1 = document.getElementById("cardNumber").value;
    $expreTarjeta = /^([0-9]{4,4})([-]{1,1})([0-9]{4,4})([-]{1,1})([0-9]{4,4})([-]{1,1})([0-9]{4,4})$/;
    if(valor1 == null||valor1.length == 0 || $exprecont.test(valor1) ){
        alert('[ERROR] Ingrese un numero');
        return false;
    }
    else{
            if(!$expreTarjeta.test(valor1)){
                alert('[ERROR] La tarjeta posee formato incorrecto');
                return false;
        }
    }
    
    valor2 = document.getElementById("cvv").value;
    $expreCvv = /^([0-9]{3,3})$/;
    if(valor2 == null||valor2.length == 0 || $exprecont.test(valor2) ){
        alert('[ERROR] Ingrese un numero');
        return false;
    }
    else{
            if(!$expreCvv.test(valor2)){
                alert('[ERROR] El cvv posee formato incorrecto');
                return false;
            }
    }
    
}


