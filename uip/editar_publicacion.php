<?	
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
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
	  
	  if (form.chk_link.value == "on" && form.txt_vinculo="")
	  { 
		alert("Hacia que página es el vinculo: ejemplo: http://www.google.com"); 
		form.txt_vinculo.focus(); 
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
<p align="center">INFORMACION PUBLICA DE OFICIO</p>
<?	
	conectardb($uipadmin);	
	$consulta = "SELECT * FROM uip_contenido where codigo_contenido='$id'";
	$result=$query($consulta);
	while($row=$fetch_array($result))
	{
			$tipo=$row["tipo"];
			$descripcion=$row["titulo"];
			$vinculo=$row["vinculo"];
	}
?>

<form action="geditar_publicacion.php" method="post" enctype="multipart/form-data"> 
    <table width="761" border="0">
      <tr>
        <td width="75" height="105">Descripci&oacute;n:</td>
        <td width="676"><textarea name="cadenatexto" cols="50" rows="4" id="cadenatexto"><? echo $descripcion ?></textarea></td>
      </tr>
      <tr>
        <td>Link?</td>
        <td>
		<? if ($tipo==1)
			echo '<input name="chk_link" type="checkbox" id="chk_link" checked>';
			else				
			echo '<input name="chk_link" type="checkbox" id="chk_link">';
		?>		
          Hacia donde? 
          <input name="txt_vinculo" type="text" id="txt_vinculo" value="<? echo $vinculo ?>" size="47"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
