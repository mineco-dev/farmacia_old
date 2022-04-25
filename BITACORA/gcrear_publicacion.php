<?	
$grupo_id=4;
include("../restringir.php");	
?>
<? 
//tomo el valor de un elemento de tipo texto del formulario 
$descripcion = $_POST["cadenatexto"]; 
$claves= $_POST["txt_claves"];
$dependencia=$_POST["cbo_dependencia"];
$tipo_publicacion=2; 
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
		/* voy a comentar esto para permitir cualquier tipo de archivos
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 25024000))) 
		{ 
			echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (25 MB) máximo.</td></tr></table>"; 
		}
		else
		{ hasta aqui comente */
			//el nombre del archivo será el codigo_archivo según la tabla publicación mas la extensión			
		   $query="SELECT MAX(codigo_archivo) as ultimo_archivo from publicacion";
		   $result=mssql_query($query);
	       while($row=mssql_fetch_array($result))
			{
               	$codigo_archivo=$row["ultimo_archivo"]+1;
			}			
		   $nombre_archivo_def=$codigo_archivo.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "manuales/".$nombre_archivo_def))
			{ 
			   echo "El archivo ha sido cargado correctamente."; 						   
			   $query = "EXEC proc_publicacion_add @vcodigo_usuario='$user', @vcodigo_dependencia='$dependencia', @vdescripcion='$descripcion', @vip='$ip', @vnombre_archivo='$nombre_archivo_def', @vpalabras_clave='$claves', @vtipo_publicacion='$tipo_publicacion', @vvigencia='$cbo_vigencia'";
    		   $result=mssql_query($query);
	   		   header("Location: publicacion.php"); 
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
		$query = "EXEC proc_publicacion_add @vcodigo_usuario='$user', @vcodigo_dependencia='$dependencia', @vdescripcion='$descripcion', @vip='$ip', @vnombre_archivo='$nombre_archivo_def', @vpalabras_clave='$claves', @vtipo_publicacion='$tipo_publicacion', @vvigencia='$cbo_vigencia'";
    	$result=mssql_query($query);
		header("Location: publicacion.php"); 
	}
	mssql_close($s);	
	
?> 
