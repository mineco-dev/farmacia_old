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
-->
</style>
</head>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><table width="100%" height="98"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="13%" rowspan="3"><div align="center"><img src="../images/logo_rpt.gif" width="82" height="95">
		  </div></td>
        <td colspan="2"><div align="right">
          <div align="center">
            <p class="titulomenu">
    <?
			$hoja_despacho=$_SESSION["hoja_despacho"];
			$existe=false;
			$qry_ingreso_enc = "select * from tb_ingreso_enc where numero_documento='$hoja_despacho' and codigo_tipo_documento=1";
			conectardb($almacen);
			$res_ingreso_enc=$query($qry_ingreso_enc);
			while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
			{
			 	$codigo_ingreso_enc=$row_ingreso_enc["codigo_ingreso_enc"];
				$solicitante=$row_ingreso_enc["solicitante"];
				$observaciones=$row_ingreso_enc["observaciones"];
				$fecha_documento=$row_ingreso_enc["fecha_documento"];
				$requisicion=$row_ingreso_enc["numero_requisicion"];
				$fecha_requisicion=$row_ingreso_enc["fecha_requisicion"];
				$existe=true;
				
			}
			$free_result($res_ingreso_enc);	
			if ($existe==true)
			{								
		?>
  HOJA DE DESPACHO INGRESADA </p>
            </div>
          </div></td>
        </tr>
      <tr>
        <td height="60"><div align="left">
          <table width="98%"  border="1" align="left" cellpadding="0" cellspacing="0">
            <tr class="titulotabla">
              <td><div align="left">SOLICITANTE</div>                <div align="center"></div></td>
              </tr>
            <tr>
              <td><span class="titulomenu"><? echo $solicitante; ?></span></td>
              </tr>
            <tr>
              <td><span class="titulomenu">
                <? 
		//$codigo_bodega=$_SESSION["bodega"];				
		//include("bodega.php"); 
		echo '<span class="titulomenu">CLINICA Z.1</span>';						
	?>
              </span></td>
              </tr>
          </table>
          <span class="titulomenu">&nbsp;          </span></div>          </td>
        <td width="44%">
          <table width="98%"  border="1" align="right" cellpadding="0" cellspacing="0">
            <tr class="titulotabla">
              <td width="49%"><div align="center">DESPACHO</div></td>
              <td width="51%"><div align="center">REQUISICI&Oacute;N</div></td>
            </tr>
            <tr>
              <td><span class="titulomenu">N&uacute;mero: <? echo $hoja_despacho; ?> </span></td>
              <td><span class="titulomenu">N&uacute;mero: <? echo $requisicion; ?></span></td>
            </tr>
            <tr>
              <td><span class="titulomenu">Fecha:&nbsp;&nbsp;&nbsp;
                    <?
				echo substr($fecha_documento,0,12);
  			?>
              </span></td>
              <td><span class="titulomenu">Fecha: &nbsp;&nbsp;
                    <?
				echo substr($fecha_requisicion,0,12);
  			?>
              </span></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td colspan="2"><span class="titulomenu">Observaciones:</span><span class="titulomenu"><? echo $observaciones; ?></span></td>
        </tr>
      <tr>
        <td height="2" colspan="3"></td>		
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
        <td width="15%"><div align="center">C�digo</div></td>
        <td width="40%"><div align="center">Descripción</div></td>
        <td width="15%"><div align="center">Uni. Medida</div></td>
        <td width="15%"><div align="center">Cantidad solicitada</div></td>
        <td width="15%"><div align="center">Cantidad despachada</div></td>
      </tr>	  
	 <?	  	
		$qry_ingreso_det = "select * from view_despacho where codigo_ingreso_enc=$codigo_ingreso_enc";
		conectardb($almacen);
		$res_ingreso_det=$query($qry_ingreso_det);		
		while($row_ingreso_det=$fetch_array($res_ingreso_det))
		{			
			$operador=$row_ingreso_det["usuario_creo"];
			$operado=$row_ingreso_det["fecha_creado"];
			echo '<tr><td align="center" width="15%"><span class="descripcionproducto">'.$row_ingreso_det["codigo_categoria"].' '.$row_ingreso_det["codigo_subcategoria"].' '.$row_ingreso_det["codigo_producto"].'</span></td>';
			echo '<td align="left" width="40%"><span class="descripcionproducto">'.$row_ingreso_det["descripcion"].'</span></td>';
			echo '<td align="center" width="15%"><span class="descripcionproducto">'.$row_ingreso_det["unidad_medida"].'</span></td>';
			echo '<td align="center" width="15%"><span class="descripcionproducto">'.$row_ingreso_det["cantidad_solicitada"].'</span></td>';
			echo '<td align="center" width="15%"><span class="descripcionproducto">'.$row_ingreso_det["cantidad_ingresada"].'</span></td></tr>';			
		}
		$free_result($res_ingreso_det);
	  ?>
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
</table>
<p>&nbsp;</p>
<p><img src="../images/iconos/ico_print.gif" onclick="imprimir();"  alt="Clic para Imprimir este documento" width="30" height="30" />
<br><span class="defaulttext Estilo2">Operado por: <? echo $operador; ?> El <? echo date("d/m/Y H:i:s"); ?></span></p>
<?
}
else
{
echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
echo '<TR><TD COLSPAN="5"><span class="error"><center>NO SE ENCONTRO NINGUNA HOJA DE DESPACHO CON EL N�MERO --> </span>'.$hoja_despacho.' </center></TD></TR>';					
}
?>
</body>
</html>
