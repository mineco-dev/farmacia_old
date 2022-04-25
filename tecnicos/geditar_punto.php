<?	
$grupo_id=9;
include("../restringir.php");	
?>
<?		
		$ticket=$_REQUEST["txt_ticket"];					
		$solicitante=$_REQUEST["cbo_solicitante"];					
		$fecha_seguimiento=$_REQUEST["txt_fecha_seg"];		
		$detalle=$_REQUEST["txt_detalle_solicita"];
		$descripcion=$_REQUEST["txt_descripcion"];			
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');      
		$consulta = "UPDATE soporte set codigo_usuario='$solicitante', fecha_seguimiento='$fecha_seguimiento', detalle_solicita='$detalle', descripcion='$descripcion' where codigo_soporte='$ticket'";
		$result=$query($consulta);
		header("Location: minuta.php");	
?>

