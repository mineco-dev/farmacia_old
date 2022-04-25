<?
// Trae los datos del agente actualizados		
	    $codigo=$_REQUEST["txt_codigo"];
		$nombres=$_REQUEST["txt_nombres"];
		$apellidos=$_REQUEST["txt_apellidos"];
		$usuario=$_REQUEST["txt_usuario"];
		$extension=$_REQUEST["txt_extension"];
		$nivel=$_REQUEST["txt_nivel"];
		$dependencia=$_REQUEST["cbo_dependencia"];
		$dependencia_temp=$_REQUEST["txt_dependencia"];
		if ($dependencia==0) $dependencia=$dependencia_temp;						
//Actualiza la base de datos	
		require_once('../connection/helpdesk.php');
		$consulta = "update usuario set codigo_dependencia='$dependencia', nombres='$nombres', apellidos='$apellidos', nombre_usuario='$usuario', extension='$extension', nivel='$nivel' where codigo_usuario='$codigo'";
		$result=$query($consulta);	
		$close($s);
		include('transaccion_operada.php');
?>
