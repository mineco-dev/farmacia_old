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
.style3 {font-size: x-small}
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
      <div align="left">FORMULARIO PARA MODIFICACION DE DATOS        
      </div>
    </div></td>
    <td height="25">&nbsp;</td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td height="25">&nbsp; </td>
    <td height="25">&nbsp;</td>
  </tr> 
	  <form name="form1" method="post" action="ged_objeto_det.php">
	  <table width="90%"  border="0" align="center">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
				$qry_plantilla="SELECT o.codigo_objeto, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, 
						  p.campo_origen, p.campo_llave, p.tamano, p.etiqueta, p.orden
						  FROM tb_plantilla pl INNER JOIN
						  tb_propiedad p ON pl.codigo_propiedad = p.codigo_propiedad INNER JOIN
						  cat_objeto o ON pl.codigo_objeto = o.codigo_objeto
						  where pl.codigo_objeto='$obj'
						  order by orden"; 
				conectardb($inventarioadmin);		  
				$res_qry_plantilla=$query($qry_plantilla);	// devuelve los campos que corresponden al objeto seleccionado
				$cnt=1;
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{
					$campo[$cnt]=$row_qry_plantilla["propiedad"];					
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
				$free_result($res_qry_plantilla);				
				$qry_select="select ";
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista de campos a consultar
				{
					$qry_select.="$campo[$cnt], ";				
					$cnt++;
				}// fin del while que forma el qry
				$qry_select.="activo from tb_inventario where codigo_inventario_enc=$id";					
				$res_qry_select=$query($qry_select);					
				$cnt=1;
				while($row_qry_select=$fetch_array($res_qry_select)) //concatena lista de campos a consultar
				{
					while ($cnt<=count($campo)) 
					{						
						$dato[$cnt]=$row_qry_select["$campo[$cnt]"];						
						$cnt++;							
					}				
				}
				$free_result($res_qry_select);	
				$res_qry_plantilla=$query($qry_plantilla);	// devuelve los campos que corresponden al objeto seleccionado
				$cnt=1;
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{
					echo '<tr><td width="20%">'.$row_qry_plantilla["etiqueta"].'</td>';
					echo '<td>';
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==1)
					{
						echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="text" id="'.$row_qry_plantilla["propiedad"].'" size="'.$row_qry_plantilla["tamano"].'" value="'.$dato[$cnt].'">';
					}
					else
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==2)
					{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];										
						$qry_cbo="SELECT * FROM $latabla where $campollave='$dato[$cnt]' order by $campoorigen"; 						
						$res_qry_cbo=$query($qry_cbo);
						while($row_qry_cbo=$fetch_array($res_qry_cbo))
						{
							$valoractual=$row_qry_cbo["$campoorigen"];
							$codigo_valoractual=$row_qry_cbo["$campollave"];	
						}
						if ($latabla=='cat_tipo_objeto')
						{
							$qry_cbo="SELECT * FROM $latabla where codigo_objeto=$obj and activo=1 and $campollave<>'$dato[$cnt]' order by $campoorigen"; 
						}
						else
						{
							$qry_cbo="SELECT * FROM $latabla where activo=1 and $campollave<>'$dato[$cnt]' order by $campoorigen"; 
						}						
						$res_qry_cbo=$query($qry_cbo);
						echo('<input  name="'.$row_qry_plantilla["propiedad"].'_temp" type="hidden" id="'.$row_qry_plantilla["propiedad"].'_temp"  value="'.$codigo_valoractual.'"/>');
						echo('<select name="'.$row_qry_plantilla["propiedad"].'">');		
						echo'<option value="0">'.$valoractual.'</option>';				
						while($row_qry_cbo=$fetch_array($res_qry_cbo))
						{
							echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
						}
						echo('</select>');					
						$free_result($res_qry_cbo);
					} // fin de cada combo.
					else
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==3)
					{
						if ($dato[$cnt]==1)
							echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="checkbox" value="1" checked>';
							else
								echo '<input name="'.$row_qry_plantilla["propiedad"].'" type="checkbox" value="2">';
					}
					$cnt++;
				echo '</td></tr>';
				}//fin de creacion de campos.
	}	// fin si esta seteado el objeto		
		$free_result($res_qry_plantilla);
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
				<li class="TabbedPanelsTab style3" tabindex="0">Etiqueta</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Asignado a</li>
				
				</ul>
				<div class="TabbedPanelsContentGroup">
					<div class="TabbedPanelsContent">
						<?  include("ed_memoria_det.php"); ?>
						<input  name="txt_memoria_reg" type="hidden" id="txt_memoria_reg"  value="<? echo $registros?>"/> 
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<?  include("ed_procesador_det.php"); ?>
						<input  name="txt_procesador_reg" type="hidden" id="txt_procesador_reg"  value="<? echo $registros_proc?>"/> 
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<?  include("ed_discoduro_det.php"); ?>
						<input  name="txt_discoduro_reg" type="hidden" id="txt_discoduro_reg"  value="<? echo $registros_disco?>"/> 
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<?  include("ed_lector_det.php"); ?>
						<input  name="txt_lector_reg" type="hidden" id="txt_lector_reg"  value="<? echo $registros_lector?>"/> 
						<br>
					</div>
					<div class="TabbedPanelsContent">
						<? include("ed_softwareoem_det.php"); ?>			
						<input  name="txt_softwareoem_reg" type="hidden" id="txt_softwareoem_reg"  value="<? echo $registros_software?>"/>			
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("ed_softwareinstall_det.php"); ?>
						<input  name="txt_softwareinstall_reg" type="hidden" id="txt_softwareinstall_reg"  value="<? echo $registros_softwareinstall?>"/> 
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("ed_etiqueta_det.php"); ?>
						<br>
					</div>	
					<div class="TabbedPanelsContent">
						<? include("ed_asignado_det.php"); ?>
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
		}
		?>	
	
	<tr>   	          
	</td>
  	<tr>   	
	<td colspan="2">
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $id?>"/> 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Actualizar" ></td></tr>  
	
</table>	  	 		  
</tr> 
<br>
<br>  
 
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
	if (confirm('�Esta acción guarda y finaliza las modificaciones para este registro, desea continuar?')) form.submit();
}
</script>
</html>
