<?	
session_start();
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");	

?>
<? 
//tomo el valor de los elemento de tipo texto del formulario 
$titulo = $_POST["element_1"]; 
$descripcion = $_POST["element_2"]; 
$fecha= $_POST["element_3"];
$link1= $_POST["element_4"];
$link2=$_POST["element_5"];
//$tipo_publicacion=2; 
//datos del archivo 
	$nombre_archivo = $HTTP_POST_FILES['element_4']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];   
	$nombre_usuario=($_SESSION["user_name"]);	 
	conectardb($comunicacion);
	if (isset($_SESSION["ingresando_solicitud"]))
	{
		$tipo_archivo = $HTTP_POST_FILES['element_4']['type']; 
		$extension = split('[.]',$nombre_archivo);
		$extension = $extension[sizeof($extension)-1];		
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 		
		//compruebo si las caracter�sticas del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "png")) && ($tamano_archivo < 5242880))) 
		{ 
			echo '<br><br>';
			echo '<table width="90%" border="0" align="center">';				
			echo '<tr><td  align="center" class="error">La extensión o el tama�o de los archivos no es correcta. Se permiten archivos .gif - .jpg - .png</td></tr>';
			echo '<tr><td  align="center">Se permiten archivos de 5120 Kb m�ximo (5 MB).</td></tr>';
			echo '<tr><td  align="center">&nbsp; </td></tr>';			
			echo '</table>';								
		}
		else
		{ 
			//el nombre del archivo ser� el codigo_contenido seg�n la tabla uip_contenido mas la extensión			
		   $query1="SELECT MAX(id_noticia) as ultimo_archivo from comsocial_notas";
		   $result=$query($query1);
	       while($row=$fetch_array($result))
			{
               	$codigo_archivo=$row["ultimo_archivo"]+1;
			}			
		   $nombre_archivo_def=$codigo_archivo.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../comunicacion/img_notas/".$nombre_archivo_def))
			{ 
			   	echo '<br><br>';
				echo '<table width="90%" border="0" align="center">';				
				echo '<tr><td  align="center">LA PUBLICACION SE HA CARGADO CORRECTAMENTE</td></tr>';
				echo '<tr><td  align="center">&nbsp; </td></tr>';				
				echo '</table>';	
			  $query1 = "insert into comsocial_notas (titulo, descripcion, imagen, fecha, activo, usuario_creo,fecha_creo, ip, link1, link2)
							values('$titulo', '$descripcion', '$nombre_archivo_def', '$fecha', 2, '$nombre_usuario', getdate(), '$ip', '$link1', '$link2')";			 
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
