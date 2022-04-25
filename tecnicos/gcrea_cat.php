<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<?
require_once('../connection/helpdesk.php');
$categoria_mayus=strtoupper($txt_categoria);
$dependencia=($txt_dependencia);
$privada=($cbo_interno);
$consulta = "SELECT * FROM categoria where codigo_dependencia='$dependencia'";
$result=mssql_query($consulta);
$entro=1;
while($row=mssql_fetch_array($result))
{
	if(strtoupper($row["categoria"]) == $categoria_mayus)
	{
		$entro=0;
	}
}
if($entro == 1)
{
	$query = "INSERT into categoria (categoria, codigo_dependencia,activo, privada) VALUES ('$categoria_mayus','$dependencia',1,'$privada')";
	mssql_query($query);
	mssql_close($s);
	header("Location: busca_cat.php");
}	
else
{
echo('<strong><font size="5"><Center><font color="#FF0000">Esta categor�a ya existe</font></Center></font></strong>');
}
?>