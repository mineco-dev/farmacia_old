<?
	//session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	require_once('../includes/conectarse.php');
	$tipo_reporte="rpt_receta.php";
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700, height=400, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>
</head>
<?
if ($tipo_reporte!="") 
	{	
		echo "<body onload=Abrir_ventana('$tipo_reporte')>";
	}
	else 
	{
		echo "<body>";
	}
?>
<?
if (isset($_SESSION["egreso"]))
{
	conectardb($almacen);
	$nombre_usuario=$_SESSION["user_name"];
	$solicitante=$nombre[0][1];
	
	/////////////////////////////////// consulta existencias //////////////////////////////////////////
		$cnt=1; 		
		$saldo=true;
		while($cnt<=count($bien))
		{			
			$codigo = $bien[$cnt][1];			
			$solicitado = $entregado[$cnt];		
			
			////// consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae
			$qry_x_rowid_producto="select * from tb_inventario where rowid='$codigo'";
			$res_rowid_producto=$query($qry_x_rowid_producto);
			while($rowid=$fetch_array($res_rowid_producto))
			{
				$cproducto[$cnt]=$rowid["codigo_producto"];
				$ccategoria[$cnt]=$rowid["codigo_categoria"];
				$csubcategoria[$cnt]=$rowid["codigo_subcategoria"];
				$cbodega[$cnt]=$rowid["codigo_bodega"];
			}		
			/////// fin de consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae
			 			
			$qry_consulta_exist="select i.existencia, (p.producto +' '+ p.marca) as producto, i.codigo_producto, i.codigo_categoria, i.codigo_subcategoria, i.codigo_bodega from tb_inventario i 
								 inner join cat_producto p on i.codigo_producto=p.codigo_producto and i.codigo_categoria=p.codigo_categoria and i.codigo_subcategoria=p.codigo_subcategoria
								 where (i.codigo_bodega='$cbodega[$cnt]' and i.codigo_producto='$cproducto[$cnt]' and i.codigo_categoria='$ccategoria[$cnt]' and i.codigo_subcategoria='$csubcategoria[$cnt]' and existencia < '$solicitado')";
			$res_consulta_exist=$query($qry_consulta_exist);
			while($row=$fetch_array($res_consulta_exist))
			{
				$saldo=false;
				$existencia=$row["existencia"];
				$producto=$row["producto"];													
				echo '<TR><TD COLSPAN="5"><span class="error"><center>Unicamente existen '.$existencia.' '.$producto.' de '.$solicitado.' solicitado(a)s</span></center></TD></TR>';														
				$tipo_reporte="";				
			}
			$cnt++;
			echo '<br>';		
		}	
		if ($saldo)
		{	
			/////////////////////////////////// Verifica numero de receta que corresponde /////////////////////////////
			if ($cbo_tipo_docto==2) //si es receta
			{
				$qry_no_receta="select max(numero_documento) as ultima_receta from tb_egreso_enc where tipo_documento='$cbo_tipo_docto'";
				$res_no_receta=$query($qry_no_receta);
				while($row_no_receta=$fetch_array($res_no_receta))
				{
					$txt_no_ingreso=$row_no_receta["ultima_receta"]+1;
				}		
			}		
			/////////////////////////////////// Verifica que esta hoja no se haya ingresado antes /////////////////////////////
			$ingresado=false;
			if ($cbo_tipo_docto<>2)
			{
				$qry_consulta="select * from tb_egreso_enc where tipo_documento='$cbo_tipo_docto' and numero_documento='$txt_no_ingreso'";
				$res_consulta=$query($qry_consulta);
				while($row_consulta=$fetch_array($res_consulta))
				{
					echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
					echo '<TR><TD COLSPAN="5"><span class="error"><center>Este Número de documento ya ha sido operado</span></center></TD></TR>';													
					$ingresado=true;
				}		
			}
			if (!$ingresado)
			{
				/////////////////////////////////// inserta datos generales del egreso	/////////////////////////////////////////
				$qry_ingreso ="insert into tb_egreso_enc";
				$qry_ingreso.="(tipo_documento, fecha_documento, numero_documento,  
							  solicitante, observaciones, activo, usuario_creo, fecha_creado) ";
				$qry_ingreso.="values ('$cbo_tipo_docto', '$date1', '$txt_no_ingreso', '$solicitante',
							  '$txt_observaciones', 1, '$nombre_usuario', getdate())";
				$query($qry_ingreso);
				/////////////////////////////////// selecciona el ultimo egreso guardado	/////////////////////////////////////////
				$qry_ultimo_egreso="select max(codigo_egreso_enc) as ultimo_egreso from tb_egreso_enc where numero_documento='$txt_no_ingreso'";
				$res_ultimo_egreso=$query($qry_ultimo_egreso);
				while($row=$fetch_array($res_ultimo_egreso))
				{
					$no_egreso = $row["ultimo_egreso"];
				}
				session_register("ultimo_reg_egreso");
				$_SESSION["ultimo_reg_egreso"]=$txt_no_ingreso;							
				/////////////////////////////////// inserta detalle del egreso //////////////////////////////////////////
				$cnt=1; 		
				while($cnt<=count($bien))
				{			
					$codigo = $bien[$cnt][1];
					$qry_ingreso_det ="insert into tb_egreso_det";	
					$qry_ingreso_det.="(codigo_egreso_enc, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_bodega, dosis, cantidad_entregada, cantidad_recetada, usuario_creo, fecha_creado, activo) ";
					$qry_ingreso_det.="values ('$no_egreso', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$cbodega[$cnt]', '$dosis[$cnt]', '$entregado[$cnt]', '$recetado[$cnt]', '$nombre_usuario', getdate(), 1)";			
					$query($qry_ingreso_det);
					$cnt++;
				}		
				/////////////////////////////////// inserta detalle del egreso en la tabla kardex//////////////////////////////////////////
				$cnt=1; 		
				while($cnt<=count($bien))
				{						
					$codigo = $bien[$cnt][1];
					$qry_ingreso_kardex ="insert into tb_kardex";	
					$qry_ingreso_kardex.="(codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_movimiento, codigo_tipo_movimiento, fecha, cantidad, usuario_creo, fecha_creado, activo) ";
					$qry_ingreso_kardex.="values ('$cbodega[$cnt]', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$txt_no_ingreso', 2, getdate(), '$entregado[$cnt]', '$nombre_usuario', getdate(), 1)";			
					$query($qry_ingreso_kardex);
					$cnt++;
				}				
				/////////////////////////////////// Actualiza tabla inventario /////////////////////////////
				
				$cnt=1; 		
				while($cnt<=count($bien))
				{						
					$codigo = $bien[$cnt][1];
					//busca el producto en la tabla
					$qry_consulta="select * from tb_inventario where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
					$res_consulta=$query($qry_consulta);
					$existe=false;
					while($row=$fetch_array($res_consulta))
					{
						$existe=true;
						$existencia_actual=$row["existencia"]-$entregado[$cnt];	
						$qry_ingreso_inventario ="update tb_inventario ";			
						$qry_ingreso_inventario.="set existencia='$existencia_actual', ultimo_egreso=getdate(), usuario_egreso='$nombre_usuario' where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
					}					
					$query($qry_ingreso_inventario);
					$cnt++;
				}	// fin actualiza inventario		
				
				/////////////////////////////////// Actualiza tabla inventario detalle/////////////////////////////				
				$cnt=1; 						
				while($cnt<=count($bien))
				{						
					$codigo = $bien[$cnt][1];
					$producto = $bien[$cnt][1];
					$requerido = $entregado[$cnt];
					//busca el producto en la tabla
					$qry_consulta="select CONVERT(VARCHAR(23), fecha_vence, 121) as vencimiento, * from tb_inventario_det where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]' and activo=1 order by fecha_vence";
					$res_consulta=$query($qry_consulta);							
					while($row=$fetch_array($res_consulta))
					{						
						$lote=$row["lote"];
						$vencimiento=$row["vencimiento"];																			
						if ($requerido>0)
						{
							if ($row["existencia"]>=$requerido)
							{
								$existencia_actual=$row["existencia"]-$requerido;
								$proveido=$requerido;
								$requerido=0;								
							}							
							else
							{
								$requerido=$requerido-$row["existencia"];
								$proveido=$row["existencia"];
								$existencia_actual=0;								
							}													
							if ($existencia_actual==0) 
							{
								$activo=2;							
							}
							else
							{
							    $activo=1;
							}
							$qry_ingreso_inventario ="update tb_inventario_det ";			
							$qry_ingreso_inventario.="set existencia='$existencia_actual', activo=$activo where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]' and fecha_vence='$vencimiento'";							
							$query($qry_ingreso_inventario);
							///////////Almacena el detalle de los productos entregados por lote y fecha de vencimiento/////////////////
							$qry_entregado="insert into tb_producto_egresa_det(codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, lote, fecha_vence, entregado, fecha_operado, numero_documento, tipo_documento) ";
							$qry_entregado.="values ('$cbodega[$cnt]', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$lote', '$vencimiento', $proveido, getdate(), '$txt_no_ingreso', '$cbo_tipo_docto')";
							$query($qry_entregado);							
							///////////Fin de detalle de productos entregados por lote y fecha de vencimiento//////////////////////////
						}						
					}
					$cnt++;
				}	// fin actualiza inventario		
				
				session_unregister("egreso");
				echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
				echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Hoja de salida guardada correctamente!</span></center></TD></TR>';									
			} //fin si el documento no ha sido operado
		}// fin de operar la solicitud si hay saldo
		else
		{
			echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
			echo '<TR><TD COLSPAN="5"><span class="error"><center>No se ha operado la solicitud</span></center></TD></TR>';									
		}
	} //fin si viene seteada la variable de sesion egreso
	else
	{
	echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
	echo '<TR><TD COLSPAN="5"><span class="error"><center>Puede operar nuevas salidas utilizando la opcion Salidas, del menú izquierdo</span></center></TD></TR>';									
	}
//cambiar_ventana("../index.php");
?>
</body>
</html>
