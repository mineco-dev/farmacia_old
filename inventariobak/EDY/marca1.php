<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="catalogo_capacidad.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar al Menu ]</a>
		</td>
		<td align="right" >
		<!--a href="mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ Cerrar Sesión ]</a-->
		</td>

	</tr>
</table>

<p class="Estilo8 Estilo7"></p>
 <table  border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
		<td colspan="7"><div align="center"><span class="Estilo1 Estilo2">  """INGRESO DE MARCA"""  </span></div></td>
  </tr>
</table>


<? 
 if ($_POST['inserta'] == 1)
 {
/*		$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
		mssql_select_db("inventario",$conection);*/
		require_once('helpdesk.php');  
		include("conectarse.php");
//		echo	$codigo_grupo;
		$mar = $_POST['marca'];
		$usr = $_POST['usuario'];
		$consulta = "EXEC proc_add_marca @v_marca='$mar',  @v_codigo_usuario_creo='$usr'";		
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
//		envia_msg("Finaliza ejecucion");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
-->
</style>


</head>
<body>
<form action="marca1.php" name="form1" method="post">
<table align="center">
<tr>
<!--td align="right"><span class="Estilo4">
Usuario
</span></td-->
<td>
<input type="hidden" name="usuario" value="1">
</td>
</tr>
<tr>
<td align="right"><span class="Estilo4">
Marca
</span></td>
<td>

<input type="text" name="marca">
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
<input type="submit" name="submit" class="Estilo4" value="Agregar">
</td>
</tr>

</table>
</form>
</body>
</html>