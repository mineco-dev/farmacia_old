<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0">
  <tr>
    <td width="18%" height="25"><div align="left"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA ADMINISTRATIVA</p>
    <p align="center" class="titulocategoria">M&Oacute;DULO: VISITANTES</p></td>
    <td width="10%"><div align="right"><img src="../../images/visitantes.gif" width="124" height="96"></div></td>
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
		$acceso=permisosdb($visitantes);					
		if (($acceso>=4) && ($acceso<=8))
		{
					$tabla_destino=seg_visita;
					$campo_llave_destino=codigo_visita;										
					$qry_insert="update $tabla_destino set ";									
					$nombre_usuario=$_SESSION["user_name"];
					$qry_insert.="usuario_egreso='$nombre_usuario', fecha_egreso=getdate(), codigo_estado=5 where 					
								  $campo_llave_destino=$idv";														
					//// consulta equipo  
					$hay_equipo=false;
					$qry_equipo="select * from seg_equipo_det where $campo_llave_destino=$idv";
					conectardb($visitantes);						
					$res_equipo=$query($qry_equipo);	
					while($row_qry_equipo=$fetch_array($res_equipo))
					{
						$hay_equipo=true;
					}
					if ($hay_equipo)
					{
						header("Location: equipo.php?id=$id&idv=$idv");
					}
					else
					{		
							header("Location: visitas.php?id=$id&idv=$idv");
					} 				
			}
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
			}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
