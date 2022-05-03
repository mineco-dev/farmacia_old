<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<?
require_once('../connection/helpdesk.php');
$ocupado=0;
$query = "Select * from videoconf where dia=$cbo_dia and mes=$cbo_mes and anio=$cbo_anio";
$result=mssql_query($query);
				while($row=mssql_fetch_array($result))  //Recorre las solicitudes y reservaciones del dia
				{
					if ($row["reservado"]==1) //solo chequea los que estan reservados para que no haya traslape
					{
						if (($cbo_inicia>=($row["hora_inicia"])) && ($cbo_inicia<($row["hora_finaliza"])))
						{
							$ocupado=1;
							break;
						}
						if (($cbo_finaliza>($row["hora_inicia"])) && ($cbo_finaliza<=($row["hora_finaliza"])))
						{
							$ocupado=1;
							break;
						}
					}
				}	
	mssql_close($s);	
	if ($ocupado==1) 
			echo "el sal�n se encuentra reservado en la fecha y hora indicada";
	else
		{				
			session_register('solicitante');
			$_SESSION['solicitante'] = $txt_usuario;		
			session_register('salon');
			$_SESSION['salon'] = $cbo_salon;		
			session_register('dia');
			$_SESSION['dia'] = $cbo_dia;		
			session_register('mes');
			$_SESSION['mes'] = $cbo_mes;		
			session_register('anio');
			$_SESSION['anio'] = $cbo_anio;		
			session_register('inicia');
			$_SESSION['inicia'] = $cbo_inicia;		
			session_register('finaliza');
			$_SESSION['finaliza'] = $cbo_finaliza;					
			header("Location: registrar_videoconf.php");
		}
		
?>
