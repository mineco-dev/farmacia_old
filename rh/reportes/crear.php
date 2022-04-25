<?	
$grupo_id=4;
include("../restringir.php");	
?><head>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
	<script LANGUAGE="JavaScript">
	function Validar(form)
	{
	  if (form.userfile.value == "")
	  { 
		alert("Clic en Examinar, para seleccionar el archivo"); 
		form.userfile.focus(); 
		return;
	  }
	  form.submit();
	}
	function Refrescar(form)
	{
		form.reset();
		form.userfile.focus(); 
	}
	</script>
</head>


<p align="left">PUBLICACI&Oacute;N DE INFORME</p>
<form action="gcrear.php" method="post" enctype="multipart/form-data"> 
    <table width="681" border="0">
      <tr>
        <td width="144" height="105" class="detalletabla1">Consultor:</td>
        <td width="527" class="detalletabla1"><textarea name="cadenatexto" cols="50" rows="4" id="cadenatexto" disabled><? echo $_REQUEST["consultor"]; ?></textarea></td>
      </tr>
      <tr class="detalletabla2">
        <td>Informe:</td>
        <td><input name="userfile" type="file">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">(PDF)
        <input type="hidden" name="idasesor" value="<? echo $_REQUEST["id"];  ?>"></td>
      </tr>
  </table>
  <p>        <input type="button" value="Publicar" onClick="Validar(this.form)"> 
  </p>
</form> 
