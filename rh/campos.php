    

<?

function get_campos()
{
	$con = mssql_query("select origen, campo from reportes where tipo <> 3 order by codigo_campo asc");
		if ($con)
		{
			while ($row=mssql_fetch_row($con))
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
		}
	return $opciones;
}



function get_tipo()
{
	$con = mssql_query("select tipo from reportes where tipo <> 3 order by codigo_campo asc");
		if ($con)
		{
			while ($row=mssql_fetch_row($con))
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
		}
	return $opciones;
}


function get_alias()
{
	$con = mssql_query("select alias  from reportes where tipo <> 3 order by codigo_campo asc");
		if ($con)
		{
			while ($row=mssql_fetch_row($con))
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
		}
	return $opciones;
}




?>
<html>
<link href="css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<?
$op = get_campos();
$orden = orden();
$criterio = criterio();

echo '<script>
var contLin10 = 1;
function agregar10() {
	var tr, td;

	tr = document.all.tabla10.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin10 +"";
		
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"campo["+contLin10+"]\" id=\"select\">';
	echo $op;
	echo '</select>";			

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"titulo["+contLin10+"]\" type=\"text\" id=\"textfield\" size=\"20\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"ancho["+contLin10+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"tamao["+contLin10+"]\" type=\"text\" id=\"textfield\" size=\"20\">";


	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"orden["+contLin10+"]\" id=\"select\">';
	echo $orden;
	echo '</select>";
	
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"criterio["+contLin10+"]\" id=\"select\">';
	echo $criterio;
	echo '</select>";

	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"valor["+contLin10+"]\" type=\"text\" id=\"textfield\" size=\"20\">";

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
	<th width="24" class="HelloUser" scope="col">#</th>
    <th width="149" class="HelloUser" scope="col">Campo</th>
    <th width="151" class="HelloUser" scope="col"><div align="center">Titulo</div></th>
    <th width="91" class="HelloUser" scope="col">Ancho</th>
    <th width="76" class="HelloUser" scope="col">Tam</th>
    <th width="72" class="HelloUser" scope="col">Orden</th>    
    <th width="52" class="HelloUser" scope="col">Criterio</th>
    <th width="116" class="HelloUser" scope="col">Valor</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar10()" value="Agregar Campo">
<input type="button" class="ProgressWriting" onClick="borrarUltima10()" value="Borrar Campo">
</body>
</html>