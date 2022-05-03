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
	  <form name="form1" method="post" action="ged_catalogos.php">
	  <table width="90%"  border="0" align="center">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			conectardb($inventarioadmin);$qry_plantilla="SELECT c.codigo_campo, c.nombre_campo, c.codigo_tipo_campo, c.tb_origen, c.ubicacion_campo, c.validar,
						   c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden_ubicacion, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, f.campos_editables
						   FROM tb_campo c 
						   inner join tb_formulario f on c.codigo_formulario=f.codigo_formulario
						   where c.codigo_formulario='$obj'
						   order by orden_ubicacion"; 					  
			$res_qry_plantilla=$query($qry_plantilla);	
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				if (!isset($campo))
				{
					$tabladestino=$row_qry_plantilla["tb_destino"];
					$nombrecampollave='codigo_'.$row_qry_plantilla["nombre_campo"];
					$campos_editables=$row_qry_plantilla["campos_editables"];
					$qry_item_catalago="select * from $tabladestino where $nombrecampollave=$id";											
					$res_qry_item_catalogo=$query($qry_item_catalago);	//devuelve datos del objeto que se esta editando
					$item=1;
					$cnt=1;
					while($row_qry_item_catalogo=$fetch_array($res_qry_item_catalogo))
					{
						while ($campos_editables>0)
						{							
							$campo[$cnt]=$row_qry_item_catalogo[$cnt];													
							$cnt++;
							$campos_editables--;
						}						
					}
				}
				echo '<tr><td width="20%">'.$row_qry_plantilla["etiqueta"].'</td>';
				echo '<td>';				
					if ($row_qry_plantilla["validar"]==1)
					{
						$campo_validacion=$row_qry_plantilla["nombre_campo"];
					}				
					if ($row_qry_plantilla["codigo_tipo_campo"]==1)
					{
						echo '<input name="'.$row_qry_plantilla["nombre_campo"].'" type="text" id="'.$row_qry_plantilla["nombre_campo"].'" size="'.$row_qry_plantilla["tamano"].'" value="'.$campo[$item].'">';
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==2)
					{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];
						$qry_cbo="SELECT * FROM $latabla where $campollave='$campo[$item]' order by $campoorigen"; 												
						$res_qry_cbo=$query($qry_cbo);
						while($row_qry_cbo=$fetch_array($res_qry_cbo))
						{
							$valoractual=$row_qry_cbo["$campoorigen"];
							$codigo_valoractual=$row_qry_cbo["$campollave"];							
						}
						$qry_cbo="SELECT * FROM $latabla where $campollave<>'$campo[$item]' order by $campoorigen"; 	
						$res_qry_cbo=$query($qry_cbo);
						echo('<input  name="'.$row_qry_plantilla["nombre_campo"].'_temp" type="hidden" id="'.$row_qry_plantilla["nombre_campo"].'_temp"  value="'.$codigo_valoractual.'"/>');
						echo('<select name="'.$row_qry_plantilla["nombre_campo"].'">');		
						echo'<option value="0">'.$valoractual.'</option>';				
						while($row_qry_cbo=$fetch_array($res_qry_cbo))
						{
							echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
						}
						echo('</select>');					
						$free_result($res_qry_cbo);
					} // fin de cada combo.
					$item++;
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
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $id?>"/> 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Actualizar" ></td></tr>  
	
</table>	  	 		  
</tr> 
<br>
<br>  
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
	if (confirm('�Esta acción guarda las modificaciones realizadas, desea continuar?')) form.submit();
}
</script>
</html>
