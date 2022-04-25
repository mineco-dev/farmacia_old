<?
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;
	
/*function get_banco_opciones($dbms2)
{
	/*$query = "select id_parentesco,parentesco from parentesco order by id_parentesco";
	$dbms2->sql=$query;
	$dbms2->Query();
	$opciones = "";
	while($Fields=$dbms2->MoveNext())
	
	$query = mssql_query("select parentesco.id_parentesco,parentesco.parentesco from parentesco order by parentesco.id_parentesco");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}*/



?>  
<?
require('../includes/inc_header_sistema.inc');
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;
	
function get_banco_opciones($dbms2)
{
	/*$query = "select id_parentesco,parentesco from parentesco order by id_parentesco";
	$dbms2->sql=$query;
	$dbms2->Query();
	$opciones = "";
	while($Fields=$dbms2->MoveNext())*/
	
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
	echo '</select>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"aniofam["+contLin4+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesfam["+contLin4+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diafam["+contLin4+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";		
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"lugar_ocupacion["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

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
	<th width="31" scope="col">#</th>
    <th scope="col" width="179">Nombre</th>
    <th width="359" scope="col"><div align="center">Tipo de Parentesco</div></th>
    <th scope="col" width="40">año</th>
    <th scope="col" width="30">mes</th>
    <th scope="col" width="30">dia</th>
    <th scope="col" width="179">Escuela o Trabajo</th>
    <th scope="col" width="179">Telefono</th>
  </tr>
</table>
<br>
<input type="button" value="Agregar Familiar" onClick="agregar4()">
<input type="button" value="Borrar Familiar" onClick="borrarUltima4()">
</body>
</html>