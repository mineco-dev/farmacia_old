<?		
$grupo_id=3; // Para agentes de seguridad 
include("../restringir.php");	
?>
<?				
		require_once('../connection/helpdesk.php');      
		$consulta="EXEC seg_equipo_det_upd @vcodigo_usuario='$user_id', @vcodigo_equipo_det='$id'";
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		header("Location: salida.php"); 	
?>

