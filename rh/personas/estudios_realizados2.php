    

<?

function get_pro2()
{
	$con = mssql_query("select codigo_profesion, profesion from tb_profesion where escolaridad =1 order by profesion asc");
		if ($con)
		{
			while ($row=mssql_fetch_row($con))
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
		}
		return $opciones;
}


function get_opciones2()
{
	
$query = mssql_query("select id_nivel_academico,nivel_estudios from nivel_academico where id_nivel_academico =1 order by id_nivel_academico");																									
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
$op = get_opciones2();
$x = get_pro2();


echo '<script>
var contLin10 = 1;
function agregar20110() {
	var tr, td;

	tr = document.all.tabla3010.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin10 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"titulo["+contLin10+"]\" id=\"select\">';
	echo $op;
	echo '</select>";	
	
	
	

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"nivel["+contLin10+"]\" id=\"select\">';
	echo $x;
	echo '</select>";	
	
	

	

	td = tr.insertCell();

	contLin10++;
}

function borrarUltima20110() {
	ultima = document.all.tabla3010.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla3010.deleteRow(ultima);
	 contLin10--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla3010">
  <tr>
    <th height="15" class="HelloUser" scope="col">&nbsp;</th>
    <th class="HelloUser" scope="col">&nbsp;</th>
    <th class="HelloUser" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th width="31" height="15" class="HelloUser" scope="col">#</th>
    <th width="179" class="HelloUser" scope="col">Oficio u Ocupacion </th>
    <th width="179" class="HelloUser" scope="col"><div align="center">Tipo de Oficio u Ocupacion </div></th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar20110()" value="Agregar datos Academicos">
<input type="button" class="ProgressWriting" onClick="borrarUltima20110()" value="Borrar datos Academicos">
</body>
</html>