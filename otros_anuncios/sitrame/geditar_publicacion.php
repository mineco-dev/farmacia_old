<?	
$grupo_id=47;
include("../../restringir.php");	
?>
<? 
//Trae la descripci?n actualizada
$descripcion = $_POST["cadenatexto"]; 
$id = $_POST["codigo_archivo"]; 
$claves= $_POST["txt_claves"];
$vigencia=$_POST["cbo_vigencia"];
if (isset($_POST["cbo_archivo_ant"])) $conservar_archivo=$_POST["cbo_archivo_ant"];
$archivo_ant=$_POST["txt_archivo_ant"];
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
		//compruebo si las caracter?sticas del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "pps")) && ($tamano_archivo < 4096000))) 
		{ 
			echo "La extensi?n o el tama?o de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de 1024 Kb m?ximo (1 MB).</td></tr></table>"; 
		}
		else
		{ 
			//el nombre del archivo ser? el codigo_archivo seg?n el registro que se esta actualizando		
		   $nombre_archivo_def=$id.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "files/".$nombre_archivo_def))
			{ 
			   echo "El archivo ha sido actualizado correctamente."; 						   
			   $query = "EXEC proc_publicacion_upd @vcodigo_usuario='$user', @vcodigo_archivo='$id', @vdescripcion='$descripcion', @vip='$ip', @vnombre_archivo='$nombre_archivo_def', @vpalabras_clave='$claves', @vvigencia='$vigencia'";
    		   $result=mssql_query($query);

			}
			else
			{ 
			   echo "Ocurri? alg?n error al subir el fichero. No pudo guardarse."; 
			} 
		} 
	}
	else
	{		
		if ($conservar_archivo==2) 
			$nombre_archivo_def="NA";  // NA= No aplica
			else
			   $nombre_archivo_def=$archivo_ant;  // NA= No aplica
			   $query = "EXEC proc_publicacion_upd @vcodigo_usuario='$user', @vcodigo_archivo='$id', @vdescripcion='$descripcion', @vip='$ip', @vnombre_archivo='$nombre_archivo_def', @vpalabras_clave='$claves', @vvigencia='$vigencia'";
    		   $result=mssql_query($query);
	}
	mssql_close($s);	
	header("Location: index.php"); 
?> 
