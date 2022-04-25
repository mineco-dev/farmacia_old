<?
// Trae los datos del agente actualizados		
		$codigo_visitante=$_REQUEST["txt_codigo"];
		$nombre=$_REQUEST["txt_nombre"];						
		$cedula=$_REQUEST["txt_numero_cedula"];		
		$licencia=$_REQUEST["txt_licencia"];		
		$pasaporte=$_REQUEST["txt_pasaporte"];		
		$carnet=$_REQUEST["txt_carnet"];		
		$municipio=$_REQUEST["cbo_municipio"];		
		$direccion=$_REQUEST["txt_direccion"];				
		$colegio=$_REQUEST["txt_colegio"];		
		$municipio_temp=$_REQUEST["txt_municipio"];		
		if ($municipio==0) $municipio=$municipio_temp;						
//Actualiza la base de datos	
		require_once('../../connection/helpdesk.php');
		$consulta = "update seg_visitante set nombre_visitante='$nombre', numero_cedula='$cedula', numero_licencia='$licencia', numero_pasaporte='$pasaporte', numero_carnet='$carnet', direccion='$direccion', extendida_en='$municipio', colegio='$colegio' where codigo_visitante='$codigo_visitante'";
		$result=$query($consulta);	
		$close($s);
		header("Location: index.php");
?>
