<?	
	//Validar la sesion 
	session_start();		
	include("../validate.php");
	$grupo_id=2;
	if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");		
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?		
	session_start();	
	if (isset($_SESSION['visita'])) 
	{		
		session_unregister('visita');
		session_unregister('visitante');
		session_unregister('dependencia');
		session_unregister('visitado');		
	}		
	require_once('../connection/helpdesk.php');
	$query = "SELECT * FROM seg_visita_det WHERE codigo_visita_det=$id";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{		   		
			$vestado=$row["codigo_estado"];
			$dependencia=$row["codigo_dependencia"];
			$visitado=$row["codigo_usuario_visitado"];
			$visitante=$row["codigo_visita"];
//$vtecnico=$row["codigo_tecnico"];     // Quien inicio el proceso de atencion al usuario.
	}		
	mssql_close($s);		
	session_register('visita');
	$_SESSION['visita'] = $id;
	session_register('visitante');
	$_SESSION['visitante'] = $visitante;
	session_register('dependencia');
	$_SESSION['dependencia'] = $dependencia;
	session_register('visitado');
	$_SESSION['visitado'] = $visitado;
	// Quien inicio la sesion
		//	session_start();
		//	$tecnico_id=($_SESSION["user_id"]);   //codigo del usuario
		//	$grupo_id=($_SESSION["group_id"]);    // Codigo del grupo
		//	$codigo_supervisor=3;	
if ($vestado == 1) 	header("Location: confirma_visita.php"); 
if ($vestado == 2) 	header("Location: equipo_det_sale.php"); 	
?>
</html>
