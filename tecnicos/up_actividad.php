<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?
	require_once('../connection/helpdesk.php');
	$query="SELECT * FROM soporte WHERE codigo_soporte=$id";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
			$vestado=$row["codigo_estado"];
			$vtecnico=$row["codigo_tecnico"];     // Quien inicio el proceso de atencion al usuario.
	}
	
	// Quien inicio la sesion
	session_start();
	$tecnico_id=($_SESSION["user_id"]);   //codigo del usuario
	$grupo_id=($_SESSION["group_id"]);    // Codigo del grupo	
	$codigo_supervisor=3;	
	include('conectarse.php');
	$ip=$_SERVER['REMOTE_ADDR'];
//	envia_msg('la ip es '.$ip);
	// Cambia el estado del ticket
/*						    envia_msg('vtecnico'.$vtecnico);
						envia_msg('tecnico_id'.$tecnico_id);
					    envia_msg('vestado'.$vestado);
					    envia_msg('grupo_id'.$grupo_id);*/


	
	if ($vestado == 1) 
	{
		//$consulta = "EXEC proc_seguimiento_inicial @vcodigo_soporte='$id', @vcodigo_tecnico='$tecnico_id'";
   	    //$result=mssql_query($consulta);		
		$vestado=2;				
	}
	else
	if ($vestado == 2) 
		{
		    if ($vtecnico == $tecnico_id)
			{
			global $id;
			include("seguimiento.php");				
			exit;
			}
			 else
			{
			 		include("restringido.php");	
					//echo "Usted no inicio esta actividad, no la puede completar";
				    exit;	
			}
			 
		}
		else   // verificar permisos del t�cnico 
			if ($vestado == 3) 
			{

				if ($grupo_id >=9)
				{

					if ($vtecnico==$tecnico_id)
					{

						include("restringido.php");	
						//echo "El ticket no puede ser eliminado por el mismo t�cnico que complet� la tarea";
						exit;	
					}
					else
					{				

						$vestado=4;
						$codigo_supervisor=$tecnico_id;
					}
				}
				else
				{
					include("restringido.php");	
					//echo "No tiene permisos para efectuar este proceso";
					exit;
				}
			}						
	// Actualiza la tabla de acuerdo al estado del ticket
//	envia_msg('la ip es '.$ip);
//		$consulta = "EXEC proc_soporte_upd @vestado='$vestado', @vcodigo_tecnico='$tecnico_id', @vcodigo_supervisor='$codigo_supervisor', @vcodigo_soporte='$id', @vip ='$ip'";
		$consulta = "EXEC proc_soporte_upd @vestado='$vestado', @vcodigo_tecnico='$tecnico_id', @vcodigo_supervisor='$codigo_supervisor', @vcodigo_soporte='$id'";

	$result=mssql_query($consulta);
	if ($vestado==4)
	{
		$consulta = "EXEC proc_seguimiento_end @vestado='$vestado', @vcodigo_tecnico='$codigo_supervisor', @vcodigo_soporte='$id';";
		$result=mssql_query($consulta);		
	}	
	mssql_close($s);
	session_write_close();
	header("Location: actividad.php"); 
?>
</html>
