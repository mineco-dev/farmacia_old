<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<? include('../includes/inc_header_sistema.inc'); 


	function fecha(){
	$mes = date("n");
	$mesArray = array(
		1 => "Enero", 
		2 => "Febrero", 
		3 => "Marzo", 
		4 => "Abril", 
		5 => "Mayo", 
		6 => "Junio", 
		7 => "Julio", 
		8 => "Agosto", 
		9 => "Septiembre", 
		10 => "Octubre", 
		11 => "Noviembre", 
		12 => "Diciembre"
	);

	$semana = date("D");
	$semanaArray = array(
		"Mon" => "Lunes", 
		"Tue" => "Martes", 
		"Wed" => "Miercoles", 
		"Thu" => "Jueves", 
		"Fri" => "Viernes", 
		"Sat" => "S�bado", 
		"Sun" => "Domingo", 
	);
	
	$mesReturn = $mesArray[$mes];
	$semanaReturn = $semanaArray[$semana];
	$dia = date("d");
	$a�o = date ("Y");
	
return $semanaReturn." ".$dia." de ".$mesReturn." de ".$a�o;
}

function fecha1($dia,$mes){

	$mesArray = array(
		'01' => "Enero", 
		'02' => "Febrero", 
		'03' => "Marzo", 
		'04' => "Abril", 
		'05' => "Mayo", 
		'06' => "Junio", 
		'07' => "Julio", 
		'08' => "Agosto", 
		'09' => "Septiembre", 
		'10' => "Octubre", 
		'11' => "Noviembre", 
		'12' => "Diciembre"
	);

	
	$semanaArray = array(
		"Mon" => "Lunes", 
		"Tue" => "Martes", 
		"Wed" => "Miercoles", 
		"Thu" => "Jueves", 
		"Fri" => "Viernes", 
		"Sat" => "S�bado", 
		"Sun" => "Domingo",  
	);
	
	$mesReturn = $mesArray[$mes];
	$semanaReturn = $semanaArray[$dia];
	
	$a�o = date ("Y");
	
return $semanaReturn." ".$dia." de ".$mesReturn." de ".$a�o;
}

$x = fecha();









$query =("select a.nombre+' '+a.nombre2+' '+a.nombre3+' '+a.apellido+' '+a.apellido2,
convert(varchar,a.fecha_nacimiento,105),a.apellido,a.sexo,d.nombre 
from asesor a, direccion d  where a.idasesor = $idasesor and a.iddireccion = d.iddireccion");

$result = mssql_query($query);
$vec = mssql_fetch_array($result);

list( $dia, $mes, $a�o ) = split( '[-__]', $vec[1] );

//print 'dia'.$dia.'mes'.$mes.'a�o'.$a�o;

$valor = fecha1($dia,$mes);
?></head>

<body>

<p align="right">&nbsp;</p>
<p align="right">&nbsp;</p>
<p align="right"><em>Guatemala, <strong><? print $x;?></strong></em></p>
<p align="right"><em>&nbsp;</em></p>
<p><strong><em><? if ($vec[3] == 'M') { print 'Se�or';}else{ print 'Se�ora';}?></em></strong><br />
    <strong><em><? print $vec[0];?></em></strong><br />
    <em>MINISTERIO DE ECONOMIA </em>
    <br/>
<em><? print $vec[4];?></em></p>
<p><em>&nbsp;</em></p>
<p><em><? if ($vec[3] == 'M') { print 'Se�or  ';}else{ print 'Se�ora  ';}?><strong><? print $vec[2];?></strong></em></p>
<p><br />
  <em>De acuerdo al Pacto Colectivo de  Condiciones de Trabajo, articulo 10&ordm; Inciso f), tiene permiso con goce de  sueldo para ausentarse de sus labores el <strong><? print $valor; ?></strong>; si su cumplea&ntilde;os es un d&iacute;a inh&aacute;bil puede  disfrutarlo el d&iacute;a h&aacute;bil inmediato. Por favor coordinar con su Jefe inmediato  para disfrutar dicho permiso.</em></p>
<p><em>&nbsp;</em></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><em>Cordialmente,</em></p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><em>&nbsp;</em></p>
<p><em>c.c. <? print $vec[4];?></em></p>
</body>
</html>
