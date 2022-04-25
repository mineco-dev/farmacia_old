<?
	//require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	conectardb($almacen);
	session_unregister("ingreso");
	session_register("egreso");
	$_SESSION["egreso"]=true;
?>
  
<?
//require('../includes/inc_header_sistema.inc');
//$dbms2=new DBMS($conexion);
//$dbms2->bdd=$database_cnn;
	
function get_banco_opciones($dbms2)
{
	/*$query = "select id_parentesco,parentesco from parentesco order by id_parentesco";
	$dbms2->sql=$query;
	$dbms2->Query();
	$opciones = "";
	while($Fields=$dbms2->MoveNext())*/		
	$qry_bodega = mssql_query("select * from cat_bodega where activo=1 and codigo_bodega=1 order by bodega");																									
	if ($qry_bodega)
		{
			while($row = mssql_fetch_row($qry_bodega))	
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
$anio = anio();
$mes = mes();
$dia = dia();
echo '<script>
var contLin4 = 1;
function agregar4() {
	var tr, td;

	tr = document.all.tabla4.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin4 +"";

	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"bodega["+contLin4+"]\" id=\"select\"></center>';
	echo $op;
	echo '</select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><a href=\"javascript:void(0)\" onClick=\"buscar=window.open(\'producto.php?tipo=bien&posi="+contLin4+"\',\'Buscar4\',\'width=600,height=525,menubar=no, scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;\"><input name=\"bien["+contLin4+"][0]\" type=\"text\" value=\"[CLIC AQUI SELECCIONA PRODUCTO]\" id=\"textfield\" disabled size=\"40\"></a></center>";

	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"dosis["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"30\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"entregado["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";
	
	td = tr.insertCell();
	td.innerHTML = 	"<input name=\"recetado["+contLin4+"]\" type=\"text\" id=\"textfield\" size=\"7\">";		
			
	td = tr.insertCell();
	td.innerHTML = 	"<input type=\"hidden\" name=\"bien["+contLin4+"][1]\" id=\"hiddenField\">";
	
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
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
</head>
<body>
<table width="100%" border=1 align="center" cellspacing="0" id="tabla4">
  <tr>
    <th width="7" rowspan="2" scope="col"><span class="Estilo2">#</span></th>
    <th width="64" rowspan="2" scope="col"><span class="Estilo2">Bodega de salida</span></th>
    <th width="510" rowspan="2" scope="col"><div align="center" class="Estilo2">Descripci&oacute;n</div></th>
    <th width="273" rowspan="2" scope="col">Dosis</th>
    <th height="19" colspan="2" scope="col"><div align="center"><span class="Estilo2">Cantidad</span></div></th>
  </tr>
  <tr>
	<th width="55" height="19" scope="col"><div align="center"><span class="Estilo2">Entregada</span></div></th>
    <th width="54" scope="col"><div align="center"><span class="Estilo2">Recetada</span></div></th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar4()" value="Agregar l&iacute;nea">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima4()" value="Borrar l&iacute;nea">
</body>
</html>