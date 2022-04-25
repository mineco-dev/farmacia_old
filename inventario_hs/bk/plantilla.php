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
      <div align="left">ASIGNACI&Oacute;N DE CAMPOS POR OBJETO, PARA CAPTURA DE DATOS</div>
    </div></td>
    <td height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="25"><div align="right" class="tituloproducto">
      <div align="right">OBJETO--&gt;</div>
    </div></td>
    <td height="25"><?
	conectardb($inventarioopera);	
if (isset($obj)) //filtro objeto seleccionado
{	
	$qry_objeto="SELECT * FROM cat_objeto where codigo_objeto='$obj'"; 
	$res_qry_objeto=$query($qry_objeto);	
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		$nombre_objeto=$row_qry_objeto["objeto"];
	}
	$qry_objeto="SELECT * FROM cat_objeto where codigo_objeto<>'$obj' and activo=1 order by objeto"; 
	$res_qry_objeto=$query($qry_objeto);	
	echo('<select name="cbo_objeto" id="cbo_objeto" onchange="url(this.value);">');		
	echo'<option value="0">'.$nombre_objeto.'</option>';
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		echo'<option value="objeto.php?obj='.$row_qry_objeto["codigo_objeto"].'">'.$row_qry_objeto["objeto"].'</option>';
	}
	echo('</select>');				
}
else
{
	$qry_objeto="SELECT * FROM cat_objeto where activo=1 order by objeto"; 
	$res_qry_objeto=$query($qry_objeto);	
	echo('<select name="cbo_objeto" onchange="url(this.value);">');		
	echo'<option value="0">--Seleccione--</option>';
	while($row_qry_objeto=$fetch_array($res_qry_objeto))
	{
		echo'<option value="objeto.php?obj='.$row_qry_objeto["codigo_objeto"].'">'.$row_qry_objeto["objeto"].'</option>';
	}
	echo('</select>');	
}
$free_result($res_qry_objeto);
	?> </td>
    <td height="25">&nbsp;</td>
  </tr> 
	  <form name="form1" method="post" action="gobjeto.php">
	  <table width="90%"  border="0" align="center">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			conectardb($inventarioopera);
			$qry_plantilla="SELECT o.codigo_objeto, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, 
						  p.campo_origen, p.campo_llave, p.tamano, p.etiqueta
						  FROM tb_plantilla pl INNER JOIN
						  tb_propiedad p ON pl.codigo_propiedad = p.codigo_propiedad INNER JOIN
						  cat_objeto o ON pl.codigo_objeto = o.codigo_objeto
						  where pl.codigo_objeto='$obj'"; 					  
			$res_qry_plantilla=$query($qry_plantilla);	
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				echo '<tr><td width="20%">'.$row_qry_plantilla["etiqueta"].'</td>';
				echo '<td>';
				if ($row_qry_plantilla["codigo_tipo_propiedad"]==1)
				{
					echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="text" id="'.$row_qry_plantilla["propiedad"].'" size="'.$row_qry_plantilla["tamano"].'">';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_propiedad"]==2)
				{
					$latabla=$row_qry_plantilla["tb_origen"];
					$campoorigen=$row_qry_plantilla["campo_origen"];
					$campollave=$row_qry_plantilla["campo_llave"];
					if ($latabla=='cat_tipo_objeto')
					{
						$qry_cbo="SELECT * FROM $latabla where codigo_objeto=$obj order by $campoorigen"; 
					}
					else
					{
						$qry_cbo="SELECT * FROM $latabla order by $campoorigen"; 
					}
					$res_qry_cbo=$query($qry_cbo);	
					echo('<select name="'.$row_qry_plantilla["propiedad"].'">');		
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
	<input type="hidden" name="nombre[0][1]" id="hiddenField"/>
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<td height="22">Usuario responsable</td>       
	<td><a href="javascript:void(0)" onclick="buscar=window.open('../clinica/busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;"><input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR EL USUARIO]" size="55" disabled />
	</a></td></tr>  
	
</table>	  	 
	 
 <?
  } // fin si esta seteado el objeto
  ?>
	  
  
	<?
	if (isset($obj))
	{
		if ($obj==2)  // si es cpu, pide datos de memoria, cpu, discos, lectores y software.
		{
		?>	
		  <table width="90%"  border="0" align="center">		  
		  <tr><td><p align="center" class="titulocategoria">COMPONENTES GENERALES DEL CPU</p></td></tr>
			<tr><td height="25" colspan="3">    
    	<img src="../images/linea.gif" width="100%" height="6"></td></tr>
		   <tr>
		   <td>
			
			<div id="TabbedPanels1" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">
				<li class="TabbedPanelsTab style3" tabindex="0">Memoria</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Procesador</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Disco Duro</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Lectores</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software OEM</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software Instalado</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Etiqueta de seguridad</li>
				
				</ul>
				<div class="TabbedPanelsContentGroup">
					<div class="TabbedPanelsContent">
						<?  include("memoria_det.php"); ?>
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<?  include("procesador_det.php"); ?>
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<?  include("discoduro_det.php"); ?>
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<?  include("lector_det.php"); ?>
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<? include("softwareoem_det.php"); ?>
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("softwareinstall_det.php"); ?>
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("etiqueta_det.php"); ?>
						<br>
					</div>				
				</div>
			</div>
			<script type="text/javascript">
				<!--
					var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
				//-->
			</script>
		<?
		}
		?>	
	</td>   
	</tr> 
	 <tr><td height="25" colspan="3">    
    <img src="../images/linea.gif" width="100%" height="6"></td></tr>
	</table> 
  </tr> 
  <p align="center">
  <input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar información" >
  </p>
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
	if ((form['numero_serie'].value+0) == 0){alert('Escriba el n�mero de serie u otro n�mero que identifique el objeto');  form['numero_serie'].focus();  return};	
	//if ((form['numero_inventario'].value+0) == 0){alert('Escriba el n�mero de inventario');  form['numero_inventario'].focus();  return};	
	if ((form['numero_sicoin'].value+0) == 0){alert('Escriba el n�mero de sicoin');  form['numero_sicoin'].focus();  return};	
	if (form['codigo_dominio'].selectedIndex == 0){alert('Indique si el equipo es de MINECO o de alg�n programa'); form['codigo_dominio'].focus();  return};		
	if ((form['nombre[0][1]'].value+0) == 0){alert('Seleccione el nombre del usuario a cargo del equipo'); return};
	if ((form['txt_obj'].value) == 2)
	{
		ban = 0; for (i=1;i<8;i++) { if (valor(form['marca['+i+']'])) ban = 1; } if (ban == 0) {alert('Debe especificar la memoria que tiene el CPU'); return};
		ban = 0; for (i=1;i<8;i++) { if (valor(form['marcaproc['+i+']'])) ban = 1; } if (ban == 0) {alert('Indique las caracteristicas del procesador'); return};
		ban = 0; for (i=1;i<16;i++) { if (valor(form['marcadisco['+i+']'])) ban = 1; } if (ban == 0) {alert('Indique las caracteristicas del disco duro'); return};
		ban = 0; for (i=1;i<8;i++) { if (valor(form['tipolector['+i+']'])) ban = 1; } if (ban == 0) {alert('Escriba las unidades de lectura (Cdrom/dvdrom/floppy) de este equipo'); return};
		ban = 0; for (i=1;i<100;i++) { if (valor(form['tipoinstall['+i+']'])) ban = 1; } if (ban == 0) {alert('Se requiere el detalle del software instalado en este equipo'); return};		
		ban = 0; for (i=1;i<100;i++) { if (valor(form['txt_etiqueta'])) ban = 1; } if (ban == 0) {alert('Escriba el n�mero de etiqueta de seguridad que corresponde a este CPU'); return};		
	};
	
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
	
	if (confirm('�Esta acción guarda y finaliza el ingreso de datos para este objeto, desea continuar?')) form.submit();
}
</script>
</html>
