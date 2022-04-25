<?
	
function get_registro_opciones($dbms2)
{
	$dbms2->sql="select 
					idtipocobro,nombre 
				from 
					tbl_tipocobro
				order by nombre"; 
	$dbms2->Query(); 
	while($Fields=$dbms2->MoveNext()) 
	{
		$opciones = $opciones."<option value=\"".$Fields["idtipocobro"]."\">".$Fields["nombre"]."</option>"; 
	}
	return $opciones;
}
?>
<html>
<head>
<script>
var contLin3 = 1;
function agregar3() {
	var tr, td;
	var op = '<? echo get_registro_opciones($dbms2); ?>';
	tr = document.all.tabla3.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin3 ;

	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"file\" name=\"userfile["+contLin3+"]\" id=\"a\" size=\"50\"/>";

	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"descripcion["+contLin3+"]\" cols=\"40\" rows=\"2\">";

	td = tr.insertCell();
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
    <td ><div align="center">Descripcion</div></td>
  </tr>
</table>
<div align="center"><br>
  <input type="button" value="Agregar documento" onClick="agregar3()">
  <input type="button" value="Borrar documento" onClick="borrarUltima3()">
</div>
</body>
</html>