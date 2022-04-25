<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($uipopera));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?
	$mtusuario = $_SESSION['user_id'];	
	$tbl = $tbl_;
	$cmp = "id".$cmp_;
	
	$maxsoli = intval(get_max("tbl_solicitud","numero",$dbms))+1;
	
	$query = "update tbl_$tbl set activo = 0, idusuariomodifica = $mtusuario, fechahoramodifica=getdate() 
				where $cmp = $idreg";
				
	$dbms->sql = $query;
	$dbms->Query();
	if (strcmp($tbl,"respuesta")==0) 
	{
		$dbms->sql="select idsolicitud  
					from tbl_$tbl 
					where $cmp = $idreg
					order by idsolicitud desc";
		$dbms->Query();
		$Fields=$dbms->MoveNext();
		$idsoli = $Fields["idsolicitud"];
		
		$query = "update tbl_solicitud set idstatus = 1 
					where idsolicitud = $idsoli";
		$dbms->sql = $query;
		$dbms->Query();
	}
	
	$mensaje = "Operación realizada correctamente... ";
?>
<head>
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
    <td colspan="2"><? print "<a href=\"javascript:history.back()\">Regresar</a>";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
