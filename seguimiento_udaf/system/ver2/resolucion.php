<?
	session_start();
?>
<?
	require('../includes/cnn/inc_header.inc');
	require('../includes/funciones.php');
	$dbms=new DBMS(conectardb($uipopera));	
	$dbms->bdd=$database_cnn;
	$mtforma = $_REQUEST['Id1']; 
	$mttipo  = $_REQUEST['Id2']; 
	$idsolicitud = $_REQUEST['Id3']; 
	
	if ((intval($mtforma) > 0) && (intval($mttipo)>0))
	{

	$Fields1=get_valores("idtiposolicitud,upper(nombre) as nombre,correo,telefono,direccion,
						pregunta,idusuario,genero,
						CONVERT(nvarchar(10), fechahora, 103) as fecha,
						CONVERT(nvarchar(10), fechahora, 108) as hora,
						idpais,orden,registro,idmunicipio,pasaporte,idtipomaterial",
						"tbl_solicitud",
						"where idsolicitud = $idsolicitud","",$dbms);
	
	$tiposolicitud = get_valores("nombre",
								"tbl_tiposolicitud",
								"where idtiposolicitud = ".$Fields1["idtiposolicitud"],"",$dbms);

	$genero = get_genero($Fields1["genero"]);
	
	$nacionalidad = get_valores("pais",
							"tbl_pais",
							"where idpais = ".$Fields1["idpais"],"",$dbms);

	$orden = get_valores("orden",
							"tbl_orden",
							"where idorden = ".$Fields1["orden"],"",$dbms);

	$respuesta = get_valores("descripcion",
							"tbl_tipomaterial",
							"where idtipomaterial = ".$Fields1["idtipomaterial"],"",$dbms);
	
	
?>
<table width="90%" border="0" align="center" class="panel">
  <tr>
    <td colspan="2"><img src="../../Imagenes/escudo_r3.jpg" border="0"/></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>RESOLUCI&Oacute;N</strong></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<? 
		print get_parrafo($mtforma,$mttipo,1,$dbms);
	?>
	<input name="fecha" type="text" id="dateArrival" onclick="popUpCalendar(this, form1.dateArrival, 'dd-mm-yyyy');" size="10" 
    value ="<? print date("d")."-".date("m")."-".date("Y");?>"/>
	<img src="images/iconCalendar.gif" width="16" height="16" border="0" onclick="popUpCalendar(this, form1.dateArrival, 'dd-mm-yyyy');"/></td>
  </tr>
  <tr>
    <td colspan="2"><? print get_parrafo($mtforma,$mttipo,2,$dbms);?></td>
  </tr>
  <tr>
    <td width="153">&nbsp;</td>
    <td width="699">
	<? 
		$Fields1["nombre"] = convertLatin1ToHtml($Fields1["nombre"]);
		print $Fields1["nombre"]; 
		print get_parrafo($mtforma,$mttipo,3,$dbms);
	?></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><textarea name="pregunta" cols="90" rows="4" id="pregunta"><? print convertLatin1ToHtml($Fields1["pregunta"]); ?></textarea></td>
  </tr>
  
  <tr>
    <td colspan="2"><div align="justify">
	<? 
		print get_parrafo($mtforma,$mttipo,4,$dbms)." ";
	 	print $Fields1["nombre"]; 
	?>
     <? 
		print get_parrafo($mtforma,$mttipo,5,$dbms);
		if ((intval($mtforma) == 1)&&(intval($mttipo) == 1)) print get_materialessolicitud($idsolicitud,$dbms); 
	?>
    <? 	print get_parrafo($mtforma,$mttipo,6,$dbms)." ";
			if (intval($mttipo)!= 1) print $Fields1["nombre"]; 
		?>
    <? print get_parrafo($mtforma,$mttipo,7,$dbms);?></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="justify"></div></td>
  </tr>
  
  <tr>
    <td colspan="2"><div align="justify"></div></td>
  </tr>
</table>
<?
}
?>