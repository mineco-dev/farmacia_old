
<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<script>

</script>
<?
echo '<script>
var contLin40 = 1;
function agregar40() {
	var tr, td;

	tr = document.all.tabla40.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin40 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"empresae["+contLin40+"]\" type=\"text\" id=\"textfield\" size=\"20\">";	
		
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"puestoemp["+contLin40+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	
		

	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"atribucionesemp["+contLin40+"]\" cols=\"20\" rows=\"6\">";

	td = tr.insertCell();

	contLin40++;
}

function borrarUltima40() {
	ultima = document.all.tabla40.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla40.deleteRow(ultima);
	 contLin40--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla40">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="50" class="HelloUser" scope="col">Entidad</th>
    <th width="35" class="HelloUser" scope="col">Puesto</th>    
    <th width="30" class="HelloUser" scope="col">Observaci&oacute;nes</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar40()" value="Agregar ITEM">
<input type="button" class="ProgressWriting" onClick="borrarUltima40()" value="Borrar ITEM">
</body>
</html>