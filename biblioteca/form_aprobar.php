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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

<link href="includes/cssWeb.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {font-size: 36px}
-->
</style>



  <?
	include("includes/inc_conexion.inc");
	


	$fecha_ingreso = date("Y-m-d H:i:s");

	$consulta = "select codigo,titulo,autor,anaquel,entrepano,existencia,idrow,file1 from tb_libros where estado = 1 ";
	$result = mssql_query($consulta);	



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
    <td><div align="right"><span class="GrayBasicFont">APROBAR PUBLICACION </span></div></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
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
