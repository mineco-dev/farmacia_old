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
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
                <p>Listado de empleados del Ministerio de Econom&iacute;a<br>
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
    
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
      <td width="6%"></thead>
      <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td><strong>Codigo</strong></td>
          <td width="25%"><strong>Nombre</strong></td>
          <td width="23%"><strong>Dependencia</strong></td>
          <td width="34%"><strong>Puesto nominal</strong></td>
          <td width="12%"><strong>Sueldo</strong></td>
      
</tr>
<?	
// query de Carlos Romero
/*	$query = "select p.puesto,g.sueldo,a.idasesor, g.renglon from asesor a, puesto p, tb_contratacion_gobierno g where a.idasesor = g.idasesor and a.id_puesto = p.id_puesto;"; */

if ($_REQUEST["rg"]) //cuando se desea un reporte por renglones
{
	if ($_REQUEST["rg"]==1)  //cuando es 029
	{
		/*$query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and dlb.id_reglon_presupuestario=3 and bon.codigo_bono = 1  order by dp.direccion_nombre";*/
				 $query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1 and bon.codigo_bono = 1";
	}
	else
	if ($_REQUEST["rg"]==2) //cuando es 022 o 011
	{ 
		/*$query = "select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and (dlb.id_reglon_presupuestario=1 or dlb.id_reglon_presupuestario=2  ) and bon.codigo_bono = 1 order by dp.direccion_nombre";*/
				 $query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1 and bon.codigo_bono = 1";
		}
	else
	if ($_REQUEST["rg"]==3) //cuando es 018 o 189
	{
		/*$query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1  and (dlb.id_reglon_presupuestario=4 or dlb.id_reglon_presupuestario=5  ) and bon.codigo_bono = 1 order by dp.direccion_nombre";*/
				 $query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1 and bon.codigo_bono = 1";
	
	}
}
	else
		{
		/*$query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,dp.direccion_nombre, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join 
				 tb_direccion_pertenece as dp on dp.id_direccion_pertenece = dlb.id_direccion_pertenece inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1 and bon.codigo_bono = 1   order by dp.direccion_nombre";*/
				 
				 $query = " select   a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado, 
				 pnm.puesto_nominal , bon.valor
				 from asesor a	inner join dbo.tb_datos_laborales as dlb on dlb.id_asesor = a.idasesor inner join
				 tb_puesto_nominal as pnm on dlb.id_puesto_nominal = pnm.id_puesto_nominal inner join tb_bono as bon on
				 bon.idasesor = a.idasesor
				 where a.activo=1 and bon.codigo_bono = 1";
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
						//cuenta el dinero 
					$contador=$contador+$vector[4];
					include("../../includes/format_table.php");						
					echo '<tr class='.$clase.'><td>'.$i.'</td><td> '.$vector[1].'</td><td> '.$vector[2].'</td><td> '.$vector[3].'</td><td> Q'.$vector[4].'</td>
					</tr>';										
						$tmp++;
						$i++;
					
				}	
				cc		
				//mssql_free_result($do);
?>
		</td>
		  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td  width="960" bgcolor="#FF0000"><? echo"Total: Q",	$contador;	?></td>
  </tr>
      </tbody>
  </table>

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
