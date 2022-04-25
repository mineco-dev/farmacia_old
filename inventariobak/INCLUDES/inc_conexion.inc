<?
$hostname_redes = "server_appl";
$database_redes = "inventario";
$username_redes = "sa";
$password_redes = "sa";
$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes)
or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);



function Conectarse($base)
{
	if (!($conexion=mssql_connect('SERVER_APPL','sa','sa')))
	{
		echo "Error conectando a la base de datos...";
		exit();
	}

	if (!mssql_select_db($base,$conexion))
	{
		echo "Error seleccionando la base de datos.";
		exit();
	}

	return $conexion;

}

//$conexion =Conectarse('RRHH');




?>