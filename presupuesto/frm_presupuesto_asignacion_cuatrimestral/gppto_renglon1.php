<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");


	
	$bien=trim($_GET['bien']); 
	$justificacion=trim($_GET['justificacion']);
	$cmes1=$_GET['cmes1'];
	$cmes2=$_GET['cmes2'];
	$cmes3=$_GET['cmes3'];
	$cmes4=$_GET['cmes4'];
	$dmes1=$_GET['dmes1'];
	$dmes2=$_GET['dmes2'];
	$dmes3=$_GET['dmes3'];
	$dmes4=$_GET['dmes4'];
	$txt_codigo_presupuesto_anual=$_GET['txtcodigoppto'];					
	$txt_codigo_periodo=$_GET['txtperiodocampo'];					
	
	if (isset($_SESSION["ingresando_obj"]))
	{		
		$acceso=permisosdb($presupuesto);							
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{
			conectardb($presupuesto);
			$nombre_usuario=$_SESSION["user_name"];																		
			session_unregister("ingresando_obj");																																						
			// Grabar el detalle del presupuesto cuatrimestral			
					
				//$codigo=trim($bien);
				$qry_consulta_codigo="select * from cat_renglon where codigo='$bien'";
				//echo $qry_consulta_codigo;
				$res_qry_consulta_codigo=$query($qry_consulta_codigo);
				while($row_qry_codigo=$fetch_array($res_qry_consulta_codigo))					
				{					
					$codigo_renglon=$row_qry_codigo["codigo_renglon"];
				}
								
				$qry_presupuesto_cuatrimestral="insert into tb_presupuesto_det(codigo_presupuesto_anual, 				codigo_renglon,comprometido_mes1,comprometido_mes2,comprometido_mes3,comprometido_mes4,devengado_mes1,devengado_mes2,devengado_mes3,devengado_mes4,justificacion,activo,codigo_periodo) values ($txt_codigo_presupuesto_anual, $codigo_renglon, $cmes1, $cmes2, $cmes3, $cmes4, $dmes1, $dmes2, $dmes3, $dmes4, '$justificacion', 1, $txt_codigo_periodo)";										
				$res_cuatrimestral=$query($qry_presupuesto_cuatrimestral);				
				
				

		}
	}
	/////////// fin del detalle
						
	?>            
	