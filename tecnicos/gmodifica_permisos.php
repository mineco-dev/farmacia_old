<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo2 {font-size: large}
.Estilo3 {color: #FF0000; font-size: xx-large}
-->
</style>
<?
$codigo_tecnico=3;
require_once('../connection/helpdesk.php');
$query = "UPDATE usuario set codigo_grupo_enc='$cbo_perfil' WHERE codigo_usuario='$cbo_usuario'";
$result=mssql_query($query);
mssql_close($s);	
include('transaccion_operada.php');
?>


