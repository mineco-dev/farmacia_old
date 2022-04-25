<?	
session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<? 
//tomo el valor de un elemento de tipo texto del formulario 
$descripcion = $_POST["txt_titulo"]; 
//datos del archivo 
	$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];   
	$nombre_usuario=($_SESSION["user_name"]);	 
	conectardb($uipadmin);
	if (isset($_SESSION["ingresando_solicitud"]))
	{
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
		$extension = split('[.]',$nombre_archivo);
		$extension = $extension[sizeof($extension)-1];		
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 		
		//compruebo si las caracter�sticas del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "pps")) && ($tamano_archivo < 5242880))) 
		{ 
			echo '<br><br>';
			echo '<table width="90%" border="0" align="center">';				
			echo '<tr><td  align="center" class="error">La extensión o el tama�o de los archivos no es correcta. Se permiten archivos .gif - .jpg - .pdf</td></tr>';
			echo '<tr><td  align="center">Se permiten archivos de 5120 Kb m�ximo (5 MB).</td></tr>';
			echo '<tr><td  align="center">&nbsp; </td></tr>';			
			echo '</table>';								
		}
		else
		{ 
			//el nombre del archivo ser� el codigo_contenido seg�n la tabla uip_contenido mas la extensión			
		   $query1="SELECT MAX(codigo_contenido) as ultimo_archivo from uip_contenido";
		   $result=$query($query1);
	       while($row=$fetch_array($result))
			{
               	$codigo_archivo=$row["ultimo_archivo"]+1;
			}			
		   $nombre_archivo_def=$codigo_archivo.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../planeacion/manuales/uipfiles/".$nombre_archivo_def))
			{ 
			   	echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center">LA PUBLICACION SE HA CARGADO CORRECTAMENTE</td></tr>';
				echo '<tr><td  align="center">&nbsp; </td></tr>';				
				echo '</table>';	
			  $query1 = "insert into uip_contenido (codigo_inciso, codigo_grupo, tipo, vinculo, titulo, usuario_creo, fecha_creado, ip, activo)
						 values ('$txt_inciso','$txt_grupo', 2, '$nombre_archivo_def', '$txt_titulo', '$nombre_usuario', getdate(), '$ip', 2)";			 
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
				echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center">EL ARCHIVO SE HA CARGADO CORRECTAMENTE</td></tr>';
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
