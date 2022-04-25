
    

<?

function get_idiomas()
{
	
$query = mssql_query("select id_idioma,idioma from tb_idioma order by id_idioma");																									
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
$op = get_idiomas();


echo '<script>
var contLin30 = 1;
function agregar30() {
	var tr, td;

	tr = document.all.tabla30.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin30 +"";
		
	

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"idioma["+contLin30+"]\" id=\"select\">';
	echo $op;
	echo '</select>";			
	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"centroidi["+contLin30+"]\" type=\"text\" id=\"textfield\" size=\"30\">";	
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"escribe["+contLin30+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"lee["+contLin30+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";

	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"habla["+contLin30+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";
	
	


	td = tr.insertCell();

	contLin30++;
}

function borrarUltima30() {
	ultima = document.all.tabla30.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla30.deleteRow(ultima);
	 contLin30--;
	}
}
</script>';
?>
</head>
<body>
<table width="73%" border=0 cellspacing="0" id="tabla30">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="100" class="HelloUser" scope="col"><div align="center">Idioma</div></th>
    <th width="179" class="HelloUser" scope="col">Centro de Estudios</th>
    <th width="40" class="HelloUser" scope="col">escribe</th>
    <th width="30" class="HelloUser" scope="col">lee</th>
    <th width="30" class="HelloUser" scope="col">habla</th>    

  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar30()" value="Agregar Idioma">
<input type="button" class="ProgressWriting" onClick="borrarUltima30()" value="Borrar Idioma">
</body>
</html>