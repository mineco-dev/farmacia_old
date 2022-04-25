<?
// Trae los datos del agente actualizados		
		$codigo_visitante=$_REQUEST["txt_codigo"];
		$motivo=$_REQUEST["cbo_motivo"];		
		$dependencia=$_REQUEST["cbo_dependencia"];				
		$usuario_visitado=$_REQUEST["cbo_usuario"];		
		if ($usuario_visitado==0) $usuario_visitado=3;
		$especifique=$_REQUEST["txt_especifique"];				
		$gafete=$_REQUEST["txt_gafete"];									
		$usuario=3;
		$casillero=$_REQUEST["txt_casillero"];									
		if (!isset($_REQUEST["chk_arma"])) $arma=2;
		else $arma=1;									
//Actualiza la base de datos	
		require_once('../../connection/helpdesk.php');      
		$consulta = "EXEC seg_visita_add @vcodigo_visitante='$codigo_visitante', @vcodigo_motivo='$motivo', @vcodigo_dependencia='$dependencia', @vcodigo_usuario='$usuario', @vespecifique_motivo='$especifique', @vgafete_asignado='$gafete', @vcodigo_usuario_visita='$usuario_visitado', @varma='$arma', @vcasillero='$casillero'";		
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
		header("Location: equipo_det.php"); 	
?>

