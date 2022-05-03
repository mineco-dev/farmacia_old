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
              <td width="13%"><img src="../imagen/logomineco.jpg" width="139" height="160"></td>
              <td width="72%"><div align="center" class="defaulttext style2">Listado Oficial de Puestos del Ministerio de Econom&iacute;a </div></td>
              <td width="15%">&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
	
<table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">     
      <td width="19%"></thead>
      <tr align="center" bgcolor="#006699" class="thead">
          <td colspan="2" class="Estilo3 thead"><strong>Codigo</strong></td>
          <td width="61%" class="Estilo3 thead"><strong>Puesto</strong></td>
          <td width="18%" class="thead Estilo3"><strong>Devengado</strong></td>
</tr>
<?				
$query = "select p.puesto,g.sueldo,a.idasesor from asesor a, puesto p, tb_contratacion_gobierno g
where a.idasesor = g.idasesor and a.id_puesto = p.id_puesto;";



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
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					
					
					echo '<tr class='.$clase.'><td colspan="2">'.$i.'</td><td> '.$vector[0].'</td><td>Q. '.$vector[1].'</td></tr>';										
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
