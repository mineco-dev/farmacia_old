<?	
	session_start();
	if ($_SESSION['us_id']== "")
	{
		header("location: errorLogin.php");
	}
	else
	{
		$id_usuario = $_SESSION['us_id'];
		$pagina = $_SESSION['paginaActual'];
		require_once('Connections/politica.php');
		mysql_select_db($database_politica); 
		$query = "select * from permisos p, prograrol pr,programa pro where p.tu_id = pr.tu_id and pr.pr_id = pro.pr_id and pro.pr_ruta like '%$pagina%' and p.us_id  = $id_usuario";
		$result = mysql_query($query);
		if ((mysql_num_rows($result)==0) && ($pagina!=""))
		{
			header("location: errorLogin.php");
		}
	}
?>
