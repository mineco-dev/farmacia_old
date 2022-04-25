<?
	require("envio_correo.php");
	require ("cnn/inc_header.inc");
	require ("funciones.php");
	$dbms=new DBMS(conectardb($bitacora));	
	$dbms->bdd=$database_cnn;
	
	///// se llena la información /////////////
	
	$query= "select codigo_usuario,e_mail from usuario where activo = 1 and codigo_usuario = 321";
	while ($resul=$fetch_array($query))
	 {
	$nomb_destino = "Recepcion documentos";
	$mail_destino = $resul["e_mail"];
	$nomb_remitente = "Ministerio de Economía";
	$mail_remitente = "webmaster@mineco.gob.gt";
	$mensaje = "Este es un mensaje de prueba <br> para utilizar la funcion de envio de correos";
	$titulo = "Prueba del correo";	
	
	////////  de esta manera se envian los correos //////
	
	envio($nomb_destino,$mail_destino,$nomb_remitente,$mail_remitente,$mensaje,$titulo,"","");   
}

	/*
		Los ultimos dos parametros se utilizan para enviar documentos adjuntos,
		el primer parametro es :
		$HTTP_POST_FILES['userfile']['name']
		el segundo parametro es el que tiene la ubicación del documento
		por el momento no se llenan estos parametros si no se adjuntan archivos
	*/

?>
