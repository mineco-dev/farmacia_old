<?
	//Validar la sesion 
	session_start();	
	$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	include("../validate.php");
	$grupo_id=3;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("logout.php");		

// Trae los datos del visitante
		$nombre=$_REQUEST["txt_nombre"];				
		$cbo_registro=$_REQUEST["cbo_registro_cedula"];		
		$numero_cedula=$_REQUEST["txt_numero_cedula"];		
		$licencia=$_REQUEST["txt_licencia"];		
		$pasaporte=$_REQUEST["txt_pasaporte"];		
		$carnet=$_REQUEST["txt_carnet"];		
		$municipio=$_REQUEST["cbo_municipio"];		
		$direccion=$_REQUEST["txt_direccion"];				
		$colegio=$_REQUEST["txt_colegio"];				
//inserta el registro en la base de datos
		require_once('../../connection/helpdesk.php');
		$consulta = "select * from seg_registro_cedula where codigo_registro='$cbo_registro'";
		$result=$query($consulta);	
		while($row=$fetch_array($result))
		{
			$registro=$row["registro"];
		}
		$cedula=$registro."".$numero_cedula;		
		$consulta = "EXEC seg_visitante_add @vnombre_visitante='$nombre', @vcodigo_registro_cedula='$cbo_registro', @vnumero_cedula='$cedula', @vnumero_licencia='$licencia', @vnumero_pasaporte='$pasaporte', @vnumero_carnet='$carnet', @vdireccion='$direccion', @vextendida_en='$municipio', @vcolegio='$colegio', @vcodigo_usuario_creo='$usuario_id'";
		$result=$query($consulta);	
		$close($s);
		header("Location: index.php");
?>
