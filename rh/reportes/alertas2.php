<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
	conectardb($rrhh);
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
	form.txt_buscar.focus(); 
	return;
  }  
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="../../css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="../../css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
.style2 {
	font-family: "Times New Roman", Times, serif;
	font-size: 24px;
	color: #666666;
}
-->
</style>
</head>

<body>

<div align="left">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"><img src="../../images/rrhh123.png" width="216" height="95"></td>
              <td width="72%"><div align="center" class="legal1">
                <p>Listado de Alertas Bonos Vencidos del Ministerio de Econom&iacute;a<br>
				<?
				if ($_REQUEST["rg"])
				{
					if ($_REQUEST["rg"]==1)  echo 'Personal 029';
					else
					if ($_REQUEST["rg"]==2)  echo 'Personal 011 y 022';
					else
					if ($_REQUEST["rg"]==3)  echo 'Personal 018';
				}
				?>
				</p>
                </div></td>
              <td width="15%"><div align="center"><img src="../../images/rrhh12.png" width="82" height="95"></div></td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    <table width="200" border="1">
  
  <tr>
    <td bgcolor="#FFFF66"><div align="center">ALERTA TEMPRANA </div></td>
  </tr>
  <tr>
    <td bgcolor="#FF0000"><div align="center">VENCIDO</div></td>
  </tr>
</table>
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
      <td width="6%"></thead>
      <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td><strong>Codigo</strong></td>
          <td width="10%"><strong>Nombre</strong></td>
          <td width="13%"><strong>Dependencia Funcional </strong></td>
          <td width="13%">Descripcion  </td>
          <td width="15%"><strong> Bono 5 a�os </strong></td>
		  <td width="15%"><strong> Bono 10 a�os </strong></td>
		  <td width="15%"><strong> Bono 15 a�os </strong></td>
		  <td width="15%"><strong> Bono 20 a�os </strong></td>
      
</tr>
<?	
// query de Carlos Romero
/*	$query = "select p.puesto,g.sueldo,a.idasesor, g.renglon from asesor a, puesto p, tb_contratacion_gobierno g where a.idasesor = g.idasesor and a.id_puesto = p.id_puesto;"; */

if ($_REQUEST["rg"]) //cuando se desea un reporte por renglones
{
	if ($_REQUEST["rg"]==1)  //cuando es 029
	{
		$query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and dlb.id_reglon_presupuestario=3 and bon.codigo_bono = 1  order by dp.direccion_nombre";
	}
	else
	if ($_REQUEST["rg"]==2) //cuando es 022 o 011
	{ 
		$query = "select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and (dlb.id_reglon_presupuestario=1 or dlb.id_reglon_presupuestario=2  ) and bon.codigo_bono = 1 order by dp.direccion_nombre";
		}
	else
	if ($_REQUEST["rg"]==3) //cuando es 018 o 189
	{
		$query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and (dlb.id_reglon_presupuestario=4 or dlb.id_reglon_presupuestario=5  ) and bon.codigo_bono = 1 order by dp.direccion_nombre";
	
	}
}
	else
		{
		
		  $fechamaquina= date('Y-m-d');
		  
		  $anio5= date('Y');
		  $dia5= date('d');
		  $mes5= date('m')+1;
		  
		  
	 // $fechaotra=$anio5.'-'.$mes5.'-'.$dia5;
		$query = " select (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as persona, 
							depfun.nombre as puesto_funcional,
							  year( dlb.fecha_ingreso),
							  day( dlb.fecha_ingreso), 
							  month( dlb.fecha_ingreso),
							  bns.descripcion,
							  DATEADD(year,+5, dlb.fecha_ingreso)as cinco,DATEADD(year,+10, dlb.fecha_ingreso) as dies,DATEADD(year,+15, dlb.fecha_ingreso) as quince,
							  DATEADD(year,+20, dlb.fecha_ingreso)as veinte 
							 from dbo.asesor as a  inner join tb_datos_laborales as dlb 
							on a.idasesor = dlb.id_asesor  inner join tb_sede as depfun on dlb.id_puesto_funcional = depfun.id_sede  
							inner join dbo.tb_bono as bn on a.idasesor = bn.idasesor inner join tb_bonos as bns on bn.id_bono=bns.id_bonos
							where a.activo=1  and  bn.codigo_bono=1 and (DATEADD(year,+5, dlb.fecha_ingreso) >'2016-10-28' and
							DATEADD(year,+10, dlb.fecha_ingreso) >'2016-10-28' and DATEADD(year,+15, dlb.fecha_ingreso) >'2016-10-28' and
							DATEADD(year,+20, dlb.fecha_ingreso) >'2016-10-28') ";
		}



				$do=mssql_query($query);
				$i = 1;									
				$tmp = 0;
				$contador =0;
		  
		 
		 
			
         
								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
		
					/*for ($x=0;$x<=$i;$x++)
					{
						if ($vector[0]==$p[$x])
						{							
							$err++;
						}else{
							$err = 0;
							$p[$i] = $vector[0];																										
						}
					}
						
						
*/
				
					include("../../includes/format_table.php");	
					
	                       $a�o55=$vector[2]+5;
					       $a�o56=$vector[2]+10;
						   $a�o57=$vector[2]+15;
						   $a�o58=$vector[2]+20;
						    
							$fecha55=	$vector[3]."-".$vector[4]."-".$a�o55;
							$fecha56=	$vector[3]."-".$vector[4]."-".$a�o56;
							$fecha57=	$vector[3]."-".$vector[4]."-".$a�o57;
							$fecha58=	$vector[3]."-".$vector[4]."-".$a�o58;
						
							
							
	echo '<tr class='.$clase.' > <td >'.$i.'</td><td> '.$vector[0].'</td><td> '.$vector[1].'</td><td> '.$vector[5].'</td><td bgcolor="#FFFF66"> '.$fecha55.'</td><td bgcolor="#FFFF66"> '.$fecha56.'</td><td bgcolor="#FFFF66"> '.$fecha57.'</td><td bgcolor="#FFFF66" > '.$fecha58.'</td>
					</tr>';	
			
														
						$tmp++;
						$i++;
					
				}	
				
				
				$query2 = " select (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as persona, 
							depfun.nombre as puesto_funcional,
							  year( dlb.fecha_ingreso),
							  day( dlb.fecha_ingreso), 
							  month( dlb.fecha_ingreso),
							  bns.descripcion,
							  DATEADD(year,+5, dlb.fecha_ingreso)as cinco,DATEADD(year,+10, dlb.fecha_ingreso) as dies,DATEADD(year,+15, dlb.fecha_ingreso) as quince,
							  DATEADD(year,+20, dlb.fecha_ingreso)as veinte 
							 from dbo.asesor as a  inner join tb_datos_laborales as dlb 
							on a.idasesor = dlb.id_asesor  inner join tb_sede as depfun on dlb.id_puesto_funcional = depfun.id_sede  
							inner join dbo.tb_bono as bn on a.idasesor = bn.idasesor inner join tb_bonos as bns on bn.id_bono=bns.id_bonos
							where a.activo=1  and  bn.codigo_bono=1 and (DATEADD(year,+5, dlb.fecha_ingreso) >'2016-10-28' and
							DATEADD(year,+10, dlb.fecha_ingreso) <'2016-10-28' and DATEADD(year,+15, dlb.fecha_ingreso) >'2016-10-28' and
							DATEADD(year,+20, dlb.fecha_ingreso) >'2016-10-28') ";
				$do2=mssql_query($query2);
				$i = 1;									
				$tmp = 0;
				$contador =0;
		  
		 
		 
			
         
								
				while($vector = mssql_fetch_row($do2))
				{	
					$err = 0;
		
					/*for ($x=0;$x<=$i;$x++)
					{
						if ($vector[0]==$p[$x])
						{							
							$err++;
						}else{
							$err = 0;
							$p[$i] = $vector[0];																										
						}
					}
						
						
*/
				
					include("../../includes/format_table.php");	
					
	                       $a�o59=$vector[2]+5;
					       $a�o60=$vector[2]+10;
						   $a�o61=$vector[2]+15;
						   $a�o62=$vector[2]+20;
						    
							$fecha59=	$vector[3]."-".$vector[4]."-".$a�o59;
							$fecha60=	$vector[3]."-".$vector[4]."-".$a�o60;
							$fecha61=	$vector[3]."-".$vector[4]."-".$a�o61;
							$fecha62=	$vector[3]."-".$vector[4]."-".$a�o62;
						
							
							
	echo '<tr class='.$clase.' > <td >'.$i.'</td><td> '.$vector[0].'</td><td> '.$vector[1].'</td><td> '.$vector[5].'</td><td bgcolor="#FF0000"> '.$fecha59.'</td><td bgcolor="#FFFF66"> '.$fecha60.'</td><td bgcolor="#FFFF66"> '.$fecha61.'</td><td bgcolor="#FFFF66" > '.$fecha62.'</td>
					</tr>';	
			
														
						$tmp++;
						$i++;
					
				}	
				
				
				
				
				
?>
		
      </tbody>
  </table>

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
