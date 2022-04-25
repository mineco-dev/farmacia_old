<?		
	include("../includes/uaip_conexion.inc");
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
<link href="../css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="../css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
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
              <td width="13%">&nbsp;</td>
              <td width="72%"><div align="center" class="legal1">Listado Oficial de Empleados del Ministerio de Econom&iacute;a </div></td>
              <td width="15%"><div align="center"><img src="../images/logo_rpt.gif" width="82" height="95"></div></td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
      <td width="19%"></thead>
      <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td colspan="2"><strong>Nombre</strong></td>
          <td><strong>Tel&eacute;fono</strong></td>
          <td><strong>Extensi&oacute;n</strong></td>
		  <td><strong>Celular</strong></td>
		  <td><strong>Correo Electr&oacute;nico</strong></td>
          <td><strong>Dependencia</strong></td>
</tr>
<?				
	//query de Carlos Romero
/*$query = "select (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2),g.sueldo,t.telefono,
t.extensiont,c.correo,d.nombre from asesor a, tb_telefono t, tb_correo c, direccion d, tb_contratacion_gobierno g
where a.idasesor = g.idasesor and a.idasesor = t.idasesor and a.idasesor = c.idasesor and
a.iddireccion = d.iddireccion and t.oficial = 1 and c.oficial = 1 order by d.nombre;"; */

	//query Nhernandez
	   $query = "select (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2 +' '+a.apellidocasada) as nombre_empleado,
				g.sueldo,
				t.telefono, t.extensiont,
				tt.telefono as celular,
				c.correo,
				d.nombre 
				from asesor a
				left join tb_telefono t on a.idasesor=t.idasesor and t.oficial=1 and t.id_tipo_telefono=1
				left join tb_telefono tt on a.idasesor=tt.idasesor and tt.oficial=1 and tt.id_tipo_telefono=2
				left join tb_correo c on a.idasesor=c.idasesor and c.oficial=1				
				left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
				left join direccion d on g.entidad_gobierno=d.iddireccion 
				where a.activo=1
				order by d.nombre_empleado";


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
					include("../includes/format_table.php");									
					echo '<tr class='.$clase.'><td colspan="2">'.$vector[0].'</td><td>'.$vector[2].'</td><td>'.$vector[3].'</td><td>'.$vector[4].'</td><td>'.$vector[5].'</td><td>'.$vector[6].'</td></tr>';										
					$tmp++;
					$i++;
					
				}				
				mssql_free_result($do);
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
