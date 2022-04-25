<?	
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	require_once('../includes/conectarse.php');
?>
<? 
//tomo el valor de un elemento de tipo texto del formulario 
$ingreso = $_POST["ingreso"]; 
$gestion = $_POST["cbo_gestion"]; 
$uejecutora = $_POST["cbo_ue"]; 
$dependencia = $_POST["cbo_dependencia"]; 
$solicitante=$nombre[0][1];
$cuenta = $_POST["cbo_cuenta"]; 
$cantidad = $_POST["cantidad"]; 
$ndocto = $_POST["ndocto"]; 
$date1 = $_POST["date1"]; 
$fac = $_POST["factura"]; 
$date2 = $_POST["date2"]; 
$proveedor = $_POST["proveedor"]; 
$observaciones = $_POST["observaciones"]; 
//datos del archivo 
	$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 		
	$ip=$_SERVER['REMOTE_ADDR'];    
//	require_once('../connection/helpdesk.php');
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
		   $query="select max (idregistro) from bbitacora";
		   $result=mssql_query($query);
	       while($row=mssql_fetch_array($result))
			{
               	$codigo_archivo=$row["ultimo_archivo"]+1;
			}			
		   $nombre_archivo_def=$codigo_archivo.".".$extension;		   
			if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "docs/".$nombre_archivo_def))
			{ 
			   echo "El archivo ha sido cargado correctamente."; 						   
			   $query = "insert into bbitacora
							(registro, id_gestion, idunidad, iddependencia, idsolicitante, idcuenta, cheque, cantidad, nodocumento,
							 fechadocumento, nofactura, fechafac, proveedor, observaciones, usuariocreo, fecha_creacion,activo )
							  values ('$ingreso','$gestion','$uejecutora','$dependencia','$solicitante', '$cuenta', '$cheque', '$cantidad', '$ndocto',
							 '$date1','$fac','$date2','$proveedor','$observaciones','$nombre_usuario', getdate(),1)";
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
		$query = "insert into bbitacora
							(registro, id_gestion, idunidad, iddependencia, idsolicitante, idcuenta, cheque, cantidad, nodocumento,
							 fechadocumento, nofactura, fechafac, proveedor, observaciones, usuariocreo, fecha_creacion,activo )
							  values ('$ingreso','$gestion','$uejecutora','$dependencia','$solicitante', '$cuenta', '$cheque', '$cantidad', '$ndocto',
							 '$date1','$fac','$date2','$proveedor','$observaciones','$nombre_usuario', getdate(),1)";
    	$result=mssql_query($query);
		//header("Location: publicacion.php"); 
		print($query);
	}
	mssql_close($s);	
	
?> 
