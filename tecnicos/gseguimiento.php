<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?
	// Quien inicio la sesion
	session_start();
	$tecnico_id=($_SESSION["user_id"]);   //codigo del usuario 
	$vestado=2;
	if ($cbo_concluido =='1') $vestado=3;
	require_once('../connection/helpdesk.php');
	$query="EXEC proc_seguimiento_add @vcodigo_soporte='$txt_id', @vcodigo_tecnico='$tecnico_id', @vdetalle='$txt_detalle_seguimiento', @vestado='$vestado', @vreasignado_por=3";
	$result=mssql_query($query);	
	mssql_close($s);
	session_write_close(); 
	header("Location: actividad.php"); 		
?>
</html>