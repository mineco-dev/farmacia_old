<?
//session_start();
	//require_once('helpdesk.php');  
	include('INCLUDES/inc_header.inc');
include("conectarse.php");

$codi1 = $_GET['codigo'];
	
?>

<!DOCTYPE html>
<html>
<head>
<met a http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario

 $usuario = $_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");

			$SQL= "UPDATE renglon set  renglon = '$_POST[renglon]'
				 
				 WHERE id_renglon = ".$_POST['codigo'];
//print $SQL;

			$result = mssql_query($SQL);

//		print $SQL;


cambiar_ventana('renglon.php');
			
?>


</body>
</html>