<title>Grabar Solicitud de Reservación del salón virtual</title>
<style type="text/css">
<!--
.Estilo2 {font-size: large}
.Estilo3 {color: #FF0000; font-size: xx-large}
-->
</style>
<?
	session_start();	
	$cbo_usuario=($_SESSION["cbo_usuario"]);	 	
	$comentario=($_SESSION["detalle"]);  
	$codigo_tecnico=3;
	$codigo_estado=1;
	$cbo_categoria=10;
	require_once('../connection/helpdesk.php');
	$ip=$_SERVER['REMOTE_ADDR'];
	$query = "EXEC proc_soporte_add @vcodigo_usuario='$cbo_usuario', @vcodigo_tecnico='$codigo_tecnico', @vcodigo_categoria='$cbo_categoria', @vdetalle_solicita='$txt_detalle_solicita', @vcodigo_estado='$codigo_estado', @vip='$ip'";
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
<?

	if (isset($_SESSION['solicitante'])) 
	{
		session_unregister('solicitante');	
		session_unregister('salon');	
		session_unregister('dia');	
		session_unregister('mes');	
		session_unregister('anio');	
		session_unregister('inicia');	
		session_unregister('finaliza');	
		session_unregister('detalle_solicita');	
	}		
?>