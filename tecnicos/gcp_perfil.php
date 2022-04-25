<?php
include("../restringir.php");
$grupo_id=17;	
// FIN DE VALIDACION
	$origen=$_REQUEST["cbo_usuario_origen"];
	$destino=$_REQUEST["cbo_usuario_destino"];
	require_once('../connection/helpdesk.php');
	$consulta = "DELETE FROM rol where codigo_usuario='$destino'";
	$result=$query($consulta);	
	$consulta2 = "SELECT * from rol where codigo_usuario='$origen'";
	$result2=$query($consulta2);	
	$i=1;
	while($row=$fetch_array($result2))
				{
					$codigo_grupo_enc[$i]=$row["codigo_grupo_enc"];
					$codigo_dependencia[$i]=$row["codigo_dependencia"];
					$permisos[$i]=$row["permisos"];
					$i++;					 					
				//	$ejecuta="EXEC proc_rol_add @vcodigo_usuario='$destino', @vcodigo_dependencia='$codigo_dependencia', @vcodigo_grupo_enc='$codigo_grupo_enc', @vcodigo_usuario_creo='$user_id'";
				//	$result2=$query($ejecuta);	
				}	
				//$i--;	
				
	for($i = 1; $permisos[$i]; $i++)
	{
		$ejecuta="insert into rol (codigo_usuario,codigo_grupo_enc,codigo_dependencia,codigo_usuario_creo,permisos) values($destino,$codigo_grupo_enc[$i],$codigo_dependencia[$i],998,$permisos[$i])";
		mssql_query($ejecuta);
		
	}
	print "<span>Proceso Finalizado</span>";
	mssql_close($s);
	include('transaccion_operada.php');
?>
