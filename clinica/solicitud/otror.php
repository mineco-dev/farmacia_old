<?
	require('../includes/inc_header.inc');
	
if ((intval($_REQUEST['Id'])==1)) /* si para otro registro */
{
?>
Registro
<select name="oregistro"  id="oregistro">
  <? 
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	$dbms->sql="select 
					id_dominio_registral,descripcion 
				from 
					tb_dominio_registral 
				order by descripcion"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["id_dominio_registral"]."\">".$Fields["descripcion"]."</option>"; 
	}
?>
</select>
<?
	}else
	{
	
	}
?>
