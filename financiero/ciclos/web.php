<!-- Manual de PHP de WebEstilo.com --> 
<html> 
<head> 
   <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title> 
</head> 
<body> 
<H1>Ejemplo de procesado de formularios</H1> 
Introduzca su nombre: 
<FORM ACTION="web.php" METHOD="GET"> 
<INPUT TYPE="text" NAME="nombre"><BR> 
<INPUT TYPE="submit" VALUE="Enviar"> 
</FORM> 

<?php
if ( isset($_GET['nombre']) )
	{
          echo "El Valor es ".$_GET['nombre']; 
	}
?>
</body> 
</html> 