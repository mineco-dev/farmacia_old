<html>
<head>
<meta http-equiv="Content-Type" content="image/jpg;">
</head>
<body>
<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="get" > 
file
  <input type="file" name="imagen" />
<input type="submit" name="submit" value="Ingresar Imágen"/>
</form>
</body>
</html>





<?php 
//CONEXIÓN a la base de datos 
//header("Content-type: image/jpeg");
//header("Content-type: image/gif");
					
					require ('../class/conexion.inc');
					$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
					mysql_select_db($BASE_DATOS,$db);
					$fecha= date("Y-m-d");
					
					
					$image = imagecreatefromjpeg($imagen); 
					ob_start(); 
					imagejpeg($image); 
					$jpg = ob_get_contents(); 
					ob_end_clean(); 
					
					$jpg = str_replace('##','##',mysql_escape_string($jpg));
					$result = mysql_query("INSERT INTO photos SET imagen='$jpg'");
					
					
					
						$result = mysql_query("SELECT max(id_banner) FROM photos ");
						$result_array = mysql_fetch_array($result);
						
						$result1 = mysql_query("SELECT imagen FROM photos WHERE '$result_array[0]'");
						$result_array1 = mysql_fetch_array($result1);
						
						echo $result_array1[0];
					
					
				mysql_close($db);	
					
					
?> 

