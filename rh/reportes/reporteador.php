<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" src="calendar_db.js"></script>
<link rel="stylesheet" href="calendar.css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<?  include('../includes/inc_header_sistema.inc'); 
	



		$fecha[] = "Enero";	
		$fecha[] = "Febrero";	
		$fecha[] = "Marzo";	
		$fecha[] = "Abril";	
		$fecha[] = "Mayo";	
		$fecha[] = "Junio";	
		$fecha[] = "Julio";	
		$fecha[] = "Agosto";	
		$fecha[] = "Septiembre";	
		$fecha[] = "Octubre";	
		$fecha[] = "Noviembre";	
		$fecha[] = "Diciembre";	
		
		
function get_depe()
{
	
$consulta = mssql_query("select iddireccion,nombre from direccion where activo=1 order by nombre");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

$dependencia = get_depe();		



	

if ($op == 1)		
{

	list($year, $month, $day) = split('-', $testinputi);



	$vector[1] = 	" d.iddireccion = '$depe' ";		
	$vector[2] =    " month(a.fecha_nacimiento) = '$month' and day(a.fecha_nacimiento) = '$day' ";		
	$vector[3] =    " a.sexo = '$sex' ";
	$vector[4] = 	" g.renglon = '$renglon' ";	


	$consulta = "SELECT distinct(a.idasesor),(a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada 
						+', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, 
						a.fecha_nacimiento, a.gafete,d.nombre as dependencia,a.sexo AS sexo,  g.renglon
					   FROM asesor a 
						left join tb_contratacion_gobierno g on a.idasesor=g.idasesor  and a.activo=1 and g.oficial = 1
						inner join direccion d on g.entidad_gobierno=d.iddireccion 
					  WHERE";
						



						
						
$valor = 0;

for($i = 1;$i<5;$i++)
{
	if ($checkbox[$i] == 'on' )
	{
		if ($valor == 0)
		{
				$consulta.= $vector[$i];			
		}else{
				if ($menu == 1)
				{
					$consulta.=' and '.$vector[$i];			
				}else{
					$consulta.=' or '.$vector[$i];			
				}
		}

		$valor++;
	}else{
	
	}
}	

//print $consulta;
		
						
							
	//print $consulta;
	
	
	$cons_consulta= mssql_query($consulta);
							
}		
	
 ?>
<style type="text/css">
<!--
.style10 {font-family: Arial, Helvetica, sans-serif}
.style12 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style15 {font-size: 12px}
.style21 {font-family: "Adobe Garamond Pro Bold"; font-size: 16px; }
-->
</style>
</head>

<body>
<form name="form1" action="" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="9%" class="style12"><span class="style21">Dependencia</span> </td>
    <td width="2%"><input name="checkbox[1]" type="checkbox" id="checkbox[1]" /></td>
    <td width="89%"><label><select name="depe" size="1" id="depe" >
					<option value="">----------------</option>
                         <? print $dependencia;?>
                        </select></label></label></td>
  </tr>
  <tr>
    <td class="style12"><span class="style21">Cumplea&ntilde;os</span></td>
    <td><input name="checkbox[2]" type="checkbox" id="checkbox[2]"  /></td>
    <td><label>
	<input type="text" name="testinputi" value="" size="10"> 
	<script language='JavaScript'>
	new tcal ({
		'formname': 'form1',
		'controlname': 'testinputi'
	})
	</script>
	
	</label></td>
  </tr>
  <tr>
    <td class="style12"><span class="style21">Sexo</span></td>
    <td><input name="checkbox[3]" type="checkbox" id="checkbox[3]"  /></td>
    <td><select name="sex" id="sex">
		<option value="">--</option>
		<option value="M">M</option>
 		<option value="F">F</option>
	</select>&nbsp;</td>
  </tr>
  <tr>
    <td class="style12"><span class="style21">Renglon</span></td>
    <td><input name="checkbox[4]" type="checkbox" id="checkbox[4]"  /></td>
    <td><select name="renglon" id="renglon">
		<option value="">---</option>
		<option value="11">011</option>
 		<option value="29">029</option>
 		<option value="18">018</option>
 		<option value="22">022</option>
	</select>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Operador</td>
    <td>&nbsp;</td>
    <td><select name="menu" id="menu" >
                    <option value="1">Y</option>
                    <option value="2">O</option>
                  </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Ejecutar Reporte" />
      <input type="hidden" name="op" value="1"></td>
  </tr>
</table>
<hr />
<tr>	
       <td><table width="100%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
    <tr>
                <td width="90%" height="49" colspan="3"><div align="center">
                    <div align="center">
                      <table width="100%" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="469" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style12"><font color="#FFFFFF">Nombre</font></span></td>
<td width="176" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style15 style10 Estilo7" lang="es-gt" xml:lang="es-gt"><strong><font color="#FFFFFF">Fecha Nacimiento</font></strong></span></td>
<td width="176" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style15 style10 Estilo7" lang="es-gt" xml:lang="es-gt"><strong><font color="#FFFFFF">Carnet</font></strong></span></td>
<td width="176" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style15 style10 Estilo7" lang="es-gt" xml:lang="es-gt"><strong><font color="#FFFFFF">Dependencia</font></strong></span></td>
<td width="176" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style15 style10 Estilo7" lang="es-gt" xml:lang="es-gt"><strong><font color="#FFFFFF">Sexo</font></strong></span></td>
<td width="176" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style15 style10 Estilo7" lang="es-gt" xml:lang="es-gt"><strong><font color="#FFFFFF">Renglon</font></strong></span></td>
<td width="86" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style15 style10 GrayLink" lang="es-gt" xml:lang="es-gt"><strong><font color="#FFFFFF">Ver</font></strong></span></td>
                          </tr>
						  
						  
						  
						  
                          <?
						   if ($cons_consulta)
						  {
						  	while($vec_consulta=mssql_fetch_row($cons_consulta))
							{
								print '<tr>';
									print '<td width="469">'.$vec_consulta[1].'</td>';
									print '<td width="176">'.$vec_consulta[2].'</td>';
									print '<td width="176">'.$vec_consulta[3].'</td>';
									print '<td width="176">'.$vec_consulta[4].'</td>';									
									print '<td width="176">'.$vec_consulta[5].'</td>';
									print '<td width="86">'.$vec_consulta[6].'</td>';																											
									print '<td width="86"><a href="../personas/cpersona.php?num_gafete='.$vec_consulta[3].'&busca=1">Ver</a></td>';																											
									
								print '</tr>';
							}
						  }
						  
 ?>


                          <tr>
                            <td width="469"></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                 
                </div></td>
         </tr>
            </table></td>        
</tr>

  &nbsp;</p>
</form>

</body>
</html>
