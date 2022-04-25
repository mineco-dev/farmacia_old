<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0">
  <tr>
    <td width="18%" height="25"><div align="left"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORM&Aacute;TICA</p>
    <p align="center" class="titulocategoria"> INVENTARIO DE HARDWARE Y SOFTWARE </p></td>
    <td width="10%"><div align="right"><img src="../../images/hard_soft.jpg" width="112" height="113"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
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
				$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj'
							order by orden"; 			
			require_once('../../connection/helpdesk.php');				
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($inventarioadmin);
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{					
					if ($row_qry_plantilla["codigo_tipo_campo"] == '6')
					{
						$tabla_destino=$row_qry_plantilla["tb_destino"];
						$campo_llave_destino=$row_qry_plantilla["campo_destino"];								
					}
				}	 //fin del while que indica los campos que corresponden al objeto
				$free_result($res_qry_plantilla);				
				$nombre_usuario=$_SESSION["user_name"];
				$qry_insert="update $tabla_destino set activo='$st', usuario_desactivo='$nombre_usuario', fecha_desactivado=getdate() where $campo_llave_destino=$id";												
				session_unregister("ingresando_obj");					
				$res_insert=$query($qry_insert);			
				if ($res_insert)
				{					
					echo '<tr><td class="titulocategoria" colspan="3" align="center">SE HA CAMBIADO EL ESTADO DEL REGISTRO CORRECTAMENTE<br><br>Para ingresar otro registro <a href="catalogos.php">[HAGA CLIC AQUI]</a></td></tr>';															
				} // fin del ingreso del encabezado
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, NO se ha cambiado el estado del registro<br><br>Para intentar nuevamente <a href="catalogos.php">[HAGA CLIC AQUI]</a></td></tr>';
				}	
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para continuar llenando los cat�logos <a href="catalogos.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
