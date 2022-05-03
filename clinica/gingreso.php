<?
	//session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	require_once('../includes/conectarse.php');
	$tipo_reporte="rpt_despacho.php";
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700, height=400, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>

<?
if ($tipo_reporte!="") 
	{	
		echo "<body onload=Abrir_ventana('$tipo_reporte')>";
	}
	else 
	{
		echo "<body>";
	}
?><body>
<?
if (isset($_SESSION["ingreso"]))
{
	conectardb($almacen);
	$nombre_usuario=$_SESSION["user_name"];
	$txt_solicitante=strtoupper($_REQUEST["txt_solicitante"]);
	$txt_observaciones=strtoupper($_REQUEST["txt_observaciones"]);
	
	/////////////////////////////////// Verifica que esta hoja no se haya ingresado antes/////////////////////////////
	// Se puede implementar cuando en el almacen existan entregas parciales
	//$qry_consulta="select * from tb_ingreso_enc where codigo_tipo_documento='$cbo_tipo_docto' and numero_documento='$txt_no_ingreso' and numero_requisicion='$txt_numero_solicitud'";
	//$query($qry_consulta);
	/////////////////////////////////// inserta datos generales del ingreso	/////////////////////////////////////////
	session_register("hoja_despacho");
	$_SESSION["hoja_despacho"]=$txt_no_ingreso;
	$qry_ingreso ="insert into tb_ingreso_enc";
	$qry_ingreso.="(codigo_tipo_documento, fecha_documento, numero_documento, numero_requisicion, fecha_requisicion, 
				  solicitante, dependencia, observaciones, activo, usuario_creo, fecha_creado) ";
	$qry_ingreso.="values ('$cbo_tipo_docto', '$date1', '$txt_no_ingreso', '$txt_no_solicitud',  '$date2',
				  '$txt_solicitante', '26', '$txt_observaciones', 1, '$nombre_usuario', getdate())";
	$query($qry_ingreso);
	/////////////////////////////////// selecciona el ultimo ingreso guardado	/////////////////////////////////////////
	$qry_ultimo_ingreso="select max(codigo_ingreso_enc) as ultimo_ingreso from tb_ingreso_enc where numero_documento='$txt_no_ingreso'";
	$res_ultimo_ingreso=$query($qry_ultimo_ingreso);
	while($row=$fetch_array($res_ultimo_ingreso))
	{
		$no_ingreso = $row["ultimo_ingreso"];		
	}
	
	/////////////////////////////////// inserta detalle del ingreso //////////////////////////////////////////
	$cnt=1; 		
	while($cnt<=count($bien))
	{						
		$vence=$aniovence[$cnt]."-".$mesvence[$cnt]."-".$diavence[$cnt]." 00:00:00.000";
		$codigo = $bien[$cnt][1];		
		if ($costo_unitario[$cnt]=="") $costo_unitario[$cnt]=0;
		
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
		$qry_ingreso_det ="insert into tb_ingreso_det";	
		$qry_ingreso_det.="(codigo_ingreso_enc, codigo_producto, codigo_categoria, codigo_subcategoria, cantidad_ingresada, costo_unidad, fecha_vence, cantidad_solicitada, codigo_bodega, usuario_creo, fecha_creado, activo) ";
		$qry_ingreso_det.="values ('$no_ingreso', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$ingresado[$cnt]', '$costo_unitario[$cnt]', '$vence', '$solicitado[$cnt]', '$cbodega[$cnt]', '$nombre_usuario', getdate(), 1)";			
		$query($qry_ingreso_det);		
		$cnt++;		
	}		
	/////////////////////////////////// inserta detalle del ingreso en la tabla kardex//////////////////////////////////////////
	$cnt=1; 		
	while($cnt<=count($bien))
	{						
		$codigo = $bien[$cnt][1];		
		$qry_ingreso_kardex ="insert into tb_kardex";	
		$qry_ingreso_kardex.="(codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_movimiento, codigo_tipo_movimiento, fecha, cantidad, usuario_creo, fecha_creado, activo) ";
		$qry_ingreso_kardex.="values ('$cbodega[$cnt]', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$txt_no_ingreso', 1, getdate(), '$ingresado[$cnt]', '$nombre_usuario', getdate(), 1)";			
		$query($qry_ingreso_kardex);
		$cnt++;
	}		
	
	/////////////////////////////////// Actualiza tabla inventario /////////////////////////////
	
	$cnt=1; 		
	while($cnt<=count($bien))
	{						
		$codigo = $bien[$cnt][1];
		// Consultar si existe el producto en la tabla
		$qry_consulta="select * from tb_inventario where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
		$res_consulta=$query($qry_consulta);
		$existe=false;
		while($row=$fetch_array($res_consulta))
		{
			$existe=true;
			$existencia_actual=$row["existencia"]+$ingresado[$cnt];	
			$qry_ingreso_inventario ="update tb_inventario ";			
			$qry_ingreso_inventario.="set existencia='$existencia_actual', ultimo_ingreso=getdate(), usuario_ingreso='$nombre_usuario' where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
		}
		if (!$existe)
		{
			$qry_ingreso_inventario ="insert into tb_inventario ";	
			$qry_ingreso_inventario.="(existencia, ultimo_ingreso, usuario_ingreso, codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria) ";
			$qry_ingreso_inventario.="values ('$ingresado[$cnt]', getdate(), '$nombre_usuario', '$cbodega[$cnt]', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]')";			
		}
		$query($qry_ingreso_inventario);
		$cnt++;
	}			
	/////////////////////////////////// Actualiza tabla inventario_det /////////////////////////////
	
	$cnt=1; 		
	while($cnt<=count($bien))
	{						
		$codigo = $bien[$cnt][1];
		$vence=$aniovence[$cnt]."-".$mesvence[$cnt]."-".$diavence[$cnt]." 00:00:00.000";
				
		// Consultar si existe el producto en la tabla
		$qry_consulta="select * from tb_inventario_det where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]' and fecha_vence='$vence'";
		$res_consulta=$query($qry_consulta);
		$existe=false;
		while($row=$fetch_array($res_consulta))
		{
			$existe=true;
			$existencia_actual=$row["existencia"]+$ingresado[$cnt];	
			$qry_ingreso_inventario ="update tb_inventario_det ";			
			$qry_ingreso_inventario.="set existencia='$existencia_actual', activo=1, fecha_vence='$vence' where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]' and fecha_vence='$vence'";
		}
		if ($existe==false)
		{
			$qry_ingreso_inventario ="insert into tb_inventario_det ";	
			$qry_ingreso_inventario.="(existencia, codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, lote, activo, fecha_vence) ";
			$qry_ingreso_inventario.="values ('$ingresado[$cnt]', '$cbodega[$cnt]', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$lote[$cnt]', 1, '$vence')";			
		}
		$query($qry_ingreso_inventario);
		$cnt++;
	}				
	session_unregister("ingreso");
	echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
	echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Hoja de ingreso guardada correctamente!</span></center></TD></TR>';										
}
else
{
	echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
	echo '<TR><TD COLSPAN="5"><span class="error"><center>Puede ingresar nuevos productos utilizando la opcion Entradas, del menú izquierdo</span></center></TD></TR>';		
}
//cambiar_ventana("../index.php");
?>
</body>
</html>
