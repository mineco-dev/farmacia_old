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


function get_oficial($ofi)
{

		
	if ($ofi == 1)
	{
		$opciones = "<option selected value = 1>SI</option><option value = 2>NO </option>";
	}else{
		$opciones = "<option value = 1>SI</option><option selected value = 2>NO </option>";
	}
	
	return $opciones;
}



function get_ubicacion($direc)
{
	
$query = mssql_query("select iddireccion,nombre from direccion order by iddireccion");																									
	if ($query)
		{

			while($row = mssql_fetch_row($query))	
			{
				if ($row[0] == $direc)
				{
					$opciones = $opciones."<option selected value = ".$row[0]. ">".$row[1]."</option>";
				}else{
					$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
				}
			}
			
	}
	return $opciones;
}





$query = mssql_query("select id_telefono,telefono,oficial,extensiont,iddireccion,id_tipo_telefono 
from tb_telefono where idasesor = '$codpersona'");

while($veta = mssql_fetch_row($query))
{

$oficial = get_oficial($veta[2]);
$ubicacion = get_ubicacion($veta[4]);


	echo '<script>
var tr, td;
	tr = document.all.tabla7.insertRow();
	
	td = tr.insertCell();
	td.innerHTML = contLin7 +"";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"telefono["+contLin7+"]\" type=\"text\" id=\"textfield\" value=\"'echo $veta[1]'\" size=\"20\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"extensiont["+contLin7+"]\" type=\"text\" id=\"textfield\" value=\"'echo $veta[3]'\" size=\"20\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"oficialt["+contLin30+"]\" id=\"select\">';
	echo $oficial;
	echo '</select>";
		
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"iddireccion["+contLin50+"]\" id=\"select\">';
	echo $ubicacion;
	echo '</select>";	
	
	td = tr.insertCell();
	contLin7++;

</script>';
}






echo '<script>


	
function agregar7() {
	var tr, td;
	
	
	td = tr.insertCell();
	td.innerHTML = contLin7 +"";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"telefono["+contLin7+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"extensiont["+contLin7+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"oficialt["+contLin30+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"iddireccion["+contLin50+"]\" id=\"select\">';
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