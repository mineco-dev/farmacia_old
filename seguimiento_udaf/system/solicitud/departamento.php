<?
	session_start();
	header('Content-Type: text/html; charset=iso-8859-1'); 
?>
<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bitacora));	
	$dbms->bdd=$database_cnn;
	$dbms->sql=" select * from bgestion where iddepto= ".$_REQUEST['Id']." order by nombre"; 
?>
<select name="idgestion"> 
<? 
	$dbms->Query(); 
	print "<option value=\"0\">- Seleccione -</option>"; 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idgestion"]."\">".$Fields["nombre"]."</option>"; 
	}
?> 
</select>