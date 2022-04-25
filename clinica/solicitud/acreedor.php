<html>
<head>
<script>
var contLin2 = 1;
function agregar2() {
	var tr, td;

	tr = document.all.tabla2.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin2 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"acreedor["+contLin2+"][0]\" type=\"text\" id=\"textfield\" size=\"75\" readonly=\"readonly\">";
	//<input type='text' name='nombre["+contLin+"]' size='10' >";

	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"acreedor["+contLin2+"][1]\" id=\"hiddenField\">";

	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onClick=\"buscar=window.open('../buscar/bpersonas.php?tipo=acreedor&posi="+contLin2+"','Buscar2','width=580,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;\">Buscar</a>";
	td = tr.insertCell();

	contLin2++;
}

function borrarUltima2() {
	ultima = document.all.tabla2.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla2.deleteRow(ultima);
	 contLin2--;
	}
}
</script>
</head>
<body>
<table width="100%" border=0 cellspacing="0" id="tabla2">
  <tr>
	<th width="65" scope="col">#</th>
    <th scope="col" width="501">Nombre</th>
    <th width="47" scope="col">&nbsp;</th>
    <th width="327" scope="col">&nbsp;</th>
  </tr>
</table>
<br>
<input type="button" value="Agregar acreedor" onClick="agregar2()">
<input type="button" value="Borrar acreedor" onClick="borrarUltima2()">
</body>
</html>