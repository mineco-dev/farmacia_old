<?
// Trae los datos del agente actualizados		
		session_start();		
		$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
		include("../validate.php");
		$grupo_id=3;
		if (($_SESSION["group_id"]) < $grupo_id) 
		include("../logout.php");				
		$id=($_SESSION["visita"]);	
//Actualiza la base de datos	
		require_once('../../connection/helpdesk.php');      
		$consulta = "EXEC seg_egresa_visita @vcodigo_usuario_egresa='$usuario_id', @vcodigo_visita='$id'";		
		$result=$query($consulta);	
		$close($s);		
		header("Location: visitas.php"); 	
?>