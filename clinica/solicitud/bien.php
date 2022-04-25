<?
require('includes/inc_header.inc');
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
	
function get_registro_opciones($dbms2)
{
	$dbms2->sql="select 
					id_dominio_registral,descripcion 
				from 
					tb_dominio_registral 
				order by descripcion"; 
	$dbms2->Query(); 
	$opciones = "<option value = 0>No</option>";
	while($Fields=$dbms2->MoveNext()) 
	{
		$opciones = $opciones."<option value=\"".$Fields["id_dominio_registral"]."\">".$Fields["descripcion"]."</option>"; 
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
	td.innerHTML = contLin3 +"<br><br><br><br><br><br><br>";

	td = tr.insertCell();
	td.innerHTML = 	"<a href=\"javascript:void(0)\" onClick=\"buscar=window.open('../buscar/bbienes.php?tipo=bien&posi="+contLin3+"','Buscar3'); return false;\">Buscar</a><br><br><br><br><br><br><br>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"bien["+contLin3+"][0]\" type=\"text\" id=\"textfield\" size=\"40\" readonly=\"readonly\"><br><br><br><br><br><br><br>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"descripcion["+contLin3+"]\" cols=\"40\" rows=\"6\">";

	td = tr.insertCell();
	td.innerHTML = 	" Este bien esta inscrito en otro registro <select name=\"otror["+contLin3+"]\">"+ op +"</select><br> Numero de Expediente : <br><input name=\"expediente["+contLin3+"]\" type=\"text\" id=\"textfield\" size=\"18\"><br><br><br><br><br>";

	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"bien["+contLin3+"][1]\" id=\"hiddenField\">";
	
	td = tr.insertCell();

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
<table width="100%" border=0 cellspacing="0" id="tabla3">
  <tr>
	<th width="40" scope="col">#</th>
    <th width="53" scope="col">&nbsp;</th>
    <th scope="col" width="278">Tipo Bien</th>
    <th scope="col" width="238">Descripcion</th>
    <th scope="col" width="321">Registro</th>
    <th width="16" scope="col">&nbsp;</th>
  </tr>
</table>
<br>
<input type="button" value="Agregar bien" onClick="agregar3()">
<input type="button" value="Borrar bien" onClick="borrarUltima3()">
</body>
</html>