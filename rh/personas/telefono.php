<?
/*require('../includes/inc_header.inc');
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;*/
?>
<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?
function get_dependencias()
{
	
$query = mssql_query("select iddireccion,nombre from direccion order by iddireccion");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}

$o = get_dependencias();




echo '<script>
var contLin7 = 1;
function agregar7() {
	var tr, td;
	tr = document.all.tabla7.insertRow();
	
	td = tr.insertCell();
	td.innerHTML = contLin7 +"";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"telefono["+contLin7+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"extensiont["+contLin7+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"oficialt["+contLin7+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"iddireccion["+contLin7+"]\" id=\"select\">';
	echo $o;
	echo '</select>";
	
	
	td = tr.insertCell();
	contLin7++;
}

function borrarUltima7() {
	ultima = document.all.tabla7.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla7.deleteRow(ultima);
	 contLin7--;
	}
}
</script>';
?>
</head>
<body>
<table width="40%" border=0 cellspacing="0" id="tabla7">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="179" class="HelloUser" scope="col">No. de Telefono</th>
	<th width="60" class="HelloUser" scope="col">Extension</th>
	<th width="60" class="HelloUser" scope="col">Oficial</th>
	<th width="200" class="HelloUser" scope="col">Ubicacion</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar7()" value="Agregar  Telefono">
<input type="button" class="ProgressWriting" onClick="borrarUltima7()" value="Borrar  Telefono">
</body>
</html>