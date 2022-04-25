<?
	
function get_registro_opciones($dbms2)
{
	$dbms2->sql="select 
					idtipomaterial,descripcion 
				from 
					tbl_tipomaterial
				where idtipomaterial not in(4,5)  
				order by descripcion"; 
	$dbms2->Query(); 
	while($Fields=$dbms2->MoveNext()) 
	{
		$opciones = $opciones."<option value=\"".$Fields["idtipomaterial"]."\">".$Fields["descripcion"]."</option>"; 
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
	td.innerHTML = 	"<input type=\"text\" name=\"cantidad["+contLin3+"]\" id=\"textField\" size=\"5\">";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"material["+contLin3+"]\">"+ op +"</select>";

	td = tr.insertCell();

	td.innerHTML = 	"<textarea name=\"descripcion["+contLin3+"]\" cols=\"40\" rows=\"2\">";


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
	<th width="34" scope="col">No.</th>
    <th width="126" scope="col"><div align="center">Cantidad</div></th>
    <th scope="col" width="136"><div align="left">Material</div></th>
    <th scope="col" width="184"><div align="left">Descripcion</div></th>
  </tr>
</table>
<div align="center"><br>
  <input type="button" value="Agregar material" onClick="agregar3()">
  <input type="button" value="Borrar material" onClick="borrarUltima3()">
</div>
</body>
</html>