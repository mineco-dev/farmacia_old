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
          <div align="right"><span class="tituloproducto">REPORTE DE EXISTENCIAS</span><br>
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
					$qry_categoria="select distinct(codigo_categoria), categoria from view_kardex 
									where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
									and codigo_categoria=$categoria";										
				 }							
				 else
				 {
				    $qry_categoria="select distinct(codigo_categoria), categoria from view_kardex 
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
							$qry_subcategoria="select distinct(codigo_subcategoria), subcategoria from view_kardex 
											   where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin'
											   and codigo_subcategoria=$subcategoria and codigo_categoria=$codigo_categoria";
						}
						else
						{
						    $qry_subcategoria="select distinct(codigo_subcategoria), subcategoria from view_kardex 
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
									$qry_nombre_producto="select distinct(codigo_producto), descripcion from view_kardex 
														  where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
														  and codigo_producto=$producto";
								}
								else								
								if (isset($_SESSION["subcategoria"]))
								{									
									$qry_nombre_producto="select distinct(codigo_producto), descripcion from view_kardex 
													  where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
													  and codigo_subcategoria=$codigo_subcategoria";
								}
								else
								{
									    $qry_nombre_producto="select distinct(codigo_producto), descripcion from view_kardex 
														  where codigo_bodega=$rpt_bodega and fecha>='$inicio' and fecha<='$fin' 
														  and codigo_subcategoria=$codigo_subcategoria and codigo_categoria=$codigo_categoria";
								}
								  
									echo '<tr class="titulotabla">';
									echo '<td width="80%"height="23" colspan="3"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;'.$row_subcat["subcategoria"].'</div></td>';
									echo '<td width="20%" height="23"><div align="center">Existencias</div></td>';
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
										echo '<tr class='.$clase.'><td colspan="3"><span class="titulomenu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row_nombre_producto["descripcion"].'</span></td>';	
										$saldo=0;
										$ingreso=0;
										$egreso=0;
										$qry_saldo_inicial="select codigo_tipo_movimiento, sum(cantidad) as subtotal, getdate() as hoy from view_kardex 
										               where codigo_bodega=$rpt_bodega and fecha<='$fin'
													   and codigo_producto=$codigo_producto
													   group by codigo_tipo_movimiento";
									  	$res_qry_saldo_inicial=$query($qry_saldo_inicial);								   
										while($row_saldo_inicial=$fetch_array($res_qry_saldo_inicial))				
										{
										 $operado=$row_saldo_inicial["hoy"];
										  if ($row_saldo_inicial["codigo_tipo_movimiento"]==1) $ingreso=$row_saldo_inicial["subtotal"];
										  else $egreso=$row_saldo_inicial["subtotal"];
										}
										$free_result($res_qry_saldo_inicial);
										$saldo=$ingreso-$egreso;  //Calcula el saldo del producto de la fecha final hacia atras										
										echo '<td class="descripcionproducto" align="center" colspan="2">'.$saldo.'</td></tr>';										
										$i++;	
										$encontro_registros=true;			
										$operador=$_SESSION["user_name"];																																			
									}
									$free_result($res_qry_nombre_producto);
							}
							$free_result($res_qry_subcategoria);
				}
				$free_result($res_qry_categoria);
				if ($encontro_registros==false)
				{			
					echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
					echo '<TR><TD COLSPAN="5"><center class="error">no se encontraron movimientos registrados dentro del rango de fecha seleccionado</center></TD></TR>';					
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
