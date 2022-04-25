function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false; 
	try 
	{ 
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e)
	{ 
		try
		{ 
			// Creacion del objet AJAX para IE 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!="undefined") { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}

function eliminaEspacios(cadena)
{
	// Funcion equivalente a trim en PHP
	var x=0, y=cadena.length-1;
	while(cadena.charAt(x)==" ") x++;	
	while(cadena.charAt(y)==" ") y--;	
	return cadena.substr(x, y-x+1);
}

function validaIngreso(valor)
{
	/* Funcion encargada de validar lo ingresado por el usuario. Se devuelve TRUE en caso de ser 
	valido, FALSE en caso contrario */
	var reg=/(^[a-zA-Z0-9.@ ]{4,40}$)/;
	if(reg.test(valor)) return true;
	else return false;
}

function nuevoEvento(evento)
{
	// Obtengo el div donde se mostraran las advertencias y errores
	var divMensaje=document.getElementById("error");

	/* Dependiendo de cual sea el evento que ejecuto esta funcion (ingreso o verificacion) se setean
	distintas variables */	
	if(evento=="ingreso")
	{
		var input=document.getElementById("ingreso");
		// Boton presionado
		var boton=document.getElementById("botonIngreso");
		// Valor ingresado por el usuario
		var valor=input.value;
		// Texto a colocar en el input mientras se esta cargando la respuesta del servidor
		var textoAccion="Ingresando...";
	}
	else
	{
		var input=document.getElementById("verificacion");
		// Boton presionado
		var boton=document.getElementById("botonVerificacion");
		// Valor ingresado por el usuario
		var valor=input.value;
		// Texto a colocar en el input mientras se esta cargando la respuesta del servidor
		var textoAccion="Comprobando...";
	}
	// Elimino espacios por delante y detras de lo ingresado por el usuario
	valor=eliminaEspacios(valor);
	// Si el ingreso es invalido coloco un mensaje de error en la capa correspondiente
	if(!validaIngreso(valor)) 
	{
		divMensaje.innerHTML="El texto ingresado contiene caracteres o longitud inv&aacute;lida";
	}
	else
	{
		// Deshabilito inputs y botones para evitar dobles ingresos
		boton.disabled=true; input.disabled=true;
		input.value=textoAccion;
		
		// Creo la conexion con el servidor y le envio la variable evento (que le indica si debe ingresar o verificar) y el dato a utilizar
		var ajax=nuevoAjax();
		ajax.open("POST", "proceso_ingreso.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send(evento+"="+valor);
		
		ajax.onreadystatechange=function()
		{
			if (ajax.readyState==4)
			{
				// Habilito nuevamente botones e inputs
				input.value="";
				boton.disabled=false; input.disabled=false;
				// Muestro el mensaje enviado desde el servidor
				divMensaje.innerHTML=ajax.responseText;
			}
		}
	}
}