<?
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
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
    <td height="25"><div align="right" class="tituloproducto">
      <div align="center"></div>
    </div></td>
    <td height="25">
	<?
	if (isset($_SESSION["ingresando_obj"]))
	{	
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{
			conectardb($inventarioadmin);//// devuelve la plantilla de acuerdo al tipo de objeto seleccionado	
				$qry_plantilla="SELECT c.codigo_campo, c.nombre_campo, c.codigo_tipo_campo, c.tb_origen, c.ubicacion_campo, c.validar,
						   c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden_ubicacion, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen
						   FROM tb_campo c 
						   where c.codigo_formulario='$txt_obj'"; 					  
				$res_qry_plantilla=$query($qry_plantilla);	
				$cnt=1;
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{
					if (!isset($nombrecampollave))
					{
						$nombrecampollave='codigo_'.$row_qry_plantilla["nombre_campo"];
					}					
					$campo[$cnt]=$row_qry_plantilla["nombre_campo"];					
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
				$free_result($res_qry_plantilla);
				$qry_insert="update $txt_tabladestino set ";
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista de campos a grabar
				{
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);
					if ($variable=="0") 
					{
						$variable_temp=$campo[$cnt]."_temp";						
						$variable=($_REQUEST["$variable_temp"]);
					}
					$qry_insert.="$campo[$cnt]='$variable', ";				
					$cnt++;
				}// fin del while que forma el qry_insert			
				$nombre_usuario=$_SESSION["user_name"];
				$qry_insert.="usuario_creo='$nombre_usuario', fecha_creado=getdate(), activo=1 where $nombrecampollave=$txt_id";			
				$cnt=1;										
				session_unregister("ingresando_obj");			
				$res_insert=$query($qry_insert);			
				if ($res_insert)
				{
					echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA ACTUALIZADO CORRECTAMENTE<br><br>Para ingresar otro registro <a href="catalogos.php">[HAGA CLIC AQUI]</a></td></tr>';															
				} // fin del ingreso del encabezado
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">Se produjo un error durante la actualización, El registro NO ha cambiado<br><br>Para intentar nuevamente <a href="catalogos.php">[HAGA CLIC AQUI]</a></td></tr>';
				}	
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para continuar llenando los catálogos <a href="catalogos.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
