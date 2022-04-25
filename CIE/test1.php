<?
	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
int</head>
<body>
<?

	print "hola";

	$dbms->sql="select nombre1,nombre2,apellido1,apellido2 from usuario"; 
	$dbms->Query(); 
	print $dbms->rowcount;
	while($Fields=$dbms->MoveNext()) 
	{
		print $Fields["nombre1"]." ".$Fields["nombre2"]."<br>"; 
	}

?>
</body>
</html>
