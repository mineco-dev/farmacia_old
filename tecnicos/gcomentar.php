
<?
	session_start(); 	 
	$tecnico_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	require_once('../connection/helpdesk.php');
	if (isset($alerta)) //poner una alerta al ticket si fuera el caso
	{
		$query="UPDATE soporte SET alerta=1 WHERE codigo_soporte='$txt_id'";
		$result=mssql_query($query);	
		$txt_detalle_seguimiento=$txt_detalle_seguimiento.'&nbsp;<img src="imagenes/iconos/ico_alert.gif" alt="Alerta" width="15" height="15">';
	}
	if (isset($correo)) //enviar correo
	{
		//enviar correo
	}
	if (isset($cbo_concluido)) //si se concluyo la actividad
	{
		$vestado=2;
		if ($cbo_concluido =='1') 
		{
			$vestado=3;
		}
		else
		if ($cbo_concluido =='8') 
		{
			$vestado=8;
		}
		$query="EXEC proc_seguimiento_add @vcodigo_soporte='$txt_id', @vcodigo_tecnico='$tecnico_id', @vdetalle='$txt_detalle_seguimiento', @vestado='$vestado', @vreasignado_por=3";
	}
	else
	{
		$query="EXEC proc_comentario_add @vcodigo_soporte='$txt_id', @vcodigo_tecnico='$tecnico_id', @vdetalle='$txt_detalle_seguimiento'";
	}		
	$result=mssql_query($query);	
	$categoria=$_REQUEST["cbo_categoria"];
	$categoria_temp=$_REQUEST["txt_categoria"];
		if ($categoria!=0)
		{
			$qry_actualiza="UPDATE soporte SET codigo_categoria='$categoria' WHERE codigo_soporte='$txt_id'";
			$resp_actualiza=mssql_query($qry_actualiza);			
		}				
	mssql_close($s);
	session_write_close(); 	
	header("Location: pendientes.php"); 	
?>
