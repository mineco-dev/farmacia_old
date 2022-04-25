    


<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?



echo '<script>
var contLin70 = 1;
function agregar70() {

	var tr, td;

	tr = document.all.tabla70.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin70 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"alergia["+contLin70+"]\" type=\"text\" id=\"textfield\" size=\"30\">";	
			

	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"forma_aliviar["+contLin70+"]\" cols=\"30\" rows=\"4\">";

	
			
	td = tr.insertCell();

	contLin70++;
}

function borrarUltima70() {
	ultima = document.all.tabla70.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla70.deleteRow(ultima);
	 contLin70--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla70">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="50" class="HelloUser" scope="col">Alergia</th>
    <th width="80" class="HelloUser" scope="col">Forma de Aliviar</th>    
  </tr>
</table>
<br>

<input type="button" class="ProgressWriting" onClick="agregar70()" value="Agregar Alergia">
<input type="button" class="ProgressWriting" onClick="borrarUltima70()" value="Borrar Alergia">

</body>
</html>