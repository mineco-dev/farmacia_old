<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
		
		
		
		
		
function gentabla($cboMesi)
{	
	//SE REALIZO ESTA CONSULTA PARA PONER SOLO LOS CUMPLEA�EROS EXISTENTES	
								
		$qry_cumple ="select idasesor,nombre+' '+nombre2+' '+nombre3+' '+apellido+' '+apellido2,fecha_nacimiento,apellido,sexo from asesor where month(fecha_nacimiento) = $cboMesi and activo='1'  order by day(fecha_nacimiento)";
		$result = mssql_query($qry_cumple);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<TD width='400'><span class='style9'>$vec[1]</span></TD>";
							  print"<TD width='120'><span class='style9'>$vec[2]</span></TD>";							
							  print "<td width='60'> <a href='cumple1.php?idasesor=".$vec[0]."' target = '_blank'>ver</a></td>";
							  print"</tr>";		 																				

						$cnt ++;
					}
					
						
		}

		
 ?>
<style type="text/css">
<!--
.style2 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>

<body>
<form name="form1" action="" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="22%"><span class="style2">Seleccione el Mes</span> </td>
    <td width="78%"><label><select name="cboMesi" size="1" id="cboMesi" >
                          <?	
					  			$m = 0;
					   			for ($x=0; $x<=11; $x++)
								{
									$m++;
									if (date("n") == $m)
									{
										echo "<option value='$m' selected>$fecha[$x]</option>";
									}
									else
									{
					   					echo "<option value='$m'>$fecha[$x]</option>";
									}
								}					   	

					  ?>
                        </select></label></label>
                        <input type="submit" name="Submit" value="Visualizar" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label></label></td>
  </tr>
</table>
<hr />
<tr>	
       <td><table width="80%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="49" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="469" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Nombre</font></td>
<td width="176" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Nacimiento</font></span></td>
<td width="86" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Ver</font></span></td>
                          </tr>
                          <?

		   gentabla($cboMesi); ?>


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
