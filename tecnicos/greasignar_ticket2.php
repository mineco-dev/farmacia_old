<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<?
	session_start();
	$reasignado_por=($_SESSION["user_id"]);   //codigo del usuario
	require_once('../connection/helpdesk.php');
	$consulta = "UPDATE soporte SET codigo_tecnico=$cbo_tecnico WHERE codigo_soporte=$txt_ticket";
	$result=mssql_query($consulta);
	$consulta ="EXEC proc_soporte_upd @vestado=2, @vcodigo_tecnico='$cbo_tecnico',@vcodigo_soporte='$txt_ticket', @vcodigo_supervisor=3"; 
	//$consulta ="EXEC proc_seguimiento_add @vcodigo_soporte='$txt_ticket', @vcodigo_tecnico='$cbo_tecnico', @vdetalle='Se reasign� t�cnico para atender su solicitud', @vestado=2, @vreasignado_por='$reasignado_por'";
	$result=mssql_query($consulta);
	mssql_close($s);	
	include('transaccion_operada.php');
?>
