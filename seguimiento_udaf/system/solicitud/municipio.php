<?
	require('../includes/cnn/inc_conexion.inc');
	require('../includes/cnn/cls_dbms.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	$dbms->sql="select idmunicipio,nombre from tbl_municipio where idorden = ".$_REQUEST['Id']." order by nombre"; 
?>
<select name="municipio"  id="municipio"> 
<? 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idmunicipio"]."\">".$Fields["nombre"]."</option>"; 
	}
?> 
</select>