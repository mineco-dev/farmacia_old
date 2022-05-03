<?
	$grupo_id=5;	
	include("../restringir.php");		
?>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo2 {font-size: large}
.Estilo3 {color: #FF0000; font-size: xx-large}
-->
</style>
<?
require_once('../connection/helpdesk.php');
$ip=$_SERVER['REMOTE_ADDR'];
$query = "UPDATE mensaje set codigo_estado=3 where codigo_usuario_rec='$user' and codigo_mensaje='$id'";
$result=mssql_query($query);
mssql_close($s);
header("Location: lista_mensajes.php"); 
?>

