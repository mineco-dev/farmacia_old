<?
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../includes/calendar.js"></script>

<script language="javascript">
function url(uri)
{
	location.href=uri; 
} 
</script>

<style type="text/css">
<!--
.style3 {font-size: small}
.style4 {color: #FFFFFF}
.style5 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo1 {font-size: medium}

-->
</style>

</head>

<body>
<form name="form1" method="post" action="">
<table width="100%"  border="0">
  <tr>
    <td width="18%" height="25"><div align="left"><img src="../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORM&Aacute;TICA</p>
    <p align="center" class="titulocategoria"> INVENTARIO DE HARDWARE Y SOFTWARE </p></td>
    <td width="10%"><div align="right"><img src="../images/hard_soft.jpg" width="112" height="113"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../images/linea.gif" width="100%" height="6"></td>   
  </tr> 
    <td height="25"><div align="right" class="tituloproducto">
      <div align="right">Filtrar por: </div></div>
	</td>
    <td height="25" colspan="2">
	
	<input name="txt_buscar" type="text" id="txt_buscar" size="50">   
	
<?
conectardb($inventarioadmin);
if (isset($obj)) //filtro objeto seleccionado
{	
	$qry_objeto="SELECT * FROM cat_objeto where codigo_objeto='$obj'"; 
	$res_qry_objeto=$query($qry_objeto);	
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		$nombre_objeto=$row_qry_objeto["objeto"];
		$codigo_objeto=$row_qry_objeto["codigo_objeto"];
	}
	$qry_objeto="SELECT * FROM cat_objeto where codigo_objeto<>'$obj' and activo=1 order by objeto"; 
	$res_qry_objeto=$query($qry_objeto);	
	echo('<select name="obj" id="cbo_objeto">');		
	echo'<option value="'.$codigo_objeto.'">'.$nombre_objeto.'</option>';
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		echo'<option value="'.$row_qry_objeto["codigo_objeto"].'">'.$row_qry_objeto["objeto"].'</option>';
	}
	echo('</select>');				
}
else
{
	$qry_objeto="SELECT * FROM cat_objeto where activo=1 order by objeto"; 
	$res_qry_objeto=$query($qry_objeto);	
	echo('<select name="obj">');		
	//echo'<option value="0">--Seleccione--</option>';
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		echo'<option value="'.$row_qry_objeto["codigo_objeto"].'">'.$row_qry_objeto["objeto"].'</option>';
	}
	echo('</select>');	
}
$free_result($res_qry_objeto);
	?> 
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Iniciar b�squeda">	    
  </tr> 
</table>
	  
 	  <table width="100%">
	  <tr><td height="25" colspan="5">    
      <img src="../images/linea.gif" width="100%" height="6"></td></tr>

 	 <?	
if (isset($obj)) //verifico si hay objeto seleccionado
{	  
  	  echo '<tr><td colspan="5" align="center">RESULTADO DE LA BUSQUEDA</td></tr>';
   	  echo '<tr class="titulotabla" align="center"><td>NUMERO DE SERIE</td><td>NUMERO DE INVENTARIO</td><td>NUMERO SICOIN</td><td>EDITAR</td><td>ASIGNAR USUARIO</td><td>ESTADO</td></tr>';					
	  $tabladestino="tb_inventario";
	  $nombrecampollave="codigo_objeto";
	  $qry_datos_insertados="select * from $tabladestino where $nombrecampollave='$obj'";
	  if (isset($txt_buscar)) $qry_datos_insertados.=" and (numero_serie like '%$txt_buscar%' or numero_inventario like '%$txt_buscar%' or numero_sicoin like '%$txt_buscar%')";
	  conectardb($inventarioadmin);$res_qry_insertados=$query($qry_datos_insertados);
	  $i=1;	  
	  while($row_qry_insertados=$fetch_array($res_qry_insertados))
	  {
		 $status=$row_qry_insertados["activo"];
		 $clase = "detalletabla2";
		  if ($i % 2 == 0) 
		  {
			$clase = "detalletabla1";
		  }
		  if ($status==1)
		  	echo '<tr><td class='.$clase.'>'.$row_qry_insertados["numero_serie"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_inventario"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_sicoin"].'</td><td class='.$clase.'><center><a href="ed_objeto_det.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&obj='.$obj.'"><img src="../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td><td class='.$clase.'><center><img src="../images/iconos/ico_user.gif" alt="Cambiar usuario responsable del equipo" border="0"></center></td><td class='.$clase.'><center><img src="../images/iconos/ico_activo.gif" alt="Desactivar" border="0"></center></td></tr>';					
//			echo '<tr><td class='.$clase.'>'.$row_qry_insertados["numero_serie"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_inventario"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_sicoin"].'</td><td class='.$clase.'><center><a href="ed_objeto_det.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&obj='.$obj.'"><img src="../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td><td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&st=2&txt_obj='.$obj.'"><img src="../images/iconos/ico_user.gif" alt="Cambiar usuario responsable del equipo" border="0"></a></center></td><td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&st=2&txt_obj='.$obj.'"><img src="../images/iconos/ico_activo.gif" alt="Desactivar" border="0"></a></center></td></tr>';					
		  	else
			echo '<tr><td class='.$clase.'>'.$row_qry_insertados["numero_serie"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_inventario"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_sicoin"].'</td><td class='.$clase.'><center><a href="ed_objeto_det.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&obj='.$obj.'"><img src="../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td><td class='.$clase.'><center><img src="../images/iconos/ico_user.gif" alt="Cambiar usuario responsable del equipo" border="0"></center></td><td class='.$clase.'><center><img src="../images/iconos/ico_desactivado.gif" alt="Activar" border="0"></center></td></tr>';	
//			echo '<tr><td class='.$clase.'>'.$row_qry_insertados["numero_serie"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_inventario"].'</td><td class='.$clase.'>'.$row_qry_insertados["numero_sicoin"].'</td><td class='.$clase.'><center><a href="ed_objeto_det.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&obj='.$obj.'"><img src="../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td><td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&st=2&txt_obj='.$obj.'"><img src="../images/iconos/ico_user.gif" alt="Cambiar usuario responsable del equipo" border="0"></a></center></td><td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados["codigo_inventario_enc"].'&st=2&txt_obj='.$obj.'"><img src="../images/iconos/ico_desactivado.gif" alt="Activar" border="0"></a></center></td></tr>';	
		  $i++;
	   }
	$free_result($res_qry_insertados);	
} // fin si esta seteado el objeto
?> 	
</table>  
</form> 

</body>
<script type="text/javascript">
function valor(objeto)
{
	try {
		if ((objeto.value+0) == 0)
			return false;
		else
			return true;
	} catch(e) 
	{
		return false;
	}
}
function validar(form)
{				  

//////////////////////// propiedades del equipo ///////////////////////////////////////////////////
	if (form['obj'].selectedIndex == 0){alert('Seleccione un tipo de objeto'); form['cbo_objeto'].focus();  return};		
	//if (form['codigo_tipo_objeto'].selectedIndex == 0){alert('Seleccione el tipo de objeto'); form['codigo_tipo_objeto'].focus();  return};	
	//if ((form['txt_buscar'].value+0) == 0){alert('Escriba el n�mero de serie, inventario o sicoin u otro n�mero que identifique el objeto');  form['numero_serie'].focus();  return};	
	//if ((form['numero_inventario'].value+0) == 0){alert('Escriba el n�mero de inventario');  form['numero_inventario'].focus();  return};	
	//if ((form['numero_sicoin'].value+0) == 0){alert('Escriba el n�mero de sicoin');  form['numero_sicoin'].focus();  return};	
	//if (form['codigo_dominio'].selectedIndex == 0){alert('Indique si el equipo es de MINECO o de alg�n programa'); form['codigo_dominio'].focus();  return};		
	//if ((form['nombre[0][1]'].value+0) == 0){alert('Seleccione el nombre del usuario a cargo del equipo'); return};
	//if ((form['txt_obj'].value) == 2)
	//	{
		//ban = 0; for (i=1;i<8;i++) { if (valor(form['marca['+i+']'])) ban = 1; } if (ban == 0) {alert('Debe especificar la memoria que tiene el CPU'); return};
		//ban = 0; for (i=1;i<8;i++) { if (valor(form['marcaproc['+i+']'])) ban = 1; } if (ban == 0) {alert('Indique las caracteristicas del procesador'); return};
		//ban = 0; for (i=1;i<16;i++) { if (valor(form['marcadisco['+i+']'])) ban = 1; } if (ban == 0) {alert('Indique las caracteristicas del disco duro'); return};
		//ban = 0; for (i=1;i<8;i++) { if (valor(form['tipolector['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba las unidades de lectura (Cdrom/dvdrom/floppy) de este equipo'); return};
		//ban = 0; for (i=1;i<100;i++) { if (valor(form['tipoinstall['+i+']'])) ban = 1; } if (ban == 0) {alert('Se requiere el detalle del software instalado en este equipo'); return};		
		//ban = 0; for (i=1;i<100;i++) { if (valor(form['txt_etiqueta'])) ban = 1; } if (ban == 0) {alert('Escriba el n�mero de etiqueta de seguridad que corresponde a este CPU'); return};		
	//};
	
	//if (form['cbo_objeto'].selectedIndex == 12){alert('Debe seleccionar en que calidad actua el solicitante'); return};
//////////////////////// Deudor ///////////////////////////
	//if ((form['txt_obj'].value+0) == 2)
	//{
//		
	//};

	//ban = 0; for (i=1;i<100;i++) { if (valor(form['deudor['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos a un Deudor'); return};
//////////////////////// Acreedor //////////////////////////////////////////////////////
	//ban = 0; for (i=1;i<100;i++) { if (valor(form['acreedor['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos a un Acreedor'); return};
//////////////////////// Bien //////////////////////////////////////////////////////////	
	//ban = 0; for (i=1;i<100;i++) { if (valor(form['bien['+i+'][1]'])) ban = 1; } if (ban == 0) {alert('Debe seleccionar por lo menos un bien para garantia'); return};
//////////////////////// Condiciones (lugar de celebracion del contrato) ///////////////
	//if (form['departamento'].selectedIndex == 0){alert('Debe seleccionar el departamento donde se celebro el contrato'); return};
	//if (form['zona'].selectedIndex == 0){alert('Debe seleccionar la zona donde se celebro el contrato'); return};
//////////////////////// Condiciones (numero de boleta y valor de boleta) //////////////
	//ban = 0; for (i=1;i<100;i++) { if (valor(form['boleta['+i+']'])) if (valor(form['valor['+i+']'])){ban = 1;} else {ban = 0 }} if (ban == 0) {alert('Debe ingresar la boleta de pago con un valor valido'); return};
/////////////////////// FIN VALIDACIONES //////////////////////////////////////////////	
	
	if (confirm('�Este bot�n inicia la b�squeda de acuerdo al objeto seleccionado y el filtro ingresado, desea continuar?')) form.submit();
}
</script>
</html>
