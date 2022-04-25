<?	
$grupo_id=3; // Para agentes de seguridad 
include("../restringir.php");	
// FIN DE VALIDACION
// Trae los datos del agente actualizados		
		$codigo_visitante=$_REQUEST["txt_codigo"];
		$lista_negra=$_REQUEST["cbo_lista_negra"];						
		$motivo=$_REQUEST["txt_motivo"];		
		$usuario=3;
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');		
		$consulta = "EXEC seg_lista_negra @vmotivo='$motivo', @vlista_negra='$lista_negra', @vcodigo_usuario_lista='$usuario_id', @vcodigo_visitante='$codigo_visitante'";		
		$result=$query($consulta);	
		$close($s);
		header("Location: index.php");			
?>

