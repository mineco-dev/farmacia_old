<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($rrhh));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
?>
<?

	$nombre = $_REQUEST['nombre'];
	$nombre2 = $_REQUEST['nombre2'];
	$nombre3 = $_REQUEST['nombre3'];
	$apellido = $_REQUEST['apellido'];
	$apellido2 = $_REQUEST['apellido2'];
	$apellido3 = $_REQUEST['apellido3'];
	$nit = $_REQUEST['nit'];
	$dpi = $_REQUEST['dpi'];
	$padron = $_REQUEST['padron'];
	$igss = $_REQUEST['igss'];
	$departamento = $_REQUEST['departamento'];
	$municipio = $_REQUEST['municipio'];
	$registro = $_REQUEST['registro'];
	$profesion = $_REQUEST['cbo_profesion'];
	$colegiado = $_REQUEST['colegiado'];
	$ecivil = $_REQUEST['cbo_civil'];
	$genero = $_REQUEST['cbo_civil'];
	$direccion = $_REQUEST['cbo_civil'];
	$renglon = $_REQUEST['cbo_renglon'];
	$dependencia = $_REQUEST['cbo_dependencia'];
	$mtusuario = $_SESSION['user_id'];	

	$nombre_archivo = $HTTP_POST_FILES['userfile']['name'];
	$tipo_archivo = $HTTP_POST_FILES['userfile']['type'];
	$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];

	$mtusuario = $_SESSION['user_id'];	

	$tmpfile = "upload/".$mtusuario."_".date("d").date("m").date("Y").date("H").date("i").date("s")."_".$nombre_archivo;

	/*if ($opnacionalidad == 1) 
	{
		$numero_pasaporte = "";
		$idnacionalidad = "'83'";
		$orden = "'$orden'";
		$municipio = "'$municipio'";
	} 
	if ($opnacionalidad == 2) 
	{
		$orden = "NULL";
		$registro = "";
		$municipio = "NULL";
	}*/
	
	$iporigen = getIP();
	
	$query = "insert into tb_empleado
				(nombre1, nombre2,nombre3, apellido1,apellido2,apellido_casada,nit,dpi,
				empadronamiento,numero_igss,id_departamento,id_municipio,registro,id_profesion,
				colegiado,id_estado_civil,id_genero,direccion_notificacion,id_renglon,usuario_creo,fecha_creo,ip,activo,foto,fecha_nacimiento,id_dependencia)
			values ('$nombre', '$nombre2', '$nombre3', '$apellido', '$apellido2', '$apellido3','$nit',
					 '$dpi', '$padron', '$igss', '$departamento', '$municipio', '$registro', '$profesion',
					'$colegiado','$ecivil', '$genero','$direccion','$renglon', '$mtusuario',getdate(),
					'$iporigen',1, '$tmpfile',getdate(),'$dependencia')";
	$dbms->sql = $query;
	$dbms->Query();
	
	if (strlen($userfile)>0)
	{
		move_uploaded_file($_FILES['userfile']['tmp_name'],$tmpfile);
	}		
	
	$mensaje = "Registro guardado satisfactoriamente <strong>".
				get_max("tb_empleado","id_empleado",$dbms)."</strong> ";
?>