<?	
$grupo_id=47;
include("../../restringir.php")
?>
<head>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
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


<p align="center">SINDICATO DE TRABAJADORES DEL MINISTERIO DE ECONOMIA -SITRAME-</p>
<form action="gcrear_publicacion.php" method="post" enctype="multipart/form-data"> 
    <table width="681" border="0">
      <tr class="detalletabla2">
        <td>Asunto</td>
        <td><input name="txt_claves" type="text" id="txt_claves" size="54" /></td>
      </tr>
      <tr>
        <td width="300" height="105" class="detalletabla1">Descripcion</td>
        <td width="527" class="detalletabla1"><textarea name="cadenatexto" cols="65" rows="10" id="cadenatexto"></textarea></td>
      </tr>
      <tr class="detalletabla1">
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
      <tr class="detalletabla1">
        <td>Tipo publicaci&oacute;n</td>
        <td><select name="cbo_tipo" size="1" id="cbo_tipo">
          <option  selected>Seleccione</option>
          <option value="3">Mensaje del Día</option>
          <option value="1">Información de Interés</option>
          <option value="2">Comunicado</option>
        </select></td>
      </tr>
      <tr class="detalletabla2">
       <td>Archivo:</td>
        <td><input name="userfile" type="file">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000"></td></tr>
  </table>
  <p>        <input type="button" value="Publicar" onClick="Validar(this.form)"> 
  </p>
</form> 
