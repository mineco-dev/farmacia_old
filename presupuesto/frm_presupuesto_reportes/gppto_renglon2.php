<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");


	
	if (isset($_SESSION["ingresando_obj"]))
	{		
		$acceso=permisosdb($presupuesto);							
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{
			conectardb($presupuesto);
			$nombre_usuario=$_SESSION["user_name"];																		
			session_unregister("ingresando_obj");																																						
			
				$qry_consulta_codigo="select max(codigo_presupuesto_det) from tb_presupuesto_det";
				
				
				$res_qry_consulta_codigo=$query($qry_consulta_codigo);
				while($row_qry_codigo=$fetch_array($res_qry_consulta_codigo))					
				{					
					$codigo_presupuesto_det=$row_qry_codigo[0];
				}
								
				$qry_presupuesto_cuatrimestral="update tb_presupuesto_det set activo = 2 where codigo_presupuesto_det = $codigo_presupuesto_det";										
				$res_cuatrimestral=$query($qry_presupuesto_cuatrimestral);															
//				print 'echo';
		}
	}			
?>            
	