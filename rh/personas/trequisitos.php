    


<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>





</head>
<body>


<table width="40%" border=0 cellspacing="0" id="tabla51">
<tr>
	<th width="31" class="HelloUser" scope="col"></th>
    <th width="179" class="HelloUser" scope="col"></th>
    <th width="60" class="HelloUser" scope="col"></th>
    
  <tr>
    <th width="31" class="HelloUser" scope="col">#</th>
    <th width="179" class="HelloUser" scope="col">Requisito</th>

    <th width="60" class="HelloUser" scope="col">Archivo</th>
  </tr>
</table>



<?

function get_requisitos()
{
	
$consulta = mssql_query("select codigo_requisito,requisito,unico from tb_requisito order by requisito asc");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

$p = get_requisitos();

echo '<script>
var contLin51 = 1;
function agregar51() {
	var tr, td;

	tr = document.all.tabla51.insertRow();
	td = tr.insertCell();
	td.innerHTML = "R"+contLin51 +""		
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"requisito["+contLin51+"]\" id=\"select\">';
	echo $p;
	echo '</select>";		
	


	

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"fichero"+contLin51+"\" type=\"file\" id=\"fichero\">";


	contLin51++;
}

function borrarUltima51() {
	ultima = document.all.tabla51.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla51.deleteRow(ultima);	
	 contLin51--;
	}
}
</script>';
?>


<br>
<input type="button" class="ProgressWriting" onClick="agregar51()" value="Agregar Requisito">
<input type="button" class="ProgressWriting" onClick="borrarUltima51()" value="Borrar Requisito">




</body>
</html>