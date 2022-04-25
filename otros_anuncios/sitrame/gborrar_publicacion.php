<?	
$grupo_id=47;
include("../../restringir.php");	
?>
<? 
	$id=$_POST["codigo_archivo"]; 
	$ip=$_SERVER['REMOTE_ADDR'];    
	require_once('../../connection/helpdesk.php');
	$query = "EXEC proc_publicacion_del @vcodigo_usuario='$user', @vcodigo_archivo='$id', @vip='$ip'";
    $result=mssql_query($query);
	mssql_close($s);	
	header("Location: publicacion.php");
?> 
