<? 
session_start();
include("conectarse.php");

$usr =   $_SESSION['idempleado'];
//$usr = 3;
$producto  = $_GET['pro'];

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


//print "aqui va el segundo cuatro";
//print $producto;
 if ($_POST['inserta'] == 1 and $_POST['pro'] == $prueba)
 {
		require_once('helpdesk.php');  
		
//		echo	$codigo_grupo;
		

		//$id_pro = $_POST['id_producto'];
		//$codpro = $_POST['producto'];	
		
		
		$producto  = $_GET['pro'];
		//print $producto;
		//print 'aqui es que viene';
		
		
   		$prod = $_POST['solu'];
		$cap = $_POST['capacidad'];
		//$usr = $_POST['usuario'];
		$consulta = "EXEC proc_add_capacidad @v_capacidad='$cap',  @v_codigo_usuario_creo='$usr',  @v_id_producto='$prod'";		
		//print $consulta;
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
		envia_msg('Se Ingreso exitosamente el registro');
		cambiar_ventana("catalogo_capacidad.php");
//		envia_msg("Finaliza ejecucion");


}


?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
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




<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">
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
  <tr>

<?   if ($_GET['pro'] == 4)
{
?>
	<tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">  INGRESO CAPACIDAD DE MEMORIA  </span></div></td>
    </tr>

    
	
<?
}
?>    

<?   if ($_GET['pro'] == 5)
{
?>
   <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">  INGRESO CAPACIDAD DE DISCO DURO  </span></div></td>
    </tr>
	
<?
}
?>    

<?   if ($_GET['pro'] == 6)
{
?>
    <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">  INGRESO CAPACIDAD DE PROCESADOR  </span></div></td>
    </tr>
	
<?
}
?>    

<?   if ($_GET['pro'] == 0)
{
?>
    <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">  INGRESE OTRO  </span></div></td>
    </tr>
	
<?
}
?>    

</table>
<form action="capacidad4.php" name="form1" method="post">
<table align="center" class="Estilo1 Estilo18" >
<tr>
<!--td align="right"><span class="Estilo9">
Usuario
</span></td-->
<td>
<input  type="hidden" name="usuario" value="1"><br>
</td>
</tr>
<tr>
<td align="right">
Capacidad
</td>
<td>
<input type="text" size="50" maxlength="50" name="capacidad">
</td>
</tr>
<tr>
<td>
<input  type="hidden" name="solu" value=" <?php echo $producto ?> ">
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
<input name="submit" type="submit" value="Agregar">
</td>
</tr>

</table>

</form>


</body>
</html>


