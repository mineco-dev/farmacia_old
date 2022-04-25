<?	
$grupo_id=3; // Para agentes de seguridad 
include("../restringir.php");	
// FIN DE VALIDACION
	$id=$_REQUEST["id"];
	require_once('../connection/helpdesk.php');
	$consulta = "DELETE FROM seg_visita_det where codigo_visita_det='$id'";
	$result=$query($consulta);	
	header("Location: visita_det.php");
?>