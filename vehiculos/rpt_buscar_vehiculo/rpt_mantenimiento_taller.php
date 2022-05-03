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
<script language="JavaScript" type="text/javascript">
function imprimir()
{
	window.print();
}


</script>
<style type="text/css">
<!--
.Estilo1 {color: #990000}
.Estilo4 {color: #000066}
-->
</style>
</head>
<!-- se agrego style="background:#CEECF5"-->
<body style="background:#CEECF5">
<table width="90%"  border="0" align="center">
  <tr>
    <td width="18%" height="25"><img src="../../images/carro.gif" width="50%" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1 Estilo1">SUBGERENCIA ADMINISTRATIVA</p>
      
	  <p align="center" class="titulocategoria Estilo4"> DESGLOSE DE COSTOS DE MANTENIMIENTO</p>
	  <p align="center" class="titulocategoria Estilo4">&nbsp;</p></td>
    <td width="10%" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="8" colspan="3">   
	</td> 
    <!--<img src="../../images/linea.gif" width="100%" height="6"></td>-->   
  </tr>  
</table>  
<table border="1" width="90%" cellpadding="0" cellspacing="0" align="center">
	<?				
$qry_tipo_mantenimiento="select distinct(m.codigo_tipo_servicio_vehiculo), t.tipo_servicio from tb_mantenimiento_vehiculo m
							 inner join cat_tipo_servicio_vehiculo t on m.codigo_tipo_servicio_vehiculo=t.codigo_tipo_servicio_vehiculo";
conectardb($vehiculos);
$res_qry_tipo_mantenimiento=$query($qry_tipo_mantenimiento);
while($row_qry_tipo_mantenimiento=$fetch_array($res_qry_tipo_mantenimiento))
{
	$id=$row_qry_tipo_mantenimiento["codigo_tipo_servicio_vehiculo"];
	$tipo_servicio=$row_qry_tipo_mantenimiento["tipo_servicio"];	
		$acceso=permisosdb($vehiculos);	
		$hay_detalle=false;										
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{							
				$qry_detalle="SELECT tb_mantenimiento_vehiculo.codigo_mantenimiento_vehiculo, tb_mantenimiento_vehiculo.observaciones, convert(nvarchar, tb_mantenimiento_vehiculo.fecha, 103) as fecha, 
							  tb_taller_vehiculo.taller, cat_tipo_servicio_vehiculo.tipo_servicio, tb_mantenimiento_vehiculo.kilometraje, 
							  tb_mantenimiento_vehiculo.costo, convert(nvarchar, tb_mantenimiento_vehiculo.proximo_servicio, 103) as proximo_servicio, 
							  tb_mantenimiento_vehiculo.activo 
							  FROM tb_mantenimiento_vehiculo 
							  LEFT JOIN tb_taller_vehiculo ON tb_mantenimiento_vehiculo.codigo_taller_vehiculo=tb_taller_vehiculo.codigo_taller_vehiculo 
							  LEFT JOIN cat_tipo_servicio_vehiculo ON tb_mantenimiento_vehiculo.codigo_tipo_servicio_vehiculo=cat_tipo_servicio_vehiculo.codigo_tipo_servicio_vehiculo 
							  WHERE tb_mantenimiento_vehiculo.codigo_tipo_servicio_vehiculo='$id' ORDER BY tb_mantenimiento_vehiculo.fecha, tb_taller_vehiculo.taller, 
							  cat_tipo_servicio_vehiculo.tipo_servicio, tb_mantenimiento_vehiculo.kilometraje, tb_mantenimiento_vehiculo.costo, tb_mantenimiento_vehiculo.proximo_servicio";				
				$res_consulta=$query($qry_detalle);										
				if ($res_consulta)
				{		 			 					 					 
					  echo '<table width="90%" border="1" align="center" cellspacing="0" cellpadding="0">';
					  echo '<tr><td align="left" colspan="3">'.$tipo_servicio.'</td></tr>';
					  echo '<tr class="titulotabla"><td align="center">TALLER DE SERVICIO</td><td align="center">DESCRIPCión</td><td align="center">COSTO</td></tr>';					  
					  $i=1;
					  while($row_qry_insertados=$fetch_array($res_consulta))
					  {
							  $hay_detalle=true;
							  $clase = "boxTitleBgMidGrey";
							  if ($i % 2 == 0) 
							  {
								$clase = "boxTitleBgLightGrey";
							  }							
							 $costo = number_format($row_qry_insertados["costo"], 2, '.', ',');
							  echo '<tr class='.$clase.'><td width="20%">'.$row_qry_insertados["taller"].'</td><td width="60%">'.$row_qry_insertados["observaciones"].'</td><td width="20%" align="center">'.$costo.'</td></tr>';
							  $i++;
					  }
					  echo '<br>';
					  $free_result($res_qry_insertados);
				 }					
				if (!$hay_detalle)
				{
					echo '<tr><td class="error" colspan="'.$no_campos_detalle.'" align="center">NO SE ENCONTRARON REGISTROS DE MANTENIMIENTO<br>PARA ESTE VEH�CULO</td></tr>';
				}	
			}		
} //fin while tipo_servicio		
			
	?>            	  
</table>
<table width="90%"  border="0" align="center">
  <tr>
    <td width="53%">&nbsp;</td>
    <td width="47%"><div align="right"><? print date("d/m/Y H:i:s         ");?><img src="../../images/iconos/ico_print.gif" onclick="imprimir();" width="30" height="30"></div></td>
  </tr>
</table>
</body>
</html>
