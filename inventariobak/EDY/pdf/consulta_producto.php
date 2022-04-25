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
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
-->
</style> 







<body> 
<p>Bienvenido <? print 'Usuario: '.$_SESSION['user']; ?>
<?php //echo $row_Recordset1['nombre']; ?>!</p>

<form method='post' action='consulta_producto.php'> 
  <div align="center">
    <p class="Estilo1">Listado General de Productos</p>
    <p>      <?php 

$result = mssql_query("SELECT id_producto, descripcion FROM cat_producto"); 
$i=0;
if ($row = mssql_fetch_array($result)){
  


 echo "<table width = '925' border = '2'> \n"; 

   echo "<tr><td>Codigo Producto</td><td>Producto</td></tr> \n"; 
 




   do {
	$cod = $row[0];
     //$codigo[ ] = $row["codigo_grado"];
     $numelentos = count($id_producto);

     $chk[ ] = "chk$i";
     echo "<tr><td>".$row["id_producto"]."</td><td>"  .$row["descripcion"]."</td>



<td> 
			<a href=\"actualiza.php?codigo=$cod\">Modificar</a>
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

 <p>&nbsp;</p>
<div align="center">   <a href="menu_consultas.php?cmd=resetall" class="Estilo4"> 

MENU  </a>   </div>


 <p>&nbsp;</p>
<div align="center">   <a href="pdf_producto.php?cmd=resetall" class="Estilo4"> 

EXPORTAR A PDF  </a>   </div>


</body> 
</html>





