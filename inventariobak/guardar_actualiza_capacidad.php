<?
//session_start();
	require_once('helpdesk.php');  
include("conectarse.php");



$codi1 = $_GET['codigo'];


	
?>

<!DOCTYPE html>
<html>
<head>
<met a http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
</head>

<body>

<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario

 $usuario = $_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");







			$SQL= "UPDATE cat_capacidad set  capacidad = '$capacidad'
				 
				 WHERE id_capacidad = ".$_POST['codigo'];
//print $SQL;

			$result = mssql_query($SQL);

	
		


					






		print $sql;


cambiar_ventana('consulta_capacidad.php');
			
?>


</body>
</html>
