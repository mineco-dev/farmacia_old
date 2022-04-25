<?
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");		
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
function imprimir()
{
	window.print();
}
</script>
<style type="text/css">
<!--
.Estilo1 {font-size: x-large}
.Estilo2 {font-size: xx-small}
-->
</style>
</head>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="16%" rowspan="2"><div align="center"><img src="../images/logo_rpt.gif" width="82" height="95"><br>
              <? 
		//$codigo_bodega=$_SESSION["bodega"];				
		//include("bodega.php"); 
		echo '<span class="titulomenu">CLINICA Z.1</span>';
		$ultimo_registro_egreso=$_SESSION["ultimo_reg_egreso"];
	?> 
          </div></td>
        <td height="102" colspan="2">            <div align="right">
          <div align="center"><span class="tituloproducto"><span class="Estilo1">DRA. ALEYDA DEL CARMEN MONZ&Oacute;N ORDO&Ntilde;EZ</span><br>
  No. COLEGIADO 12,143 </span>
</div>
          </div></td>
        <td width="12%" rowspan="2"><img src="../images/logo_medicina.gif" width="93" height="95"></td>
      </tr>
      <tr>
        <td height="18" colspan="2"></td>
      </tr>
      <tr>
        <td colspan="4"> </td>
      </tr>
      <tr>
        <td colspan="4"></td>
		<?			
			$existe=false;
			$qry_egreso_enc = "select * from tb_egreso_enc where numero_documento='$ultimo_registro_egreso'";
			conectardb($almacen);
			$res_egreso_enc=$query($qry_egreso_enc);
			while($row_egreso_enc=$fetch_array($res_egreso_enc))
			{
			 	$codigo_empleado=$row_egreso_enc["solicitante"];
				$observaciones=$row_egreso_enc["observaciones"];
				$fecha_docto=$row_egreso_enc["fecha_documento"];
				$codigo_egreso_enc=$row_egreso_enc["codigo_egreso_enc"];
				$existe=true;
			}
			$free_result($res_egreso_enc);				
		if ($existe==true)		
		{
			$qry_paciente = "SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.idasesor
						  FROM asesor a where a.idasesor=$codigo_empleado";
			conectardb($rrhh);  
			$res_paciente=$query($qry_paciente);
			while($row_paciente=$fetch_array($res_paciente))
			{
				$nombre_paciente=$row_paciente["empleado"];
			}
			$free_result($res_paciente);				
		?>
      </tr>
      <tr>
        <td><span class="titulomenu">Paciente:&nbsp;</span>&nbsp;&nbsp;          </td>
        <td colspan="2"><input name="textfield" type="text" value="<? echo $nombre_paciente; ?>" size="65"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="titulomenu">Observaciones:</span>&nbsp;</td>
        <td colspan="2"><input name="textfield2" type="text" value="<? echo $observaciones; ?>" size="65"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
          <div align="left" class="titulomenu">Fecha:</div></td>
        <td width="52%"><span class="titulomenu">
		<?
				echo substr($fecha_docto,0,12);
  			?></span></td>
        <td colspan="2"><div align="right"><span class="tituloproducto">RECETA M&Eacute;DICA No. </span><span class="error"> <? echo $ultimo_registro_egreso; ?>&nbsp;</span> </div></td>
        </tr>
    </table></td>
  </tr>  
  <tr>    
    <td>  
    <td>  
    <td>  
  </tr>  
    <table width="95%"  border="1" align="center" cellpadding="0" cellspacing="0">
      <tr class="titulotabla">
        <td width="60%"><div align="center">Descripci&oacute;n</div></td>
        <td width="20%"><div align="center">Recetadas</div></td>
        <td width="20%"><div align="center">Entregadas</div></td>
      </tr>	  
	  <tr>	  
	  <td colspan="3">
		<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
      
	  <?	  	
		$qry_egreso_det = "select * from view_receta where codigo_egreso_enc=$codigo_egreso_enc";
		conectardb($almacen);
		$res_egreso_det=$query($qry_egreso_det);
		echo '<tr><td colspan="3">RP.</td></tr>';
		while($row_egreso_det=$fetch_array($res_egreso_det))
		{
			$operador=$row_egreso_det["usuario_creo"];
			$operado=$row_egreso_det["fecha_creado"];
			echo '<tr><td colspan="3" align="left"><span class="titulocategoria"><u>'.$row_egreso_det["producto"].'</u></span></td></tr>';	
			echo '<tr><td align="left" width="60%"><span class="descripcionproducto">'.$row_egreso_det["dosis"].'</span></td><td align="center" width="20%"><span class="descripcionproducto">'.$row_egreso_det["cantidad_recetada"].'</span></td><td align="center" width="20%"><span class="descripcionproducto">'.$row_egreso_det["cantidad_entregada"].'</span></td></tr>';
			echo '<tr><td colspan="3" align="center">&nbsp;</td></tr>';	
		}
		$free_result($res_egreso_det);
	  ?>  
    </table>
	</tr>		
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="titulomenu"><div align="center">(F)_______________________________</div></td>
    <td class="titulomenu"><div align="center">(F)_______________________________</div></td>
  </tr>
  <tr>
    <td height="19" class="titulomenu"><div align="center">Recib&iacute; conforme </div></td>
    <td height="19" class="titulomenu"><div align="center">Doctor(a)</div></td>
  </tr>
</table><br>
<table width="95%"  border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" class="titulotabla"><div align="center">PARA USO INTERNO (Desglose de productos a entregar, por lote y fecha de vencimiento)</div></td></tr>
  <tr>
    <td width="25%" class="titulomenu"><div align="center">Producto</div></td>
    <td width="25%" class="titulomenu"><div align="center">No. de lote </div></td>
    <td width="25%" class="titulomenu"><div align="center">Fecha de vencimiento </div></td>
    <td width="25%" class="titulomenu"><div align="center">Cantidad</div></td>
  </tr>
  	  <?	  	
		$qry_entregado_det = "select * from view_entregado_det where numero_documento='$ultimo_registro_egreso'";
		conectardb($almacen);
		$res_entregado_det=$query($qry_entregado_det);		
		while($row_entregado_det=$fetch_array($res_entregado_det))
		{			
			echo '<tr><td align="left"><span class="descripcionproducto">'.$row_entregado_det["producto"].'</span></td>';	
			echo '<td align="center"><span class="descripcionproducto">'.$row_entregado_det["lote"].'</span></td><td align="center"><span class="descripcionproducto">'.$row_entregado_det["fecha_vence"].'</span></td>';
			echo '<td align="center"><span class="descripcionproducto">'.$row_entregado_det["entregado"].'</span></td></tr>';	
		}
		$free_result($res_entregado_det);
	  ?>  
</table>
<p>&nbsp;</p>
<p><img src="../images/iconos/ico_print.gif" onclick="imprimir();"  alt="Clic para Imprimir este documento" width="30" height="30" />
<br><span class="defaulttext Estilo2">Operado por: <? echo $operador; ?> El <? echo $operado; ?></span></p>
<?
}
else
{
echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
echo '<TR><TD COLSPAN="5"><span class="error"><center>NO SE ENCONTRO NINGUNA RECETA</span></center></TD></TR>';					
}
?>
<p>&nbsp;</p>
</body>
</html>
