<?	
$grupo_id=17; // Para agentes de seguridad 
include("../restringir.php");	
// FIN DE VALIDACION
	$id=$_REQUEST["id"];
	require_once('../connection/helpdesk.php');
	$consulta = "DELETE FROM rol where codigo_rol='$id'";
	$result=$query($consulta);	
	header("Location: roles_det.php");
?>