<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
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
    <td width="11%" height="25"><div align="center"><img src="../../images/logo_rpt_mineco.gif" width="82" height="95"></div></td>
    <td width="77%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA FINANCIERA</p>
    <p align="center" class="titulocategoria">M&Oacute;DULO DE PRESUPUESTOS </p></td>
    <td width="12%"><div align="right"><img src="../../images/presupuesto.jpg" width="128" height="89"></div></td>
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
		$obj=$txt_obj;
		$acceso=permisosdb($presupuesto);							
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
			conectardb($presupuesto);
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
					$registro_encontrado=true;
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
						$qry_insert.="usuario_creo, fecha_creado, activo) values (";			
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
									//compruebo si las caracter�sticas del archivo son las que deseo 		
									if ((($extension=="EXE") || ($extension=="COM") || ($extension=="BAT") || ($extension=="PHP")) && ($tamano_archivo < 25024000)) 
									{ 
										echo '<tr><td class="titulocategoria" colspan="3" align="center">La extensión o el tama�o de los archivos no es correcta en el campo '.$campo[$cnt].'. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (10 MB) m�ximo.</td></tr>'; 
									}
									else
									{ 
										//el nombre del archivo ser� el codigo_archivo seg�n la tabla publicación mas la extensión			
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
						$qry_insert.="'$nombre_usuario', getdate(), 1)";												
						session_unregister("ingresando_obj");																																							
						$res_insert=$query($qry_insert);									
						if ($res_insert)
						{
							// Grabar el detalle del ingreso de presupuesto anual
							
							//buscar el ultimo registro grabado
					$qry_ultimo_reg="select max(codigo_financiamiento_actividad) as ultimo_registro from tb_financiamiento_actividad ";
					$res_qry_ultimo_reg=$query($qry_ultimo_reg);	
					while($row_qry_ultimo_reg=$fetch_array($res_qry_ultimo_reg))					
					{
						$codigo_financiamiento_enc=$row_qry_ultimo_reg["ultimo_registro"];
					}
					//inserta registro en tb_inventario_responsable_det	
					 $cnt=1; 		
					  while($cnt<=count($bien))
					  {						
						$codigo=$bien[$cnt][0];
						$qry_consulta_codigo="select * from cat_grupo where codigo='$codigo'";
						$res_qry_consulta_codigo=$query($qry_consulta_codigo);
						while($row_qry_codigo=$fetch_array($res_qry_consulta_codigo))					
						{
							$codigo_grupo=$row_qry_codigo["codigo_grupo"];
						}
						$qry_presupuesto_grupo="insert into tb_presupuesto_anual(codigo_financiamiento_actividad, codigo_grupo,monto_presupuestado) values ($codigo_financiamiento_enc, $codigo_grupo, $monto[$cnt])";										
						$query($qry_presupuesto_grupo);
							$cnt++;
					  }
							/////////// fin del detalle
							
							echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA GRABADO CORRECTAMENTE<br><br>Para ingresar otro registro <a href="agregar.php?obj='.$obj.'">[HAGA CLIC AQUI]</a></td></tr>';															
						} // fin del ingreso del encabezado
						else
						{
							echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, El registro NO se ha grabado<br><br>Para intentar nuevamente <a href="agregar.php?obj='.$obj.'">[HAGA CLIC AQUI]</a></td></tr>';
						}
					}	//fin sino encontro registros coincidentes.
					else
					{
						echo '<tr><td class="error" colspan="3" align="center">ESTE REGISTRO YA EXISTE!!<br><br>Para ingresar otro registro <a href="agregar.php?obj='.$obj.'">[HAGA CLIC AQUI]</a></td></tr>';
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
		echo '<tr><td class="error" colspan="3" align="center">Para ingresar otro registro <a href="agregar.php?obj='.$obj.'">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
