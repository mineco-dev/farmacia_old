<?
	
	conectardb($presupuesto);
	session_unregister("egreso");
	session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>
<html>
<head>
<?
echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";	
			
	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onClick=\"buscar=window.open(\'../../buscar_empleado_dependencia/buscar.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><textarea name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"\" id=\"textfield\"  alt=\"CLIC PARA SELECCIONAR\" cols=\"70\" rows=\"2\" disabled>CLIC AQUI PARA SELECCIONAR EMPLEADO</textarea></a>";
		
	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"bien["+contLin4+"][1]\" id=\"hiddenField\">";
	
	td = tr.insertCell();
	contLin4++;
}

function borrarUltima4() {
	ultima = document.all.tabla4.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla4.deleteRow(ultima);
	 contLin4--;
	}
}
</script>';
?>
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
</head>
<body>
<table width="100%" border=1 cellspacing="0" id="tabla4">
  <tr>
    <th width="11" height="19" scope="col"><span class="Estilo2">#</span></th>
    <th scope="col"><div align="center" class="Estilo2">Nombre del empleado</div></th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Quitar">
</body>
</html>