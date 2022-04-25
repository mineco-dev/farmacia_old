<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
function validar(form)
{

		if (form.codigo.value == "")
	  { alert("Por favor ingrese El Codigo Correspondiente"); form.codigo.focus(); return; }

				if (confirm('Esta seguro de guardar estos datos?')){ 
			//  document.form.submit() 
				form.submit();
		
  		} 
	
	
	
}
</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

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

	
	/*$codigo = "codigo like '%$codigo%'"; 
	$tipo_documento = 	"tip_documento like '%$tip_documento%'";		
	$tema = "tema like '%$tema%'";		
	$titulo = "titulo like '%$titulo%'";
	$autor = 	"autor like '%$autor%'";
	$lugar = 	"lugar like '%$lugar%'";
	$fecha_impresion =	"fecha_impresion like '%$fecha_impresion%'";
	$resumen =	"resumen like '%$resumen%'";
	$palabras_clave =	"palabras_clave like '%$palabras_clave%'";
	$anaquel = 	"anaquel like '%$anaquel%'";
	$entrepano =	"entrepano like '%$entrepano%'";
	$existencia =	"existencia like '%$existencia%'";*/
	
	

	
//		$consulta = "select codigo,titulo,autor,anaquel,entrepano,existencia,idrow,file1 from tb_libros where resumen like '%$resumen%' or codigo like '%$codigo%' or tip_documento like '%$tip_documento' or tema like '%$tema%' or titulo like '%$titulo' or autor like '%$autor%' or lugar like '%$lugar%' or fecha_impresion like '%$fecha-impresion%' or palabras_clave like '%$palabras_clave%' or anaquel like '%$anaquel%' or entrepano like '%$entrepano%' or existencia like '%$existencia'";

		$consulta = "select codigo,titulo,autor,anaquel,entrepano,existencia,idrow,file1 from tb_libros where resumen like '%$resumen%'";
		

		
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
        <td width="209" class="blueFont"><div align="right">Codigo</div></td>
        <td width="15">&nbsp;</td>
        <td width="308"><input name="codigo" id="codigo" type="text" class="BasicFontInBorder4" >&nbsp;
          <input name="codigo2" type="hidden" class="BasicFontInBorder4" id="codigo2" size="2" maxlength="2" value="1"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Tipo de Documento </div></td>
        <td>&nbsp;</td>
        <td><input name="tip_documento" type="text" class="BasicFontInBorder4" id="tip_documento" ></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Tema</div></td>
        <td>&nbsp;</td>
        <td><input name="tema" type="text" class="BasicFontInBorder4" id="tema" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Titulo</div></td>
        <td>&nbsp;</td>
        <td><input name="titulo" type="text" class="BasicFontInBorder4" id="titulo" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Autor</div></td>
        <td>&nbsp;</td>
        <td><input name="autor" type="text" class="BasicFontInBorder4" id="autor" size="50" maxlength="50"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Lugar Impresion </div></td>
        <td>&nbsp;</td>
        <td><input name="lugar" type="text" class="BasicFontInBorder4" id="lugar" size="50" maxlength="50" ></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Fecha Impresion </div></td>
        <td>&nbsp;</td>
        <td><input name="fecha_impresion" type="text" class="BasicFontInBorder4" id="fecha_impresion"  ></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Resumen</div></td>
        <td>&nbsp;</td>
        <td><textarea name="resumen" cols="50" rows="4" class="BasicFontInBorder4" id="resumen"></textarea></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Palabras Claves </div></td>
        <td>&nbsp;</td>
        <td><input name="palabras_clave" type="text" class="BasicFontInBorder4" id="palabras_clave" ></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Anaquel </div></td>
        <td>&nbsp;</td>
        <td><input name="anaquel" type="text" class="BasicFontInBorder4" id="anaquel" size="12" maxlength="12"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Entrepa&ntilde;o</div></td>
        <td>&nbsp;</td>
        <td><input name="entrepano" type="text" class="BasicFontInBorder4" id="entrepano" size="12" maxlength="12"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Existencia</div></td>
        <td>&nbsp;</td>
        <td><input name="existencia" type="text" class="BasicFontInBorder4" id="existencia" size="10" maxlength="10" ></td>
      </tr>
      <tr>
        <td class="blueFont">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="blueFont">&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="boton_guardar" type="submit" id="boton_guardar" class="TuringHelp" value="Ejecutar Busqueda"  />
		
          <input name="submit2" type="reset" class="TuringHelp" value="Cancelar" /></td>
      </tr>
    </table></td>
  </tr>
  
  
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
