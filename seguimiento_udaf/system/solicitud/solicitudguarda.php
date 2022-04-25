<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bitacora));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?
	//$tiposolicitud = $_REQUEST['tiposolicitud'];
	$unidad_ejecutora = $_REQUEST['cbo_ue'];
	$dependencia = $_REQUEST['iddireccion'];
	$nombre = $_REQUEST['idusuario'];
	$departamento = $_REQUEST['iddepto'];
	$gestion = $_REQUEST['idgestion'];
	$cantidad = $_REQUEST['cantidad'];	
	$descripcion = $_REQUEST['descripcion'];
	$mtusuario = $_SESSION['user_id'];	

	$nombre_archivo = $HTTP_POST_FILES['userfile']['name'];
	$tipo_archivo = $HTTP_POST_FILES['userfile']['type'];
	$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];

	$mtusuario = $_SESSION['user_id'];	

	$tmpfile = "upload/".$mtusuario."_".date("d").date("m").date("Y").date("H").date("i").date("s")."_".$nombre_archivo;
	
	
	$iporigen = getIP();
	
	$query = "insert into docs_udaf
	(id_gestion, id_ejecutora, id_dependencia, id_nombre, doct_sfp, cantidad, 
	dictamen_no, cur_no, observaciones, usuario_creo, documento,ip,fecha_creacion,
	activo,estado,iddepto_udaf)
values ('$gestion', '$unidad_ejecutora', '$dependencia', '$nombre', '$docto_sf', 
	'$cantidad', '$dictamen', '$cur_no', '$descripcion','$mtusuario', 
	'$tmpfile', '$iporigen', getdate(),1,1, '$departamento')";
	$dbms->sql = $query;
	$dbms->Query();
	
	if (strlen($userfile)>0)
	{
		move_uploaded_file($_FILES['userfile']['tmp_name'],$tmpfile);
	}		
	
	$mensaje = "Solicitud guardada satisfactoriamente, su solicitud es la No. <strong>".
				get_max("docs_udaf","id_documento",$dbms)."</strong> ";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />

</head>
<body oncontextmenu="return false">
<p>&nbsp;</p>
<table width="80%" border="0" align="center" class="panel">
  <tr>
    <td colspan="2"><? print $mensaje;?></td>
  </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="379">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    <? print "<a href=\"solicitud.php\">Regresar</a>";?>
    
    
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
