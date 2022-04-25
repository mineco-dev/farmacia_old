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
<p align="center">PUBLICACIONES Y ANUNCIOS</p>
<?	
	require_once('../connection/helpdesk.php');
	$consulta = "SELECT * FROM publicacion where codigo_archivo='$id'";
	$result=$query($consulta);
	while($row=$fetch_array($result))
	{
			$descripcion=$row["descripcion"];
			$claves=$row["palabras_clave"];
	}
?>

<form action="geditar_publicacion.php" method="post" enctype="multipart/form-data"> 
    <table width="397" border="0">
      <tr>
        <td width="92" height="105">Descripci&oacute;n:</td>
        <td width="289"><textarea name="cadenatexto" cols="50" rows="4" id="cadenatexto"><? echo $descripcion ?></textarea></td>
      </tr>
      <tr>
        <td>Palabras Clave: </td>
        <td><input name="txt_claves" type="text" id="txt_claves" value="<? echo $claves ?>" size="53"></td>
      </tr>
      <tr>
        <td>Archivo:</td>
        <td><input name="userfile" type="file">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        <input name="codigo_archivo" type="hidden" id="codigo_archivo" value="<? echo $id ?>"></td>
      </tr>
    </table>
    <p>        <input type="button" value="Actualizar publicaci&oacute;n" onClick="Validar(this.form)"> 
  </p>
</form> 
