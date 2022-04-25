<?
/*require('../includes/inc_header.inc');
$dbms2=new DBMS($conexion);
$dbms2->bdd=$database_cnn;*/
?>
<html>
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<head>
<script>
/*
var contLin5 = 1;
function agregar5() {
	var tr, td;
	tr = document.all.tabla5.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin5 +"";
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"correo["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"50\">";
	td = tr.insertCell();
	contLin5++;
}

function borrarUltima5() {
	ultima = document.all.tabla5.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla5.deleteRow(ultima);
	 contLin5--;
	}
}*/
</script>

<?
echo '<script>
var contLin5 = 1;
function agregar5() {
	var tr, td;
	tr = document.all.tabla5.insertRow();
	
	td = tr.insertCell();
	td.innerHTML = contLin5 +"";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"correo["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"50\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<select name=\"oficialc["+contLin5+"]\" id=\"select\">';
	echo $condicional;
	echo '</select>";
	
	
	td = tr.insertCell();
	contLin5++;
}

function borrarUltima5() {
	ultima = document.all.tabla5.rows.length - 1;
	if (ultima !=0)
	{
	 document.all.tabla5.deleteRow(ultima);
	 contLin5--;
	}
}
</script>';
?>
</head>
<body>
<table width="40%" border=0 cellspacing="0" id="tabla5">
  <tr>
	<th width="31" class="HelloUser" scope="col">#</th>
    <th width="179" class="HelloUser" scope="col">Correo electronico</th>
	<th width="60" class="HelloUser" scope="col">Oficial</th>
  </tr>
</table>
<br>
<input type="button" class="ProgressWriting" onClick="agregar5()" value="Agregar correo electronico">
<input type="button" class="ProgressWriting" onClick="borrarUltima5()" value="Borrar correo electronico">
</body>
</html>