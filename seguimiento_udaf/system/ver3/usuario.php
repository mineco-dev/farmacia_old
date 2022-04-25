<?
	session_start();
?>
<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bitacora2));	
	$dbms->bdd=$database_cnn;
	$dbms->sql="select u.codigo_usuario, (u.nombres+ ''+ u.apellidos) as nombre, u.e_mail from usuario u 
				inner join dependencia d on u.codigo_dependencia=d.codigo_dependencia
				where u.codigo_usuario is not null and u.activo=1 and d.codigo_dependencia= ".$_REQUEST['Id']." order by nombre"; 
?>
<select name="idusuario"> 
<? 
	$dbms->Query(); 
	print "<option value=\"0\">- Seleccione -</option>"; 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["codigo_usuario"]."\">".$Fields["nombre"]."</option>"; 
	}
?> 
</select>