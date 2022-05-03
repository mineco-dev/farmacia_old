<?
include("conexion.php");
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
                <p>Inventario equipo FOGUAMI escritorio<br>
				
				</p>
                </div></td>
              <td width="15%"><div align="center"><img src="../../../images/logo_rpt.gif" width="82" height="95"></div></td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
      <td width="7%"></thead>
      <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td><strong>Correlativo</strong></td>
          <td width="8%"><strong>Nombre</strong></td>
        <td width="7%"><strong>color</strong></td>
        <td width="8%"><strong>Serie</strong></td>
        <td width="7%">Movimiento</td>
        <td width="10%">Movimiento 2</td>
        <td width="10%">Marca</td>
        <td width="43%">Modelo</td>
        <td width="43%">Propiedad</td>
        <td width="43%">Procesador</td>
        <td width="43%">Marca Procesador</td>
        <td width="43%">Velocidad</td>
        <td width="43%">HD</td>
    </tr>
<?	
	$query = "select * from equipo_lenovo";
					$do=mssql_query($query);
				$i = 1;									
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
					include(__FILE__ . '../../../../../includes/format_table.php');
					echo '<tr class='.$clase.'><td>'.$i.'</td><td> '.$vector[1].'</td><td> '.$vector[2].'</td> <td> '.$vector[3].'</td><td> '.$vector[4].'</td><td> '.$vector[5].'</td><td> '.$vector[6].'</td><td> '.$vector[7].'</td><td> '.$vector[8].'</td><td> '.$vector[9].'</td><td> '.$vector[10].'</td><td> '.$vector[11].'</td><td> '.$vector[12].'</td>
					</tr>';										
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
