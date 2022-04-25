<?
session_start();
include('conectarse.php');
$_SESSION['nivel']=1;



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
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
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
.Estilo71 {font-size: 18px}
-->
</style>


</head>

<body>

<!--form name="form1" method="post" action="catalogo_capacidad.php" onSubmit="return Verifica()"-->
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><p class="Estilo3"><span class="Estilo1 Estilo8">
      </span>CATALOGO DE TIPOS VARIOS </p></th>
    </tr>
  </table>
	
  <p class="Estilo8 Estilo7"></p>
  <table  border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2"> Elija tipo de Producto </span></div></td>
    </tr>

  <tr><Td><br></Td></tr>
  <tr class="Estilo1" >
    <td class="Estilo7" align="center" ><?
				 $cuatro = 4;
				//print $cuatro;
		print "<a href=tipo.php?pro=".$cuatro.">MEMORIA</a>";
		
		?>  <p></p></td>
  </tr>
  
  
  <tr class="Estilo1" >
    
    <td class="Estilo7" align="center">
	<?
				 $cuatro = 5;
				//print $cuatro;
		print "<a href=tipo.php?pro=".$cuatro.">DISCO DURO</a>"; ?>
	<p></p>
	</td>
  </tr>
  
  
<tr class="Estilo1" >

    <td class="Estilo7" align="center">
	<?
				 $cuatro = 6;
				//print $cuatro;
		print "<a href=tipo.php?pro=".$cuatro.">PROCESADOR</a>"; ?>
	
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
