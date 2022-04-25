<html>
<!-->
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<!-->
<head>

<?


$anio = anio();
$mes = mes();
$dia = dia();

function periodo()
{
	$valor = $valor.'<option value = "1" >'.date("Y").' </option>';
	$valor = $valor.'<option value = "2" >'.date("Y-1").' </option>';
	
	return $valor;
}

$periodo = periodo();


echo '<script>
var contLin500 = 1;
function agregar500() {
	var tr, td;
	tr = document.all.tabla500.insertRow();
	
	td = tr.insertCell();
	td.innerHTML = contLin500 +"";
	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"vacdia["+contLin500+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"vacmes["+contLin500+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"vacanio["+contLin500+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"vacdia1["+contLin500+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"vacmes1["+contLin500+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"vacanio1["+contLin500+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";
	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"vacdiasp["+contLin500+"]\" type=\"text\" id=\"textfield\" size=\"5\">";
	
	
	td = tr.insertCell();
	contLin500++;
}

function borrarUltima500() {
	ultima = document.all.tabla500.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla500.deleteRow(ultima);
	 contLin500--;
	}
}
</script>';
?>
</head>
<body>
<table width="500" border=0 cellspacing="0" id="tabla500">
  <tr>
	<td width="5" height="24" class="HelloUser" scope="col"></td>
	<td colspan = "3" width="200" align="center" class="HelloUser" >Fecha de Egreso</td>
	<td colspan = "3" width="200" align="center" class="HelloUser" >Fecha de RE-Ingreso</td>
	<td width="60" class="HelloUser" scope="col">Dias Pendientes</td>
  </tr>
</table>
<br>

<input type="button" class="ProgressWriting" onClick="agregar500()" value="Agregar Vacacion">
<input type="button" class="ProgressWriting" onClick="borrarUltima500()" value="Del">

</body>
</html>