<?	
//$grupo_id=45;
//include("../../restringir.php");	
?>
<? 
//tomo el valor de un elemento de tipo texto del formulario 
$titulo = $_POST["titulo"]; 
$descripcion = $_POST["descripcion"]; 
$fecha= $_POST["fecha"];
$link1= $_POST["link1"];
$link2=$_POST["link2"];
$fecha= $_POST["fecha"];
//$tipo_publicacion=2; 
//datos del archivo 
	$nombre_archivo = $HTTP_POST_FILES['imagen']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];    
	require_once('../connection/helpdesk.php');
	if ($nombre_archivo!="")
	{
		$tipo_archivo = $HTTP_POST_FILES['imagen']['type']; 
		$extension = split('[.]',$nombre_archivo);
		$extension = $extension[sizeof($extension)-1];		
		$tamano_archivo = $HTTP_POST_FILES['imagen']['size']; 		
		//compruebo si las características del archivo son las que deseo 
	 //voy a comentar esto para permitir cualquier tipo de archivos
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 5242880))) 
		{ 
			echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (5 MB) máximo.</td></tr></table>"; 
		}
		else
		{  //hasta aqui comente 
			//el nombre del archivo será el codigo_archivo según la tabla publicación mas la extensión			
		   $query="SELECT MAX(codigo_imagen) as ultimo_archivo from comsocial_imagenes";
		   $result=mssql_query($query);
	       while($row=mssql_fetch_array($result))
			{
               	$codigo_archivo=$row["ultimo_archivo"]+1;
			}			
		   $nombre_archivo_def=$codigo_imagen.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['imagen']['tmp_name'], "comunicacion/img_notas/".$nombre_archivo_def))
			{ 
			   echo "El archivo ha sido cargado correctamente."; 						   
			   $query = "insert into comsocial_notas (titulo, descripcion, imagen, fecha, activo,usuario_creo,fecha_creo) 			  	values('$titulo','$descripcion','$nombre_archivo_def','$fecha','2'$usuario_creo', getdate())";
    		   $result=mssql_query($query);
	   		 //  header("Location: publicacion.php"); 
			}
			else
			{ 
			   echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
			} 
		} //descomentar esta llave cuando descomente el bloque anterior.
	}
	else
	{		
		$nombre_archivo_def="NA";  // NA= No aplica
		$query = "insert into comsocial_notas (titulo, descripcion, imagen, fecha, activo,usuario_creo,fecha_creo) 			  	values('$titulo','$descripcion','$nombre_archivo_def','$fecha','2'$usuario_creo', getdate())";
    	$result=mssql_query($query);
		//header("Location: publicacion.php"); 
	}
	mssql_close($s);	
	
?> 
