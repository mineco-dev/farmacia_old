<?
	session_start();
	require('../includes/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
	require_once('../includes/conectarse.php');
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?
$user_name = 0;
/////////////////////////////////// inserta datos del contrato	/////////////////////////////////////////
$query ="insert into tb_contrato_garantia";
$query.="(codigo_municipio, fecha_celebracion, edificio, colonia, aldea, calle, casa, codigo_zona, 
          monto, interes, plazo_o_condicion, codigo_status, usuario_creo, fecha_creado) ";
$query.="values ('$municipio', '$date1', '$edificio', '$colonia',  '$aldea', '$calle', '$casa', 
          '$zona', '$monto', '$ianual', '$plazo', 1, '$user_name', now())";
$dbms->sql = $query;
$dbms->QueryI();
//print $dbms->sql."<br>";
/////////////////////////////////// selecciona el contrato guardado	/////////////////////////////////////////
$dbms->sql="select max(codigo_contrato) as ultimo_contrato from tb_contrato_garantia";
$dbms->Query();
$Fields2=$dbms->MoveNext();	
$contrato = $Fields2["ultimo_contrato"];
//print $dbms->sql."<br>";
/////////////////////////////////// inserta detalle del contrato //////////////////////////////////////////
$qry_insertar_contrato_det ="insert into tb_contrato_garantia_detalle";
$qry_insertar_contrato_det.="(activo, codigo_contrato, codigo_motivo_inscripcion, codigo_tipo_garantia,  usuario_creo, fecha_creado,usuario,codigo_estado,preimpreso) ";
$qry_insertar_contrato_det.="values (1, $contrato, 1, $tipo_garantia, '$user_name', now(),12,1,'$nexpediente')";
$dbms->sql = $qry_insertar_contrato_det;
$dbms->QueryI();
print $dbms->sql."<br>";
/////////////////////////////////// selecciona el detalle del contrato /////////////////////////////////////////
$dbms->sql="select max(codigo_detalle_contrato) as ultimo_detalle_contrato from tb_contrato_garantia_detalle";
$dbms->Query();
$Fields2=$dbms->MoveNext();	
$detalle_contrato = $Fields2["ultimo_detalle_contrato"];
//print $dbms->sql."<br>";
/////////////////////////////////// inserta pago ///////////////////////////////////////////////////////
$cnt = 1;
while ($cnt <= count($boleta))
{
	$qry_insertar_pago ="insert into tb_detalle_pago";
	$qry_insertar_pago.="(codigo_banco, codigo_detalle_contrato, boleta, valor, usuario_creo, fecha_creado) ";
	$qry_insertar_pago.="values ('$banco[$cnt]', $detalle_contrato, $boleta[$cnt], $valor[$cnt], '$user_name', now())";
	$dbms->sql = $qry_insertar_pago;
	$dbms->QueryI();
	//print $dbms->sql."<br>";
	$cnt ++;
}
/////////////////////////////////// inserta involucrado ///////////////////////////////////////////////////////
$codigo=$nombre[0][1];
$qry_solicitante ="insert into tb_contrato_involucrado";
$qry_solicitante.="(codigo_detalle_contrato, codigo_persona_individual, codigo_actuacion, solicitante, folio, libro, numero_inscripcion, usuario_creo, fecha_creado) ";
$qry_solicitante.="values ($detalle_contrato, '$codigo', '$actuacion', 1, '$folio', '$libro', '$inscripcion', '$user_name', now())";
$dbms->sql = $qry_solicitante;
$dbms->QueryI();
//print $dbms->sql."<br>";
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
	//print $dbms->sql."<br>";
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
	//print $dbms->sql."<br>";
	$cnt++;
} 	     
/////////////////////////////////// inserta bienes ///////////////////////////////////////////////////////
$cnt=1; 		
while($cnt<=count($bien))
{						
	$codigo = $bien[$cnt][1];
	$qry_bien ="insert into tb_detalle_contrato_bien";
	if ($otror[$cnt]!=0) 
	{
		$qry_bien.="(descripcion, codigo_bien, codigo_detalle_contrato, id_dominio_registral, expedienteregistro) ";
		$qry_bien.="values ('$descripcion[$cnt]', '$codigo', $detalle_contrato, $otror[$cnt], '$expediente[$cnt]')";			
	}
	else 
	{
		$qry_bien.="(descripcion, codigo_bien, codigo_detalle_contrato) ";
		$qry_bien.="values ('$descripcion[$cnt]', '$codigo', $detalle_contrato)";			
	}		
	$dbms->sql = $qry_bien;
	$dbms->QueryI();
	//print $dbms->sql."<br>";
	$cnt++;
}		
/////////////////////////////////////// Generar Numero en pantalla   /////////////////////////////////////////////////
$qry_formulario ="insert into tb_formulario";
$qry_formulario.="(usuario_creo, fecha_creado, codigo_motivo_inscripcion, codigo_detalle_contrato,status) ";
$qry_formulario.="values ('$user_name', now(), 1, $detalle_contrato,1)";
$dbms->sql = $qry_formulario;
$dbms->QueryI();
//print $dbms->sql."<br>";
/////////////////////////////////////// Buscar formulario reciente  /////////////////////////////////////////////////
$dbms->sql="select max(codigo_formulario) as ultimo_formulario from tb_formulario";
$dbms->Query();
$Fields2=$dbms->MoveNext();	
$ultimo_formulario = $Fields2["ultimo_formulario"];
//print $dbms->sql."<br>";
/////////////////////////////////////// Buscar abreviatura  /////////////////////////////////////////////////
$dbms->sql="select abreviatura from tb_motivo_inscripcion where codigo_motivo_inscripcion=1";
$dbms->Query();
$Fields2=$dbms->MoveNext();	
$prefijo = $Fields2["abreviatura"];
//print $dbms->sql."<br>";
/////////////////////////////////////// Genera codigo de formulario  /////////////////////////////////////////////////
$codigo_formulario=$ultimo_formulario.'-'.$prefijo;
$qry_formulario ="update tb_formulario ";
$qry_formulario.="set no_identificacion='$codigo_formulario' ";
$qry_formulario.="where codigo_formulario=$ultimo_formulario";
$dbms->sql = $qry_formulario;
$dbms->QueryI();

$req = "Favor presentar los siguientes documentos: <br><br>
Boleta de Pago <br>
Carta Poder <br>
Nombramiento <br>	
Mandato <br>
Contrato de Garantia Mobiliaria <br>
Notificaciones a otro Acreedores garantizados (Art. 17 Decreto Número 51-2007) <br>
Otros <br>
";

session_register('no_formulario');
$_SESSION['no_formulario'] = $codigo_formulario . "<br><br>".$req;
cambiar_ventana("../index.php?id=28&ms=11");
?>
<table width="100%" border="0">
  <tr>
    <td><div align="center">Solicitud guardada correctamente,<strong> No. <? print $codigo_formulario;?> </strong></div></td>
  </tr>
</table>
</body>
</html>
