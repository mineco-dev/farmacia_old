<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bsecretaria));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?
	
	$mtusuario = $_SESSION['user_id'];	
	$lineas = sizeof($userfile);
	$cnt = 0;
	$ban = 0;
	
	while ($cnt <= $lineas)
	{
		$nombre_archivo = $HTTP_POST_FILES['userfile']['name'][$cnt];
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type'][$cnt];
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size'][$cnt];
	
		$tmpfile = "upload/".$mtusuario."_".date("d").date("m").date("Y").date("H").date("i").date("s")."_".$nombre_archivo;
		
		if (strlen($userfile[$cnt])>0)
		{
			if(move_uploaded_file($_FILES['userfile']['tmp_name'][$cnt],$tmpfile))
			{ 
				$query = "insert into barchivos
						(id_documento, original, url, 
						 descripcion,fechahora,id_usuario,activo)
					  values 
						('$id_documento','$nombre_archivo','$tmpfile',
						'".$descripcion[$cnt]."',getdate(),'$mtusuario',1)";
				$dbms->sql = $query;
				$dbms->Query();
				$ban = 1;
	
				$dbms->sql = "update docs_udaf set estado = 5 where estado = (2,4,6,7,8) and id_documento =$id_documento";
				$dbms->Query();
			}
		}	
		$cnt ++;		
	}
	if ($ban == 1)	
	{
		$mensaje = "Documentos guardados satisfactoriamente";
	}else
	{
		$mensaje = "No se ha guardado ninguna informaci�n, favor completar los campos anteriores";
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
