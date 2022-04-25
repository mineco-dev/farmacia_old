<?	
$grupo_id=8;
include("../restringir.php");	
?>
<?		
		$codigo_seguimiento=$_REQUEST["txt_codigo_seguimiento"];					
		$detalle=$_REQUEST["txt_detalle_solicita"];		
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');      
		$consulta = "UPDATE seguimiento set codigo_tecnico='$user_id', detalle='$detalle' where codigo_seguimiento='$codigo_seguimiento'";
		$result=$query($consulta);
		header("Location: geditar_tickets.php");	
?>

