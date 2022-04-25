<?
session_start();
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
if (isset($_REQUEST["stat"]))
{	
		$referencia=1;	//publicaciones
		if ($referencia==1) 
		 	{

					  $latabla="uip_contenido";
					  $campocond="codigo_contenido";
					  $retornar="publicacion.php";
			}
		
		conectardb($uipadmin);
		$nuevo_estado=$_REQUEST["stat"];	
		$rowid=$_REQUEST["id"];	
		$nombre_usuario=$_SESSION["user_name"];
		$qry_cambia_stat="UPDATE $latabla SET activo='$nuevo_estado', usuario_desactivo='$nombre_usuario', fecha_desactivado=getdate() WHERE $campocond='$rowid'";
		$query($qry_cambia_stat);
}
header("Location: $retornar"); 
?>
