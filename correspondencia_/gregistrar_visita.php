<?
phpinfo();
//Validar la sesion 
	session_start();	
	$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	include("../validate.php");
	$grupo_id=3;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");	
// Trae los datos del agente actualizados		
		$codigo_visitante=$_REQUEST["txt_codigo"];			
		$gafete=$_REQUEST["txt_gafete"];											
		$casillero=$_REQUEST["txt_casillero"];									
		$arma=$_REQUEST["chk_arma"];																		
//Actualiza la base de datos	
		require_once('../../connection/helpdesk.php');      
		$consulta = "EXEC seg_visita_add @vcodigo_visitante='$codigo_visitante', @vcodigo_usuario='$usuario_id', @vgafete_asignado='$gafete', @varma='$arma', @vcasillero='$casillero'";		
		$result=$query($consulta);	
		$consulta = "select max(codigo_visita) as ultima_visita from seg_visita";
		$result=$query($consulta);
		while($row=$fetch_array($result))		
		{
			$ultima_visita=$row["ultima_visita"];
		}		
		$close($s);		
		session_register('ultima_visita');
		$_SESSION['ultima_visita'] = $ultima_visita;		
		header("Location: visita_det.php"); 	
?>

