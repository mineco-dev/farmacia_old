    


<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?
function get_puestos()
{
	
$query = mssql_query("select id_puesto,puesto from puesto order by id_puesto");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

function get_depe()
{
	
$consulta = mssql_query("select iddireccion,nombre from direccion");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

$p = get_depe();
$o = get_puestos();
echo '<script>
var contLin50 = 1;
function agregar50() {
	var tr, td;

	tr = document.all.tabla50.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin50 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"empresaexp["+contLin50+"]\" id=\"select\">';
	echo $p;
	echo '</select>";		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"anioexpi["+contLin50+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesexpi["+contLin50+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diaexpi["+contLin50+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";
	
	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"sueldo["+contLin50+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"renglon["+contLin50+"]\" id=\"select\">';
	echo $renglon;
	echo '</select>";


	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"oficialcg["+contLin50+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";
	
	td = tr.insertCell();			
	tr = document.all.tabla50.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin50 +"";
	

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"puestoexp["+contLin50+"]\" id=\"select\">';
	echo $o;
	echo '</select>";

	
		
	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"anioexpf["+contLin50+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesexpf["+contLin50+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diaexpf["+contLin50+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";

	
	td = tr.insertCell();
	td.innerHTML = 	"<textarea name=\"partida["+contLin50+"]\" cols=\"40\" rows=\"6\">";

	


	
	td = tr.insertCell();	

	contLin50++;
}

function borrarUltima50() {
	ultima = document.all.tabla50.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla50.deleteRow(ultima);
	 document.all.tabla50.deleteRow(ultima-1);
	 contLin50--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla50">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="40" class="HelloUser" scope="col">Entidad</th>
    <th width="30" class="HelloUser" scope="col">año</th>
    <th width="30" class="HelloUser" scope="col">mes</th>
    <th width="30" class="HelloUser" scope="col">dia</th>
    <th width="35" class="HelloUser" scope="col">Puesto/Cargo</th>    
</tr>		
<tr>
    <th width="30" class="HelloUser" scope="col">Renglon</th>	
    <th width="30" class="HelloUser" scope="col">año</th>
    <th width="30" class="HelloUser" scope="col">mes</th>
    <th width="30" class="HelloUser" scope="col">dia</th>    
    <th width="30" class="HelloUser" scope="col"></th>    
    <th width="30" class="HelloUser" scope="col">Partida</th> 
    <th width="30" class="HelloUser" scope="col">Salario/Vigente</th>       
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar50()" value="Agregar Contratacion">
<input type="button" class="ProgressWriting" onClick="borrarUltima50()" value="Borrar Contratacion">
</body>
</html>