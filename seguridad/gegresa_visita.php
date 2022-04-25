<?		
$grupo_id=3; // Para agentes de seguridad 
include("../restringir.php");			
session_start();
$id=($_SESSION["visita"]);	
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');      
		$consulta = "EXEC seg_egresa_visita @vcodigo_usuario_egresa='$user_id', @vcodigo_visita='$id'";		
		$result=$query($consulta);	
		$close($s);		
		header("Location: visitas.php"); 	
?>