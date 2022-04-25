<?	
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
session_register("ingresando_solicitud");
$_SESSION["ingresando_solicitud"]=true;
?><head>
<link href="..helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script LANGUAGE="JavaScript">
	function Validar(form)
	{
	  if (form.txt_titulo.value == "")
	  { 
		alert("Escriba el titulo que tendr� el v�nculo"); 
		form.txt_titulo.focus(); 
		return;
	  }
	  	  if (form.txt_vinculo.value == "")
	  { 
		alert("Escriba la p�gina hacia donde ser� el enlace"); 
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



<p align="center" class="cotizadortitulo"><BR> 
MODIFICACI&Oacute;N DEL V&Iacute;NCULO
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

<form action="geditar_link.php" method="post"> 
    <table width="90%" border="0" align="center">
      <tr>
        <td width="156" height="39" class="boxTitleBgLightBlue">Titulo del v&iacute;nculo</td>
        <td width="700" class="boxTitleBgStone"><input name="txt_titulo" type="text" id="txt_titulo" value="<? echo $descripcion; ?>" size="50"></td>
      </tr>
      <tr>
        <td class="boxTitleBgLightBlue">Vincular a la p&aacute;gina</td>
        <td class="boxTitleBgStone">http://          <input name="txt_vinculo" type="text" id="txt_vinculo" value="<? echo $vinculo; ?>" size="44"></td>
      </tr>
      <tr>
        <td><input name="button" type="button" onClick="Validar(this.form)" value="Actualizar"></td>
        <td><input name="txt_contenido" type="hidden" id="txt_contenido" value="<? echo $id; ?>">        </td>
      </tr>
  </table>
    <p>&nbsp;  </p>
</form> 
