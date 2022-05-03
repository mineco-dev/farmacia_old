<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
<!--
function validar(form)
{

		if (form.codigo.value == "")
	  { alert("Por favor ingrese El Codigo Correspondiente"); form.codigo.focus(); return; }

				if (confirm('Esta seguro de guardar estos datos?')){ 
			//  document.form.submit() 
				form.submit();
		
  		} 
	
	
	
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>

<link href="includes/cssWeb.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {font-size: 36px}
-->
</style>



  <?
	include("includes/inc_conexion.inc");
	
if (!empty($codigo2))
{

	$fecha_ingreso = date("Y-m-d H:i:s");

	
	
	$vector[1] = 	"tip_documento like '%$codigo%'";		
	$vector[2] =    "tema like '%$codigo%'";		
	$vector[3] =    "titulo like '%$codigo%'";
	$vector[4] = 	"autor like '%$codigo%'";
	$vector[5] = 	"lugar like '%$codigo%'";
	$vector[6] =	"fecha_impresion like '%$codigo%'";
	$vector[7] =	"resumen like '%$codigo%'";
	$vector[8] =	"palabras_clave like '%$codigo%'";
	
$consulta = "select codigo,titulo,autor,anaquel,entrepano,existencia,idrow,file1 from tb_libros where ";
		
$valor = 0;

for($i = 1;$i<9;$i++)
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
		
		$result = mssql_query($consulta);	

		
	}
	

  ?>

</head>

<body>



<p>

</p>
<p>&nbsp;</p>
<form name="form1" action="" method="post" enctype="multipart/form-data">
<table width="816" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="785"><span class="style2"><img src="img/23092006-142346.jpg" width="142" height="103" />Biblioteca Virtual </span></td>
  </tr>
  
  
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td><div align="right"><span class="GrayBasicFont">CONSULTAS</span></div></td>
  </tr>
  
  <tr>
    <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="4">
        <tr>
          <td colspan="3" class="MainWritingArea">Escriba el texto que desea buscar en el campo Criterio de Busqueda y luego Marque las opciones que desea incluir en la consulta.</td>
          </tr>
        <tr>
          <td class="blueFont">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="208" class="blueFont"><div align="right">Criterio de Busqueda </div></td>
          <td width="32">&nbsp;</td>
          <td width="519"><input name="codigo" type="text" class="BasicFontInBorder4" id="codigo" size="60" >
            <input name="codigo2" type="hidden" class="BasicFontInBorder4" id="codigo2" size="2" maxlength="2" value="1" />            &nbsp;</td>
        </tr>
        <tr>
          <td class="blueFont"><div align="right">Tipo de Operador
              <select name="menu" id="menu" >
                <option value="1">AND</option>
                <option value="2">OR</option>
              </select>
          </div></td>
          <td>&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        </tr>
        <tr>
          <td class="blueFont"><div align="right">Tipo de Documento </div></td>
          <td><label>
            <input name="checkbox[1]" type="checkbox" id="checkbox1" />
            </label></td>
          </tr>
        <tr>
          <td class="blueFont"><div align="right">Tema</div></td>
          <td><label>
            <input name="checkbox[2]" type="checkbox" id="checkbox2" />
            </label></td>
          </tr>
        <tr>
          <td class="blueFont"><div align="right">Titulo</div></td>
          <td><label>
            <input name="checkbox[3]" type="checkbox" id="checkbox3"  />
            </label></td>
          </tr>
        <tr>
          <td class="blueFont"><div align="right">Autor</div></td>
          <td><label>
            <input name="checkbox[4]" type="checkbox" id="checkbox4" />
            </label></td>
          </tr>
        <tr>
          <td class="blueFont"><div align="right">Lugar Impresion </div></td>
          <td><input name="checkbox[5]" type="checkbox" id="checkbox5"  /></td>
          </tr>
        <tr>
          <td class="blueFont"><div align="right">Fecha Impresion </div></td>
          <td><input name="checkbox[6]" type="checkbox" id="checkbox6"  /></td>
          </tr>
        <tr>
          <td class="blueFont"><div align="right">Resumen</div></td>
          <td><input name="checkbox[7]" type="checkbox" id="checkbox7"  /></td>
          </tr>
        <tr>
          <td class="blueFont"><div align="right">Palabras Claves </div></td>
          <td><input name="checkbox[8]" type="checkbox" id="checkbox8" /></td>
          </tr>
        
        <tr>
          <td class="blueFont">&nbsp;</td>
          <td>&nbsp;</td>
          <td><input name="boton_guardar" type="submit" id="boton_guardar" class="TuringHelp" value="Ejecutar Busqueda"  />
            <input name="submit2" type="reset" class="TuringHelp" value="Cancelar" /></td>
        </tr>
      </table></td></tr>
  
  
  <tr>
    <td height="22" class="BoldBasicFont">Resultados de la busqueda </td>
  </tr>
  <tr>
    <td height="22" class="BoldBasicFont">
	
	<table width="735" 
                        border="0" align="center" cellpadding="0" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                        <tbody>
                          <tr>
<td width="130" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Codigo </font></td>
<td width="172" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="Estilo7" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Titulo</font></span></td>
<td width="106" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Autor</font></span></td>
<td width="106" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Anaquel/Entrepa�o</font></td>
<td width="215" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Portada</font></span></td>
                          </tr>
                          <?

$space = "-";
		while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";							  
							  print"<TD width='130'><span class='style9'><font color='#335B96'><a href='form_visu.php?idrow=".$vec[0]."' target = '_blank'>$vec[0]</a></font></span></TD>";
							  print"<TD width='172'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='106'><span class='style9'><font color='#335B96'>$vec[2]</font></span></TD>";
							  print"<TD width='106' align='center'><span class='style9'>$vec[3]".$space."$vec[4]</span></TD>";

		  
		  if (!empty($vec[7]))
		  {
		  print"<TD width='215'><span class='style9'><a href='portadas/".$vec[7]."' target = '_blank'><img src='portadas/$vec[7]' width='73' height='89'/></a></span></TD>";
		  }else{		  
		  		print"<TD width='215'><span class='style9'></span></TD>";
		  }
							  print"</tr>";		 																				
						$cnt ++;
					}

		
	

?>
                          <tr>
                            <td width="130"></td>
                          </tr>
                        </tbody>
                      </table>	�</td>
  </tr>

	
	<?
	
	?>
</table>
</form>
<p>&nbsp; </p>
</body>
</html>
