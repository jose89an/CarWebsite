function comprobar(formulario){
	   var tiponombre=/^[A-Z|Ñ|Á|É|Í|Ó|Ú]{1}[a-z|A-Z|Ñ|ñ|á|é|í|ó|ú|ü|\s]*$/;
       if (formulario.nombre.value.length==0){
         alert("Tiene que escribir su nombre")
         formulario.nombre.focus();
         return false;
         }
	   else{
		   if (formulario.nombre.value.length>15){
			   alert("Su nombre debe contener como mucho 15 caracteres")
			   formulario.nombre.focus();
			   return false;
		   }
	     if (formulario.nombre.value.match(tiponombre)){
		   }
		 else{
		   alert("Formato de nombre incorrecto. Debe tener primera letra mayúscula y el resto caracteres alfabéticos en minúscula.");
		   formulario.nombre.focus();
		   return false;
		   }
	     }
	   var s=0;
	   var sx="";
	   for (var i = 0; i < formulario.usuario.length; i++ ) {
         if ( formulario.usuario[i].checked ) {
           s=1;
		   if(i==0)
		   sx="Propietario";
		   else
		   sx="Apostante";
           break;
         }
       }
       if ( s ==0){
         alert("Debe seleccionar si es propietario o apostante" ) ;
		 return false;
       }
	   var tipocorreo=/(^[0-9a-zA-Z]+(?:[._][0-9a-zA-Z]+)*)@correo.ugr.es/;
	   var tipocorreo2=/(^[0-9a-zA-Z]+(?:[._][0-9a-zA-Z]+)*)@ugr.es/;
	   if (formulario.email.value.length==0){
	     alert("Tiene que introducir su correo electrónico")
	     formulario.email.focus();
	     return false;
	     }
	   else{
	     if (!formulario.email.value.match(tipocorreo) && !formulario.email.value.match(tipocorreo2)){
	       alert("Formato de correo incorrecto. Debe ser *@correo.ugr.es o *@ugr.es");
		   formulario.email.focus();
		   return false;
		   }
		 }
		 
		 if (formulario.dni.value.length!=9){
			 alert ("Debe introducir su DNI con letra");
			 formulario.dni.focus();
			 return false;
	     }
		 
		 if (formulario.password.value.length==0 || formulario.password2.value.length==0){
			 alert("Debe introducir una contraseña y confirmarla a continuación");
			 formulario.password.focus();
			 return false;
		 }
		 else{
			 if(formulario.password.value!=formulario.password2.value){
				 alert("La contraseña introducida como confirmación no coincide con la original");
				 formulario.password.focus();
				 return false;
			 }
		 }
		 if(formulario.telefono.value.length==0){
			 alert("Debe introducir un número de teléfono");
			 formulario.telefono.focus();
			 return false;
		 }
		 else{
			 var tipotelefono=/[0-9]{9}/;
			 if (!formulario.telefono.value.match(tipotelefono)){
				 alert("El teléfono debe constar de 9 cifras");
				 formulario.telefono.focus();
				 return false;
			 }
		 }
				 
		 
		 		 mensaje="¿Acepta registrarse en este servicio ilegal de tráfico de drogas y asesinatos a sueldo encubierto como";
				 mensaje=mensaje+" servicio de subastas de vehículos aun sabiendo que si nos pillan chivaremos en tu contra debido";
				 mensaje=mensaje+" a que eres el último en haber entrado en el negocio?";
		 
		 if(confirm(mensaje)){
			 return true;
		 }
		 else{
			 return false;
			 self.close();
		 }
}

function comprobarvehiculo(formulario){
	var tipomatricula=/^\d{4}[A-Z]{3}$/;
	var tiponumero=/^\d{1,}$/;
	if (formulario.matricula.value.length==0){
         alert("Tiene que introducir la matrícula del vehículo")
         formulario.matricula.focus();
         return false;
	}else{
		if (!formulario.matricula.value.match(tipomatricula)){
			alert("Tiene que introducir un formato válido de matrícula (Ej: 1111AAA)");
			formulario.matricula.focus();
			return false;
		}
	}
	if (formulario.marca.value.length==0){
		alert("Tiene que introducir la marca del vehículo")
		formulario.marca.focus();
		return false;
	}
	if (formulario.modelo.value.length==0){
		alert("Tiene que introducir el modelo del vehículo")
		formulario.modelo.focus();
		return false;
	}
	if (formulario.anyo.value.length==0){
		alert("Tiene que introducir el año de fabricación del vehículo")
		formulario.anyo.focus();
		return false;
	}
	else{
		var tipoanyo=/[0-9]{4}/;
		if (!formulario.anyo.value.match(tipoanyo)){
			alert("El año de fabricación debe constar de 4 cifras");
			formulario.anyo.focus();
			return false;
		}
	}
	if (formulario.kilometraje.value.length==0){
		alert("Tiene que introducir el kilometraje del vehículo")
		formulario.kilometraje.focus();
		return false;
	}
	else{
		if (!formulario.kilometraje.value.match(tiponumero)){
			alert("El kilometraje del vehículo debe ser un número");
			formulario.kilometraje.focus();
			return false;
		}
	}
	if (formulario.precio.value.length==0){
		alert("Tiene que introducir el precio de salida del vehículo")
		formulario.precio.focus();
		return false;
	}
	else{
		if (!formulario.precio.value.match(tiponumero)){
			alert("El precio de salida del vehículo debe ser un número");
			formulario.precio.focus();
			return false;
		}
	}
	if (formulario.dialim.value==0 || formulario.meslim.value==0 || formulario.anyolim.value==0){
		alert("Tiene que introducir una fecha límite para la subasta del vehículo")
		formulario.dialim.focus();
		return false;
	}
			
	mensaje="¿Aceptar poner en subasta el vehículo introducido?";
	if(confirm(mensaje)){
		return true;
	}
	else{
		return false;
		self.close();
	}
	
}

function confirmar(){
	mensaje="¿Confirma su acción? Esta acción no podrá ser rectificada";
	if (confirm(mensaje)){
		return true;
	}
	else{
		return false;
		self.close();
	}
}