<?
include('conectarse.php');
//envia_msg($_SESSION['usr_val']);
//envia_msg($_SESSION['nivel']);
//envia_msg($nivel);
	if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}
?>
<title>MINECO - SubGerencia Financiera - SubGerencia de Inform�tica - Secci�n de Inventarios - INVENTARIO</title>