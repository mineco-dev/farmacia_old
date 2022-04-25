<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?
echo '<script>
var contLin21 = 1;
function agregar2850() {
	var tr, td;

	tr = document.all.tabla21.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin21 +"";

	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"codigo_cole["+contLin21+"]\" type=\"text\" id=\"textfield\" size=\"30\">";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"nombre_cole["+contLin21+"]\" type=\"text\" id=\"textfield\" size=\"40\">";

	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"aniovence["+contLin21+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesvence["+contLin21+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diavence["+contLin21+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";

	
	

	contLin21++;
}

function borrarUltima2850() {
	ultima = document.all.tabla21.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla21.deleteRow(ultima);
	 contLin21--;
	}
}
</script>';
?>

<table width="74%" border="0" id="tabla21">
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th colspan="3" class="HelloUser" scope="col"><div align="center">Fecha de vencimineto </div></th>
  </tr>
  <tr>
    <th width="31" class="HelloUser" scope="col"><span class="HelloUser">#</span></th>
    <th  width="40" class="HelloUser" scope="col"><div align="center">Codigo Colegiado </div></th>
    <th  width="40" class="HelloUser" scope="col"><div align="center">Nombre de Colegio </div></th>
    <th width="40"  class="HelloUser" scope="col"><div align="center">A&ntilde;o </div></th>
    <th width="30"  class="HelloUser" scope="col"><div align="center">mes</div></th>
    <th width="30" class="HelloUser" scope="col"><div align="center">dia</div></th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar2850()" value="Agregar Colegiado">
<input type="button" class="ProgressWriting" onClick="borrarUltima2850()" value="Borrar Colegiado">
<p>&nbsp;</p>
<p>&nbsp;</p>
