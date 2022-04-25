<title>Grabar Solicitud de Asistencia Técnica</title>
<style type="text/css">
<!--
.Estilo2 {font-size: large}
.Estilo3 {color: #FF0000; font-size: xx-large}
-->
</style>
<?
$cbo_categoria=$_REQUEST['cbo_categoria'];
if ($txt_codigo_dependencia==46) $cbo_categoria=87;
else $cbo_categoria=73;
$codigo_tecnico=3;
$codigo_estado=1;
require_once('../connection/helpdesk.php');
$ip=$_SERVER['REMOTE_ADDR'];
$query = "EXEC proc_soporte_add @vcodigo_usuario='$cbo_usuario', @vcodigo_tecnico='$codigo_tecnico', @vcodigo_categoria='$cbo_categoria', @vdetalle_solicita='$txt_detalle_solicita', @vcodigo_estado='$codigo_estado', @vip='$ip', @vcodigo_dependencia='$txt_codigo_dependencia', @vdescripcion='$txt_descripcion', @vfecha_seguimiento='$txt_fecha_seg'";
$result=mssql_query($query);				
mssql_close($s);	
header("Location: punto_nuevo.php");
?>
