<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($uipopera));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?
	$mtusuario = $_SESSION['user_id'];	
	$ban = 0;
	
	$Fields1=get_valores("upper(nombre) as nombre", "tbl_solicitud", "where idsolicitud = $idsolicitud","",$dbms);
	$Fields1["nombre"] = convertLatin1ToHtml($Fields1["nombre"]);
	
	$respuesta = get_parrafo($midforma,$idtiporespuesta,1,$dbms)." ".get_formatofecha($fecha)."<br><br><br>".
				 get_parrafo($midforma,$idtiporespuesta,2,$dbms)."<br>".
				 "<ul>".$Fields1["nombre"].get_parrafo($midforma,$idtiporespuesta,3,$dbms)." ".$pregunta."</ul>".
				 get_parrafo($midforma,$idtiporespuesta,4,$dbms)." ".
				 $Fields1["nombre"]." ".get_parrafo($midforma,$idtiporespuesta,5,$dbms);
				 
	if ((intval($midforma) == 1)&&(intval($idtiporespuesta) == 1)) 
		$respuesta = $respuesta . get_materialessolicitud($idsolicitud,$dbms); 

	$respuesta = $respuesta . get_parrafo($midforma,$idtiporespuesta,6,$dbms)." ";
	
	if (intval($idtiporespuesta)!= 1) $respuesta = $respuesta . $Fields1["nombre"]; 

	$respuesta = $respuesta . get_parrafo($midforma,$idtiporespuesta,7,$dbms);

	if (strlen($pregunta)>0)
	{
		$query = "insert into tbl_respuesta
					(idtiporespuesta, idforma, 
					 idsolicitud, pregunta, 
					 respuesta,idusuario,
					 fechahora)
				  values 
					('$idtiporespuesta', '$midforma', 
					 '$idsolicitud', '$pregunta', 
					 '$respuesta','$mtusuario',
					 getdate())";
		$dbms->sql = $query;
		$dbms->Query();
		
		
		
		$dbms->sql = "update tbl_solicitud set idstatus = (1+$idtiporespuesta) 
						where (idstatus = 5 or idstatus = 1) and idsolicitud = $idsolicitud";
		$dbms->Query();

		$ban = 1;
		$maxrespuesta = get_max("tbl_respuesta","idrespuesta",$dbms);
	}	
	
	if ($ban == 1)	
	{
		$mensaje = "Resolución guardada correctamente de la siguiente manera: 
		<hr>
		<br>
		<br>
		<img src=\"../../Imagenes/escudo_r3.jpg\">
		<br>
		$respuesta
		<br>
		<br>
		<br>
		<div align=\"center\">
		<a href=\"resolucionimp.php?idrespuesta=$maxrespuesta\" target=\"_blank\">
		<img src=\"../../Imagenes/printer.png\" border=\"0\"> Imprimir Resolución</a>
		</div>
		<br><hr>";
	}else
	{
		$mensaje = "No se ha podido guardar la resolución, favor completar los campos anteriores";
	}
?>
<head>
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body oncontextmenu="return false">
<p>&nbsp;</p>
<table width="80%" border="0" align="center" class="panel">
  <tr>
    <td colspan="2">
    <div align="justify"><? print $mensaje;?></div></td>
  </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="379"></td>
  </tr>
  <tr>
    <td colspan="2"><? print "<a href=\"solicitud_ver.php?idsolicitud=$idsolicitud\">Regresar</a>";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
