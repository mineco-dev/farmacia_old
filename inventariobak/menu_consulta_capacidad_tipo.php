<?
session_start();
include('conectarse.php');
$_SESSION['nivel']=1;

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

?>

<table border="0" width="100%" class="Estilo69">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Inicio ]</a>
		</td>
		

	</tr>
</table>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="estilos.css" rel="stylesheet" type="text/css">


</head>

<body>

<!--form name="form1" method="post" action="catalogo_capacidad.php" onSubmit="return Verifica()"-->
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><p class="Estilo69"><span class="Estilo69">
      </span>CONSULTA TIPOS VARIOS </p></th>
    </tr>
  </table>
	
  <p class="Estilo69"></p>
  <table  border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo69"> Elija tipo de Producto </span></div></td>
    </tr>

  <tr><Td><br></Td></tr>
  <tr class="Estilo69" >
    <td class="Estilo69" align="center" ><?
				 $cuatro = 4;
				//print $cuatro;
		print "<a href=consulta_tipos_varios.php?pro=".$cuatro.">MEMORIA</a>";
		
		?>  <p></p></td>
  </tr>
  
  
  <tr class="Estilo69" >
    
    <td class="Estilo69" align="center">
	<?
				 $cuatro = 5;
				//print $cuatro;
		print "<a href=consulta_tipos_varios.php?pro=".$cuatro.">DISCO DURO</a>"; ?>
	<p></p>
	</td>
  </tr>
  
  
<tr class="Estilo69" >

    <td class="Estilo69" align="center">
	<?
				 $cuatro = 6;
				//print $cuatro;
		print "<a href=consulta_tipos_varios.php?pro=".$cuatro.">PROCESADOR</a>"; ?>
	
	</td>
  </tr>  
  
  <td width="25%">
		<? /*
				 $cuatro = 5;
				print $cuatro;
		print "<a href=capacidad2.php?paramas=".$cuatro.">prueba</a>";
		*/
		?>
	</td>
  
<!--input name="inserta" type="hidden" size="1" value="1"-->

</table>
<table width="77%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    
</table>
<!--/form-->


</body>
</html>
