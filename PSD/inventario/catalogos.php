<?
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
  <tr>
    <td height="25" colspan="2"><div align="right" class="tituloproducto">
      <div align="left">FORMULARIO PARA INGRESO DE ELEMENTOS AL CATALOGO DE 
        <?
	conectardb($inventarioadmin);if (isset($obj)) //filtro objeto seleccionado
{	
	$qry_objeto="SELECT * FROM tb_formulario where codigo_formulario='$obj'"; 
	$res_qry_objeto=$query($qry_objeto);	
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		$nombre_objeto=$row_qry_objeto["uso"];
	}
	$qry_objeto="SELECT * FROM tb_formulario where codigo_formulario<>'$obj' and activo=1 order by uso"; 
	$res_qry_objeto=$query($qry_objeto);	
	echo('<select name="cbo_objeto" id="cbo_objeto" onchange="url(this.value);">');		
	echo'<option value="0">'.$nombre_objeto.'</option>';
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		echo'<option value="catalogos.php?obj='.$row_qry_objeto["codigo_formulario"].'">'.$row_qry_objeto["uso"].'</option>';
	}
	echo('</select>');				
}
else
{
	$qry_objeto="SELECT * FROM tb_formulario where activo=1 order by uso"; 
	$res_qry_objeto=$query($qry_objeto);	
	echo('<select name="cbo_objeto" onchange="url(this.value);">');		
	echo'<option value="0">--Seleccione--</option>';
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		echo'<option value="catalogos.php?obj='.$row_qry_objeto["codigo_formulario"].'">'.$row_qry_objeto["uso"].'</option>';
	}
	echo('</select>');	
}
$free_result($res_qry_objeto);
	?>
      </div>
    </div></td>
    <td height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td height="25">&nbsp; </td>
    <td height="25">&nbsp;</td>
  </tr> 
	  <form name="form1" method="post" action="gcatalogos.php">
	  <table width="90%"  border="0" align="center">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			conectardb($inventarioadmin);$qry_plantilla="SELECT c.codigo_campo, c.nombre_campo, c.codigo_tipo_campo, c.tb_origen, c.ubicacion_campo, c.validar,
						   c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden_ubicacion, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen
						   FROM tb_campo c 
						   where c.codigo_formulario='$obj'
						   order by orden_ubicacion"; 					  
			$res_qry_plantilla=$query($qry_plantilla);	
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				echo '<tr><td width="20%">'.$row_qry_plantilla["etiqueta"].'</td>';
				echo '<td>';
				if ($row_qry_plantilla["validar"]==1)
				{
					$campo_validacion=$row_qry_plantilla["nombre_campo"];
				}				
				if ($row_qry_plantilla["codigo_tipo_campo"]==1)
				{
					$tabladestino=$row_qry_plantilla["tb_destino"];
					if (!isset($campodestino)) $campodestino=$row_qry_plantilla["campo_destino"];
					$qry_datos_insertados="select * from $tabladestino order by $campodestino";
					echo '<input name="'.$row_qry_plantilla["nombre_campo"].'" type="text" id="'.$row_qry_plantilla["nombre_campo"].'" size="'.$row_qry_plantilla["tamano"].'">';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==2)
				{
					$latabla=$row_qry_plantilla["tb_origen"];
					$campoorigen=$row_qry_plantilla["campo_origen"];
					$campollave=$row_qry_plantilla["campo_llave"];
					$qry_cbo="SELECT * FROM $latabla where activo=1 order by $campoorigen"; 
					$res_qry_cbo=$query($qry_cbo);	
					echo('<select name="'.$row_qry_plantilla["nombre_campo"].'">');		
					//echo'<option value="0">--Seleccione--</option>';				
					while($row_qry_cbo=$fetch_array($res_qry_cbo))
					{
						echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
					}
					echo('</select>');					
					$free_result($res_qry_cbo);
				} // fin de cada combo.
				echo '</td></tr>';
			}	 //fin de creacion de campos.	
		$free_result($res_qry_plantilla);
	?>
	<tr>   	          
	</td>
  	<tr>   	
	<td colspan="2">
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_campodestino" type="hidden" id="txt_campodestino"  value="<? echo $campodestino?>"/> 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar" ></td></tr>  
	
</table>	  	 		  
</tr> 
<br>
<br>
  <table>
  <tr><td width="50">&nbsp;</td><td>DATOS YA EXISTENTES EN EL CATALOGO</td></tr>
  <?	
	  $res_qry_insertados=$query($qry_datos_insertados);
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
		  	echo '<tr><td width="50">&nbsp;</td><td class='.$clase.'>'.$row_qry_insertados["$campodestino"].'</td><td class='.$clase.'><center><a href="ed_catalogos.php?id='.$row_qry_insertados[0].'&obj='.$obj.'"><img src="../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td><td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados[0].'&st=2&txt_obj='.$obj.'"><img src="../images/iconos/ico_activo.gif" alt="Desactivar" border="0"></a></center></td></tr>';					
		  	else
			echo '<tr><td width="50">&nbsp;</td><td class='.$clase.'>'.$row_qry_insertados["$campodestino"].'</td><td class='.$clase.'><center><a href="ed_catalogos.php?id='.$row_qry_insertados[0].'&obj='.$obj.'"><img src="../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td><td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados[0].'&st=1&txt_obj='.$obj.'"><img src="../images/iconos/ico_desactivado.gif" alt="Activar" border="0"></a></center></td></tr>';					
		  $i++;
	   }
	$free_result($res_qry_insertados);	
  ?>
  </table>  
 <?
 }
 ?>  
   </form>
</table>
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
	//if (form['codigo_tipo_objeto'].selectedIndex == 0){alert('Seleccione el tipo de objeto'); return};
	//if (form['codigo_tipo_objeto'].selectedIndex == 0){alert('Seleccione el tipo de objeto'); form['codigo_tipo_objeto'].focus();  return};	
	//if ((form['numero_serie'].value+0) == 0){alert('Escriba el n�mero de serie u otro n�mero que identifique el objeto');  form['numero_serie'].focus();  return};	
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
	
	if (confirm('�Esta acción guarda y finaliza el ingreso de datos, desea continuar?')) form.submit();
}
</script>
</html>
