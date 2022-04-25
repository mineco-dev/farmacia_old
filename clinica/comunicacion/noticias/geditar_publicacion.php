<?	
$grupo_id=4;
include("../restringir.php");	
?>
<? 
//Trae la descripción actualizada
$descripcion = $_POST["cadenatexto"]; 
$id = $_POST["codigo_archivo"]; 
$claves= $_POST["txt_claves"];
//datos del archivo 
	$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];    
	require_once('../connection/helpdesk.php');
	if ($nombre_archivo!="")
	{
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
		$extension = split('[.]',$nombre_archivo);
		$extension = $extension[sizeof($extension)-1];		
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 		
		//compruebo si las características del archivo son las que deseo 
		/* voy a comentar este bloque para permitir cualquier tipo de archivos
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "zip")) && ($tamano_archivo < 25024000))) 
		{ 
			echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de 1024 Kb máximo (1 MB).</td></tr></table>"; 
		}
		else
		{   hasta aqui */
			//el nombre del archivo será el codigo_archivo según el registro que se esta actualizando		
		   $nombre_archivo_def=$id.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "manuales/".$nombre_archivo_def))
			{ 
			   echo "El archivo ha sido actualizado correctamente."; 						   
			   $query = "EXEC proc_publicacion_upd @vcodigo_usuario='$user', @vcodigo_archivo='$id', @vdescripcion='$descripcion', @vip='$ip', @vnombre_archivo='$nombre_archivo_def', @vpalabras_clave='$claves'";
    		   $result=mssql_query($query);
 		   	   header("Location: publicacion.php"); 
			}
			else
			{ 
			   echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
			} 
		// } tambien descomentar esta llave cuando descomente el bloque anterior
	}
	else
	{		
		$nombre_archivo_def="NA";  // NA= No aplica
			   $query = "EXEC proc_publicacion_upd @vcodigo_usuario='$user', @vcodigo_archivo='$id', @vdescripcion='$descripcion', @vip='$ip', @vnombre_archivo='$nombre_archivo_def', @vpalabras_clave='$claves'";
    	$result=mssql_query($query);
		header("Location: publicacion.php"); 
	}
	mssql_close($s);	

?> 
