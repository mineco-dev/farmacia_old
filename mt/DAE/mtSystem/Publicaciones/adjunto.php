<html>
<head>
<script>
var contLin3 = 1;
function agregar3() {
	var tr, td;
	tr = document.all.tabla3.insertRow(-1);
	td = tr.insertCell(-1);
	td.innerHTML = contLin3 ;

	td = tr.insertCell(-1);
	td.innerHTML = 	"<input type=\"file\" name=\"userfile["+contLin3+"]\" id=\"a\" size=\"30\"/>";

	td = tr.insertCell(-1);
	td.innerHTML = 	"<input type=\"hidden\" name=\"MAX_FILE_SIZE"+contLin3+"\" value=\"9000000\"";

	contLin3++;
}

function borrarUltima3() {
	ultima = document.all.tabla3.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla3.deleteRow(ultima);
	 contLin3--;
	}
}
</script>
</head>
<body>
<table width="60%" border=0 align="center" cellspacing="0" id="tabla3">
  <tr>
	<td width="34" scope="col">No.</td>
    <td ><div align="center">Archivo</div></td>
  </tr>
</table>
<div align="center"><br>
  <input type="button" value="Agregar documento" onClick="agregar3()">
  <input type="button" value="Borrar documento" onClick="borrarUltima3()">
</div>
</body>
</html>