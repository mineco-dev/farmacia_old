<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<?php
session_start();
require_once('../connection/helpdesk.php');
$txt_usuario = $_POST['txt_usuario'];
$usuario_mayus=strtoupper($txt_usuario);
$consulta = "SELECT * FROM usuario";
$result=mssql_query($consulta);
$entro=1;
$txt_apellidos = $_POST['txt_apellidos'];
$txt_nombres = $_POST['txt_nombres'];

$cbo_dependencia = $_POST['cbo_dependencia'];
$txt_contrasena = $_POST['txt_contrasena'];
$txt_nivel = $_POST['txt_nivel'];
$txt_extension = $_POST['txt_extension'];

while($row=mssql_fetch_array($result))
{
	if(strtoupper($row["nombre_usuario"]) == $usuario_mayus)
	{
		$entro=0;
	}
}
if($entro == 1)
{
	$temp = trim($txt_contrasena);

	$contrasena=md5($temp);
			
	$query = "INSERT INTO USUARIO (apellidos,
								   nombres,
								   nombre_usuario,
								   codigo_dependencia,
								   codigo_grupo_enc,
								   contrasena,
								   nivel,
								   extension,
								   activo) 
								   VALUES ('$txt_apellidos',
								   '$txt_nombres',
								   '$usuario_mayus',
								   '$cbo_dependencia',
								   '1',
								   '$contrasena',
								   '$txt_nivel',
								   '$txt_extension',
								   '1')";
	
	
	/*EXEC proc_usuario_add @vapellidos='$txt_apellidos', @vnombres='$txt_nombres', @vnombre_usuario=$usuario_mayus, @vcodigo_grupo_enc='1', @vcodigo_dependencia='$cbo_dependencia', @vcontrasena='$contrasena', @vnivel='$txt_nivel', @vextension='$txt_extension'";*/


	mssql_query($query);
	mssql_close($s);
	include('transaccion_operada.php');
}	
else
{
echo('<strong><font size="5"><Center><font color="#FF0000">El nombre de usuario ya existe</font></Center></font></strong>');
}
?>