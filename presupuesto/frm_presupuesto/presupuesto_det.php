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
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onDblClick=\"buscar=window.open(\'../frm_buscar_renglon/buscar.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=700,height=500,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"\" id=\"textfield\"  alt=\"Doble clic para consultar el catalogo\" size=\"10\"></a>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"justificacion["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"40\" maxsize=\"100\">";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes1["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes2["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes3["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"mes4["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
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
    <th width="78" scope="col"><span class="Estilo2">Rengl&oacute;n</span></th>
    <th width="700" scope="col"><div align="center" class="Estilo2">Justificaci&oacute;n </div></th>
    <th width="71" scope="col"><span class="Estilo2">Monto Mes 1</span></th>
    <th width="69" scope="col"><span class="Estilo2">Monto Mes 2 </span></th>
    <th width="69" scope="col"><span class="Estilo2">Monto Mes 3 </span></th>
    <th width="75" scope="col"><span class="Estilo2">Monto Mes 4 </span></th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">
</body>
</html>