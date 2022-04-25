    


<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>





</head>
<body>


<table width="40%" border=0 cellspacing="0" id="tabla99">
  <tr>
    <th width="31" class="HelloUser" scope="col">#</th>
    <th width="179" class="HelloUser" scope="col">Requisito</th>
    <th width="60" class="HelloUser" scope="col">A&ntilde;o</th>
    <th width="60" class="HelloUser" scope="col">Mes</th>
    <th width="60" class="HelloUser" scope="col">Dia</th>
    <th width="60" class="HelloUser" scope="col">Observacion</th>
    <th width="60" class="HelloUser" scope="col">Archivo</th>
  </tr>
</table>



<?

function get_tipo_observacion()
{
	
$consulta = mssql_query("select codigo_observacion,observacion from tb_observacion order by codigo_observacion asc");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

$p = get_tipo_observacion();

echo '<script>
var contLin99 = 1;
function agregar99() {
	var tr, td;

	tr = document.all.tabla99.insertRow();
	td = tr.insertCell();
	td.innerHTML = "R"+contLin99 +""		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"txtcodigoobservacion["+contLin99+"]\" id=\"select\">';
	echo $p;
	echo '</select>";		
	


	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"anioobservacion["+contLin99+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";


	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"meseobservacion["+contLin99+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";


	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diaobservacion["+contLin99+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"txtobservacion["+contLin99+"]\" cols=\"20\" rows=\"3\">";



	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"adjunto"+contLin99+"\" type=\"file\" id=\"adjunto\">";


	contLin99++;
}

function borrarUltima99() {
	ultima = document.all.tabla99.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla99.deleteRow(ultima);	
	 contLin99--;
	}
}
</script>';
?>


<br>
<input type="button" class="ProgressWriting" onClick="agregar99()" value="Agregar Observacion">
<input type="button" class="ProgressWriting" onClick="borrarUltima99()" value="Borrar Observacion">




</body>
</html>