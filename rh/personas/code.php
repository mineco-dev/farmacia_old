<?

	include('conectarse.php');
	include('../includes/inc_header_sistema.inc');
	
	
	
	$h = mssql_query("select id_contratacion_gobierno,idasesor,sueldo,salario from tb_contratacion_gobierno");

	$punto = ".";
	$cadena = ",";
	$vacio = " ";
	
	while($r = mssql_fetch_row($h))
	{
		$auxiliar = $r[2];
		$code = $r[0];
		
		if($auxiliar[0]=='1' || $auxiliar[0]=='2' || $auxiliar[0]=='3' || $auxiliar[0]=='4' || $auxiliar[0]=='5' || $auxiliar[0]=='6' || $auxiliar[0]=='7' || $auxiliar[0]=='8' || $auxiliar[0]=='9')
		{

				$parser = strpos($auxiliar,$cadena);			

				if(!empty($parser))
				{
//					envia_msg($parser);				
					$valor = str_replace($cadena,$vacio,$auxiliar);
//					envia_msg($valor);
					$vector = split($vacio,$valor);
					$result = $vector[0].$vector[1];
				}else{
					
					$result = $auxiliar;
				}
				
				$parser = strpos($auxiliar,$punto);			
				if(!empty($parser))
				{
					$string = floatval($result);
				mssql_query("update tb_contratacion_gobierno set salario = '$string' where id_contratacion_gobierno = '$code'");

				}else{
					
					$string = intval($result);
				mssql_query("update tb_contratacion_gobierno set salario = '$string' where id_contratacion_gobierno = '$code'");
				}

				
				

				
				
		}else{
//			echo ' no se elmino nada  ' ;
		}
		
		echo "fin";
		
	}
	
	
	
	
?>