<?php
function generaSelect()
{
	include 'conexion.php';
	conectar();
/*	$query="SELECT id, opcion FROM select_1";
	$consulta = mssql_query($query);*/
//	$consulta=mssql_query("SELECT id, opcion FROM select_1");
	$consulta=mssql_query("SELECT id, opcion FROM select_1");
//	echo $query;
//	desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mssql_fetch_array($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<!-- 



Este contenido es de libre uso y modificación bajo la siguiente licencia: http://creativecommons.org/licenses/by-nc-sa/2.5/deed.es

Sobre el reconocimiento:
Todos los c�digos han sido realizados con la idea de que sirvan para colaborar con el aprendizage de aquellos que se est�n introduciendo
en estas tecnolog�as y no con el objetivo de que sean utilizados directamente en sitios web. No obstante si utilizas alg�n c�digo en tu sitio 
(ya sea sin modificar o modificado), o si ofreces los fuentes para descargar o si bien decides publicar alguno de los art�culos debes cumplir con:
-Colocar un link a http://www.formatoweb.com.ar/ajax/ visible por tus usuarios como forma de mención a la fuente original del contenido.
-Enviar un correo a edanps@gmail.com informando la URL donde el contenido se ha publicado o se va a publicar en un futuro.
-Si publicas los fuentes para descargar este texto no debe ser eliminado ni alterado.

M�s ejemplos y material sobre AJAX en: http://www.formatoweb.com.ar/ajax/
Cualquier sugerencia, cr�tica o comentario son bienvenidos.
Contacto: edanps@gmail.com



-->

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link rel="stylesheet" type="text/css" href="select_dependientes_3_niveles.css">
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>
</head>

<body>

			<div id="demo" style="width:600px;">
				<div id="demoDer">
					<select disabled="disabled" name="select3" id="select3">
						<option value="0">Selecciona opci&oacute;n...</option>
					</select>
				</div>
				<div id="demoMed">
					<select disabled="disabled" name="select2" id="select2">
						<option value="0">Selecciona opci&oacute;n...</option>
					</select>
				</div>
				<div id="demoIzq"><?php generaSelect(); ?></div>
			</div>


<!--select name='a'>
	<? 
/* 	$querys="SELECT id, opcion FROM select_1";
	$consultas = mssql_query($querys);
	while ($cons = mssql_fetch_array($consultas))
	 {
	 ?>
	 <option value="<? echo $cons[0]; ?>"><? echo $cons[1]; ?></option>
	 <?
	 }
	?>
</select>
<select name='b'>
	<? 
 	$querys="SELECT id, opcion FROM select_2";
	$consultas = mssql_query($querys);
	while ($cons = mssql_fetch_array($consultas))
	 {
	 ?>
	 <option value="<? echo $cons[0]; ?>"><? echo $cons[1]; ?></option>
	 <?
	 }
	?>
</select>
<select name='c'>
	<? 
 	$querys="SELECT id, opcion FROM select_3";
	$consultas = mssql_query($querys);
	while ($cons = mssql_fetch_array($consultas))
	 {
	 ?>
	 <option value="<? echo $cons[0]; ?>"><? echo $cons[1]; ?></option>
	 <?
	 }*/
	?>
</select-->
</body>
</html>