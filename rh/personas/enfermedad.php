    


<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?



echo '<script>
var contLin60 = 1;
function agregar60() {

	var tr, td;

	tr = document.all.tabla60.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin60 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"enfermo["+contLin60+"]\" type=\"text\" id=\"textfield\" size=\"30\">";	
			
	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"doctor["+contLin60+"]\" cols=\"40\" rows=\"6\">";

	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"medicina["+contLin60+"]\" cols=\"20\" rows=\"6\">";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"estatusenfermedad["+contLin60+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";
	
			
	td = tr.insertCell();

	contLin60++;
}

function borrarUltima60() {
	ultima = document.all.tabla60.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla60.deleteRow(ultima);
	 contLin60--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla60">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="40" class="HelloUser" scope="col">Enfermedad</th>
    <th width="50" class="HelloUser" scope="col">Prescripcion Medica</th>    
    <th width="40" class="HelloUser" scope="col">Medicamentos</th>	
    <th width="50" class="HelloUser" scope="col">Enfermedad Presente</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar60()" value="Agregar Enfermedad">
<input type="button" class="ProgressWriting" onClick="borrarUltima60()" value="Borrar Enfermedad">
</body>
</html>