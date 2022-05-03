<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<?
require_once('../connection/helpdesk.php');
$query = "EXEC proc_usuario_upd @vcodigo_usuario='$txt_codigo_usuario', @vapellidos='$txt_apellidos', @vnombres='$txt_nombres', @vnombre_usuario='$txt_usuario', @vcontrasena='$txt_contrasena', @vcodigo_dependencia='$cbo_dependencia', @vnivel='$txt_nivel', @vextension='$txt_extension', @vactivo='$cbo_activo'";
	mssql_query($query);
	mssql_close($s);
	include("transaccion_operada.php");
?>
