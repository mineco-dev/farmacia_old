<?
	session_start();
	if (!isset($_SESSION["subgerencia"])) $dependencia=33;
	else $dependencia=($_SESSION["subgerencia"]);		
	if (!isset($_SESSION["this_cookie"]))
	{
		$user=3;
	}
	else
		{
			$user=($_SESSION["user_id"]);		
		}
?>
<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
require("../../includes/envio_correo/envio_correo.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0">
  <tr>
    <td width="18%" height="25"><div align="left"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA ADMINISTRATIVA</p>
    <p align="center" class="titulocategoria">M&Oacute;DULO: VISITANTES</p></td>
    <td width="10%"><div align="right"><img src="../../images/visitantes.gif" width="124" height="96"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25"><div align="right" class="tituloproducto">
      <div align="center"></div>
    </div></td>
    <td height="25">
	<?
	if (isset($_SESSION["ingresando_obj"]))
	{			
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{
		$acceso=permisosdb($visitantes);							
		if (($acceso==2) || ($acceso==3) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{
							session_unregister("ingresando_obj");
							conectardb($visitantes);
							$nombre_usuario=$_SESSION["user_name"];
							$qry_actualiza="update seg_visita_det set codigo_estado=2, usuario_traslada='$nombre_usuario', 
							fecha_traslada=getdate() where codigo_visita_det='$txt_visita_det'";
							$query($qry_actualiza);	
							echo $qry_actualiza;
							// insertar empleados visitados
				  		    $cnt=1; 		
					  		while($cnt<=count($bien))
							  {						
									$visitado=$bien[$cnt][1];
									$qry_visitado ="insert into seg_visita_det";	
									$qry_visitado.="(codigo_visita, codigo_usuario, codigo_estado) ";
									$qry_visitado.="values ($txt_visita, '$visitado', 3)";			
									$query($qry_visitado);									
									$cnt++;		
							  }
							// confirmar por correo, al empleado visitado
				  		    $cnt=1; 		
							//if ($dependencia==37)  // para que solo confirme cuando el usuario del sistema sea de seguridad
							if ($user==263)  //usuario nhernandez							
							{
								conectardb($rrhh);
								while($cnt<=count($bien))
								 {		
										$visitado=$bien[$cnt][1];
										$qry_notifica ="select * from tb_correo where oficial=1 and idasesor='$visitado'";		
										$res_notifica=$query($qry_notifica);									
										while($row_notifica=$fetch_array($res_notifica))
										{	
											$mail_destino=$row_notifica["correo"];
											$nomb_destino = "Empleado del Ministerio";		
											$nomb_remitente = 'Notificación autom�tica de ingreso de visitante';
											$mail_remitente = 'nhernandez@mineco.gob.gt';
											//$mensaje='prueba';
											$mensaje = 'En este momento el(la) se�or(a) '.$txt_visitante.' ingres� al Ministerio indicando que lo visitar�a a usted, para confirmar su visita <a href="aseggys.mineco.gob.gt/confirmar.php">HAGA CLIC AQUI</a> de lo contrario comuniquese a Seguridad a la extensión 1000.';
	$titulo = "NOTIFICACION AUTOMATICA DE VISITA";
	envio($nomb_destino,$mail_destino,$nomb_remitente,$mail_remitente,$mensaje,$titulo,"","");	
										}									
										$cnt++;			
								 }
							} // finaliza confirmacion
							
							echo '<tr><td class="titulocategoria" colspan="3" align="center">SE HA EFECTUADO EL TRASLADO CORRECTAMENTE<br>PARA CONTINUAR UTILICE LAS OPCIONES DEL MEN� IZQUIERDO</td></tr>';																			
			}
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
			}			
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">PUEDE CONTINUAR, UTILIZANDO LAS OPCIONES DEL MEN� QUE EST� A LA IZQUIERDA</td></tr>';
	}
	?>             
	</td>
  </tr>
</table>
</body>
</html>
