
		function validacion() {

		  $exprecont=/^\s*$/;
		  $exprecontCap=/^[0-9]*$/;

		  var valor1 = document.getElementById("texto1").value;
		  if(valor1 == null||valor1.length == 0 || $exprecont.test(valor1) ){
		       alert("[Hubo un error] Ingrese una patente");
		       return false;
		  }
		  else
		  	if(valor1.length >= 10){
		  		alert("[Hubo un error] La patente no puede superar los 10 caracteres")
		  		return false;
		  	}

		  var valor2 = document.getElementById("texto2").value;
		  if(valor2 == null||valor2.length == 0 || $exprecont.test(valor2) ){
		    alert('[Hubo un error] Ingrese el Modelo del auto');
		    return false;
		  }
		  else
		  	if(valor2.length >= 15){
		  		alert("[Hubo un error] El modelo no puede superar los 15 caracteres");
		  		return false;
		  	}
		  var valor3 = document.getElementById("texto3").value;
		  if(valor3==null||valor3.length==0 || $exprecont.test(valor3) || valor3 ==''){
		    alert('[Hubo un error]  Ingrese la marca del auto');
		    return false;
		  }
		  else
		  	if(valor3.length >= 15){
		  		alert("[Hubo un error] La marca no puede superar los 15 caracteres");
		  		return false;
		  	}
		  var valor4 = document.getElementById("texto4").value;
		  if(valor4==null||valor4.length==0 || valor4 ==''){
		    alert('[Hubo un error] Ingrese la Capacidad del auto');
		    return false;
		  }
		  else
		  	 if(!$exprecontCap.test(valor4)){
		  	 	alert('[Hubo un error] Ingrese la Capacidad con numeros');
		        return false;
		     }
		    else
		  	if(valor4.length >= 2){
		  		alert("[Hubo un error] La capacidad no puede superar los 2 digitos");
		  		return false;
		  	} 
		 return true;
		}
