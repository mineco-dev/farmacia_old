<? 
session_start();
include("conectarse.php");
include('includes/inc_header.inc');
$dbms=new DBMS($conexion);
$dbms->bdd=$database_cnn;

 if ($_POST['inserta'] == 1)
 {
		include('includes/inc_header.inc');
		
		$nombre_banco = $_POST['nombre_banco'];
		  
$result = mysql_query("insert into tb_banco (nombre_banco, usuario_creo, fecha_creado) values ('$nombre_banco', 'EDY', now() )",$conexion);
		
		session_write_close();
}

if ($_POST['inserta'] == 2)
 {
		include('includes/inc_header.inc');

		$bancoss = $_POST['codigo'];		
		$bancoe = $_POST['nombre_banco'];		
		$bancoes = $_POST['variable'];
	
		$result = mysql_query("UPDATE tb_banco set nombre_banco ='$bancoe', usuario_modifico='ROBERTOooo', fecha_modificado= now() where codigo_banco = '$bancoes'",$conexion);
				
		session_write_close();
} 
				 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<script language="JavaScript" type="text/javascript">
<!--
function PopWindow()
{
window.open('agrega_persona.php','prueba','width=750,height=475,menubar=no,scrollbars=no,toolbar=no,location=no,directories=no,resizable=no,top=10,left=20');
}
//-->
</script>


<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.nombre_banco.value == "")
  { alert("Por favor ingrese Banco"); form.nombre_banco.focus(); return; }
   
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
		<td><div align="center"><span class="Estilo1 Estilo2">INGRESO DE BANCO</span></div></td>
  </tr>
</table>

<form action="banco.php" name="form1" method="post" >
<table align="center" class="Estilo69">
<tr>
<!--td align="right"><span class="Estilo4">
Usuario
</span></td-->
<td>
<input type="hidden" name="usuario" value="1">
</td>
</tr>
<tr>
<td>

<?
$nose = $_POST['si'];
$codi = $_GET['codigo'];

$dbms->sql="SELECT codigo_banco, nombre_banco FROM tb_banco where codigo_banco = '$_GET[codigo]'"; 
$dbms->Query();
while($Fields=$dbms->MoveNext())
				{
$nombre_banco = $Fields['nombre_banco'];
}
?>

<?
$codiii = 0;
//$codiii = $codii;
if ($codiii == $_GET[codigo])
{
?>
BANCO
<input type="text" name="nombre_banco" maxlength="50"  size="25" onKeyUp="javascript:this.value=this.value.toUpperCase();">
<?
}
else//if ($codiii ==  $_GET[codigo]) 
{
?>
BANCO
<input type="text" name="nombre_banco" maxlength="50" size="25" value="<? echo $nombre_banco; //$Fields['pais']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" >
<?
}
?>
</td>
</tr>
<tr class="Estilo1">
<td>
<?
$codiii = 0;
if ($codiii == $_GET[codigo])
{
?>
<input type="hidden" name="inserta" value="1">
<?
}
else
{
?>
<input type="hidden" name="inserta" value="2">
<?
}
?>
</td>
</tr>
</table>
<table align="center">
<tr>
<td align="center">
<!--input type="submit" name="submit" class="Estilo4" value="Agregar"-->
<?
$codiii = 0;
if ($codiii == $_GET[codigo])
{
?>
<input name="cmd_guardar" type="button" onClick="Validar(this.form)" id="cmd_guardar" value="Guardar" >
<?
}
else
{
?>
<input  type="hidden" name="variable"  value="<?php echo $_GET[codigo]; ?>">
<input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Actualizar" >
<?
}
?>
</td>
</tr>
</table>
<?php 
$dbms->sql="SELECT codigo_banco, nombre_banco FROM tb_banco"; 
$dbms->Query();
$i=0;		
				if ($Fields=$dbms->MoveNext())
				{
									 
	?>
<table width = '420' border = '0' align="center">
<tr class='Estilo69'>
<td width = '280' bgcolor='#C9CDED' align = 'center'><strong>Banco</strong></td>
<td bgcolor='#99CCFF' align = 'center'><strong>Editar</strong></td>
</tr>
<? do {
	$cod = $Fields['codigo_banco'];
	 $numelentos = count($codigo_banco);
	 
	  $chk[ ] = "chk$i"; 
?>
<tr class='Estilo67' >
	 <td bgcolor='#C9CDED'> 
	 
	 <? echo $Fields['nombre_banco'];
	 ?>
</td>
<td align = 'center' bgcolor='#99CCFF' class= 'Estilofondocol2'>  
			
			<? 
			echo " 
			<a href=\"banco.php?codigo=$cod\">  <img src=\"imagenes/b_edit.PNG\"  width = '16' border='0'>  </a>
			\n"; 
			
			?>
					
	  </td>
</td>
</tr>
	 <?
	 			 $i++;
     } while($Fields=$dbms->MoveNext())
	  
?>
</table>
<? return $Fields;
 }
?>
</form>
</body>
</html>