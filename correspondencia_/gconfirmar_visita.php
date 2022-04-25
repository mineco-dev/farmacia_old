<?
	//Validar la sesion 
	session_start();	
	$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	include("../validate.php");
	$grupo_id=2;
	if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");		
//	<body onload="Abrir_ventana('new.php')">
?>
<?
// Trae los datos del visitante actualizados		
		session_start();	
		$codigo_visita=($_SESSION["visita"]);
		$dependencia_temp=($_SESSION["dependencia"]);
		$visitado_temp=($_SESSION["visitado"]);
		session_write_close();
		$dependencia=$_REQUEST["cbo_dependencia"];					
		$usuario_visitado=$_REQUEST["cbo_usuario_visitado"];		
		$motivo=$_REQUEST["cbo_motivo"];
		$especifique=$_REQUEST["txt_especifique"];			
		// si no cambio los valores del combo dependencia y usuario, asigna a las variables los valores que traia
		if ($dependencia==0) $dependencia=$dependencia_temp;
		if ($usuario_visitado==0) $usuario_visitado=$visitado_temp;		
//Actualiza la base de datos	
		$pendiente=2;
		require_once('../../connection/helpdesk.php');      
		$consulta = "EXEC seg_visita_conf @vcodigo_visita='$codigo_visita', @vcodigo_dependencia='$dependencia', @vcodigo_usuario_visita='$usuario_visitado', @vcodigo_motivo='$motivo', @vcodigo_usuario='$usuario_id', @vespecifique_motivo='$especifique'";
		$result=$query($consulta);
		$consulta2 = "Select * from seg_visita_det where codigo_visita_det='$codigo_visita'";
		$result2=$query($consulta2);	
		while($row2=$fetch_array($result2))
		{				
				$codigo_visita=$row2["codigo_visita"];
		}							
		$consulta2 = "Select * from seg_visita_det where codigo_visita='$codigo_visita' and codigo_estado=1";
		$result2=$query($consulta2);	
		while($row2=$fetch_array($result2))
					{
						$pendiente=1;
					}		
		if ($pendiente==2)
		{
			echo "hola pendiente es igual a 2";
			echo $codigo_visita;
			$consulta3 = "UPDATE seg_visita SET codigo_estado=2 where codigo_visita='$codigo_visita'";
			$result3=$query($consulta3);								
		}					
		$close($s);				
		header("Location: visitas.php");	
?>

