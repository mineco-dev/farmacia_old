<?
	//Validar la sesion 
	session_start();	
	$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	include("../validate.php");
	$grupo_id=3;
	if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");		
?>
<?		
		echo $id;
		phpinfo();
		require_once('../../connection/helpdesk.php');      
		$consulta="EXEC seg_equipo_det_upd @vcodigo_usuario='$usuario_id', @vcodigo_equipo_det='$id'";
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		header("Location: salida.php"); 	
?>

