<?
	include('../includes/inc_header_sistema.inc'); 
	require_once('../includes/conectarse.php');
	/*$dbms=new DBMS($conexion); */
	$IdActividad = $_REQUEST['Id']; 
	
	$sql = "select codigo_departamento from tb_registro where codigo_registro =$IdActividad";
	$result = mssql_query($sql);
	$res = mssql_fetch_array($result);
	$cdepartamento = $res['codigo_departamento']; 
	
?> 
<label for="SubActividad"></label> 
<select name="idgrupo"  id="SubActividades"  class="TituloMedios"> 
<? 

$sql = "select codigo_municipio, nombre_municipio from tb_municipio where codigo_departamento =$cdepartamento";
			$result = mssql_query($sql);
			while ($res = mssql_fetch_array($result))
			  { 
			  	
				?>
					<option value="<? echo $res['codigo_municipio']; ?>" selected><? echo caracteres_html($res['nombre_municipio']); ?></option>
				
					

			<? } ?>

<?
/*
	$dbms->sql="select codigo_municipio,nombre_municipio from tb_municipio where codigo_departamento = $IdActividad"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["codigo_municipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
	}*/
?> 
</select>
