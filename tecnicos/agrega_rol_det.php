<?
$grupo_id=17; 
include("../restringir.php");	
// Trae los datos del usuario
		require_once('../connection/helpdesk.php');  
		$codigo_usuario=($_SESSION["codigo_usuario"]);   //codigo del usuario al que se le agregan roles
		$dependencia=$_REQUEST["cbo_dependencia"];		
		$codigo_grupo=$_REQUEST["cbo_grupo"];				
		$tipo_permiso=$_REQUEST["cbo_permiso"];				
//Actualiza la base de datos							
		$consulta = "EXEC proc_rol_add @vtipo_permiso='$tipo_permiso', @vcodigo_usuario='$codigo_usuario', @vcodigo_dependencia='$dependencia', @vcodigo_grupo_enc='$codigo_grupo', @vcodigo_usuario_creo='$user'";		
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		header("Location: roles_det.php"); 	
?>

