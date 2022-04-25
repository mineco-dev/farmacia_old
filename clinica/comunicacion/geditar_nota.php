<?	
session_start();
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
?>
<? 
//tomo el valor de un elemento de tipo texto del formulario 
$titulo = $_POST["titulo"]; 
$descripcion = $_POST["descripcion"]; 
$fecha = $_POST["fecha"]; 
$link1 = $_POST["comunicado"]; 
$link2 = $_POST["imagenes"]; 
$id = $_POST["codigo_archivo"]; 
//datos del archivo 
	$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];   
	$nombre_usuario=($_SESSION["user_name"]);	 
	conectardb($uipadmin);
	if (isset($_SESSION["ingresando_solicitud"]))
	{
	  if ($nombre_archivo!="")
	  {
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
		$extension = split('[.]',$nombre_archivo);
		$extension = $extension[sizeof($extension)-1];		
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 		
		//compruebo si las características del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 4096000))) 
		{ 
			echo '<br><br>';
			echo '<table width="90%" border="0" align="center">';				
			echo '<tr><td  align="center" class="error">La extensión o el tamaño de los archivos no es correcta. Se permiten archivos .gif - .jpg - .pdf</td></tr>';
			echo '<tr><td  align="center">Se permiten archivos de 4096 Kb máximo (4 MB).</td></tr>';
			echo '<tr><td  align="center">&nbsp; </td></tr>';			
			echo '</table>';								
		}
		else
		{ 			
		   $nombre_archivo_def=$id.".".$extension;			  
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../comunicacion/img_notas/".$nombre_archivo_def))
			{ 
			   	echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center">LA ACTUALIZACION SE HA REALIZADO CORRECTAMENTE</td></tr>';
				echo '<tr><td  align="center">&nbsp; </td></tr>';				
				echo '</table>';	
			  $query1 = "update comsocial_notas
							set titulo='$titulo', descripcion= '$descripcion', imagen='$nombre_archivo_def', fecha='$fecha',
							 usuario_modifico= '$nombre_usuario', fecha_modifico=getdate(), link1='$link1',link2= '$link2'
							where id_noticia='$id'";			  
    		   $result=$query($query1);
			   session_unregister("ingresando_solicitud");	
			}
			else
			{ 
				echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center" class="error">Ocurrió algún error al subir el fichero. No pudo guardarse.</td></tr>';
				echo '<tr><td  align="center">&nbsp; </td></tr>';
				echo '</table>';				
			} 
		} 
	}
	else
	{
	 $query1 = "update comsocial_notas
							set titulo='$titulo', descripcion= '$descripcion', imagen='$nombre_archivo_def', fecha='$fecha',
							 usuario_modifico= '$nombre_usuario', fecha_modifico=getdate(), link1='$link1',link2= '$link2'
							where id_noticia='$id'";			  
    		    $result=$query($query1);
			    session_unregister("ingresando_solicitud");	
				if ($result)
				{
					echo '<br><br>';
					echo '<table width="90%" border="0" align="center">';				
					echo '<tr><td  align="center">LA ACTUALIZACION SE HA REALIZADO CORRECTAMENTE</td></tr>';
					echo '<tr><td  align="center">&nbsp; </td></tr>';				
					echo '</table>';
				}
	}
	}
	else	
	{
				echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center">LA ACTUALIZACION SE HA REALIZADO CORRECTAMENTE</td></tr>';
				echo '<tr><td  align="center">&nbsp; </td></tr>';				
				echo '</table>';	
	}
?> 
