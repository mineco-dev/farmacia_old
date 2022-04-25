<?
// Trae los datos del agente actualizados		
		session_start();
		$ultima_visita=($_SESSION["ultima_visita"]);   //codigo del ultimo visitante
		$dependencia=$_REQUEST["cbo_dependencia"];		
		$usuario_visitado=$_REQUEST["cbo_usuario"];				
		if ($dependencia==0) $dependencia=33;						
		if ($usuario_visitado==0) $usuario_visitado=3;	
//Actualiza la base de datos	
		require_once('../../connection/helpdesk.php');  
		$consulta = "EXEC seg_visita_det_add @vcodigo_visita='$ultima_visita', @vcodigo_dependencia='$dependencia', @vcodigo_usuario_visitado='$usuario_visitado'";		
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		header("Location: visita_det.php"); 	
?>

