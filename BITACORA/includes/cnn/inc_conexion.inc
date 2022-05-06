<?PHP
$hostname_redes = "128.5.8.85";
$database_redes = "helpdesk_farmacia";
$username_redes = "farmacia";
$password_redes = "DTIdesa@2K271.";
$conexion = mssql_connect($hostname_redes,$username_redes,$password_redes) or die("no se puede conectar a SQL Server");
mssql_select_db($database_redes,$conexion);
?>
