<?
	// Quien inicio la sesion
	session_start();
	$user=($_SESSION["user_id"]);   //codigo del usuario que inicio sesion
	require_once('../connection/helpdesk.php'); 
	$query="SELECT codigo_tecnico FROM soporte WHERE codigo_soporte='$id'";	
	$result=mssql_query($query);
	while($fila=mssql_fetch_array($result))
	{
		$codigo_tecnico=$fila["codigo_tecnico"];
	}	
	if ($codigo_tecnico==$user)
	{
		$query="UPDATE soporte SET alerta=2 WHERE codigo_soporte='$id'";
		$result=mssql_query($query);	
	}
	mssql_close($s);
	session_write_close(); 	
	header("Location: pendientes.php"); 		
?>
