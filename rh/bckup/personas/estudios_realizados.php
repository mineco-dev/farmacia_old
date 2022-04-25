    

<?

function get_pro()
{
	$con = mssql_query("select codigo_profesion, profesion from tb_profesion order by profesion asc");
		if ($con)
		{
			while ($row=mssql_fetch_row($con))
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
		}
		return $opciones;
}


function get_opciones()
{
	
$query = mssql_query("select id_nivel_academico,nivel_estudios from nivel_academico order by id_nivel_academico");																									
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
$op = get_opciones();
$x = get_pro();

echo '<script>
var contLin10 = 1;
function agregar10() {
	var tr, td;

	tr = document.all.tabla10.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin10 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"titulo["+contLin10+"]\" id=\"select\">';
	echo $x;
	echo '</select>";			

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"nivel["+contLin10+"]\" id=\"select\">';
	echo $op;
	echo '</select>";			
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"anioaca["+contLin10+"]\" id=\"select\">';
	echo $anio;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"mesaca["+contLin10+"]\" id=\"select\">';
	echo $mes;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"diaaca["+contLin10+"]\" id=\"select\">';
	echo $dia;
	echo '</select>";

	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"centroaca["+contLin10+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	td = tr.insertCell();

	contLin10++;
}

function borrarUltima10() {
	ultima = document.all.tabla10.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla10.deleteRow(ultima);
	 contLin10--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla10">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="179" class="HelloUser" scope="col">Titulo Obtenido</th>
    <th width="359" class="HelloUser" scope="col"><div align="center">Nivel Academico</div></th>
    <th width="40" class="HelloUser" scope="col">año</th>
    <th width="30" class="HelloUser" scope="col">mes</th>
    <th width="30" class="HelloUser" scope="col">dia</th>    
    <th width="179" class="HelloUser" scope="col">Centro de Estudios</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar10()" value="Agregar datos Academicos">
<input type="button" class="ProgressWriting" onClick="borrarUltima10()" value="Borrar datos Academicos">
</body>
</html>