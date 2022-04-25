    

<?

?>
<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?



echo '<script>
var contLin20 = 1;
function agregar20() {
	var tr, td;

	tr = document.all.tabla20.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin20 +"";

	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"curso_cap["+contLin20+"]\" type=\"text\" id=\"textfield\" size=\"30\">";	
	


	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"lugar_cap["+contLin20+"]\" type=\"text\" id=\"textfield\" size=\"40\">";

	td = tr.insertCell();

	contLin20++;
}

function borrarUltima20() {
	ultima = document.all.tabla20.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla20.deleteRow(ultima);
	 contLin20--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla20">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="359" class="HelloUser" scope="col"><div align="center">Curso</div></th>
    <th width="179" class="HelloUser" scope="col">Lugar</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar20()" value="Agregar Curso">
<input type="button" class="ProgressWriting" onClick="borrarUltima20()" value="Borrar Curso">
</body>
</html>