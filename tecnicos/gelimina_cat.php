<?
// Trae los datos del agente actualizados		
		$codigo=$_REQUEST["txt_codigo"];
		$eliminar=$_REQUEST["cbo_baja"];				
//Actualiza la base de datos
		require_once('../connection/helpdesk.php');
		$consulta = "update categoria set activo='$eliminar' where codigo_categoria='$codigo'";
		$result=$query($consulta);	
		$close($s);
		header("Location: busca_cat.php");
?>
