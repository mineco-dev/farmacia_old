<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
function validar(form)
{


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
	
	if (!empty($codigo))
	{
	
	$carpeta = "portadas";
	
		   $query="SELECT MAX(idrow) from tb_libros";
		   $result=mssql_query($query);
		   $row=mssql_fetch_array($result);
		   $codigo_archivo=$row[0]+1;

		$archi = "file1";
		$fichero_name = $HTTP_POST_FILES[$archi]['name']; 		
		if ($fichero_name!="")
		{
 		   $tipo_archivo = $HTTP_POST_FILES[$archi]['type']; 
		   $extension = split('[.]',$fichero_name);
		   $extension = $extension[sizeof($extension)-1];		
		   $tamano_archivo = $HTTP_POST_FILES[$archi]['size']; 		
		   		   		   
		   $nombre_archivo_def=$codigo_archivo.".".$extension;			   
		   if(move_uploaded_file($HTTP_POST_FILES[$archi]['tmp_name'], $carpeta."/".$nombre_archivo_def))
		   {}else{'Error el fichero no fue copiado correctamente';}			
	     }




	
	
	$fecha_ingreso = date("Y-m-d H:i:s");
	
		$consulta = "insert into tb_libros (codigo,tip_documento,tema,titulo,autor,lugar,fecha_impresion,resumen,palabras_clave,anaquel,entrepano,fecha_ingreso,existencia,file1,estado) values ('$codigo','$tip_documento','$tema','$titulo','$autor','$lugar','$fecha_impresion','$resumen','$palabras_clave','$anaquel','$entrepano','$fecha_ingreso',$existencia,'$nombre_archivo_def',1)";	

		mssql_query($consulta);	
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
    <td><div align="right"><span class="GrayBasicFont">INGRESO DE LIBROS  </span></div></td>
  </tr>
  
  <tr>
    <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="4">
      <tr>
        <td width="209" class="blueFont"><div align="right">Codigo</div></td>
        <td width="15">&nbsp;</td>
        <td width="308"><input name="codigo" id="codigo" type="text" class="BasicFontInBorder4" onKeyUp="javascript:this.value=this.value.toUpperCase();">&nbsp;</td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Tipo de Documento </div></td>
        <td>&nbsp;</td>
        <td><input name="tip_documento" type="text" class="BasicFontInBorder4" id="tip_documento" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Tema</div></td>
        <td>&nbsp;</td>
        <td><input name="tema" type="text" class="BasicFontInBorder4" id="tema" size="50" maxlength="50" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Titulo</div></td>
        <td>&nbsp;</td>
        <td><input name="titulo" type="text" class="BasicFontInBorder4" id="titulo" size="50" maxlength="50" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Autor</div></td>
        <td>&nbsp;</td>
        <td><input name="autor" type="text" class="BasicFontInBorder4" id="autor" size="50" maxlength="50" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Lugar Impresion </div></td>
        <td>&nbsp;</td>
        <td><input name="lugar" type="text" class="BasicFontInBorder4" id="lugar" size="50" maxlength="50" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Fecha Impresion </div></td>
        <td>&nbsp;</td>
        <td><input name="fecha_impresion" type="text" class="BasicFontInBorder4" id="fecha_impresion" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Resumen</div></td>
        <td>&nbsp;</td>
        <td><textarea name="resumen" cols="50" rows="4" class="BasicFontInBorder4" id="resumen" onKeyUp="javascript:this.value=this.value.toUpperCase();"></textarea></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Palabras Claves </div></td>
        <td>&nbsp;</td>
        <td><input name="palabras_clave" type="text" class="BasicFontInBorder4" id="palabras_clave" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Anaquel </div></td>
        <td>&nbsp;</td>
        <td><input name="anaquel" type="text" class="BasicFontInBorder4" id="anaquel" size="12" maxlength="12" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Entrepa&ntilde;o</div></td>
        <td>&nbsp;</td>
        <td><input name="entrepano" type="text" class="BasicFontInBorder4" id="entrepano" size="12" maxlength="12" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">No. Existencia</div></td>
        <td>&nbsp;</td>
        <td><input name="existencia" type="text" class="BasicFontInBorder4" id="existencia" size="10" maxlength="10"onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
      </tr>
      <tr>
        <td class="blueFont"><div align="right">Archivo de Portada </div></td>
        <td>&nbsp;</td>
        <td><label>
          <input name="file1" type="file" class="BasicFontInBorder4" id="file1" />
        </label></td>
      </tr>
      <tr>
        <td class="blueFont">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="blueFont">&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="boton_guardar" type="button" id="boton_guardar" class="TuringHelp" value="Enviar Datos" onClick="validar(this.form)" />
		
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
