<?	
$grupo_id=4;
include("../restringir.php");	
?><head>
	<script LANGUAGE="JavaScript">
	function Validar(form)
	{
	  if (form.cadenatexto.value == "")
	  { 
		alert("Escriba una breve descripción"); 
		form.cadenatexto.focus(); 
		return;
	  }
	  form.submit();
	}
	function Refrescar(form)
	{
		form.reset();
		form.cadenatexto.focus(); 
	}
	</script>
</head>

<p align="center">	NOTICIAS</p>
<form action="gcrear_publicacion.php" method="post" enctype="multipart/form-data"> 
    <table width="584" border="0">
      <tr>
        <td height="34">Titulo</td>
        <td><input name="txt_titulo" type="text" id="txt_titulo2" size="54" /></td>
      </tr>
      <tr>
        <td width="144" height="105">Descripci&oacute;n:</td>
        <td width="430"><textarea name="cadenatexto" cols="50" rows="4" id="cadenatexto"></textarea></td>
      </tr>
      
      <tr>
        <td>D&iacute;as de vigencia?</td>
        <td><select name="cbo_vigencia" size="1" id="cbo_vigencia">
          <option value="700" selected>NO CADUCA</option>
          <option value="1">1 DIA</option>
          <option value="2">2 DIAS</option>
          <option value="3">3 DIAS</option>
          <option value="4">4 DIAS</option>
          <option value="5">5 DIAS</option>
          <option value="10">10 DIAS</option>
          <option value="15">15 DIAS</option>
          <option value="20">20 DIAS</option>
          <option value="25">25 DIAS</option>
          <option value="30">30 DIAS</option>
        </select></td>
      </tr>
      <tr>
        <td>Imagen</td>
        <td><input name="userfile" type="file" />
          <input type="hidden" name="MAX_FILE_SIZE2" value="100000" /></td>
      </tr>
      <tr>
        <td>Archivo:</td>
        <td><input type="hidden" name="MAX_FILE_SIZE" value="100000"></td>
      </tr>
    </table>
  <p>        <input type="button" value="Publicar" onClick="Validar(this.form)"> 
  </p>
</form> 
