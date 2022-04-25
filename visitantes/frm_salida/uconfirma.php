<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
require_once('../../connection/helpdesk.php');
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
		$qry_consulta="select * from seg_visita_det where codigo_usuario='$id' and referencia='$rf' and codigo_estado in (1, 3) ";		
		$res_qry_consulta=$query($qry_consulta);
		while($row_qry_consulta=$fetch_array($res_qry_consulta))
		{
			$nombre_usuario='CONFIRMADO POR CORREO';
			$acceso=4;
			$id=$row_qry_consulta["codigo_visita_det"];
		}
		//$acceso=permisosdb($visitantes);					
		if (($acceso>=4) && ($acceso<=8))
		{
					$tabla_destino=seg_visita_det;
					$campo_llave_destino=codigo_visita_det;										
					$qry_insert="update $tabla_destino set ";									
					//$nombre_usuario=$_SESSION["user_name"];
					$qry_insert.="codigo_usuario_confirma='$nombre_usuario', fecha_aceptado=getdate(), codigo_estado=2 where 					
								  $campo_llave_destino=$id";														
					//conectardb($visitantes);						
					$res_insert=$query($qry_insert);	
					$qry_consulta="select * from seg_visita_det where $campo_llave_destino=$id";
					$res_consulta=$query($qry_consulta);	
					while($row_qry_consulta=$fetch_array($res_consulta))
					{
						$codigo_visita=$row_qry_consulta["codigo_visita"];
					}
					$qry_consulta2="select * from seg_visita_det where codigo_visita='$codigo_visita' and codigo_estado=1";
					$res_consulta2=$query($qry_consulta2);	
					$encontro=false;
					while($row_qry_consulta=$fetch_array($res_consulta))
					{
						$encontro=true;
					}
					if (!$encontro)
					{
						$qry_actualiza="update seg_visita set codigo_estado=2 where codigo_visita='$codigo_visita'";
						$res_actualiza=$query($qry_actualiza);	
					}
					
				if ($res_insert)
				{					
					echo '<tr><td class="legal1" colspan="3" align="center">CONFIRMACión EXITOSA, PUEDE CERRAR ESTA VENTANA</a></td></tr>';
				} 
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">Se produjo un error durante la confirmación, El visitante NO ha sido aceptado<br><br>Para intentar nuevamente <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
				}	
			}
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
			}
			$close($s);
	?>            
	</td>
  </tr>
</table>
</body>
</html>
