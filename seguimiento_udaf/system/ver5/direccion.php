<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bitacora));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
	$dbms->sql="select codigo_dependencia, nombre_dependencia from dependencia = ".$_REQUEST['Id']." order by nombre_dependencia"; 
?>
<select name="iddireccion"  id="iddireccion" onChange="javascript:cargarCombo('usuario.php', 'codigo_dependencia, 'Div_usuario')"> 
<? 
	$dbms->Query(); 
	print "<option value=\"0\">- Seleccione -</option>"; 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["codigo_dependencia"]."\">".$Fields["nombre_dependencia"]."</option>"; 
	}
?> 
</select>