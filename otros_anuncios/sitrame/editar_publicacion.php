<?	
$grupo_id=47;
include("../../restringir.php");	
?><head>
	<link href="../helpdesk.css" rel="stylesheet" type="text/css">
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
<p align="left">PUBLICACIONES SITRAME</p>
<?	
	require_once('../../connection/helpdesk.php');
	$consulta = "SELECT * FROM publicacion where codigo_archivo='$id'";
	$result=$query($consulta);
	while($row=$fetch_array($result))
	{
			$descripcion=$row["descripcion"];
			$claves=$row["palabras_clave"];
			$vigencia=$row["vigencia"];
			$archivo_ant=$row["nombre_archivo"];
	}
?>

<form action="geditar_publicacion.php" method="post" enctype="multipart/form-data"> 
    <table width="594" border="0">
      <tr class="detalletabla1">
        <td width="192" height="105">Descripci&oacute;n:</td>
        <td width="392"><textarea name="cadenatexto" cols="50" rows="4" id="cadenatexto"><? echo $descripcion ?></textarea></td>
      </tr>
      <tr class="detalletabla2">
        <td>Palabras Clave: </td>
        <td><input name="txt_claves" type="text" id="txt_claves" value="<? echo $claves ?>" size="53"></td>
      </tr>
      <tr class="detalletabla1">
        <td>Caduca:</td>
        <td><? echo $vigencia ?></td>
      </tr>
      <tr class="detalletabla2">
        <td>Agregar d&iacute;as de vigencia?</td>
        <td><select name="cbo_vigencia" size="1" id="cbo_vigencia">
          <option value="0" selected>NO</option>
          <option value="700">NO CADUCA</option>
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
      <tr class="detalletabla2">
        <td>Archivo:</td>
        <td><input name="userfile" type="file">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        <input name="codigo_archivo" type="hidden" id="codigo_archivo" value="<? echo $id ?>">
        <input name="txt_archivo_ant" type="hidden" id="txt_archivo_ant" value="<? echo $archivo_ant ?>"></td>
      </tr>
    </table>
  <p>        <input type="button" value="Actualizar publicaci&oacute;n" onClick="Validar(this.form)"> 
  </p>
</form> 
