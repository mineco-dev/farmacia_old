<?		
	include("../includes/cnn/inc_conexion.inc");
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
<link href="css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
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
              <td width="13%"><img src="uiplogo.jpg" width="190" height="50"></td>
              <td width="72%"><div align="center" class="legal1">Listado de Solicitudes de Acceso a la Informacion Publica </div></td>
              <td width="15%"><div align="center"><img src="mineco.JPG" width="107" height="113"></div></td>
            </tr>
            <tr>
              <td colspan="2"><?PHP 
			  
			  if ($cboMesi < 10)
			  {
			  	$cboMesi = '0'.$cboMesi;
			  }

			  if ($cboMesf < 10)
			  {
			  	$cboMesf = '0'.$cboMesf;
			  }

			  if ($cboDiai < 10)
			  {
			  	$cboDiai = '0'.$cboDiai;
			  }

			  if ($cboDiaf < 10)
			  {
			  	$cboDiaf = '0'.$cboDiaf;
			  }
			  
			  
			  
				$fecha1 = $cboDiai.'-'.$cboMesi.'-'.$cboAnioi;
				$fecha2 = $cboDiaf.'-'.$cboMesf.'-'.$cboAniof;								
						
				echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
		?></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
      <tr>
        <td colspan="2"></thead>
    <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td colspan="2"><strong>Fecha</strong></td>
          <td><strong>Hora</strong></td>
          <td><strong>Nombre</strong></td>
		  <td><strong>Telefono</strong></td>
		  <td><strong>Expediente</strong></td>
		  <td><strong>Pregunta</strong></td>
          <td><strong>Nacionalidad</strong></td>
</tr>
<?				
	//query de Carlos Romero
/*$query = "select (a.nombre+' '+a.nombre2+' '+a.apellido+' '+a.apellido2),g.sueldo,t.telefono,
t.extensiont,c.correo,d.nombre from asesor a, tb_telefono t, tb_correo c, direccion d, tb_contratacion_gobierno g
where a.idasesor = g.idasesor and a.idasesor = t.idasesor and a.idasesor = c.idasesor and
a.iddireccion = d.iddireccion and t.oficial = 1 and c.oficial = 1 order by d.nombre;"; */

	//query Nhernandez
	   $query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
						CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
						t.nombre as solicitante,
						t.pregunta,t.idsolicitud,t.telefono,p.pais
						
 from
	tbl_solicitud t, tbl_pais p
	where 
	CONVERT(nvarchar(10), fechahora, 105) >= '$fecha1' and CONVERT(nvarchar(10), fechahora, 105) <= '$fecha2' and t.idpais = p.idpais 
 order by fechahora desc
";


//print $query;

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
					include("css/format_table.php");									
					echo '<tr class='.$clase.'><td colspan="2">'.$vector[0].'</td><td>'.$vector[1].'</td><td>'.$vector[2].'</td><td>'.$vector[5].'</td><td>'.$vector[4].'</td><td>'.substr($vector[3],0,100).'...</td><td>'.$vector[6].'</td></tr>';										
					$tmp++;
					$i++;
					
				}				
				mssql_free_result($do);
?>
		</td>
      </tbody><?PHP
	  	
	  ?>
  </table>

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>
