<?

	if (intval($opcion)==1)  /// sector
	{
	  if (intval($sector)==1) header("location: industrias/alimentos/alimentos.php");
	  if (intval($sector)==2) header("location: industrias/manufactura/manufactura.php");
/*	  if (intval($sector)==3) header("location: industrias/construccion/construccion.php");
	  if (intval($sector)==4) header("location: industrias/manufactura/manufactura.php");
	  if (intval($sector)==5) header("location: industrias/servicios/servicios.php");
*/	}
	else                     /// producto
	{
	  
	}
?>
