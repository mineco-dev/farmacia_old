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
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>

<link href="includes/cssWeb.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {font-size: 36px}
-->
</style>



  <?
	include("includes/inc_conexion.inc");
	

	if (!empty($centinel))
	{
		$update = "update tb_libros  set  codigo = '$codigo',tip_documento='$tip_documento',tema='$tema',titulo='$titulo',autor='$autor',lugar='$lugar',fecha_impresion= '$fecha_impresion',resumen = '$resumen',palabras_clave = '$palabras_clave',anaquel = '$anaquel',entrepano = '$entrepano',fecha_ingreso = '$fecha_ingreso',existencia=$existencia,estado = $estado where idrow = $centinel ";
		$res = mssql_query($update);	
	}

	
		$consulta = "select codigo,tip_documento,tema,titulo,autor,lugar,fecha_impresion,resumen,palabras_clave,anaquel,entrepano,fecha_ingreso,existencia,file1,estado,idrow from tb_libros where codigo = '$idrow'";	

		$resultado = mssql_query($consulta);	
		$row = mssql_fetch_row($resultado);



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
    <td><div align="right"><span class="GrayBasicFont">Ministerio de Economia </span></div></td>
  </tr>
  
  <tr>
    <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="4">
      <tr>
        <td class="blueFont"><div align="right">Estado</div></td>
        <td>&nbsp;</td>
        <td><select name="estado" id="estado">
			<?php 
				if ($row[14]==1)
				{
					print '<option value = "1" selected>No Aprobado</option><option value = "2">Aprobado</option>';
				}else{
					print '<option value = "1" >No Aprobado</option><option value = "2" selected >Aprobado</option>';
				}
			?>
		</select>&nbsp;<input type="hidden" name="centinel" id="centinel" value="<? print $row[15];?>"></td>
      </tr>
      <tr>
        <td width="209" class="blueFont"><div align="right">Codigo</div></td>
        <td width="15">&nbsp;</td>
        <td width="308"><input name="codigo" id="codigo" type="text" class="BasicFontInBorder4" value="<? print $row[0];?>" >&nbsp;</td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Tipo de Documento </div></td>
        <td>&nbsp;</td>
        <td><input name="tip_documento" type="text" class="BasicFontInBorder4" id="tip_documento" value="<? print $row[1];?>" ></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Tema</div></td>
        <td>&nbsp;</td>
        <td><input name="tema" type="text" class="BasicFontInBorder4" id="tema" size="50" maxlength="50" value = "<? print $row[2];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Titulo</div></td>
        <td>&nbsp;</td>
        <td><input name="titulo" type="text" class="BasicFontInBorder4" id="titulo" size="50" maxlength="50" value = "<? print $row[3];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Autor</div></td>
        <td>&nbsp;</td>
        <td><input name="autor" type="text" class="BasicFontInBorder4" id="autor" size="50" maxlength="50" value = "<? print $row[4];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Lugar Impresion </div></td>
        <td>&nbsp;</td>
        <td><input name="lugar" type="text" class="BasicFontInBorder4" id="lugar" size="50" maxlength="50" value ="<? print $row[5];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Fecha Impresion </div></td>
        <td>&nbsp;</td>
        <td><input name="fecha_impresion" type="text" class="BasicFontInBorder4" id="fecha_impresion" value = "<? print $row[6];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Resumen</div></td>
        <td>&nbsp;</td>
        <td><textarea name="resumen" cols="50" rows="4" class="BasicFontInBorder4" id="resumen"><? print $row[7];?></textarea></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Palabras Claves </div></td>
        <td>&nbsp;</td>
        <td><input name="palabras_clave" type="text" class="BasicFontInBorder4" id="palabras_clave" value= "<? print $row[8];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Anaquel </div></td>
        <td>&nbsp;</td>
        <td><input name="anaquel" type="text" class="BasicFontInBorder4" id="anaquel" size="12" maxlength="12" value= "<? print $row[9];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Entrepa&ntilde;o</div></td>
        <td>&nbsp;</td>
        <td><input name="entrepano" type="text" class="BasicFontInBorder4" id="entrepano" size="12" maxlength="12" value= "<? print $row[10];?>"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Existencia</div></td>
        <td>&nbsp;</td>
        <td><input name="existencia" type="text" class="BasicFontInBorder4" id="existencia" size="10" maxlength="10"value= "<? print $row[12];?>"></td>
      </tr>
      
      <tr>
        <td class="blueFont">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="blueFont">&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="boton_guardar" type="button" id="boton_guardar" class="TuringHelp" value="Actualizar" onClick="validar(this.form)" />
		
          <input name="submit2" type="reset" class="TuringHelp" value="Reset" /></td>
      </tr>
    </table></td>
  </tr>
  
  
  <tr>
    <td height="22">&nbsp;</td>
  </tr>
  <tr>
    <td height="22"><div align="center"></div></td>
  </tr>
</table>
</form>
<p>&nbsp; </p>
</body>
</html>
