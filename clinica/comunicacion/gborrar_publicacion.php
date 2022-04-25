<?	
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");	
?>
<? 
	$id=$_POST["codigo_archivo"]; 
	$ip=$_SERVER['REMOTE_ADDR'];    
	$nombre_usuario=($_SESSION["user_name"]);		
	//require_once('../connection/helpdesk.php');
	$query = "update comsocial_notas
				set  activo=2, usuario_elimino='$nombre_usuario', fecha_elimino= getdate()
			where id_noticia ='$id'";
    $result=mssql_query($query);
	mssql_close($s);	
	/*header("Location: publicacion.php");*/
?> 
