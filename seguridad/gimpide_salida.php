<?	
$grupo_id=2; // Para agentes de seguridad 
include("../restringir.php");	
?>
<?
// Trae los datos del agente actualizados		
		$codigo_visita=$_REQUEST["txt_codigo"];
		$observacion=$_REQUEST["txt_observacion"];		
		$permite_salir=$_REQUEST["cbo_permite_salir"];		
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');      
		$consulta = "UPDATE seg_visita set impedir_salida='$permite_salir', motivo_impedir='$observacion', codigo_usuario_impide='$user_id' where codigo_visita='$codigo_visita'";	
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		header("Location: visitas.php"); 	
?>
	
