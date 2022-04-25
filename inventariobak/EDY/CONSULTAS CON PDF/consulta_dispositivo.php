<?php

//session_start();
		require_once('helpdesk.php');  
		include("conectarse.php");

?>

<html>
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {
	color: #FF0000;
	font-size: 14pt;
}
body,td,th {
	color: #0000CC;
}
-->
</style> 

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





<body> 


<form method='post' action='consulta_dispositivo.php'> 
  <div align="center">
    <p class="Estilo1">Listado General de Tipos de Dispositivos</p>
	
<table width = '925' border = '0'>         
	<tr>
	<td>
	<div align="right">   <a href="pdf_tipo.php" class="Estilo4"> 

Exportar a  PDF <img src="imagenes/PDF3.JPEG" width="20" border="0"> </a> </div>
</td>
	</tr>
</table>
	<?php 

$result = mssql_query("SELECT id_tipo_dispositivo, tipo_dispositivo FROM cat_tipo_dispositivo"); 
$i=0;
if ($row = mssql_fetch_array($result)){
  


 echo "<table width = '925' border = '2'> \n"; 

   echo "<tr><td width = '180'>Codigo Dispositivo</td><td>Dispositivo</td></tr> \n"; 
 




   do {
	$cod = $row[0];
     //$codigo[ ] = $row["codigo_grado"];
     $numelentos = count($id_tipo_dispositivo);

     $chk[ ] = "chk$i";
     echo "<tr><td>".$row["id_tipo_dispositivo"]."</td><td>"  .$row["tipo_dispositivo"]."</td>



<td> 
			<a href=\"actualiza.php?codigo=$cod\">  <img src=\"imagenes/b_edit.PNG\"  width = '16' border='0'>  </a>
			</td>
			


			</tr> \n"; 

        $i++;
     } while ($row = mssql_fetch_array($result));


   echo "</table> \n";
   



} else { 
echo "¡ No se ha encontrado ningún registro !"; 
}

?> 





    <p>  </div>
</form>  







</body> 
</html>





