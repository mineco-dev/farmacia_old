<?	
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
session_register("ingresando_solicitud");
$_SESSION["ingresando_solicitud"]=true;
?><head>
	<script LANGUAGE="JavaScript">
	function Validar(form)
	{
	  if (form.descripcion.value == "")
	  { 
		alert("Escriba una breve descripción"); 
		form.descripcion.focus(); 
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
<p align="center">EDITAR NOTAS</p>
<?	
	conectardb($comunicacion);	
	$consulta = "SELECT * FROM comsocial_notas where id_noticia='10'";
	$result=$query($consulta);
	while($row=$fetch_array($result))
	{
			$titulo=$row["titulo"];
			$descripcion=$row["descripcion"];
			$fecha=$row["fecha"];
			$link1=$row["link1"];
			$link2=$row["link2"];
	}
?>

<form action="geditar_nota.php" method="post" enctype="multipart/form-data"> 
    <table width="397" border="0">
      <tr>
        <td width="92" height="24">Título</td>
        <td width="289">
          <input type="text" name="titulo" id="titulo" size="120" value="<? echo $titulo ?>" />
        </td>
      </tr>
      <tr>
        <td>Descripción </td>
        <td>
          <textarea name="descripcion" id="descripcion" cols="45" rows="5"  ></textarea>
        </td>
      </tr>
      <tr>
        <td>Fecha</td>
        <td>
          <input type="text" name="fecha" id="fecha" value=" <? echo $fecha ?>" />
        </td>
      </tr>
      <tr>
        <td>Link 1</td>
        <td>
          <input type="text" name="comunicado" id="comunicado" size="100" value=" <? echo $link1 ?>" />
        </td>
      </tr>
      <tr>
        <td>Link2</td>
        <td>
          <input type="text" name="imagenes" id="imagenes" size="100"  value="<? echo $link2 ?>" />
        </td>
      </tr>
      <tr>
        <td>Archivo:</td>
        <td><input name="userfile" type="file">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        <input name="codigo_archivo" type="hidden" id="codigo_archivo" value="<? echo '$id=10' ?>"></td>
      </tr>
    </table>
  <p>        <input type="button" value="Actualizar publicaci&oacute;n" onClick="Validar(this.form)"> 
  </p>
</form> 
