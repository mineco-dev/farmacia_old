<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($uipopera));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?
	$mtusuario = $_SESSION['user_id'];	
	$lineas = sizeof($valor);
	$cnt = 0;
	$ban = 0;
	while ($cnt <= $lineas)
	{
		if (($valor[$cnt]>0))
		{
			$query = "insert into tbl_cobro
						(idsolicitud, valor, idtipocobro, 
						 descripcion,fechahora,idusuario)
					  values 
						('$idsolicitud',".$valor[$cnt].",'".$tipocobro[$cnt]."',
						'".$descripcion[$cnt]."',getdate(),'$mtusuario')";
			$dbms->sql = $query;
			$dbms->Query();

			$dbms->sql = "update tbl_solicitud set idstatus = 1 where idstatus = 5 and idsolicitud = $idsolicitud";
			$dbms->Query();

			$ban = 1;
		}	
		$cnt ++;		
	}
	if ($ban == 1)	
	{
		$mensaje = "Cobro(s) guardado(s) satisfactoriamente";
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
    <td colspan="2"><? print "<a href=\"solicitud_ver.php?idsolicitud=$idsolicitud\">Regresar</a>";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
