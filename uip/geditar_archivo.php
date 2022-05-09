<?	
session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<? 
//tomo el valor de un elemento de tipo texto del formulario 
$descripcion = $_POST["txt_titulo"]; 
$id = $_POST["txt_contenido"]; 
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
		//compruebo si las caracter�sticas del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "pps")) && ($tamano_archivo < 4096000))) 
		{ 
			echo '<br><br>';
			echo '<table width="90%" border="0" align="center">';				
			echo '<tr><td  align="center" class="error">La extensión o el TAMAÑO de los archivos no es correcta. Se permiten archivos .gif - .jpg - .pdf</td></tr>';
			echo '<tr><td  align="center">Se permiten archivos de 4096 Kb m�ximo (4 MB).</td></tr>';
			echo '<tr><td  align="center">&nbsp; </td></tr>';			
			echo '</table>';								
		}
		else
		{ 			
		   $nombre_archivo_def=$id.".".$extension;			  
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../planeacion/manuales/uipfiles/".$nombre_archivo_def))
			{ 
			   	echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center">LA ACTUALIZACION SE HA REALIZADO CORRECTAMENTE</td></tr>';
				echo '<tr><td  align="center">&nbsp; </td></tr>';				
				echo '</table>';	
			  $query1 = "update uip_contenido set vinculo='$nombre_archivo_def', titulo='$txt_titulo', usuario_modifico='$nombre_usuario', fecha_modificado=getdate()
			  			where codigo_contenido='$txt_contenido'";			  
    		   $result=$query($query1);
			   session_unregister("ingresando_solicitud");	
			}
			else
			{ 
				echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center" class="error">Ocurri� alg�n error al subir el fichero. No pudo guardarse.</td></tr>';
				echo '<tr><td  align="center">&nbsp; </td></tr>';
				echo '</table>';				
			} 
		} 
	}
	else
	{
	 $query1 = "update uip_contenido set titulo='$txt_titulo', usuario_modifico='$nombre_usuario', fecha_modificado=getdate()
	  			where codigo_contenido='$txt_contenido'";			  
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
<head>
<style type="text/css">
body {
	background-image: url(../imagen/Theme_Marcos/marco11.gif);
}
</style>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
