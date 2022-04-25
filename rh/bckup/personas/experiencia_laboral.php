    


<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
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
	td.innerHTML = 	"<select name=\"anioempi["+contLin40+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesempi["+contLin40+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diaempi["+contLin40+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"puestoemp["+contLin40+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"referenciaemp["+contLin40+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
		
	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"anioempf["+contLin40+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesempf["+contLin40+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diaempf["+contLin40+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";


	
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
    <th width="40" class="HelloUser" scope="col">Entidad</th>
    <th width="30" class="HelloUser" scope="col">año</th>
    <th width="30" class="HelloUser" scope="col">mes</th>
    <th width="30" class="HelloUser" scope="col">dia</th>
    <th width="35" class="HelloUser" scope="col">Puesto/Cargo</th>    
    <th width="30" class="HelloUser" scope="col">Referencia</th>	
    <th width="30" class="HelloUser" scope="col">año</th>
    <th width="30" class="HelloUser" scope="col">mes</th>
    <th width="30" class="HelloUser" scope="col">dia</th>    
    <th width="30" class="HelloUser" scope="col">Atribuciones</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar40()" value="Agregar ITEM">
<input type="button" class="ProgressWriting" onClick="borrarUltima40()" value="Borrar ITEM">
</body>
</html>