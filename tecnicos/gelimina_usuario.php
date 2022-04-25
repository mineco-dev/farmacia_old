<?
// Trae los datos del agente actualizados		
		$codigo=$_REQUEST["txt_codigo"];
		$eliminar=$_REQUEST["cbo_baja"];				
//Actualiza la base de datos
		require_once('../connection/helpdesk.php');
		$consulta = "update usuario set activo='$eliminar' where codigo_usuario='$codigo'";
		$result=$query($consulta);	
		$close($s);
		include('transaccion_operada.php');
?>
