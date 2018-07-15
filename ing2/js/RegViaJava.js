 
		function validacion() {

		  $exprecont=/^\s*$/;
		  $exprecontCap=/^[0-9]*$/;

		  var valor1 = document.getElementById("texto1").value;
		  if(valor1 == null||valor1.length == 0 || $exprecont.test(valor1) ){
		       alert("[Hubo un error] Ingrese un Origen");
		       return false;
		  }

		  var valor2 = document.getElementById("texto2").value;
		  if(valor2 == null||valor2.length == 0 || $exprecont.test(valor2) ){
		    alert('[Hubo un error] Ingrese un Destino');
		    return false;
		  }

		  if(valor1 == valor2) {
		    alert('[Hubo un error] El Origen y el Destino no pueden ser iguales');
		    return false;
		  } 
		  
          /*Fecha oca */
		  var valor3 = document.getElementById("texto3").value;
		  var valor4 = document.getElementById("texto4").value;
          var horallegadaId1 = document.getElementById("horallegadaId1").value;
		  
		  /*Fecha sem */
		  var valor5 = document.getElementById("texto5").value;
		  var valorSem = document.getElementById("textoNume1").value;
		  var valor6 = document.getElementById("texto6").value;
		  var horallegadaId2 = document.getElementById("horallegadaId2").value;
		  /*Fecha diario */
		  var valor7 = document.getElementById("texto7").value;
		  var valorDias = document.getElementById("textoNume2").value;
		  var valor8 = document.getElementById("texto8").value;
		   var horallegadaId3 = document.getElementById("horallegadaId3").value;
		  if(valor3.length == 0 &&  valor5.length== 0 && valor7.length == 0 ){
		    alert('[Hubo un error] Ingrese una fecha');
		    return false;
		  }
		  else{
		  	if(valor3.length =! 0 && valor5.length != 0 && valor7.length != 0 ){
		      alert('[Hubo un error] Solo puede ingresar una fecha por tipo de viaje');
		      return false;
		    }
		    else{
	 	      if(valor3.length == 0 && valor5.length != 0 && valor7.length != 0 ){
		        alert('[Hubo un error] Solo puede ingresar una fecha por tipo de viaje ');
		        return false;
		      }	
		      else{
		      	 if(valor3.length != 0 && valor5.length != 0 && valor7.length == 0 ){
		          alert('[Hubo un error] Solo puede ingresar una fecha por tipo de viaje');
		          return false;
		         }
		         else{
		         	 if(valor3.length != 0 && valor5.length == 0 && valor7.length != 0 ){
		               alert('[Hubo un error] Solo puede ingresar una fecha por tipo de viaje ');
		               return false;
		             }
		         
		         }
		      
		      }
		    
		    }
		  }
	         
          if(valor3.length != 0 && valor5.length == 0 && valor7.length == 0 ){
             if(valor4 == null||valor4.length == 0 ){
               alert('[Hubo un error] Ingrese la hora en la que desea viajar');
		       return false;

             } 
             else{
             	if(horallegadaId1 == null||horallegadaId1.length == 0 ){
                 alert('[Hubo un error] Ingrese la hora estimada de llegada');
		         return false;
                }
             }
          }
          if(valor3.length == 0 && valor5.length != 0 && valor7.length == 0 ){
            if(valorSem == null||valorSem.length == 0 ){
               alert('[Hubo un error] Ingrese la cantidad de semanas que desea que se repita el viaje.');
		       return false;     
            }
            else{
            	if(valor6 == null || valor6.length == 0 ){
                  alert('[Hubo un error] Ingrese la hora en la que desea viajar.');
		          return false; 
            	}
            	else{
             	  if(horallegadaId2 == null||horallegadaId2.length == 0 ){
                    alert('[Hubo un error] Ingrese la hora estimada de llegada');
		            return false;
                  }                 
                }
            }
          }

          if(valor3.length == 0 && valor5.length == 0 && valor7.length != 0 ){
          	 if(valorDias == null||valorDias.length == 0 ){
               alert('[Hubo un error] Ingrese la hora en la que desea viajar');
		       return false;     
             }
             else{
             	  if(horallegadaId3 == null||horallegadaId3.length == 0 ){
                    alert('[Hubo un error] Ingrese la hora estimada de llegada');
		            return false;

                }    
                else{
            	  if(valor8 == null||valor8.length == 0 ){
                    alert('[Hubo un error] Ingrese la cantidad de dias que desea que se repita el viaje.');
		            return false; 
		          } 
            	}


            }
          }	


		  var valor9 = document.getElementById("texto9").value;
		  if(valor9==null||valor9.length==0 || valor9 ==''){
		    alert('[Hubo un error] Ingrese un precio');
		    return false;
		  }


		 return true;
        }
		
	



