<?php
session_start();
//error_reporting(0);
// Trae los datos del agente actualizados		
		$codigo=$_REQUEST["txt_codigo"];
		$eliminar=$_REQUEST["cbo_baja"];	
		$contrasena=md5($_REQUEST["txt_contrasena"]);				
//Actualiza la base de datos
		require_once('../connection/helpdesk.php');
		$consulta = "update usuario set contrasena='$contrasena' where codigo_usuario='$codigo' and $eliminar=1";
		$result=$query($consulta);	
//print $consulta;
		
		// AGREGADO EL 190208 PARA ACTUALIZAR CONTRASEÑA DE CORRESPONDENCIA
include('../correspondencia/INCLUDES/inc_header.inc');
$dbms=new DBMS($conexion); 
include('../correspondencia/conectarse.php');
//envia_msg('usrcor'.$_SESSION['usrcor']);
$consultax = "UPDATE asesor SET password='$contrasena' WHERE usuario='".$_SESSION['usrcor']."'";
$result1 = mssql_query($consultax);
//envia_msg($consultax);
//print "***<br>".$consultax;		
$close($s);
ob_flush();// - Vaciar (enviar) el búfer de salida
ob_clean();// - Limpiar (eliminar) el búfer de salida
ob_end_flush();// - Volcar (enviar) el búfer de salida y deshabilitar el almacenamiento en el mismo
ob_end_clean();// - Limpiar (eliminar) el búfer de salida y deshabilitar el almacenamiento en el mismo

header("Location: busca_usuario.php", true, 301);
die();
?>
