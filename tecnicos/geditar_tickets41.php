<?	
$grupo_id=8;
include("../restringir.php");	
?>
<?		
		$codigo_seguimiento=$_REQUEST["txt_codigo_seguimiento"];							
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');      
		$consulta = "delete from seguimiento where codigo_seguimiento='$codigo_seguimiento'";
		$result=$query($consulta);
		header("Location: geditar_tickets.php");	
?>

