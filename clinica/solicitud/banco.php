<?
require('includes/inc_header.inc');
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;
	
function get_banco_opciones($dbms2)
{
	$query = "select codigo_banco,nombre_banco from tb_banco order by nombre_banco";
	$dbms2->sql=$query;
	$dbms2->Query();
	$opciones = "";
	while($Fields=$dbms2->MoveNext())
	{
		$opciones = $opciones."<option value = ".$Fields["codigo_banco"]. ">".$Fields["nombre_banco"]."</option>";
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
	td.innerHTML = 	"<input name=\"boleta["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"banco["+contLin4+"]\" id=\"select\">';
	echo $op;
	echo '</select>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"valor["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

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
<table width="60%" border=0 cellspacing="0" id="tabla4">
  <tr>
	<th width="31" scope="col">#</th>
    <th scope="col" width="179">No. de Boleta</th>
    <th width="359" scope="col"><div align="center">Banco</div></th>
    <th scope="col" width="179">Valor</th>
  </tr>
</table>
<br>
<input type="button" value="Agregar boleta de pago" onClick="agregar4()">
<input type="button" value="Borrar boleta de pago" onClick="borrarUltima4()">
</body>
</html>