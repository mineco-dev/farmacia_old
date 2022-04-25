<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($uipopera));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?
	$Fields1=get_valores("respuesta", "tbl_respuesta", "where idrespuesta = $idrespuesta","",$dbms);
?>
<head>

</head>
<body oncontextmenu="return false">
<table width="70%" border="0" align="center" class="panel">
  <tr>
    <td colspan="3"><img src="../../Imagenes/escudo_r2.jpg"></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>RESOLUCION No. <? print $idrespuesta;?></strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
    <div align="justify"><? print $Fields1["respuesta"];?></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td width="196">&nbsp;</td>
    <td width="281"><hr></td>
    <td width="180"></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center">
      <p>Aurora Nohem&iacute; Hern&aacute;ndez G.<br>
  Jefe Unidad de  Informaci&oacute;n P&uacute;blica<br>
  Ministerio de Econom&iacute;a</p>
    </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
<?
	if (intval($imp)!=1)
	{
?>
	<script language='javascript'>
	print();
	</script>
<?
	}
?>
