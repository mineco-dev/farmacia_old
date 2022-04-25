 
<?
require('../includes/inc_header_sistema.inc');

	
function get_banco_opciones($dbms2)
{

	
	$query = mssql_query("select parentesco.id_parentesco,parentesco.parentesco from parentesco order by parentesco.id_parentesco");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

?>
<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?
$op = get_banco_opciones($dbms2);

echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"nombre_familiar["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"tipo_parentesco["+contLin4+"]\" id=\"select\">';
	echo $op;
	echo '</select>";';

	
	
	echo '		
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"telefonofam["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	td = tr.insertCell();

	contLin4++;
}

function borrarUltima4() {
	ultima = document.all.tabla4.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla4.deleteRow(ultima);
	 contLin4--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla4">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="190" class="HelloUser" scope="col">Nombre</th>
    <th width="140" class="HelloUser" scope="col"><div align="center">Tipo de Parentesco</div></th>
    <th width="179" class="HelloUser" scope="col">Telefono</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar4()" value="Agregar Familiar">
<input type="button" class="ProgressWriting" onClick="borrarUltima4()" value="Borrar Familiar">
</body>
</html>