<?
	
	conectardb($visitantes);
	session_unregister("egreso");
	session_register("ingreso");
	$_SESSION["ingreso"]=true;
?>
<html>
<head>
<?
function get_equipo_opciones($dbms2)
{	
	$qry_equipo = mssql_query("select * from seg_equipo where activo=1 order by nombre_equipo");																									
	if ($qry_equipo)
		{
			$opciones = "<option value = '0'>-- Seleccione --</option>";
			while($row_equipo = mssql_fetch_row($qry_equipo))	
			{
				$opciones = $opciones."<option value = ".$row_equipo[0]. ">".$row_equipo[1]."</option>";
			}			
	}
	return $opciones;
}
function get_movimiento_opciones($dbms2)
{	
	$qry_movimiento= mssql_query("select * from seg_mov_equipo where activo=1 order by descripcion");																									
	if ($qry_movimiento)
		{
			$opciones = "<option value = '0'>-- Seleccione --</option>";
			while($row_movimiento = mssql_fetch_row($qry_movimiento))	
			{
				$opciones = $opciones."<option value = ".$row_movimiento[0]. ">".$row_movimiento[1]."</option>";
			}			
	}
	return $opciones;
}
?>
<?
$llenar_equipo = get_equipo_opciones($dbms2);
$llenar_movimiento=get_movimiento_opciones($dbms2);
echo '<script>
var contLin5 = 1;
function agregar5() {
	var tr, td;

	tr = document.all.tabla5.insertRow();
	td = tr.insertCell();
	td.innerHTML = contLin5 +"";	
			
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"equipo["+contLin5+"]\" id=\"select\">';
	echo $llenar_equipo;
	echo '</center></select>";	
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><input name=\"serie["+contLin5+"]\" type=\"text\" id=\"textfield\" size=\"25\"></center>";
	
	td = tr.insertCell();
	td.innerHTML = 	"<center><select name=\"movimiento["+contLin5+"]\" id=\"select\">';
	echo $llenar_movimiento;
	echo '</center></select>";		
		
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
<style type="text/css">
<!--
.Estilo2 {font-size: x-small}
-->
</style>
</head>
<body>
<table width="100%" border=1 cellspacing="0" id="tabla5">
  <tr>
    <th width="16" height="19" scope="col"><span class="Estilo2">#</span></th>
    <th width="241" scope="col"><div align="center" class="Estilo2">Equipo</div></th>
    <th width="316" scope="col"><span class="Estilo2">Serie</span></th>
    <th width="384" scope="col"><span class="Estilo2">Movimiento</span></th>
  </tr>
</table>
<br>
<input name="Bot&oacute;n" type="button" onClick="agregar5()" value="Agregar">
<input name="Bot&oacute;n" type="button" onClick="borrarUltima5()" value="Quitar">
</body>
</html>