<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
	include('../../../../includes/sqlcommand.inc');
	include('../../../../includes/funciones.php');
	conectardb($rrhh);
	
	
	
	function genemple($iddireccion)
{	
		
	//se agrego and activo =1 que desplieguen quienes estan activos
							
		$qry_cumple ="select idasesor,nombre+' '+nombre2+' '+nombre3+' '+apellido+' '+apellido2,fecha_nacimiento,apellido,sexo,gafete from asesor where iddireccion=$iddireccion and activo=1 order by day(fecha_nacimiento)";
		$result = mssql_query($qry_cumple);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<TD width='400'><span class='style9'>$vec[1]</span></TD>";
							  print"<TD width='120'><span class='style9'>$vec[2]</span></TD>";							
							  print "<td width='120'> <a href='../../../personas/cpersona.php?num_gafete=".$vec[5]."&busca=1' >ver</a></td>";
							  print"</tr>";		 																				

						$cnt ++;
					}
					
						
		}

	
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<table width="80%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
              <tr>
                <td width="737" height="49" colspan="3"><div align="center">
                    <div align="center">
                      <table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="282" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Nombre</font></td>
<td width="363" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha Nacimiento</font></span></td>
<td width="86" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Ver</font></span></td>
                          </tr>
                          <?

		   genemple($iddireccion); ?>


                          <tr>
                            <td width="282"></td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                 
                </div></td>
              </tr>
            </table>
</body>
</html>
