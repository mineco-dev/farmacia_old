<?
	include('inc_header.inc');
	$dbms=new DBMS($conexion); 
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?
	$dbms->sql="select nombre1,nombre2,apellido1,apellido2 from usuario"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print $Fields["nombre1"]." ".$Fields["nombre2"]."<br>"; 
	}
?>
</body>
</html>
