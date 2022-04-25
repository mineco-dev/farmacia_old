<?php
	require_once('Connections/politica.php'); 
	mysql_select_db($database_politica);
	$query = "select us_id from users where us_login='$login' and us_password=password('$clave')";	
	$resultado = mysql_query($query);
	$row = mysql_fetch_array($resultado);
	if (mysql_num_rows($resultado)>0)
	{
		session_register('us_id');
		$_SESSION['us_id'] = $row[0];

		header("location: dpiMenu.php"); 
		// se modifico el output_buffering de off a on   /windows en PHP.ini
	}
	else
	{
	    header("location: errorLogin.php");
	}
?>
