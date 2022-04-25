<?php

include('../includes/inc_header_sistema.inc');

$origen = mssql_query("select idasesor,convert(varchar,fecha_ingreso,112),reglon,partida,sueldo,id_puesto,iddireccion from asesor");



	while($vorigen = mssql_fetch_array($origen))
	{
	
	print $vorigen[1];
	
	
 	  for($i=0;$i<7;$i++)
		{
			if (empty($vorigen[$i]) && ($i==0))
			{
				$idasesor = ' ';				
			}else{
				$idasesor = $vorigen[0];				
			}									
			
			if (empty($vorigen[$i]) && ($i==1))
			{
				$fecha_ingreso = '0000-00-00 00:00:00.000';				
			}else{
				$fecha_ingreso = $vorigen[1];				
			}									
			
			if (empty($vorigen[$i]) && ($i==2))
			{
				$renglon = '.';				
			}else{
				$renglon = $vorigen[2];				
			}									
			
			if (empty($vorigen[$i]) && ($i==3))
			{
				$partida = '.';				
			}else{
				$partida = $vorigen[3];				
			}									
			
			if (empty($vorigen[$i]) && ($i==4))
			{
				$sueldo = 0;				
			}else{
				$sueldo = $vorigen[4];				
			}									
			
			if (empty($vorigen[$i]) && ($i==5))
			{
				$puesto = 1;				
			}else{
				$puesto = $vorigen[5];				
			}									
			
			
			if (empty($vorigen[$i]) && ($i==6))
			{
				$entidad_gobierno = 0;				
			}else{
				$entidad_gobierno = $vorigen[6];				
			}									
						
			$i++;			
		}   
				
mssql_query("insert into tb_contratacion_gobierno(idasesor,renglon,partida,sueldo,oficial,puesto,entidad_gobierno,fecha_ingreso) values ('$idasesor','$renglon','$partida','$sueldo','1','$puesto','$entidad_gobierno','$fecha_ingreso')");
						
	}
?>