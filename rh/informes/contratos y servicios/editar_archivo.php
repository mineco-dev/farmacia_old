<?	
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
session_register("ingresando_solicitud");
$_SESSION["ingresando_solicitud"]=true;
?><head>
<style type="text/css">
body {
	background-image: url(../imagen/Theme_Marcos/marco11.gif);
}
</style>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script LANGUAGE="JavaScript">
	function Validar(form)
	{
	  if (form.txt_titulo.value == "")
	  { 
		alert("Escriba una breve descripción"); 
		form.txt_titulo.focus(); 
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




<p align="center" class="cotizadortitulo"><BR>
  MODIFICAR ARCHIVO 
  <?
conectardb($uipadmin);
$consulta1="select * from uip_grupo where codigo_grupo='$group'";
$resultado=$query($consulta1);
while ($filagrupo=$fetch_array($resultado))
{
$nombre_grupo=$filagrupo["nombre_grupo"];
}
$free_result($resultado);

$consulta1="select * from uip_inciso where codigo_inciso='$item'";
$resultado=$query($consulta1);
while ($filagrupo=$fetch_array($resultado))
{
	$nombre_inciso=$filagrupo["titulo"];
}
$free_result($resultado);
?>
<?		
	$consulta = "SELECT * FROM uip_contenido where codigo_contenido='$id'";
	$result=$query($consulta);
	while($row=$fetch_array($result))
	{
			$tipo=$row["tipo"];
			$descripcion=$row["titulo"];
			$vinculo=$row["vinculo"];
	}
?>
</p>
<form action="geditar_archivo.php" method="post" enctype="multipart/form-data"> 
    <table width="90%" border="0" align="center">
      <tr>
        <td width="78" height="36" class="boxTitleBgLightBlue">Titulo</td>
        <td width="793" class="boxTitleBgStone"><input name="txt_titulo" type="text" id="txt_titulo" value="<? echo $descripcion; ?>" size="54"></td>
      </tr>
      <tr>
        <td class="boxTitleBgLightBlue">Archivo</td>
        <td class="boxTitleBgStone"><input name="userfile" type="file">
          (sino agrega un archivo, se conservar&aacute; el anterior)
          <input type="hidden" name="MAX_FILE_SIZE" value="100000">
          <input name="txt_contenido" type="hidden" id="txt_contenido" value="<? echo $id; ?>">
          <input name="txt_archivo_ant" type="hidden" id="txt_archivo_ant" value="<? echo $vinculo; ?>"></td>
      </tr>
      <tr>
        <td><input name="button" type="button" onClick="Validar(this.form)" value="Actualizar"></td>
        <td>&nbsp;</td>
      </tr>
  </table>
    <p>&nbsp;  </p>
</form> 
