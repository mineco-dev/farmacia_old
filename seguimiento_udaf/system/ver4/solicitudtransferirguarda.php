<?
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($bsecretaria));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
	require('../includes/envio_correo/envio_correo.php');
?>
<?
//ENVIO HACIA GERENCIA
	$mtusuario = $_SESSION['user_id'];
	
		$ban = 0;
	if (strlen($descripcion)>0)
	{
		$query = "insert into btraslado
					(id_documento, idusuario1,idusuario2,descripcion,fechahora)
				 values 
					('$id_documento','$mtusuario','$idusuario','$descripcion',getdate())";
		$dbms->sql = $query;
		$dbms->Query();

		$dbms->sql = "update docs_udaf set estado = 6 where estado = 5 and id_documento = $id_documento";
		$dbms->Query();
		
		//$idusuario=$_REQUEST["idusuario"];
		
		$dbms2=new DBMS(conectardb($bsecretaria));	
				  	$dbms2->bdd=$database_cnn;
                    $query = "select * from usuario where activo=1 and codigo_usuario='$idusuario' /*(303,674,678,773)*/";
                    $dbms2->sql=$query;
                    $dbms2->Query();
										while($Fields=$dbms2->MoveNext())
										{	
											$mail_destino=$Fields["e_mail"];
											$nomb_destino = "Empleado Ministerio";		
											$nomb_remitente = 'UDAF NOTIFICACION AUTOMATICA';
											$mail_remitente = 'webmaster@mineco.gob.gt';
											$mensaje = 'Esta es una notificación autom�tica de Documentos de la Unidad de Administracion Financiera, para ver la solicitud favor de ingresar a <a href="http://aseggys.mineco.gob.gt">aseggys.mineco.gob.gt</a>, usted tiene el expediente';
											$titulo = "UDAF NOTIFICACION AUTOMATICA";
	envio($nomb_destino,$mail_destino,$nomb_remitente,$mail_remitente,$mensaje,$titulo,"","");	
										}	
		
		
		$ban = 1;
	}	
//print "query = ".$query." idusuario = ".$idusuario;
	if ($ban == 1)	
	{	
			$mensaje = "Solicitud trasladada correctamente ";
	}else
	{
		$mensaje = "No se ha podido trasladar, favor completar los campos anteriores";
	}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body oncontextmenu="return false">
<p>&nbsp;</p>
<table width="80%" border="0" align="center" class="panel">
  <tr>
    <td colspan="2"><? print $mensaje;?></td>
  </tr>
  <tr>
    <td width="92">&nbsp;</td>
    <td width="379">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? print "<a href=\"solicitud_ver.php?id_documento=$id_documento\">Regresar</a>";?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
