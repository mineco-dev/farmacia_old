<?	
$grupo_id=17; // Para agentes de seguridad 
include("../restringir.php");	
// FIN DE VALIDACION
	$id=$_REQUEST["id"];
	require_once('../connection/helpdesk.php');	
	$consulta = "EXEC proc_usuario_rol_add @vcodigo_usuario=$cbo_usuario, @vcodigo_usuario_creo=$user_id";
	$result=$query($consulta);	
	header("Location: agrega_usuario_rol.php");
?>