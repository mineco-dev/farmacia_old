<? 
session_start();
include("conectarse.php");
$usr =   $_SESSION['idempleado'];
//$usr = 4;

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

 if ($_POST['inserta'] == 1)
 {
/*		$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
		mssql_select_db("inventario",$conection);*/
		require_once('helpdesk.php');  
		
//		echo	$codigo_grupo;
		$ni = $_POST['nit'];
		$prove = $_POST['proveedor'];
		$dire = $_POST['direccion'];
		$tel = $_POST['telefono'];
		$ema = $_POST['email'];
		$usr = $_POST['usuario'];
		$consulta = "EXEC proc_add_proveedor @v_nit='$ni',  @v_proveedor='$prove', @v_direccion='$dire', @v_telefono='$tel', @v_email='$ema',       @v_codigo_usuario_creo='$usr'";		
		$result=$query($consulta);	
		$close($s);		
		session_write_close();
//		envia_msg("Finaliza ejecucion");

//print $consulta;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.nit1.value == "")
  { alert("Por favor ingrese su Nit"); form.nit1.focus(); return; }
  if (form.proveedor.value == "")
  { alert("Por favor ingrese un proveedor"); form.proveedor.focus(); return; }
  if (form.direccion.value == "")
  { alert("Por favor ingrese Direccion"); form.direccion.focus(); return; }
  if (form.telefono.value == "")
  { alert("Por favor ingrese Telefono"); form.codigo_grado.focus(); return; }
  
   
if (confirm('�Esta seguro de guardar estos datos?')){ 
    //  document.form.submit() 
		form.submit();
   		} 

}
</script>

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
		<td><div align="center"><span class="Estilo1 Estilo2">INGRESO DE PROVEEDOR</span></div></td>
  </tr>
</table>

<form action="guardar_proveedor.php" name="form1" method="post">
<table align="center" class="Estilo69">
<tr>
<!--td align="right"><span class="Estilo4">
Usuario
</span></td-->
<td>
<input type="hidden" name="usuario" value="1">
</td>
</tr>
<tr class="Estilo1">
<td align="right"><span class="Estilo69">
Nit
</span></td>
<td>

<input type="text" name="nit1" maxlength="10">
</td>
</tr>

<tr class="Estilo1">
<td align="right"><span class="Estilo69">
Proveedor
</span></td>
<td>

<input type="text" name="proveedor" maxlength="100" size="50">
</td>
</tr>

<tr class="Estilo1">
<td align="right"><span class="Estilo9">
Direccion
</span></td>
<td>

<input type="text" name="direccion" maxlength="100" size="75">
</td>
</tr>

<tr class="Estilo1">
<td align="right"><span class="Estilo9">
Telefono
</span></td>
<td>

<input type="text" name="telefono" maxlength="50">
</td>
</tr>

<tr class="Estilo1">
<td align="right"><span class="Estilo9">
Email
</span></td>
<td>

<input type="text" name="email" maxlength="100">
</td>
</tr>



<tr class="Estilo1">
<td>
<input type="hidden" name="inserta" value="1">
</td>
</tr>
</table>

<table align="center">
<tr>
<td align="center">
<!--input type="submit" name="submit" class="Estilo4" value="Agregar"-->

<input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Guardar" >
</td>
</tr>

</table>
</form>
</body>
</html>