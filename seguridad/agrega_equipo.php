<?
// Trae los datos del agente actualizados		
		session_start();
		$grupo_id=$_SESSION["group_id"];
		$tecnico_id=($_SESSION["user_id"]);
		$ultima_visita=($_SESSION["ultima_visita"]);   //codigo del ultimo visitante
		$equipo=$_REQUEST["cbo_equipo"];		
		$serie=$_REQUEST["txt_serie"];				
		$codigo_mov_equipo=$_REQUEST["cbo_mov_equipo"];				
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');  
		if ($grupo_id==3) $ingresa=1;
		else $ingresa=2;
		$consulta = "EXEC seg_equipo_add @vcodigo_visita='$ultima_visita', @vcodigo_equipo='$equipo', @vnumero_serie='$serie', @vcodigo_mov_equipo='$codigo_mov_equipo', @vingresa='$ingresa', @vcodigo_usuario_ing='$tecnico_id'";		
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		header("Location: equipo_det.php"); 	
?>

