<title>Grabar Solicitud de Asistencia Técnica</title>
<style type="text/css">
<!--
.Estilo2 {font-size: large}
.Estilo3 {color: #FF0000; font-size: xx-large}
-->
</style>
<?
	$codigo_tecnico=3; // sin asignar, por default
	$codigo_estado=1;  // solicitado, por default
	$ip=$_SERVER['REMOTE_ADDR'];
require_once('../connection/helpdesk.php');
$query = "EXEC proc_soporte_add @vcodigo_usuario='$cbo_usuario', @vcodigo_tecnico='$codigo_tecnico', @vcodigo_categoria='$cbo_categoria', @vdetalle_solicita='$txt_detalle_solicita', @vcodigo_estado='$codigo_estado', @vip='$ip', @vcodigo_dependencia='$txt_codigo_dependencia', @vdescripcion='NA', @vfecha_seguimiento='NA'";
$result=mssql_query($query);
				while($row=mssql_fetch_array($result))
				{
                	$ticket=$row["ticket"];
				}	
	mssql_close($s);	
?>
<table width="100%" border="0">
  <tr>
    <td width="27%"><span class="Estilo2"><span class="Estilo4">No. de ticket asignado</span> --&gt; </span></td>
    <td width="73%"><span class="Estilo3">
	<?
		echo $ticket;
	?>
	</span></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p align="justify" class="Estilo2">Por favor apunte su n&uacute;mero de ticket ya que le servir&aacute; para darle seguimiento a su solicitud. </p>
    <p align="justify" class="Estilo2">En un momento le atenderemos...</p>    </td>
  </tr>
</table>
