<?
session_start();
include("conectarse.php");
$usr =   $_SESSION['idempleado'];

if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}
 if ($_POST['inserta'] == 1)
 {
/*		$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
		mssql_select_db("inventario",$conection);*/
		require_once('helpdesk.php');  
		
//		echo	$codigo_grupo;
		$dispo = $_POST['tipo_dispositivo'];
		//$usr = $_POST['usuario'];
		$consulta = "EXEC proc_add_dispositivo @v_tipo_dispositivo='$dispo',  @v_codigo_usuario_creo='$usr'";		
		$result=$query($consulta);
		$close($s);		
		session_write_close();
		envia_msg('Se Ingreso exitosamente el Dispositivo');	
					//cambiar_ventana('dispositivo.php');


//		envia_msg("Finaliza ejecucion");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
a:link {
	color: #999999;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
.Estilo4 {color: #FF0000}
.Estilo9 {color: #000000}
-->
</style>

</head>
<body>
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Inicio ]</a>
		</td>
	</tr>
</table>

 <table  border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
		<td><div align="center"><span class="Estilo1 Estilo2">  INGRESO DE DISPOSITIVO  </span></div></td>
  </tr>
</table>
<form action="dispositivo.php" name="form1" method="post">
<table align="center" class="Estilo1 Estilo18">
<tr>
<!--td align="right"><span class="Estilo4">
Usuario
</span></td-->
<td>
<input type="hidden" name="usuario" value="1">
</td>
</tr>
<tr>
<td align="right">Tipo Dispositivo</td>
<td>
<input type="text" size="30" maxlength="50" name="tipo_dispositivo">
</td>
</tr>
<tr>
<td>
<input type="hidden" name="inserta" value="1">
</td>
</tr>
</table>

<table align="center">
<tr>
<td align="center">
<input type="submit" name="submit" value="Agregar">
</td>
</tr>

</table>
</form>
</body>
</html>