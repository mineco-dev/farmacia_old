    


<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>





</head>
<body>


<table width="40%" border=0 cellspacing="0" id="tabla65">

  <tr>
    <th width="31" class="HelloUser" scope="col">(+)</th>
    <th width="179" class="HelloUser" scope="col">Salarios</th>
	<th width="60" class="HelloUser" scope="col">Valor</th>
  </tr>
</table>



<?

function get_bonos()
{
	
$consulta = mssql_query("select id_bonos,descripcion from tb_bonos order by id_bonos asc");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

$p = get_bonos();

echo '<script>
var contLin65 = 1;
function agregar65() {
	var tr, td;

	tr = document.all.tabla65.insertRow();
	td = tr.insertCell();
	td.innerHTML = "Salarios "+contLin65 +""		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"bono["+contLin65+"]\" id=\"select\">';
	echo $p;
	echo '</select>";		
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"cuentabono["+contLin65+"]\" type=\"hidden\" id=\"cuentabono\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"valorbono["+contLin65+"]\" type=\"text\" id=\"valorbono\">";

	

	contLin65++;
}

function borrarUltima65() {
	ultima = document.all.tabla65.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla65.deleteRow(ultima);	
	 contLin65--;
	}
}
</script>';
?>


<br>
<input type="button" class="ProgressWriting" onClick="agregar65()" value="Agregar Salario">
<input type="button" class="ProgressWriting" onClick="borrarUltima65()" value="Borrar Salario">




</body>
</html>