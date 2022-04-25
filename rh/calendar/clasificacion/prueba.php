<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body><? 

$usuario = $_GET['login'];
$password = $_GET['clave'];

/*print $usuario;
print "</br>";
print $password;*/

 if (!($link=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("rgm",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
 $result=mysql_query("select usuario,login,clave from tb_verificadores where login = '$usuario' and clave = '$password'",$link);	

						
						if ($result)
						{
							$row = mysql_fetch_row($result);
																	
							if(!empty($row[0]))
							{
								
										setcookie('usuario1',$row[0]);
										setcookie('login1',$row[1]);
										setcookie('seguridad1',1);
										
										header ('Location: repdoctos.php');
							
							}else{
										header ('Location: ../error.php');

							}
							
						}
						mysql_close($link);
?>


</body>
</html>
