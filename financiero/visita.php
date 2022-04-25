<?
session_start();	
$_SESSION['folder'] = "";
include('conectarse.php');
$_SESSION['nivel']=1;
//include('valida.php');

  if (!$_SESSION['idempleado'] && $_SESSION['tipo'] != 'despacho')
  {
  	// header("location: welcome.php");

  }
?>

<style type="text/css">
<!--
.Estilo4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}

.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
-->
</style>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFF00;
	font-weight: bold;
	font-size: 16px;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
a:link {
	text-decoration: none;
	color: #666666;
}
a:visited {
	text-decoration: none;
	color: #000066;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
}
-->
</style>
<table border="0" width="100%" class="Estilo4 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<!--td align="right"  width="70%">
		<a href="../../visita.php"><img src="tareas.gif" width="16" height="16" border="0">Regresar al Menu</a>
		</td-->
		<td align="right" >
		<!--a href="mtlogin.php">[ Cerrar Sesión ]</a-->
		</td>

	</tr>
</table>

<table align="center">
	  <tr bgcolor="#0066CC">
    <td align="center"><div align="center"><span class="Estilo1 "><font color="#FFFFFF">CONTROL DE PRESUPUESTO </font></span> </div></td>
	</tr>
</table>
<table width="540" border="0" align="center">
  <tr>
    <td>
<script webstyle4>document.write('<scr'+'ipt src="xaramenu.js">'+'</scr'+'ipt>');document.write('<scr'+'ipt src="menuimagen/consultavisita.js">'+'</scr'+'ipt>');/*img src="menuimagen/Consultasvicedespacho.gif" moduleid="Default (Project)\Consultasvicedespacho_off.xws"*/</script></td>

  </tr>
</table>
<p align="center"><!--<form name="form1" method="post" action="">

<p><font size="6">
<a href="asignaactividad.php">Nuevo Calendario</marquee></a></font></p>

</form> -->
</p>
<p><font size="2">
</font></p>
<table  border="0" align="center">
  <tr bgcolor="#FFFFFF" align="center">
    <td width="188" height="201" valign="top" align="center" bgcolor="#FFFFFF"><p class="Estilo10">&nbsp;</p>
			<img  align="top" src="images/presupuestos.jpg">
  </td>
  </tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
