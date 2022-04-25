<?	
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
session_register("ingresando_solicitud");
$_SESSION["ingresando_solicitud"]=true;
?>
<head>
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
	  	  if (form.userfile.value == "")
	  { 
		alert("seleccione el archivo PDF correspondiente"); 
		form.userfile.focus(); 
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
  NUEVO ARCHIVO 
  <?
conectardb($uipadmin);
$consulta1="select * from uip_grupo where codigo_grupo='$group'";
$resultado=$query($consulta1);
while ($filagrupo=$fetch_array($resultado))
{
$nombre_grupo=$filagrupo["nombre_grupo"];
}
$free_result($resultado);

$consulta1="select * from uip_inciso where codigo_inciso='$item' and codigo_grupo='$group'";
$resultado=$query($consulta1);
while ($filagrupo=$fetch_array($resultado))
{
	$nombre_inciso=$filagrupo["titulo"];
}
$free_result($resultado);
?>
</p>
<form action="gagregar_archivo.php" method="post" enctype="multipart/form-data"> 
    <table width="90%" border="0" align="center">
      <tr>
        <td height="21" class="boxTitleBgLightBlue">Grupo:</td>
        <td class="boxTitleBgStone"><? echo $nombre_grupo; ?>&nbsp;</td>
      </tr>
      <tr>
        <td height="26" class="boxTitleBgLightBlue">Inciso:</td>
        <td class="boxTitleBgStone"><? echo $nombre_inciso; ?>&nbsp;</td>
      </tr>
      <tr>
        <td width="78" height="36" class="boxTitleBgLightBlue">Titulo</td>
        <td width="793" class="boxTitleBgStone"><input name="txt_titulo" type="text" id="txt_titulo" value="" size="54"></td>
      </tr>
      <tr>
        <td class="boxTitleBgLightBlue">Archivo</td>
        <td class="boxTitleBgStone"><input name="userfile" type="file">
          <input type="hidden" name="MAX_FILE_SIZE" value="100000">
          <input name="txt_grupo" type="hidden" id="txt_grupo" value="<? echo $group; ?>">
          <input name="txt_inciso" type="hidden" id="txt_inciso" value="<? echo $item; ?>"></td>
      </tr>
      <tr>
        <td><input name="button" type="button" onClick="Validar(this.form)" value="Publicar"></td>
        <td>&nbsp;</td>
      </tr>
  </table>
    <p>&nbsp;  </p>
</form> 
