<? 
session_start();
$renglon = $_POST["element_4"]; 
$dependencia = $_POST["$p"]; 
$salario=$_POST["element_1_1"];
$mes=$_POST["delement_6"];
$anio=$_POST["element_7"];
$nombre = $_POST["element_2_1"]; 
$apellido = $_POST["element_2_2"]; 
$nombre = $_POST["element_2_1"]; 

//datos del archivo 
	$nombre_usuario=($_SESSION["user_name"]);
	$nombre_archivo = $HTTP_POST_FILES['element_3']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];    
	require_once('../../connection/helpdesk.php');
	if ($nombre_archivo!="")
	{
		$tipo_archivo = $HTTP_POST_FILES['element_3']['type']; 
		$extension = split('[.]',$nombre_archivo);
		$extension = $extension[sizeof($extension)-1];		
		$tamano_archivo = $HTTP_POST_FILES['element_3']['size']; 		
		//compruebo si las características del archivo son las que deseo 
		/* voy a comentar esto para permitir cualquier tipo de archivos
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 25024000))) 
		{ 
			echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (25 MB) máximo.</td></tr></table>"; 
		}
		else
		{ hasta aqui comente */
			//el nombre del archivo será el codigo_archivo según la tabla publicación mas la extensión			
		   $query="SELECT MAX(id_contrato) as ultimo_archivo from informes_personal";
		   $result=mssql_query($query);
	       while($row=mssql_fetch_array($result))
			{
               	$codigo_archivo=$row["ultimo_archivo"]+1;
			}			
		   $nombre_archivo_def=$codigo_archivo.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['element_3']['tmp_name'], "rh/informes/informes/".$nombre_archivo_def))
			{ 
			   echo "El archivo ha sido cargado correctamente."; 						   
			   $query = "insert into informes_personal
(renglon, id_direccion, salario, mes, año, nombres, apellidos, dir_informe,ip,usuario_creo,fecha_creo)
values 
('$renglon', '$dependencia', '$salario', '$mes', '$anio', '$nombre', '$apellido','$nombre_archivo_def', '$ip', '$nombre_usuario', getdate())";
    		   $result=mssql_query($query);
	   		 //  header("Location: publicacion.php"); 
			}
			else
			{ 
			   echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
			} 
		//} descomentar esta llave cuando descomente el bloque anterior.
	}
	else
	{		
		$nombre_archivo_def="NA";  // NA= No aplica
		$query = "insert into informes_personal
(renglon, id_direccion, salario, mes, año, nombres, apellidos, dir_informe,ip,usuario_creo,fecha_creo)
values 
('$renglon', '$dependencia', '$salario', '$mes', '$anio', '$nombre', '$apellido','$nombre_archivo_def', '$ip', '$nombre_usuario', getdate())";
    	$result=mssql_query($query);
		//header("Location: publicacion.php"); 
	}
	mssql_close($s);	
	




?>

