<?
	require('../includes/inc_header.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	$dbms->sql="select codigo_municipio,nombre_municipio from tb_municipio where codigo_departamento = ".$_REQUEST['Id']." order by nombre_municipio"; 
?>
<select name="municipio"  id="municipio"> 
<? 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["codigo_municipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
	}
?> 
</select>