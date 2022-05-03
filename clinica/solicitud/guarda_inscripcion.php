<?
	require('../includes/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>
<body>
<?
$user_name = 0;

/////////////////////////////////// inserta datos del contrato	/////////////////////////////////////////
$query ="insert into tb_contrato_garantia";
$query.="(codigo_municipio, fecha_celebracion, edificio, colonia, aldea, calle, casa, codigo_zona, 
          monto, interes, plazo_o_condicion, codigo_status, usuario_creo, fecha_creado) ";
$query.="values ('$municipio', '$date1', '$edificio', '$colonia',  '$aldea', '$calle', '$casa', 
          '$zona', '$monto', '$intanual', '$plazo', 1, '$user_name', now())";
$dbms->sql = $query;
$dbms->QueryI();
print $dbms->sql."<br>";
/////////////////////////////////// selecciona el contrato guardado	/////////////////////////////////////////
$dbms->sql="select max(codigo_contrato) as ultimo_contrato from tb_contrato_garantia";
$dbms->Query();
$Fields2=$dbms->MoveNext();	
$contrato = $Fields2["ultimo_contrato"];
print $dbms->sql."<br>";
/////////////////////////////////// inserta detalle del contrato //////////////////////////////////////////
$qry_insertar_contrato_det ="insert into tb_contrato_garantia_detalle";
$qry_insertar_contrato_det.="(activo, codigo_contrato, codigo_motivo_inscripcion, codigo_tipo_garantia,  usuario_creo, fecha_creado,usuario) ";
$qry_insertar_contrato_det.="values (1, $ultimo_contrato, 1, $tipo_garantia, '$user_name', now(),12)";
$dbms->sql = $qry_insertar_contrato_det;
$dbms->QueryI();
print $dbms->sql."<br>";
/////////////////////////////////// selecciona el detalle del contrato /////////////////////////////////////////
$dbms->sql="select max(codigo_detalle_contrato) as ultimo_detalle_contrato from tb_contrato_garantia_detalle";
$dbms->Query();
$Fields2=$dbms->MoveNext();	
$contrato_detalle = $Fields2["ultimo_detalle_contrato"];
print $dbms->sql."<br>";
/////////////////////////////////// inserta pago ///////////////////////////////////////////////////////
$cnt = 1;
while ($cnt <= count($boleta))
{
	$qry_insertar_pago ="insert into tb_detalle_pago";
	$qry_insertar_pago.="(codigo_banco, codigo_detalle_contrato, boleta, valor, usuario_creo, fecha_creado) ";
	$qry_insertar_pago.="values ('$banco[$cnt]', $detalle_contrato, $boleta[$cnt], $valor[$cnt], '$user_name', now())";
	$dbms->sql = $qry_insertar_pago;
	$dbms->QueryI();
	print $dbms->sql."<br>";
	$cnt ++;
}
/////////////////////////////////// inserta involucrado ///////////////////////////////////////////////////////
$qry_solicitante ="insert into tb_contrato_involucrado";
$qry_solicitante.="(codigo_detalle_contrato, codigo_persona_individual, codigo_actuacion, nombramiento, folio, libro, numero_inscripcion, usuario_creo, fecha_creado) ";
$qry_solicitante.="values ($detalle_contrato, '$nombre[0][1]', '$actuacion', 1, '$folio', '$libro', '$inscripcion', '$user_name', now())";
$dbms->sql = $qry_solicitante;
$dbms->QueryI();
print $dbms->sql."<br>";
/////////////////////////////////// inserta deudores ///////////////////////////////////////////////////////
$cnt=1; 		
while($cnt<=count($deudor))
{	
	$codigo=$deudor[$cnt][1];
	$qry_involucrados ="insert into tb_contrato_involucrado";
	$qry_involucrados.="(codigo_detalle_contrato, codigo_persona_individual, codigo_actuacion, usuario_creo, fecha_creado) ";
	$qry_involucrados.="values ($detalle_contrato, $codigo, 1, '$user_name', now())";
	$dbms->sql = $qry_involucrados;
	$dbms->QueryI();
	print $dbms->sql."<br>";
	$cnt++;		
} 		
/////////////////////////////////// inserta acreedores ///////////////////////////////////////////////////////
$cnt=1; 		
while($cnt<=count($acreedor))
{						
	$codigo=$acreedor[$cnt][1];
	$qry_involucrados ="insert into tb_contrato_involucrado";
	$qry_involucrados.="(codigo_detalle_contrato, codigo_persona_individual, codigo_actuacion, usuario_creo, fecha_creado) ";
	$qry_involucrados.="values ($detalle_contrato, $codigo, 2, '$user_name', now())";
	$dbms->sql = $qry_involucrados;
	$dbms->QueryI();
	print $dbms->sql."<br>";
	$cnt++;
} 	     
/////////////////////////////////// inserta bienes ///////////////////////////////////////////////////////
$cnt=1; 		
while($cnt<=count($bien))
{						
	$qry_bien ="insert into tb_detalle_contrato_bien";
	if ($registro!=0) 
	{
		$qry_bien.="(descripcion, codigo_bien, codigo_detalle_contrato, id_dominio_registral, expedienteregistro) ";
		$qry_bien.="values ('$descripcion[$cnt]', $bien[$cnt][1], $detalle_contrato, $otror[$cnt], '$expediente[$cnt]')";			
	}
	else 
	{
		$qry_bien.="(descripcion, codigo_bien, codigo_detalle_contrato) ";
		$qry_bien.="values ('$descripcion[$cnt]', $bien[$cnt][1], $detalle_contrato)";			

	}		
	$dbms->sql = $qry_bien;
	$dbms->QueryI();
	print $dbms->sql."<br>";
	$cnt++;
}		
///////////////////////////////////////////////////////////////////////////////////////////////////////////
// inserta datos en el formulario para generar el numero en pantalla (10)	
/*	$qry_formulario ="insert into tb_formulario";
	$qry_formulario.="(usuario_creo, fecha_creado, codigo_motivo_inscripcion, codigo_detalle_contrato) ";
	$qry_formulario.="values ('$user_name', now(), 1, $ultimo_detalle_contrato)";
	$query($qry_formulario);			
// busca el No. de formulario insertado recientemente (11)
	$qry_ultimo_formulario="select max(codigo_formulario) as ultimo_formulario from tb_formulario";
	$res_qry_ultimo_formulario=$query($qry_ultimo_formulario);	
	while($row_ultimo_formulario=$fetch_array($res_qry_ultimo_formulario))	
	{
		$ultimo_formulario=$row_ultimo_formulario["ultimo_formulario"];
	}			
// busca el No. de contrato insertado recientemente (12)
		$qry_pref_form="select abreviatura from tb_motivo_inscripcion where codigo_motivo_inscripcion=1";
		$res_qry_pref_form=$query($qry_pref_form);	
		while($row_pref_form=$fetch_array($res_qry_pref_form))	
		{
			$prefijo=$row_pref_form["abreviatura"];
		}					
//genera numero de formulario y lo actualiza en la DB (13)
	$codigo_formulario=$prefijo.'-'.$ultimo_formulario;
	$qry_formulario ="update tb_formulario ";
	$qry_formulario.="set no_identificacion='$codigo_formulario' ";
	$qry_formulario.="where codigo_formulario=$ultimo_formulario";
	$query($qry_formulario);
	
	*/	
?>
</body>
</html>
