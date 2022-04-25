<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
	require("../../includes/conectarse.php");

	if (isset($_SESSION["ingresando_obj"]))
	{		
		$acceso=permisosdb($presupuesto);							
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{
			conectardb($presupuesto);
			$nombre_usuario=$_SESSION["user_name"];																		
			session_unregister("ingresando_obj");																																						
			// Grabar el detalle del presupuesto cuatrimestral			
						

												
			$update = 'delete from tb_presupuesto_det where codigo_presupuesto_anual ='.$txt_codigo_presupuesto_anual;
			mssql_query($update);
			
			//print $update;
			
			
			
			
					
		$i = 1;
		
		while ($i <= count($justificacion))
		{				
			
			$valor = trim($bien[$i][0]);
				
			$qry_consulta_codigo='select codigo_renglon from cat_renglon where codigo='.$valor;

			
			$res_qry_consulta_codigo=$query($qry_consulta_codigo);
			while($row_qry_codigo=$fetch_array($res_qry_consulta_codigo))					
			{					
				$cod_renglon=$row_qry_codigo[0];
			}
							
				$qry_presupuesto_cuatrimestral="insert into tb_presupuesto_det(codigo_presupuesto_anual, 				codigo_renglon,comprometido_mes1,comprometido_mes2,comprometido_mes3,comprometido_mes4,justificacion,activo,codigo_periodo) values ($txt_codigo_presupuesto_anual,$cod_renglon, $cmes1[$i], $cmes2[$i], $cmes3[$i], $cmes4[$i],'$justificacion[$i]', '1', '$txt_codigo_periodo')";
				

														
				$res_cuatrimestral=$query($qry_presupuesto_cuatrimestral);							
				$i++;				
		}// fin del while que graba los datos				



		$cont = 1;
		
		while ($cont <= count($justifi))
		{
			$crenglon=trim($codigo_renglon[$cont]);


			$qry_consulta_codigo1='select codigo_renglon from cat_renglon where codigo='.$crenglon;
		
			$res_qry_consulta_codigo1=$query($qry_consulta_codigo1);
			while($row_qry_codigo1=$fetch_array($res_qry_consulta_codigo1))					
			{					
				$renglon=$row_qry_codigo1[0];
			}
							
				$qry_presupuesto_cuatrimestral1="insert into tb_presupuesto_det(codigo_presupuesto_anual, 				codigo_renglon,comprometido_mes1,comprometido_mes2,comprometido_mes3,comprometido_mes4,justificacion,activo,codigo_periodo) values ($txt_codigo_presupuesto_anual,$renglon, $comprometido_mes1[$cont], $comprometido_mes2[$cont], $comprometido_mes3[$cont], $comprometido_mes4[$cont],'$justifi[$cont]', '1', '$txt_codigo_periodo')";
				

														
				$res_cuatrimestral1=$query($qry_presupuesto_cuatrimestral1);							
				$cont++;				
		}// fin del while que graba los datos				



	}// fin del IF de acceso
}// fin del IF de Variable de Sesion
		
		echo 'utilice el menu de la izquierda para continuar operando el sistema';
						
?>            
	