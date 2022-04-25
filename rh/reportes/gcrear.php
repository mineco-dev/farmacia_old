<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
	conectardb($rrhh);
?>
<? 
//datos del archivo 
	$idasesor=$_REQUEST["idasesor"];
	$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];  
	$nombre_usuario=$_SESSION["user_name"];  
	//require_once('../connection/helpdesk.php');
	if ($nombre_archivo!="")
	{
		$mesnum=(int)date("m");
		$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
		$extension = split('[.]',$nombre_archivo);
		$extension = $extension[sizeof($extension)-1];		
		$tamano_archivo = $HTTP_POST_FILES['userfile']['size']; 		
		//compruebo si las características del archivo son las que deseo 
		if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg") || strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "pps")) && ($tamano_archivo < 4096000))) 
		{ 
			echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de 4MB máximo.</td></tr></table>"; 
		}
		else
		{ 
			//el nombre del archivo será el codigo_archivo según la tabla publicación mas la extensión					   			
		   $nombre_archivo_def=$idasesor."_".$mesnum.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "informes/".$nombre_archivo_def))
			{ 
			   echo "El archivo ha sido cargado correctamente."; 
			   $codigo_informe=0;
		   	   $query1="SELECT * from asesor_informe where idasesor='$idasesor'";
		       $result1=mssql_query($query1);
			   while($row=mssql_fetch_array($result1))
				{
				echo "entra";
					$codigo_informe=$row["idinfome"];
					echo $codigo_informe;
				}
			   
			 if ($codigo_informe==0)  {  						   
 		    $query = "insert into asesor_informe(idasesor, informe, usuario_creo, fecha_creo, activo, mes) values ($idasesor, '$nombre_archivo_def', '$nombre_usuario', getdate(), 1, $mesnum)"; }
			else
			{
			$query = "update asesor_informe set idasesor=$idasesor, informe='$nombre_archivo_def', usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo=1, mes=$mesnum where idinfome='$codigo_informe'";
			}
			   echo $query;
    		   $result=mssql_query($query);

			}
			else
			{ 
			   echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
			} 
		} 
	}
	else
	{		
		echo "Debe seleccionar un archivo";
	}
	header("Location: reporteMensual.php?rg=3"); 
?> 
