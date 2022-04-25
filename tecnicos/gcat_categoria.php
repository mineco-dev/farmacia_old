<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<?
require_once('../connection/helpdesk.php');
$modelo1=strtoupper($_POST["txt_categoria"]);
$consulta = "SELECT * FROM categoria where activo=1";
$result=mssql_query($consulta);
$entro=1;
while($row=mssql_fetch_array($result))
{
	if(strtoupper($row["categoria"]) == $modelo1)
	{
		$entro=0;
	}
}

if($entro == 1)
{
	$query = "EXEC proc_categoria_add @vcategoria='$modelo1'";
	mssql_query($query);
	mssql_close($s);
	include("transaccion_operada.php");
	
}
else
{
	echo('<strong><font size="5"><Center><font color="#FF0000">Categor�a previamente ingresada</font></Center></font></strong>');
}
?>