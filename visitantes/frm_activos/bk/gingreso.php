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
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj' and c.activo=1
							order by orden"; 			
			require_once('../../connection/helpdesk.php');				
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($visitantes);
				$cnt=1;
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{					
					if ($row_qry_plantilla["codigo_tipo_campo"] != '6')
					{
						$campo[$cnt]=$row_qry_plantilla["campo"];			
						$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];			
						$cnt++;					
					}
					else
					{
						$tabla_destino=$row_qry_plantilla["tb_destino"];
						$campo_llave_destino=$row_qry_plantilla["campo_destino"];			
					}
				}	 //fin del while que indica los campos que corresponden al objeto
				$free_result($res_qry_plantilla);				
				//////////////////////////////CONSULTA SI EXISTE EL REGISTRO//////////////////////////////
				$qry_consulta="select * from $tabla_destino where ";
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista de campos a grabar
				{
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);
					$qry_consulta.="$campo[$cnt]='$variable' and ";				
					$cnt++;
				}
				$qry_consulta=substr($qry_consulta,0,(strlen($qry_consulta)-5));
				$res_consulta=$query($qry_consulta);
				$registro_encontrado=false;
				while($row_qry_consulta=$fetch_array($res_consulta))
				{
					$registro_encontrado=false;
				}
				//////////////////////////////////////////////////////////////////////////////////////////
				if (!$registro_encontrado)
				{
						$qry_insert="insert into $tabla_destino(";
						$cnt=1;
						while ($cnt<=count($campo)) //concatena lista de campos a grabar
						{
							$qry_insert.="$campo[$cnt], ";				
							$cnt++;
						}// fin del while que forma el qry_insert			
						$qry_insert.="usuario_ingreso, fecha_ingreso, codigo_estado, codigo_visitante) values (";			
						$cnt=1;			
						while ($cnt<=count($campo))  //concatena el contenido a grabar en los campos
						{
							//inicia carga de archivo
							if ($tipo_campo[$cnt]=='5')
							{				
									$nombre_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['name'];						
									$tipo_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['type']; 
									$extension = split('[.]',$nombre_archivo);
									$extension = $extension[sizeof($extension)-1];		
									$tamano_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['size']; 		
									$extension=strtoupper($extension);									
									//compruebo si las caracter???sticas del archivo son las que deseo 		
									if ((($extension=="EXE") || ($extension=="COM") || ($extension=="BAT") || ($extension=="PHP")) && ($tamano_archivo < 25024000)) 
									{ 
										echo '<tr><td class="titulocategoria" colspan="3" align="center">La extensi??n o el TAMA??O de los archivos no es correcta en el campo '.$campo[$cnt].'. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (10 MB) m???ximo.</td></tr>'; 
									}
									else
									{ 
										//el nombre del archivo ser??? el codigo_archivo seg???n la tabla publicaci??n mas la extensi??n			
										$qry_ultimo_reg="select max($campo_llave_destino) as ultimo_registro  from $tabla_destino";
										$res_qry_ultimo_reg=$query($qry_ultimo_reg);	
										while($row_qry_ultimo_reg=$fetch_array($res_qry_ultimo_reg))					
										{
											$codigo_archivo=$row_qry_ultimo_reg["ultimo_registro"]+1;
										}							  
										$nombre_archivo_def=strtoupper($campo[$cnt]."_".$codigo_archivo.".".$extension);								   
										if (move_uploaded_file($HTTP_POST_FILES["$campo[$cnt]"]['tmp_name'], "archivos/".$nombre_archivo_def))
										{ 
											  $mensaje= "El archivo ha sido cargado correctamente."; 													     
											  $variable=$nombre_archivo_def;
										}
										else
										{ 
											   echo '<tr><td class="titulocategoria" colspan="3" align="center">No se ha grabado archivo en el campo '.$campo[$cnt].'</td></tr>'; 
										} // hasta aqui corresponde al archivo
									}// fin si el tipo de archivo no es exe, com, bat, php
								if ($HTTP_POST_FILES["$campo[$cnt]"]['error']!="0")	$variable="NA";				
							}	// fin si el tipo de campo es archivo
							else
							if (($tipo_campo[$cnt]=='8') || ($tipo_campo[$cnt]=='10'))
							{
							 	$dia=substr($_REQUEST["$campo[$cnt]"],0,2);
								$mes=substr($_REQUEST["$campo[$cnt]"],3,2);								
								$anio=substr($_REQUEST["$campo[$cnt]"],6,4);
								if ($tipo_campo[$cnt]=='10')
								{
									$hora=$_REQUEST["$campo[$cnt]_hora"];
									$minutos=$_REQUEST["$campo[$cnt]_minutos"];
								}
								else
								{
									$hora="00";
									$minutos="00";
								}
								$variable=$anio.'-'.$mes.'-'.$dia.' '.$hora.':'.$minutos.':00';							  					
							}
							else
							if ($tipo_campo[$cnt]=='11') 
							{							 	
								$variable=$_REQUEST["$campo[$cnt]_id"];
							}
							else
							{
								$variable=strtoupper($_REQUEST["$campo[$cnt]"]);				
							}
							$qry_insert.="'$variable', ";				
							$cnt++;
						}// fin del while que forma el qry_insert			
						$nombre_usuario=$_SESSION["user_name"];
						$qry_insert.="'$nombre_usuario', getdate(), 1, '$txt_id')";												
						session_unregister("ingresando_obj");																																							
						$res_insert=$query($qry_insert);									
						if ($res_insert)
						{
							///////ingresa detalle de visitas
								//buscar el ultimo registro grabado
							$qry_ultimo_reg="select max(codigo_visita) as ultimo_registro from seg_visita where 
							codigo_visitante='$txt_id'";
							$res_qry_ultimo_reg=$query($qry_ultimo_reg);	
							while($row_qry_ultimo_reg=$fetch_array($res_qry_ultimo_reg))					
							{
								$ultima_visita=$row_qry_ultimo_reg["ultimo_registro"];
							}
							// insertar empleados visitados
				  		    $cnt=1; 		
					  		while($cnt<=count($bien))
							  {						
									$visitado=$bien[$cnt][1];
									$qry_visitado ="insert into seg_visita_det";	
									$qry_visitado.="(codigo_visita, codigo_usuario, codigo_estado) ";
									$qry_visitado.="values ($ultima_visita, '$visitado', 1)";			
									$query($qry_visitado);									
									$cnt++;							
									
							  }
							
							// insertar equipos ingresados
				  		    $cnt=1; 		
					  		while($cnt<=count($equipo))
							  {		
									$qry_equipo ="insert into seg_equipo_det";	
									$qry_equipo.="(codigo_visita, codigo_equipo, numero_serie, codigo_mov_equipo) ";
									$qry_equipo.="values ($ultima_visita, '$equipo[$cnt]', '$serie[$cnt]', '$movimiento[$cnt]')";			
									$query($qry_equipo);									
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
											$nomb_remitente = 'Notificaci??n autom???tica de ingreso de visitante';
											$mail_remitente = 'nhernandez@mineco.gob.gt';
											//$mensaje='prueba';
											$mensaje = 'En este momento el(la) se???or(a) '.$txt_visitante.' ingres??? al Ministerio indicando que lo visitar???a a usted, para confirmar su visita <a href="aseggys.mineco.gob.gt/confirmar.php">HAGA CLIC AQUI</a> de lo contrario comuniquese a Seguridad a la extensi??n 1000.';
	$titulo = "NOTIFICACION AUTOMATICA DE VISITA";
	envio($nomb_destino,$mail_destino,$nomb_remitente,$mail_remitente,$mensaje,$titulo,"","");
										}									
										$cnt++;			
								 }
							}
							// finaliza confirmacion
							echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA GRABADO CORRECTAMENTE<br><br>Para ingresar otro registro <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';															
						} // fin del ingreso del encabezado
						else
						{
							echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, El registro NO se ha grabado<br><br>Para intentar nuevamente <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
						}
					}	//fin sino encontro registros coincidentes.
					else
					{
						echo '<tr><td class="error" colspan="3" align="center">ESTE REGISTRO YA EXISTE!!<br><br>Para ingresar otro registro <a href="agregar.php">[HAGA CLIC AQUI]</a></td></tr>';
					}
			}
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
			}			
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para ingresar otro registro <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>             
	</td>
  </tr>
</table>
</body>
</html>
