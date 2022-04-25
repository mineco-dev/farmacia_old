<?
	session_start();
//	include('conectarse.php');
	
	$pag = $_GET['pag'];
	$maxpag = $_GET['maxpag'];
	$linkant = $_GET['linkant'];
/*envia_msg('pag '.$pag);
envia_msg('maxpag '.$maxpag);
envia_msg('linkant'.$linkant);*/

/*	if ($pag == -1) { $PagNow = $PagNow - 1;}
	if ($pag == 0) { $PagNow = $PagNow + 1;}
	if ($pag > 0) { $PagNow = $pag;}
	if ($PagNow < 1) { $PagNow = 1;}
	if ($PagNow > $maxpag) { $PagNow = $maxpag;}*/

	
	if ($pag == -1) { $_SESSION['PagNow'] = $_SESSION['PagNow'] - 1;}
	if ($pag == 0) { $_SESSION['PagNow']  = $_SESSION['PagNow']  + 1;}
	if ($pag > 0) { $_SESSION['PagNow']  = $pag;}
	if ($_SESSION['PagNow']  < 1) { $_SESSION['PagNow']  = 1;}
	if ($_SESSION['PagNow']  > $maxpag) { $_SESSION['PagNow']  = $maxpag;}


	header("Location: $linkant");
//cambiar_ventana($linkant);
	exit;
?>