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
</head>

<body>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6%">&nbsp;</td>
    <td width="94%"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10%" rowspan="2"><img src="../images/logo_rpt.gif" width="82" height="95"> </td>
        <td width="90%">
		<?
			$inicio=$_SESSION["fecha_inicial"].' 00:00:00';
			$fin=$_SESSION["fecha_final"].' 23:59:59';
			$rpt_bodega=$_SESSION["rpt_bodega"];  			
			$dias=1; //dias a restar
			$fecha_inicio=substr($inicio,8,2).'-'.substr($inicio,5,2).'-'.substr($inicio,0,4);	
			$fecha_fin=substr($fin,8,2).'-'.substr($fin,5,2).'-'.substr($fin,0,4);				
			$fecha_saldo_inicial=date("d-m-Y", strtotime("$fecha_inicio -$dias day")); 		
  		?>
          <div align="right"><span class="tituloproducto">REPORTE DE PRODUCTOS POR VENCER</span><br>
              <? 
		//$codigo_bodega=$_SESSION["bodega"];				
		//include("bodega.php"); 
		echo '<span class="titulomenu">CLINICA ZONA 1</span>';
	?>
          </div></td>
      </tr>
      <tr>
        <td>          <div align="right"><span class="titulomenu">Del <? echo $fecha_inicio; ?> Al <? echo $fecha_fin; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2"> </td>
      </tr>
      <tr>
        <td colspan="2">          <?									
				conectardb($almacen);
				$encontro_registros=false;
				 if (isset($_SESSION["categoria"]))
				 {				
					$categoria=$_SESSION["categoria"];				
					$qry_categoria="select distinct(codigo_categoria), categoria from view_vencimiento 
									where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
									and codigo_categoria=$categoria";										
				 }							
				 else
				 {
				    $qry_categoria="select distinct(codigo_categoria), categoria from view_vencimiento 
									where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin'";									
				 }
					$res_qry_categoria=$query($qry_categoria);
					while($row_cat=$fetch_array($res_qry_categoria))				
					{						
						$codigo_categoria=$row_cat["codigo_categoria"];
						//imprime categoria	
						echo '<br>';
						echo '<span class="titulomenu">'.$row_cat["categoria"].'</span>';
						echo '<br>';
						
						if (isset($_SESSION["subcategoria"]))
						{										
							$subcategoria=$_SESSION["subcategoria"];						
							$qry_subcategoria="select distinct(codigo_subcategoria), subcategoria from view_vencimiento 
											   where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin'
											   and codigo_subcategoria=$subcategoria and codigo_categoria=$codigo_categoria";
						}
						else
						{
						    $qry_subcategoria="select distinct(codigo_subcategoria), subcategoria from view_vencimiento 
										      where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin'
											  and codigo_categoria=$codigo_categoria";
						}
							$res_qry_subcategoria=$query($qry_subcategoria);
							while($row_subcat=$fetch_array($res_qry_subcategoria))				
							{
								$codigo_subcategoria=$row_subcat["codigo_subcategoria"];
								//imprime subcategoria
								echo '<table width="100%"  border="1" cellpadding="0" cellspacing="0">';								
								if (isset($_SESSION["producto"]))
								{									
									$producto=$_SESSION["producto"];														
									$qry_nombre_producto="select existencia, codigo_producto, descripcion, fecha, operado from view_vencimiento 
														  where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
														  and codigo_producto=$producto";
								}
								else								
								if (isset($_SESSION["subcategoria"]))
								{									
									$qry_nombre_producto="select codigo_producto, descripcion, existencia, fecha, operado from view_vencimiento 
													  where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
													  and codigo_subcategoria=$codigo_subcategoria";
								}
								else
								{
									    $qry_nombre_producto="select codigo_producto, existencia, descripcion, operado, fecha from view_vencimiento 
														  where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
														  and codigo_subcategoria=$codigo_subcategoria and codigo_categoria=$codigo_categoria";
								}
								  
									echo '<tr class="titulotabla">';
									echo '<td width="60%"height="23" colspan="2"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;'.$row_subcat["subcategoria"].'</div></td>';
									echo '<td width="20%" height="23"><div align="center">Cantidad</div></td>';
									echo '<td width="20%" height="23"><div align="center">Vencimiento</div></td>';
									echo '</tr>';
									$i = 0;
									$res_qry_nombre_producto=$query($qry_nombre_producto);																		
									while($row_nombre_producto=$fetch_array($res_qry_nombre_producto))				
									{
										$codigo_producto=$row_nombre_producto["codigo_producto"];																														
										$clase = "detalletabla6";
										if ($i % 2 == 0) 
										{
											$clase = "detalletabla5";
										}
										echo '<tr class='.$clase.'><td colspan="2"><span class="titulomenu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row_nombre_producto["descripcion"].'</span></td>';	
										echo '<td class="descripcionproducto" align="center">'.$row_nombre_producto["existencia"].'</td>';
										echo '<td class="descripcionproducto" align="center">'.$row_nombre_producto["fecha"].'</td></tr>';										
										$i++;	
										$encontro_registros=true;																																																
										$operado=$row_nombre_producto["operado"];
									}
									$free_result($res_qry_nombre_producto);
									$operador=$_SESSION["user_name"];
									
							}
							$free_result($res_qry_subcategoria);
				}
				$free_result($res_qry_categoria);
				if ($encontro_registros==false)
				{			
					echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
					echo '<TR><TD COLSPAN="5"><center class="error">No se encontraron productos por vencer dentro del rango de fecha seleccionado</center></TD></TR>';					
				}
?>
          <div align="left"></div></td>
      </tr>
    </table>      </td>
  </tr>
</table>
<p><img src="../images/iconos/ico_print.gif" onclick="imprimir();"  alt="Clic para Imprimir este documento" width="30" height="30" />
<br><span class="defaulttext Estilo2">Generado por: <? echo $operador; ?> El <? echo $operado; ?></span></p>
</body>
</html>
