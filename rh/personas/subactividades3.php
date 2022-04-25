<?
	include('../includes/inc_header_sistema.inc'); 
	require_once('../includes/conectarse.php');
	/*$dbms=new DBMS($conexion); */
	$IdActividad = $_REQUEST['idgrupo']; 
	
	$sql = "select codigo_departamento from tb_registro where codigo_registro =$IdActividad";
	$result = mssql_query($sql);
	$res = mssql_fetch_array($result);
	$cdepartamento = $res['codigo_departamento']; 
	
?> 
<label for="SubActividad2"></label> 
<select name="idgrupo2"  id="SubActividades2"  class="TituloMedios"> 
<? 

$sql = "select codigo_municipio, nombre_municipio from tb_municipio where codigo_departamento =$IdActividad";
			$result = mssql_query($sql);
			while ($res = mssql_fetch_array($result))
			  { 
			  	
				?>
					<option value="<? echo $res['codigo_municipio']; ?>" selected><? echo caracteres_html($res['nombre_municipio']); ?></option>
				
					

			<? } ?>

</select>
