<?
	require('../../includes/cnn/inc_conexion.inc');
	require('../../includes/cnn/cls_dbms.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	$dbms->sql="select iddireccion,nombre from tbl_direccion where idviceministerio = ".$_REQUEST['Id']." order by nombre"; 
?>
<select name="iddireccion"  id="iddireccion" onChange="javascript:cargarCombo('usuario.php', 'iddireccion', 'Div_usuario')"> 
<? 
	$dbms->Query(); 
	print "<option value=\"0\">- Seleccione -</option>"; 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
	}
?> 
</select>