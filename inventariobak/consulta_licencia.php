<?php
session_start();
		require_once('helpdesk.php');  
		include("conectarse.php");

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

<html>
<head>

<link href="estilos.css" rel="stylesheet" type="text/css">

</head>

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





<body> 


<form method='post' action='consulta_licencia.php'> 
	
	<div align="center"><p class="Estilo69">
    <p class="Estilo69" colspan="20"> <span class="Estilo69"></span>Listado General de Tipos de Licencia </p>
<table width = '600' border = '0'>         
	<tr>
	<td>
	<div align="right">   <a href="pdf_licencia.php" class="Estilo69"> 

Exportar a  PDF <img src="imagenes/PDF3.JPG" width="25" border="0"> </a> </div>
</td>
	</tr>
</table>
	<?php 

$result = mssql_query("SELECT id_tipo_licencia, tipo_licencia FROM cat_tipo_licencia"); 
$i=0;
if ($row = mssql_fetch_array($result)){
  


 echo "<table width = '600' border = '0'> \n"; 

echo "<tr class='Estilo69'>
		<td width = '70' align= 'center'  bgcolor='#C9CDED' >Codigo </td>
		<td bgcolor='#99CCFF' align ='center'>Licencia</td><td  bgcolor='#C9CDED' align = 'center'>Editar</td>
	  </tr> \n"; 



   do {
	$cod = $row[0];
     //$codigo[ ] = $row["codigo_grado"];
     $numelentos = count($id_tipo_licencia);

     $chk[ ] = "chk$i";

 echo "<tr class='Estilo67'>
 			<td class= 'Estilofondocol2'  width = '70' align = 'center'>".$row["id_tipo_licencia"]."</td>
			<td  bgcolor='#99CCFF' width= '440' class= 'Estilofondocol'>"  .$row["tipo_licencia"]."</td>



			<td align = 'center' bgcolor='#C9CDED' class= 'Estilofondocol2'> 
			<a href=\"actualiza_licencia.php?codigo=$cod\">  <img src=\"imagenes/b_edit.PNG\"  width = '16' border='0'>  </a>
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
