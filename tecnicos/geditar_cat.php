<?
// Trae los datos de la categoria actualizados	
	    $codigo=$_REQUEST["txt_codigo"];
		$categoria=$_REQUEST["txt_categoria"];
		$privada=$_REQUEST["cbo_interno"];
// Actualiza la base de datos	
		require_once('../connection/helpdesk.php');
		$consulta = "update categoria set categoria='$categoria', privada='$privada' where codigo_categoria='$codigo'";
		$result=$query($consulta);	
		$close($s);
		header("Location: busca_cat.php"); 		
?>
