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
$query = "EXEC proc_mensaje_add @vcodigo_usuario_env='$user', @vcodigo_usuario_rec='$cbo_usuario', @vasunto='$txt_asunto', @vdescripcion='$txt_mensaje', @vip='$ip'";
$result=mssql_query($query);
mssql_close($s);	
?>
<table width="100%" border="0">
  <tr>
    <td width="100%">&nbsp;</td>
  </tr>
  <tr>
    <td><p align="center" class="Estilo2">&iexcl;Su mensaje ha  sido enviado con &eacute;xito! </p>
    </td>
  </tr>
</table>
