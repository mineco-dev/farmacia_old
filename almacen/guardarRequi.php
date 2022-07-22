<?php
	session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	require_once('../includes/conectarse.php');
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/
	
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
<body>
	<?php
		$Accion = $_POST["T_Accion"];//valor cero enviado desde la requisión
		$bien = $_POST["bien"];//este guarda la línea del producto requerido
		$nombre = $_POST['nombre'];//trae la matriz con los datos de solicitante
		$Departamento  = $_POST['Departamento'];//nombre de la dependencia o direccion
		$Municipio  = $_POST['Municipio'];//nombre del jefe de la dependencia
		$cantidad_solicitada = $_POST['cantidad_solicitada'];//cantidad solicitada por producto
		if (isset($_SESSION["ingreso"]) && $Accion == 0)
		{
			conectardb($almacen);
			$solicitante=$nombre[0][2];
			$s = $_SESSION["nombre[0][2]"];
			$nombre_usuario=$_SESSION["user_name"];
			$observaciones=strtoupper(utf8_decode($_REQUEST["observaciones"]));
			$_SESSION["hoja_requisicion"];
			$cnt=1; 		
			$saldo=true;
			while($cnt<=count($bien))//buscar y asigna el codigo, cat, subcat, bodega y cod_empresa a cada linea.
			{
				$codigo = $bien[$cnt][4]; //codigo de la fila de la tabla cat_producto		
				$solicitado = $cantidad_solicitada[$cnt]; 
				$qry_x_rowid_producto = "select  distinct inventario.codigo_producto,inventario.codigo_categoria,inventario.codigo_subcategoria, inventario.codigo_bodega, inventario.codigo_empresa 
										from tb_inventario as inventario
										inner join cat_producto as produc on
										inventario.codigo_categoria = produc.codigo_categoria and inventario.codigo_subcategoria = produc.codigo_subcategoria
										where inventario.codigo_producto =(select codigo_producto from cat_producto 
										where rowid = '$codigo')  and produc.rowid ='$codigo' and inventario.existencia>0 and (inventario.codigo_bodega=8)";
				//echo "<hr>";
				//echo $qry_x_rowid_producto;
				//echo "<hr>";
				$res_rowid_producto=$query($qry_x_rowid_producto);
				while($rowid=$fetch_array($res_rowid_producto))
				{
					
							$cproducto[$cnt]=$rowid["codigo_producto"];
							$ccategoria[$cnt]=$rowid["codigo_categoria"];
							$csubcategoria[$cnt]=$rowid["codigo_subcategoria"];
							$cbodega[$cnt]=$rowid["codigo_bodega"];
							$cempresa[$cnt]=$rowid["codigo_empresa"];
					
				}		
				$cnt++;
				
			}	///se ingresan los datos a la tabla tb_requisicion_enc
				$usuario_id=$_SESSION["user_id"];	
				$qry_ingreso ="insert into tb_requisicion_enc";
				$qry_ingreso.="(fecha_requisicion, codigo_dependencia, codigo_jefe_dependencia, codigo_solicitante, solicitante, codigo_estatus,observaciones, usuario_creo, fecha_creado, user_id) values ";
				$qry_ingreso.="(getdate(), $Departamento, $Municipio, '".$nombre[0][1]."', '$solicitante', 4,'$observaciones', '$nombre_usuario', getdate(), '$usuario_id')";
				$respuesta = $query($qry_ingreso);
				$qry_ultimo_ingreso="select max(codigo_requisicion_enc) as ultima_requisicion from tb_requisicion_enc";
				$res_ultimo_ingreso=$query($qry_ultimo_ingreso);
				while($row=$fetch_array($res_ultimo_ingreso))
				{
					$no_ingreso = $row["ultima_requisicion"];		
				}
				$cnt=1; 	
				while($cnt<=count($bien))//se ingresan los datos de cada producto. por fila
				{						
					$solicitado = $cantidad_solicitada[$cnt];
					$qry_ingreso_det ="insert into tb_requisicion_det";	
					$qry_ingreso_det.="(codigo_requisicion_enc,codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, cantidad_solicitada,  codigo_empresa)";
					$qry_ingreso_det.="values ('$no_ingreso',  '$cbodega[$cnt]','$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$solicitado', '$cempresa[$cnt]')";			
					$query($qry_ingreso_det);		
					$cnt++;		
				}
				
				$cnt=1; 		
				/*while($cnt<=count($bien))// se actualiza la cantidad comprometida
				{						
					/conectardb($almacen);
					$solicitado = $cantidad_solicitada[$cnt];
					$qry_consulta="select * from tb_inventario where codigo_bodega='$cbodega[$cnt]' and codigo_empresa='$cempresa[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
					$res_consulta=$query($qry_consulta);
					$existe=false;
					while($row=$fetch_array($res_consulta))
					{
						
						$existe=true;
						$comprometido=$row["cantidad_comprometida"]+$solicitado;	
						$qry_ingreso_inventario ="update tb_inventario set cantidad_comprometida='$comprometido' where codigo_empresa='$cempresa[$cnt]' and codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
					}					
					$query($qry_ingreso_inventario);
					$cnt++;
				}*/	

					echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
					echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Requisición Enviada a Autorización!</span></center></TD></TR>';
					echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';
		}
	
	else{
		print("nada");
	}
	?>
</body>
</html>
