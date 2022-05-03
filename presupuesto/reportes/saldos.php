<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-family: Georgia, "Times New Roman", Times, serif}
.style6 {font-family: "Courier New", Courier, mono}
.style7 {font-family: Geneva, Arial, Helvetica, sans-serif}
.style11 {font-family: "Times New Roman", Times, serif}
.style12 {font-family: Arial, Helvetica, sans-serif}
.style17 {font-size: 10px}
.style18 {font-size: 10}
.style22 {font-size: 9px}
.style23 {font-size: 9}
.style24 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: 9; }
.style25 {color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; }
-->
</style>
</head>

<body>


<p>

</p>
<p align="center">PROGRAMACION FINANCIERA</p>
<p align="center">CORRESPODIENTE AL PRIMER CUATRIMESTRE 2010</p>
<p align="center">PROGRAMA DEL REGISTRO DE LA PROPIEDAD INTELECTUAL </p>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
    <td width="4%"><span class="style23"></span></td>
    <td width="2%"><span class="style23"></span></td>
    <td width="3%"><span class="style23"></span></td>
    <td colspan="4" bgcolor="#666666"><div align="center" class="style24">Presupuestado</div></td>
    <td width="5%" bgcolor="#FFFFFF"><div align="center"><span class="style1"><span class="style2"><span class="style6"><span class="style7"><span class="style11"><span class="style12"><span class="style17"><span class="style18"><span class="style22"><span class="style23"></span></span></span></span></span></span></span></span></span></span></div></td>
    <td colspan="4" bgcolor="#666666"><div align="center" class="style24">Autorizado</div></td>
    <td width="5%"><span class="style23"></span></td>
    <td colspan="4" bgcolor="#666666"><div align="center" class="style25">Pagado</div></td>
  </tr>
  <tr>
    <td width="4%" bgcolor="#000000"><div align="center" class="style24">Grup</div></td>
    <td width="2%" bgcolor="#000000"><div align="center" class="style24">FF</div></td>
    <td width="3%" bgcolor="#000000"><div align="center" class="style24">Ren</div></td>
    <td width="5%" bgcolor="#000000"><div align="center" class="style24">Enero </div></td>
    <td width="7%" bgcolor="#000000"><div align="center" class="style24">Febrero</div></td>
    <td width="5%" bgcolor="#000000"><div align="center" class="style24">Marzo</div></td>
    <td width="10%" bgcolor="#000000"><div align="center" class="style24">Abril</div></td>
    <td width="5%" bgcolor="#000000"><div align="center" class="style24">Suma</div></td>
    <td width="5%" bgcolor="#000000"><div align="center" class="style24">Enero</div></td>
    <td width="7%" bgcolor="#000000"><div align="center" class="style24">Febrero</div></td>
    <td width="5%" bgcolor="#000000"><div align="center" class="style24">Marzo</div></td>
    <td width="8%" bgcolor="#000000"><div align="center" class="style24">Abril</div></td>
    <td width="5%" bgcolor="#000000"><div align="center" class="style24">Suma</div></td>
    <td width="7%" bgcolor="#000000"><div align="center"><span class="style25">Enero</span></div></td>
    <td width="7%" bgcolor="#000000"><div align="center"><span class="style25">Febrero</span></div></td>
    <td width="7%" bgcolor="#000000"><div align="center"><span class="style25">Marzo</span></div></td>
    <td width="8%" bgcolor="#000000"><div align="center" class="style24">
      <div align="center">Abril</div>
    </div></td>
  </tr>
  
  
    <?
	
	$myserver="server_appl";
	$myuser="sa";
	$mypass="Sup3rus3r2009";
	$mydb="presupuesto";

/*	$myserver="me-s-portal";
	$myuser="test2010";
	$mypass="test2010";
	$mydb="helpdesk";*/

	$s=mssql_connect($myserver, $myuser,$mypass) or die ("no se pudo conectar al servidor $myserver");
	$d=mssql_select_db($mydb, $s);
	//variables para manejo de base de datos
	$query="mssql_query";
	$fetch_array="mssql_fetch_array";
	$close="mssql_close";



	$query_reporte = "
	select  distinct(b.codigo_renglon),
	a.codigo_fuente_financiamiento,
    a.codigo_programa,
	a.codigo_actividad,
	b.codigo_grupo,	
	b.asignado_mes1,
	b.asignado_mes2,
	b.asignado_mes3,
	b.asignado_mes4,
	c.comprometido_mes1,
	c.comprometido_mes2,
	c.comprometido_mes3,
	c.comprometido_mes4,
	c.codigo_renglon,
	d.codigo_grupo,
	d.codigo_grupo as grupo2,
	b.codigo_periodo 
from 
	tb_financiamiento_actividad a, 
	tb_asignacion_cuatrimestral b,
	tb_presupuesto_det c, 
	tb_presupuesto_anual d
where 	
	a.codigo_financiamiento_actividad = b.codigo_financiamiento_actividad
	and a.codigo_actividad = 8 
	and b.codigo_periodo = 1 
	and c.codigo_presupuesto_anual = d.codigo_presupuesto_anual
	and d.codigo_financiamiento_actividad = a.codigo_financiamiento_actividad
	and d.codigo_grupo = b.codigo_grupo";
			
	

	
	$consulta_reporte = mssql_query($query_reporte);
	
	
	if ($consulta_reporte)
	{	
	
	$i = 0;
		while($vector_reporte = mssql_fetch_row($consulta_reporte))
		{				
		if ($i % 2 == 0)
		{
		$suma1 = $vector_reporte[5]+$vector_reporte[6]+$vector_reporte[7]+$vector_reporte[8];
		$suma2 = $vector_reporte[9]+$vector_reporte[10]+$vector_reporte[11]+$vector_reporte[12];
		$renglon_value = $vector_reporte[0];
		
		$query_pagado = "select  	
									e.codigo_renglon,
									sum(e.dev_mes1) as pagado_mes1,
									sum(e.dev_mes2) as pagado_mes2,
									sum(e.dev_mes3) as pagado_mes3,
									sum(e.dev_mes4) as pagado_mes4
								from 
									tb_ejecucion_presupuesto e, tb_financiamiento_actividad  a
								where   
									e.codigo_financiamiento_actividad = a.codigo_financiamiento_actividad
									and a.codigo_actividad = 8
									and e.codigo_periodo = 1
									and e.codigo_renglon = $renglon_value
								
								group by e.codigo_renglon ";
								
			$consulta_pagado = mssql_query($query_pagado);
			
			if ($consulta_pagado)
			{
				$vector_pagado = mssql_fetch_row($consulta_pagado);
			}
								
								
		
		if (!empty($vector_pagado[1]))
		{
			$p1 = $vector_pagado[1];
		}else{
			$p1 = 0;
		}
		
		if (!empty($vector_pagado[2]))
		{
			$p2 = $vector_pagado[2];
		}else{
			$p2 = 0;
		}
		
				if (!empty($vector_pagado[3]))
		{
			$p3 = $vector_pagado[3];
		}else{
			$p3 = 0;
		}
		
		if (!empty($vector_pagado[4]))
		{
			$p4 = $vector_pagado[4];
		}else{
			$p4 = 0;
		}
		
		
			print '<tr>';
				print '<td width="6%"><input type=text size=5 value='.$vector_reporte[4].' /></td>
					    <td width="5%"><input type=text size=5 value='.$vector_reporte[1].' /></td>
					    <td width="4%"><input type=text size=5 value='.$vector_reporte[0].' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[9].' /></td>
					    <td width="9%"><input type=text size=5 value='.$vector_reporte[10].' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[11].' /></td>
					    <td width="6%"><input type=text size=5 value='.$vector_reporte[12].' /></td>
					    <td width="6%"><input type=text size=5 value='.$suma1.' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[5].' /></td>
					    <td width="9%"><input type=text size=5 value='.$vector_reporte[6].' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[7].' /></td>
					    <td width="6%"><input type=text size=5 value='.$vector_reporte[8].' /></td>
					    <td width="6%"><input type=text size=5 value='.$suma2.' /></td>
					    <td width="7%"><input type=text size=5 value='.$p1.' /></td>
					    <td width="9%"><input type=text size=5 value='.$p2.' /></td>
					    <td width="7%"><input type=text size=5 value='.$p3.' /></td>
					    <td width="6%"><input type=text size=5 value='.$p4.' /></td>';
			
			print '</tr>';
			}
			
			$i++;
		}
	}

	
	
	/*	$query_reporte = "
	select  distinct(b.codigo_renglon),
	a.codigo_fuente_financiamiento,
        a.codigo_programa,
	a.codigo_actividad,
	b.codigo_grupo,	
	b.asignado_mes1,
	b.asignado_mes2,
	b.asignado_mes3,
	b.asignado_mes4,
	c.comprometido_mes1,
	c.comprometido_mes2,
	c.comprometido_mes3,
	c.comprometido_mes4,
	c.codigo_renglon,
	d.codigo_grupo,
	d.codigo_grupo as grupo2,
	b.codigo_periodo 
from 
	tb_financiamiento_actividad a, 
	tb_asignacion_cuatrimestral b,
	tb_presupuesto_det c, 
	tb_presupuesto_anual d
where 	
	a.codigo_financiamiento_actividad = b.codigo_financiamiento_actividad
	and a.codigo_actividad = 8 
	and b.codigo_periodo = 1 
	and c.codigo_presupuesto_anual = d.codigo_presupuesto_anual
	and d.codigo_financiamiento_actividad = a.codigo_financiamiento_actividad
	and d.codigo_grupo = b.codigo_grupo
";
			
	

	
	$consulta_reporte = mssql_query($query_reporte);
	
	
	if ($consulta_reporte)
	{	
		while($vector_reporte = mssql_fetch_row($consulta_reporte))
		{
		
		$suma1 = $vector_reporte[5]+$vector_reporte[6]+$vector_reporte[7]+$vector_reporte[8];
		$suma2 = $vector_reporte[9]+$vector_reporte[10]+$vector_reporte[11]+$vector_reporte[12];
			print '<tr>';
				print '<td width="6%"><input type=text size=5 value='.$vector_reporte[0].' /></td>
					    <td width="5%"><input type=text size=5 value='.$vector_reporte[1].' /></td>
					    <td width="4%"><input type=text size=5 value='.$vector_reporte[2].' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[5].' /></td>
					    <td width="9%"><input type=text size=5 value='.$vector_reporte[6].' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[7].' /></td>
					    <td width="6%"><input type=text size=5 value='.$vector_reporte[8].' /></td>
					    <td width="6%"><input type=text size=5 value='.$suma1.' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[9].' /></td>
					    <td width="9%"><input type=text size=5 value='.$vector_reporte[10].' /></td>
					    <td width="7%"><input type=text size=5 value='.$vector_reporte[11].' /></td>
					    <td width="6%"><input type=text size=5 value='.$vector_reporte[12].' /></td>
					    <td width="6%"><input type=text size=5 value='.$suma2.' /></td>
					    <td width="15%">Justificacion</td>';
			
			print '</tr>';
		}
	}	

*/

?>
</table>
<p>&nbsp;</p>
</body>
</html>
