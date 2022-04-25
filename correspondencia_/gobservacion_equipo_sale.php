<?
// Trae los datos del agente actualizados		
		$codigo_equipo=$_REQUEST["txt_codigo"];
		$observacion=$_REQUEST["txt_observacion"];		
		$serie=$_REQUEST["txt_serie"];		
//Actualiza la base de datos	
		require_once('../../connection/helpdesk.php');      
		$consulta = "UPDATE seg_equipo_det set observacion='$observacion', numero_serie='$serie' where codigo_equipo_det='$codigo_equipo'";		
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		header("Location: salida.php"); 	
?>

