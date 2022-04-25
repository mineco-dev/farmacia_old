<? 
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");	
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
	  if (form.titulo.value == "")
	  { alert("Escriba t�tulo");  	form.titulo.focus(); return;  }
	  if (form.descripcion.value == "")
	  { alert("Escriba Descripción");  	form.descripcion.focus(); return;  }
	  if (form.imagen.value == "")
	  { alert("Cargue una imagen");  	form.imagen.focus(); return;  }
	  
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
<? echo $nombre_grupo; ?>
<? echo $nombre_inciso; ?>
</p>

<p align="center">PUBLICACI&Oacute;N DE NOTAS OFICINA DE COMUNICACION SOCIAL</p>
<BR /><BR />
<form action="gnota.php" method="post" enctype="multipart/form-data" name="form" id="form">
<table width="653" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="221">T&iacute;tulo</td>
    <td width="425"><label>
      <input type="text" name="titulo" id="titulo" size="100" />
    </label></td>
  </tr>
  <tr>
    <td>Descripci&oacute;n</td>
    <td><label>
      <textarea name="descripcion" id="descripcion" cols="45" rows="5"></textarea>
    </label></td>
  </tr>
  <tr>
    <td>Imagen</td>
    <td><label>
      <input type="file" name="userfile" id="userfile" />
      <input type="hidden" name="MAX_FILE_SIZE" value="100000">
    </label></td>
  </tr>
  <tr>
    <td>Link</td>
    <td><label>
      <input type="text" name="imagenes" id="imagenes" />
    </label></td>
  </tr>
  <tr>
    <td>Link2</td>
    <td><label>
      <input type="text" name="comunicado" id="comunicado" />
    </label></td>
  </tr>
  <tr>
    <td>Fecha</td>
    <td><label>
      <input type="text" name="fecha" id="fecha" />
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
        <input type="button" value="Publicar" onClick="Validar(this.form)" />
</td>
    </tr>
</table>

</form>



