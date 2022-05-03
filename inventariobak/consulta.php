<?
session_start();
include('conectarse.php');
$_SESSION['nivel']=1;
$usr = $_SESSION['idempleado'];
if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
<table border="0" width="95%" >
	<tr class="Estilo69">
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Inicio ]</a>
		</td>
		<!--td align="right" >
		<a href="mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a>
		</td-->
	</tr>
	<!--tr><td><font face="Arial, Helvetica, sans-serif" size="2"><br><strong><a href="boleta_empresarial_.php"><strong><< Regresar a Ingreso >></strong></a></strong></font></td>
	</tr-->
	
</table>
<table   border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><p class="Estilo3"><span class="Estilo1 Estilo8"></span>
	  Consulta de Inventario</p></th>
    </tr>
  </table>
<table border="0" width="500" align="center" class="Estilofondocol2">
<form name="form1" action="consulta.php" method="post">
<tr class="Estilo69"><td align="right">No. de Inventario</td><td align="left"><input type="text" name="inven" maxlength="50" size="50"></td></tr>
<tr>
    <td class="Estilo69" align="right">Empleado</td><td align="left"><select name="asesor"><option></option>
	<? 
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("RRHH",$conection);
	$consulta = 'select idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada from asesor where habilitado = "Y" and idasesor > 1 order by 2,3,4,5';
	$result = mssql_query($consulta);
	while ($row = mssql_fetch_array($result))
	 {
	  $nombre = $row[1].' '.$row[2].' '.$row[3].' '.$row[4].' '.$row[5].' '.$row[6]; 
	  ?>
	  <option value="<? echo $row[0]; ?>"><? echo $row[1].' '.$row[2].' '.$row[3].' '.$row[4].' '.$row[5].' '.$row[6];  ?></option>
	  <?
	 }
	?>
	</select>
	</td>
 </tr>
  <tr class="Estilo1">
    <td class="Estilo69" align="right">Dispositivo</td><td align="left"><select name="dispositivo"><option></option>
	<? 
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("inventario",$conection);
	$consulta = 'select id_producto, descripcion from cat_producto order by 2';
	$result = mssql_query($consulta);
	while ($row = mssql_fetch_array($result))
	 { 	  ?>
	  <option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
  <? } ?>
	</select>
	</td>
   </tr>

  <tr class="Estilo1">
    <td class="Estilo69" align="right">Proveedor </td><td align="left"><select name="proveedor"><option></option>
	<? 
	$consulta = 'select nit, proveedor from cat_proveedor order by 2';
	$result = mssql_query($consulta);
	while ($row = mssql_fetch_array($result))
	 { 	  ?>
	  <option value="<? echo $row[0]; ?>"><? echo $row[1]; ?></option>
  <? } ?>
	</select>
	</td>
   </tr>   
<tr class="Estilo69"><td align="right" >No. de Factura</td><td align="left"><input type="text" name="factura" maxlength="50" size="50"></td></tr>
<tr class="Estilo69"><td align="right" >Codigo Antiguo</td><td align="left"><input type="text" name="cod_antiguo" maxlength="50" size="50"></td></tr>
   
<!--tr class="Estilo69">
<Td align="center">Busqueda por Codigo Inventario <input type="radio" name="filtroper" value="1" checked></td>
<Td align="center">Busqueda de Inventarios por Persona <input type="radio" name="filtroper" value="2"></Td>
<Td align="center">Busqueda de Inventarios por Dispositivo <input type="radio" name="filtroper" value="3"></Td>
</tr>
</table>
<table border="0" align="center" class="Estilofondocol2"-->
<tr class="Estilo69"><td align="right"><input type="submit" name="submit" value="Buscar"></td>
<input type="hidden" name="busca" value="1">
</form>

<form name="form2" action="consulta.php" method="post">
<td align="center" ><input type="submit" name="submit" value="Limpiar Consulta"></td></tr>
<input type="hidden" name="busca" value="0">
</form>
</table>


<? 
 if ($_POST['busca'] == 1)
 {

?> 
<table border="0" width="95%" align="center">
<Tr class="Estilo69" bgcolor="#6699FF"><td colspan="14" align="center">Resultados de la Busqueda</td></Tr>
<tr class="Estilo69"><td bgcolor="#C9CDED">Cod. Inventario</td><td bgcolor="#99CCFF">Dispositivo</td><td bgcolor="#C9CDED">Sicoin</td><td bgcolor="#99CCFF">Marca</td>
<Td bgcolor="#C9CDED">Modelo</Td><td bgcolor="#99CCFF">Serie</td>
<Td bgcolor="#C9CDED">Valor  Compra Q. </Td>
<td bgcolor="#99CCFF">Etiqueta Seguridad</td>
<Td bgcolor="#C9CDED">Asignado a</Td>
<td bgcolor="#99CCFF"></td>
<Td bgcolor="#C9CDED"></Td>
<td bgcolor="#99CCFF"></td>
<Td bgcolor="#C9CDED"></Td>
<td bgcolor="#99CCFF"></td>
</tr>
<?
	$conection = mssql_connect("server_appl","sa","sa") or die("No puede conectarse a SQL Server");
	mssql_select_db("inventario",$conection);
	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	
    $sql = "select a.id_inventario, a.id_registro_inventario, a.id_producto, b.descripcion, a.sicoin, a.id_marca, c.marca, a.modelo, a.no_serie, a.valor_compra, 
			a.id_registro_informatica, a.id_institucion_reg_it, a.id_anio_reg_it, e.idasesor, e.nombre, e.nombre2, e.nombre3, e.apellido, e.apellido2, e.apellidocasada ";
/*	if (isset($_POST['filtroper']) and ($_POST['filtroper'] == 2) ) 
	 {*/
	   $sql= $sql."from m_inventario a, cat_producto b, cat_marca c, inventario_x_usuario d, RRHH.dbo.asesor e, cat_proveedor f  ";
/*   	 }
	else
	 {
	  $sql =$sql." from m_inventario a, cat_producto b, cat_marca c "; 
	 }*/
			
	$sql = $sql."where a.id_institucion_reg_it = ".$_SESSION['id_unidad']." and a.id_producto = b.id_producto and a.id_marca = c.id_marca and a.nit = f.nit ";
	
	if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
		isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
 		isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
		isset($_POST['nit']) and (!empty($_POST['nit'])) and
		isset($_POST['factura']) and (!empty($_POST['factura'])) and
		isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
	 {
	   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
	     			and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] and a.factura = $_POST[factura]
					and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
	 }
	else
	  if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
		isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
 		isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
		isset($_POST['nit']) and (!empty($_POST['nit'])) and
		isset($_POST['factura']) and (!empty($_POST['factura'])) )
	  {
		$sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
	     			and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] and a.factura = $_POST[factura]";
	  }
	 else
		 if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
			isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
			isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
			isset($_POST['nit']) and (!empty($_POST['nit'])) and
			isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
		 {
		   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
						and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] 
						and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
		 }
		else
			if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
				isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
				isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
				isset($_POST['factura']) and (!empty($_POST['factura'])) and
				isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
			 {
			   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
							and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = f.nit and a.factura = $_POST[factura]
							and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
			 }
			else
				if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
					isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
					isset($_POST['nit']) and (!empty($_POST['nit'])) and
					isset($_POST['factura']) and (!empty($_POST['factura'])) and
					isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
				 {
				   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
								and d.id_empleado = $_POST[asesor] and a.id_producto = b.id_producto and a.nit = $_POST[nit] and a.factura = $_POST[factura]
								and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
				 }
				else
					if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
						isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
						isset($_POST['nit']) and (!empty($_POST['nit'])) and
						isset($_POST['factura']) and (!empty($_POST['factura'])) and
						isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
					 {
					   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
									and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] and a.factura = $_POST[factura]
									and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
					 }
					else
						if (isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
							isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
							isset($_POST['nit']) and (!empty($_POST['nit'])) and
							isset($_POST['factura']) and (!empty($_POST['factura'])) and
							isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
						 {
						   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
										and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] and a.factura = $_POST[factura]
										and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
						 }
						else
							if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
								isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
								isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
								isset($_POST['nit']) and (!empty($_POST['nit']))  )
							 {
							   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
											and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] ";
							 }
							else
								if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
									isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
									isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
									isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
								 {
								   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
												and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = f.nit 
												and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
								 }
								else
									if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
										isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
										isset($_POST['factura']) and (!empty($_POST['factura'])) and
										isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
									 {
									   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
													and d.id_empleado = $_POST[asesor] and a.id_producto = b.id_producto and a.nit = f.nit and a.factura = $_POST[factura]
													and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
									 }
									else
										if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
											isset($_POST['nit']) and (!empty($_POST['nit'])) and
											isset($_POST['factura']) and (!empty($_POST['factura'])) and
											isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
										 {
										   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
														and a.id_producto = b.id_producto and a.nit = $_POST[nit] and a.factura = $_POST[factura]
														and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
										 }
										else
											if (isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
												isset($_POST['nit']) and (!empty($_POST['nit'])) and
												isset($_POST['factura']) and (!empty($_POST['factura'])) and
												isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
											 {
											   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
															and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] and a.factura = $_POST[factura]
															and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
											 }
											else
												if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
													isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
													isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) )
												 {
												   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																and d.id_empleado = $_POST[asesor] and a.id_producto = $_POST[dispositivo] and a.nit = f.nit ";
												 }
												else
													if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
														isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
														isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
													 {
													   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																	and d.id_empleado = $_POST[asesor] and a.id_producto = b.id_producto and a.nit = f.nit 
																	and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
													 }
													else
														if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
															isset($_POST['factura']) and (!empty($_POST['factura'])) and
															isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
														 {
														   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																		and a.id_producto = b.id_producto and a.nit = f.nit and a.factura = $_POST[factura]
																		and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
														 }
														else
															if (isset($_POST['nit']) and (!empty($_POST['nit'])) and
																isset($_POST['factura']) and (!empty($_POST['factura'])) and
																isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
															 {
															   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																			and a.id_producto = b.id_producto and a.nit = $_POST[nit] and a.factura = $_POST[factura]
																			and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
															 }
															else
																if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
																	isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
																 {
																   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																				and a.id_producto = b.id_producto and a.nit = f.nit and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
																 }
																else
																	if (isset($_POST['factura']) and (!empty($_POST['factura'])) and
																		isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
																	 {
																	   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																					and a.id_producto = b.id_producto and a.nit = f.nit and a.factura = $_POST[factura]
																					and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
																	 }
																	else
																		if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
																			isset($_POST['nit']) and (!empty($_POST['nit'])) )
																		 {
																		   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' 
																		   				and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																						and a.id_producto = b.id_producto and a.nit = $_POST[nit]";
																		 }
																		else
																			if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
																				isset($_POST['factura']) and (!empty($_POST['factura'])) )
																			 {
																			   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' 
																			   				and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																							and a.id_producto = b.id_producto and a.nit = f.nit 
																							and a.factura = $_POST[factura]	";
																			 }
																			else														
																				if (isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
																					isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) )
																				 {
																				   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																								and a.id_producto = $_POST[dispositivo] and a.nit = f.nit ";
																				 }
																				else													
																					if (isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
																						isset($_POST['nit']) and (!empty($_POST['nit']))  )
																					 {
																					   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																									and d.id_empleado = $_POST[asesor] and a.id_producto = b.id_producto 
																									and a.nit = $_POST[nit] ";
																					 }
																					else
																						if (isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
																							isset($_POST['factura']) and (!empty($_POST['factura'])) )
																						 {
																						   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																										and d.id_empleado = $_POST[asesor] and a.id_producto = b.id_producto 
																										and a.nit = f.nit and a.factura = $_POST[factura]";
																						 }
																						else														
																							if (isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
																								isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
																							 {
																							   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																											and d.id_empleado = $_POST[asesor] and a.id_producto = b.id_producto 
																											and a.nit = f.nit 
																											and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
																							 }
																							else
																								if (isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
																									isset($_POST['nit']) and (!empty($_POST['nit']))  )
																								 {
																								   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																												and a.id_producto = $_POST[dispositivo] and a.nit = $_POST[nit] ";
																								 }
																								else
																									if (isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
																										isset($_POST['factura']) and (!empty($_POST['factura']))  )
																									 {
																									  $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																														and a.id_producto = $_POST[dispositivo] and a.nit = f.nit and a.factura = $_POST[factura]";
																									 }
																									else
																										if (isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) and 
																											isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
																										 {
																										   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																														and a.id_producto = $_POST[dispositivo] and a.nit = f.nit 
																														and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
																										 }
																										else	
																											if (isset($_POST['nit']) and (!empty($_POST['nit'])) and
																												isset($_POST['factura']) and (!empty($_POST['factura'])) )
																											 {
																											   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																																		and a.id_producto = b.id_producto and a.nit = $_POST[nit] and a.factura = $_POST[factura]";
																											 }
																											else
																												if (isset($_POST['nit']) and (!empty($_POST['nit'])) and
																													isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
																												 {
																													$sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																																and a.id_producto = b.id_producto and a.nit = $_POST[nit] 
																																and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
																												 }
																												else						
																													if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
																														isset($_POST['asesor']) and (!empty($_POST['asesor'])) )
																													 {
																														   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' 
																																and a.id_inventario = d.id_inventario 
																																and d.id_empleado = e.idasesor and d.id_empleado = $_POST[asesor] ";
																											
																													 }
																													else
									if (isset($_POST['inven']) and (!empty($_POST['inven'])) and
										isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) )
									  {
									   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
											and a.id_producto = $_POST[dispositivo]";
									 }
									 else
										if (isset($_POST['asesor']) and (!empty($_POST['asesor'])) and
											isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) )
										  {
										   $sql= $sql." and d.id_empleado = $_POST[asesor] and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
												and a.id_producto = $_POST[dispositivo]";
										  }
										else
											if (isset($_POST['dispositivo']) and (!empty($_POST['dispositivo'])) )
											  {
											   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor and a.id_producto = $_POST[dispositivo]";
											  }
											 else
												if (isset($_POST['inven']) and (!empty($_POST['inven']))  )
													{	
														$sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor";
													 }
												else
													if (isset($_POST['asesor']) and (!empty($_POST['asesor']))  )
													  {
													   $sql= $sql." and d.id_empleado = $_POST[asesor] and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor";
													  }
													 else
														if (	isset($_POST['nit']) and (!empty($_POST['nit']))  )
															 {
															   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																			and a.id_producto = b.id_producto and a.nit = $_POST[nit] ";
															 }
															else													  
																if (	isset($_POST['factura']) and (!empty($_POST['factura']))  )
																	 {
																	   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																					and a.id_producto = b.id_producto and a.nit = f.nit and a.factura = $_POST[factura]";
																	 }
																	else													  
																		if (isset($_POST['cod_antiguo']) and (!empty($_POST['cod_antiguo'])) )
																			 {
																			   $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor
																							and a.id_producto = b.id_producto and a.nit = f.nit 
																							and a.codigo_antiguo like '%".$_POST['cod_antiguo']."%'";
																			 }
																		else
																			 {  
																			 $sql= $sql." and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor";
																			 $no_ex = 1;
																		 }
/*	if (isset($_POST['filtroper']) and ($_POST['filtroper'] == 1) ) 
	 {
	   $sql= $sql." and a.id_registro_inventario like '%".$_POST['inven']."%' and a.id_inventario = d.id_inventario and d.id_empleado = e.idasesor";
 	 }
	  
	if (isset($_POST['filtroper']) and ($_POST['filtroper'] == 2) ) 
	 {
	   $sql= $sql." and d.id_empleado = e.idasesor and a.id_inventario = d.id_inventario and d.id_empleado = $_POST[asesor]";
   	 }	
 	if (isset($_POST['filtroper']) and ($_POST['filtroper'] == 3) ) 
	 {
	   $sql= $sql." and d.id_empleado = e.idasesor and a.id_inventario = d.id_inventario and a.id_producto = $_POST[dispositivo]";
   	 }	
*/  
	$sql= $sql." order by 15, 16, 17, 18, 19 asc";

//		echo $sql;
			$result = mssql_query($sql);
			$rsRows = mssql_num_rows($result);
			while ($row = mssql_fetch_array($result) )
			 {?>
			  <Tr class="Estilo67">
			   <!--td><? //echo $row['id_empresa']; ?></td-->
			   <td class="Estilofondocol2"><? echo $row['id_registro_inventario']; ?></td>
			   <td class="Estilofondocol"><? echo $row['descripcion']; ?></td>
			   <td class="Estilofondocol2"><? echo $row['sicoin']; ?></td>
			   <td class="Estilofondocol"><? echo $row['marca']; ?></td>
			   <td class="Estilofondocol2"><? echo $row['modelo']; ?></td>
			   <td class="Estilofondocol"><? echo $row['no_serie']; ?></td>
			   <td class="Estilofondocol2" align="right"><? echo $row['valor_compra']; ?></td>   
			   <td class="Estilofondocol"><? echo $row['id_anio_reg_it'].'-'.$row['id_institucion_reg_it'].'-'.$row['id_registro_informatica']; ?></td>
			   <td class="Estilofondocol2" align="right"><? echo $row['nombre'].' '.$row['nombre2'].' '.$row['nombre3'].' '.$row['apellido'].' '.$row['apellido2'].' '.$row['apellidocasada']; ?></td>      
			   <td class="Estilofondocol"><a href="edita_inventario.php?idi=<? echo $row['id_inventario']; ?>"><img src="imagenes/b_edit.png" border="0" alt="Editar"></a></td>
  			   <td class="Estilofondocol2"><a href="cambia_eti_seg.php?idi=<? echo $row['id_inventario']; ?>"><img src="imagenes/eti_seg.jpg" width="20" border="0" alt="Cambia Etiqueta Seguridad"></a></td>
  			   <td class="Estilofondocol"><a href="movto_inv.php?idi=<? echo $row['id_inventario']; ?>"><img src="imagenes/trans.jpg" border="0" alt="Traslado de Inventario" width="20"></a></td>			   
   			   <td class="Estilofondocol2"><a href="rpt_movimientos_inventario.php?idi=<? echo $row['id_inventario']; ?>"><img src="imagenes/adobe-hq.png" width="20" border="0" alt="Bitacora de este Inventario"></a></td>
   			   <td class="Estilofondocol"><a href="rpt_bitacora_etiquetas.php?idi=<? echo $row['id_inventario']; ?>"><img src="imagenes/adobe-hq.png" width="20" border="0" alt="Bitacora Etiquetas de Seguridad"></a></td>			   
			   </Tr>
			<? }
			?>
			<TR class="estilo69"><TD colspan="7" class="Estilo69"><strong><? echo 'TOTAL DE REGISTROS==> '.$rsRows; ?></strong></TD></TR>
			</table>

<?

}
?>


<script type="text/javascript"> 
var peticion = false; 
var  testPasado = false; 
try { 
  peticion = new XMLHttpRequest(); 
  } catch (trymicrosoft) { 
  try { 
  peticion = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (othermicrosoft) { 
  try { 
  peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
  } catch (failed) { 
  peticion = false; 
  } 
  } 
} 
if (!peticion) 
alert("ERROR AL INICIALIZAR!"); 
  
function cargarCombo (url, comboAnterior, element_id) { 
    //Obtenemos el contenido del div 
    //donde se cargaran los resultados 
    var element =  document.getElementById(element_id); 
    //Obtenemos el valor seleccionado del combo anterior 
    var valordepende = document.getElementById(comboAnterior) 
    var x = valordepende.value 
    //construimos la url definitiva 
    //pasando como parametro el valor seleccionado 
    var fragment_url = url+'?Id='+x; 
    element.innerHTML = '<img src="Imagenes/loading.gif" />'; 
    //abrimos la url 
    peticion.open("GET", fragment_url); 
    peticion.onreadystatechange = function() { 
        if (peticion.readyState == 4) { 
//escribimos la respuesta 
element.innerHTML = peticion.responseText; 
        } 
    } 
   peticion.send(null); 
} 
</script>


</body>
</html>
