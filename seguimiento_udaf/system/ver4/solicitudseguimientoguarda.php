<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bsecretaria));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?
	$mtusuario = $_SESSION['user_id'];	
	$lineas = sizeof($descripcion);
	$cnt = 0;
	$ban = 0;
	while ($cnt <= $lineas)
	{
		if (strlen($descripcion[$cnt])>0)
		{
			$query = "insert into bseguimiento
						(id_documento,  
						 descripcion,fechahora,id_usuario)
					  values 
						('$id_documento',
						'".$descripcion[$cnt]."',getdate(),'$mtusuario')";
			$dbms->sql = $query;
			$dbms->Query();

			$dbms->sql = "update docs_udaf set estado = 5 where estado in (5) and id_documento = $id_documento";
			$dbms->Query();

			$ban = 1;
		}	
		$cnt ++;		
	}
	if ($ban == 1)	
	{
		$mensaje = "Observación guardada satisfactoriamente";
	}else
	{
		$mensaje = "No se ha guardado ninguna información, favor completar los campos anteriores";
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
    <td colspan="2"><? print $mensaje;?></td>
  </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="379">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? print "<a href=\"solicitud_ver.php?id_documento=$id_documento\">Regresar</a>";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
