<?
session_start();	
$_SESSION['folder'] = "";
//include('conectarse.php');
$_SESSION['nivel']=1;
include('valida.php');

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
.Estilo2 {
	color: #FFFFFF; 
	font-weight: bold;
	font-size: 16px;
}

.Estilo6 {color: #FF0000}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
.Estilo22 {font-size: 11px}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo46 {color: #666666; font-weight: bold;}
.Estilo47 {color: #000000}
.Estilo61 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
.Estilo64 {
	color: #000000;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFF00;
	font-weight: bold;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo3 {color: #FFFFFF; font-weight: bold; }
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
    <td align="center"><div align="center"><span class="Estilo1 Estilo2"><font color="#FFFFFF">SEGURIDAD EN INVENTARIO DE EQUIPO DE COMPUTO</font> </span></div></td>
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
			<img  align="top" src="imagenes/inventario.jpg">
  </td>
  </tr>
</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
