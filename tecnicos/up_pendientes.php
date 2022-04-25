<?
	session_start(); 	// Quien inicio la sesion
?>
<?	
	require_once('../connection/helpdesk.php');
	$query="SELECT * FROM soporte WHERE codigo_soporte=$id";
	$result=mssql_query($query);	
	while($row=mssql_fetch_array($result))
	{
			$vestado=$row["codigo_estado"];
			$vtecnico=$row["codigo_tecnico"];     // Quien inicio el proceso de atencion al usuario.
	}
	$emp=vtecnico;	
	$tecnico_id=($_SESSION["user_id"]);   //codigo del usuario
	$grupo_id=($_SESSION["group_id"]);    // Codigo del grupo	
	$codigo_supervisor=3;	
	include('conectarse.php');
	$ip=$_SERVER['REMOTE_ADDR'];

	if ($vestado == 1) //si el ticket esta en rojo 
	{
		$vestado=2;		//pasa a amarillo		
	}
	else
	if (($vestado == 2) || ($vestado == 8))
		{
		    if ($vtecnico == $tecnico_id) //si el tecnico que inicio sesion es el que esta atendiendo este ticket
			{
				global $id;
				include("comentar.php");				
				exit;
			}
			 else
			{
			 		include("restringido.php");	
					//echo "Usted no inicio esta actividad, no la puede completar";
				    exit;	
			}
			 
		}
		else   // verificar permisos del técnico 
			if ($vestado == 3) // si el ticket esta en verde
			{

				if ($grupo_id >=9) //solo usuarios con roles arriba de tecnicos pueden supervisar tickets
				{

					if ($vtecnico==$tecnico_id) //siempre y cuando no sea el mismo usuario que se quiera supervisar
					{
						include("restringido.php");	
						//echo "El ticket no puede ser eliminado por el mismo técnico que completó la tarea";
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
	$consulta = "EXEC proc_soporte_upd @vestado='$vestado', @vcodigo_tecnico='$tecnico_id', @vcodigo_supervisor='$codigo_supervisor', @vcodigo_soporte='$id'";
	$result=mssql_query($consulta);
	if ($vestado==4)
	{
		$consulta = "EXEC proc_seguimiento_end @vestado='$vestado', @vcodigo_tecnico='$codigo_supervisor', @vcodigo_soporte='$id';";
		$result=mssql_query($consulta);		
	}	
	mssql_close($s);
	session_write_close();
	header("Location: pendientes.php"); 
?>
</html>
