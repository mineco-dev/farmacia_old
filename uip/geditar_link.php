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
		$query1 = "update uip_contenido set vinculo='$txt_vinculo', titulo='$txt_titulo', usuario_modifico='$nombre_usuario', fecha_modificado=getdate() where codigo_contenido='$txt_contenido'";				
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
		echo '<tr><td  align="center">¡SE HAN GRABADO LAS MODIFICACIONES!</td></tr>';
		echo '<tr><td  align="center">&nbsp; </td></tr>';
		echo '</table>';
  }
  else
	{
		echo '<br><br>';
		echo '<table width="90%" border="0" align="center">';				
		echo '<tr><td  align="center">¡SE HA PRODUCIDO UN ERROR AL INTENTAR GRABAR!</td></tr>';
		echo '<tr><td  align="center">&nbsp; </td></tr>';		
		echo '</table>';
	}
  ?>

