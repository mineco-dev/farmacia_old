<?
						$pass = md5($userpassword);
						require ('class/inc_conexion_sql_seguridad.inc');												
						$sql = mssql_query("select nombre_usuario,contrasena,codigo_usuario from usuario where nombre_usuario = '$username' and contrasena = '$pass'");																									
						if ($sql)
						{
							$row = mssql_fetch_row($sql);
							if(!empty($row[2]))
							{	session_start();						
								$_SESSION['nombre_usuario'] = $row[0];													
								$_SESSION['codigo_usuario'] = $row[0];													
								$_SESSION['seguridad'] = 1;																						
								header ('Location: marcos.php');											
							}else{
								header ('Location: error.php');
							}							
						}
?>