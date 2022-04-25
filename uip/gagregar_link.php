<?
	session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<style type="text/css">
<!--
.Estilo2 {font-size: large}
.Estilo3 {color: #FF0000; font-size: xx-large}
-->
</style>
<?
	if (isset($_SESSION["ingresando_solicitud"]))
	{			
		$ip=$_SERVER['REMOTE_ADDR'];
		$nombre_usuario=($_SESSION["user_name"]);	
		conectardb($uipadmin);
		$query1 = "insert into uip_contenido (codigo_inciso, codigo_grupo, tipo, vinculo, titulo, usuario_creo, fecha_creado, ip, activo)
					values ('$txt_inciso','$txt_grupo', 1, '$txt_vinculo', '$txt_titulo', '$nombre_usuario', getdate(), '$ip', 2)";
		$result=$query($query1);		
		session_unregister("ingresando_solicitud");	
	}
?>
<br>
  <?
  if ($result)
  {
  		echo '<br><br>';
		echo '<table width="90%" border="0" align="center">';				
		echo '<tr><td  align="center">¡EL NUEVO ENLACE HA QUEDADO GRABADO!</td></tr>';
		echo '<tr><td  align="center">&nbsp; </td></tr>';
		echo '</table>';
  }
  else
	{
		echo '<br><br>';
		echo '<table width="90%" border="0" align="center">';				
		echo '<tr><td  align="center">¡EL NUEVO ENLACE YA SE ENCUENTRA ALMACENADO!</td></tr>';
		echo '<tr><td  align="center">&nbsp; </td></tr>';		
		echo '</table>';
	}
  ?>

