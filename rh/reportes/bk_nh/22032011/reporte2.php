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
              <td width="13%">&nbsp;</td>
              <td width="72%"><div align="center" class="legal1">
                <p>Listado de empleados del Ministerio de Econom&iacute;a<br>
				<?
				if ($_REQUEST["rg"])
				{
					if ($_REQUEST["rg"]==1)  echo 'Asesores 029';
					else
					if ($_REQUEST["rg"]==2)  echo 'Asesores 011 y 022';
					else
					if ($_REQUEST["rg"]==3)  echo 'Asesores 018';
				}
				?>
				</p>
                </div></td>
              <td width="15%"><div align="center"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
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
          <td width="34%"><strong>Puesto</strong></td>
          <td width="12%"><strong>Devengado</strong></td>
</tr>
<?	
// query de Carlos Romero
/*	$query = "select p.puesto,g.sueldo,a.idasesor, g.renglon from asesor a, puesto p, tb_contratacion_gobierno g where a.idasesor = g.idasesor and a.id_puesto = p.id_puesto;"; */

if ($_REQUEST["rg"]) //cuando se desea un reporte por renglones
{
	if ($_REQUEST["rg"]==1)  //cuando es 029
	{
		$query = "select  a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,
				 d.nombre as dependencia,
				 p.puesto,
				 g.sueldo 		
				 from asesor a	
				left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
				left join direccion d on g.entidad_gobierno=d.iddireccion
				 left join puesto p on  p.id_puesto=g.puesto 
				 where a.activo=1 and g.renglon='29' and g.oficial=1
				 order by d.dependencia";
	}
	else
	if ($_REQUEST["rg"]==2) //cuando es 022
	{
		$query = "select  a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,
				 d.nombre as dependencia,
				 p.puesto,
				 g.sueldo 		
				 from asesor a	
				left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
				left join direccion d on g.entidad_gobierno=d.iddireccion
				 left join puesto p on  p.id_puesto=g.puesto 
				 where a.activo=1 and (g.renglon='11' or g.renglon='22') and g.oficial=1
				 order by d.dependencia";
	}
	else
	if ($_REQUEST["rg"]==3) //cuando es 018
	{
		$query = "select  a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,
				 d.nombre as dependencia,
				 p.puesto,
				 g.sueldo 		
				 from asesor a	
				left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
				left join direccion d on g.entidad_gobierno=d.iddireccion
				 left join puesto p on  p.id_puesto=g.puesto 
				 where a.activo=1 and (g.renglon='189' or g.renglon='18') and g.oficial=1
				 order by d.dependencia";
	}
}
	else
		{
		$query = "select  a.idasesor, (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2) as nombre_empleado,
			 d.nombre as dependencia,
			 p.puesto,
			 g.sueldo, g.renglon	
			 from asesor a	
			left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
			left join direccion d on g.entidad_gobierno=d.iddireccion
			 left join puesto p on  p.id_puesto=g.puesto and g.oficial=1
			 where a.activo=1 and g.oficial=1
			 order by d.dependencia";
		}



				$do=mssql_query($query);
				$i = 0;									
				$tmp = 0;
		

								
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
					echo '<tr class='.$clase.'><td>'.$i.'</td><td> '.$vector[1].'</td><td> '.$vector[2].'</td><td> '.$vector[3].'</td><td>Q. '.$vector[4].'</td></tr>';										
						$tmp++;
						$i++;
					
				}				
				//mssql_free_result($do);
?>
		</td>
      </tbody>
  </table>

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
