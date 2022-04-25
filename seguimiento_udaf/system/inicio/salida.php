<?
	session_start();

	session_unregister('mtusuario');
	session_unregister('nombre_usuario');
	session_unregister('mttipousuario');
	header("location: ../../");
?>

