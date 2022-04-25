<script>
var contLin = 1;
function agregar() {
	var tr, td;

	tr = document.all.tabla.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin +"";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"deudor["+contLin+"][0]\" type=\"text\" id=\"textfield\" size=\"75\" readonly=\"readonly\">";
	//<input type='text' name='nombre["+contLin+"]' size='10' >";

	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"deudor["+contLin+"][1]\" id=\"deudor["+contLin+"][1]\">";

	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onClick=\"buscar=window.open('../buscar/bpersonas.php?tipo=deudor&posi="+contLin+"','Buscar1','width=580,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;\">Buscar</a>";
	td = tr.insertCell();

	contLin++;
}

function borrarUltima() {
	ultima = document.all.tabla.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla.deleteRow(ultima);
	 contLin--;
	}
}
</script>
<table width="95%" border=0 cellspacing="0" id="tabla">
  <tr>
	<th width="65" scope="col">#</th>
    <th scope="col" width="501">Nombre</th>
    <th width="47" scope="col">&nbsp;</th>
    <th width="327" scope="col">&nbsp;</th>
  </tr>
</table>
<br>
<input type="button" value="Agregar deudor" onClick="agregar()">
<input type="button" value="Borrar deudor" onClick="borrarUltima()">
