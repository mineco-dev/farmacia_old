<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?

	require('../../includes/cnn/inc_conexion.inc');
	require('../../includes/cnn/cls_dbms.inc');
	$dbms=new DBMS($conexion);
	$dbms->bdd=$database_cnn;
	$dbms->sql="select idusuario,nombre1 
				from tbl_usuario 
				where len(nombre1) > 0 and iddireccion = ".$_REQUEST['Id'].
				" order by nombre1"; 
?>
<select name="idusuario"  id="idusuario"> 
<? 
	$dbms->Query(); 
	print "<option value=\"0\">- Seleccione -</option>"; 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idusuario"]."\">".$Fields["nombre1"]."</option>"; 
	}
?> 
</select>