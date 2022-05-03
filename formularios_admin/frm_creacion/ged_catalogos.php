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
    <td width="18%" height="25"><div align="left"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORM&Aacute;TICA</p>
    <p align="center" class="titulocategoria"> INVENTARIO DE HARDWARE Y SOFTWARE </p></td>
    <td width="10%"><div align="right"><img src="../../images/hard_soft.jpg" width="112" height="113"></div></td>
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
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion,
							c.campo_origen, c.campo_llave as campollave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo, c.cambio_fila,
							p.condicion, p.campo_llave
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj'
							order by orden"; 																		
			require_once('../../connection/helpdesk.php');				
			$res_qry_plantilla=$query($qry_plantilla);		
			$cnt=1;
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				if ($row_qry_plantilla["codigo_tipo_campo"]!= '6')
				{									
					$campo[$cnt]=$row_qry_plantilla["campo"];				
					$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];	
					$cnt++;					
				}
				if ($row_qry_plantilla["campo_llave"]==1)  //para saber en que tabla se grabara y a traves de que campo se realizara el filtro del reg. seleccionado.
				{
					$tabla_destino=$row_qry_plantilla["tb_destino"];
					$campo_llave_destino=$row_qry_plantilla["campo"];										
				}
			} //fin del while que indica los campos que corresponden al objeto				
			$free_result($res_qry_plantilla);
			$qry_insert="update $tabla_destino set ";
			$cnt=1;
			while ($cnt<=count($campo)) //concatena lista de campos a grabar
				{													
					if ($tipo_campo[$cnt]=='5')
					{							
						$nombre_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['name'];
						if ($nombre_archivo=="") //inicia carga de archivo
						{	
							$variable_temp=$campo[$cnt]."_temp";						
							if ($variable_temp!="")
								$variable=($_REQUEST["$variable_temp"]);											
								else
									$variable="NA";								
							echo '<tr><td class="titulocategoria" colspan="3" align="center">No se reemplaz� el archivo en el campo '.$campo[$cnt].'</td></tr>'; 							
						}
						else //si viene vacio no se sobreescribe el archivo
						{								
							$nombre_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['name'];
							$tipo_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['type']; 
							$extension = split('[.]',$nombre_archivo);
							$extension = $extension[sizeof($extension)-1];																							
							$tamano_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['size']; 		
							//compruebo si las caracter�sticas del archivo son las que deseo 		
							if ((($extension=="EXE") || ($extension=="COM") || ($extension=="BAT") || ($extension=="PHP")) && ($tamano_archivo < 25024000)) 
							{ 
								echo '<tr><td class="titulocategoria" colspan="3" align="center">La extensión o el tama�o de los archivos no es correcta en el campo '.$campo[$cnt].'. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (10 MB) m�ximo.</td></tr>'; 
							}
							else
							{ 								
								//el nombre del archivo ser� el codigo_archivo	
								$codigo_archivo=$_REQUEST["txt_id"];														  
								$nombre_archivo_def=strtoupper($campo[$cnt].$tamano_archivo."_".$codigo_archivo.".".$extension);															   																																
								if (move_uploaded_file($HTTP_POST_FILES["$campo[$cnt]"]['tmp_name'], "archivos/".$nombre_archivo_def))
									{ 
									echo '<tr><td class="titulocategoria" colspan="3" align="center">El archivo del campo '.$campo[$cnt].' se ha cargado correctamente</td></tr>';																										     
									$variable=$nombre_archivo_def;
									}
									else
									{ 									  
									   echo '<tr><td class="titulocategoria" colspan="3" align="center">No se ha grabado archivo en el campo '.$campo[$cnt].'</td></tr>'; 
									} // hasta aqui corresponde al archivo
							} //fin si se acepto el tipo y tamano de archivo
						}// fin sino viene vacio el campo				
						
					}	// fin si el tipo de campo es archivo
					else //si es otro tipo de campo
					{						
						if (!isset($_REQUEST["$campo[$cnt]"])) 
						{
							$variable_temp=$campo[$cnt]."_temp";						
							$variable=($_REQUEST["$variable_temp"]);							
						}
						else
						{
							$variable=strtoupper($_REQUEST["$campo[$cnt]"]);	
						}
					}
					$qry_insert.="$campo[$cnt]='$variable', ";				
					$cnt++;
				}// fin del while que forma el qry_insert							
				$nombre_usuario=$_SESSION["user_name"];
				$qry_insert.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo=1 where $campo_llave_destino=$txt_id";														
				//session_unregister("ingresando_obj");	
				conectardb($formularioadmin);					
				$res_insert=$query($qry_insert);			
				if ($res_insert)
				{					
					echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA ACTUALIZADO CORRECTAMENTE<br><br>Para modificar otro registro <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';															
					//buscar el ultimo registro grabado
					$codigo_formulario=$_REQUEST["txt_id"];					
					
					//actualiza la informacion de los campos que forma el formulario
					  $cnt=1; 		
				      while($cnt<=count($txt_campo_upd))
					  {					 
					   if ($cbo_tipocampo_upd[$cnt]=="0") $cbo_tipocampo_upd[$cnt]=$cbo_tipocampo_upd_temp[$cnt]; 
   					   if ($cbo_tipocombo_upd[$cnt]=="0") $cbo_tipocombo_upd[$cnt]=$cbo_tipocombo_upd_temp[$cnt]; 					  			  					
						   $qry_campo ="update tb_campo set ";
						   $qry_campo.="campo='$txt_campo_upd[$cnt]', codigo_tipo_campo='$cbo_tipocampo_upd[$cnt]', tb_origen='$txt_tborigen_upd[$cnt]',"; 
					       $qry_campo.=" campo_origen='$txt_campoorigen_upd[$cnt]', campo_llave='$txt_campollave_upd[$cnt]', tamano='$txt_tamano_upd[$cnt]',"; 
					       $qry_campo.=" etiqueta='$txt_etiqueta_upd[$cnt]', orden='$txt_orden_upd[$cnt]', tb_destino='$txt_tbdestino_upd[$cnt]',"; 
   					       $qry_campo.=" campo_destino='$txt_campodestino_upd[$cnt]', tipo_combo='$cbo_tipocombo_upd[$cnt]', combo_destino='$txt_combodestino_upd[$cnt]',"; 
					       $qry_campo.=" validar='$txt_validar_upd[$cnt]', texto_validacion='$txt_textovalidacion_upd[$cnt]', activo='$txt_activo_upd[$cnt]', ayuda='$txt_tip_upd[$cnt]', cambio_fila='$txt_posicion_upd[$cnt]', "; 
						   $qry_campo.=" usuario_modifico='$nombre_usuario', fecha_modificado=getdate()";
						   $qry_campo.=" where codigo_campo='$txt_codigo_campo_upd[$cnt]'";					   	  
						   $query($qry_campo);							  
						   //actualiza las condiciones de los campos en la tabla tb_plantilla
						   if ($cbo_tipocampo_upd[$cnt]=='6') $campollave=1;
						   else $campollave=2;								  
						   $qry_campo ="update tb_plantilla set ";
   						   $qry_campo.="condicion='$txt_condicion_upd[$cnt]', campo_llave='$campollave'";
   						   $qry_campo.=" where codigo_campo='$txt_codigo_campo_upd[$cnt]' and codigo_formulario='$codigo_formulario'";					   	  
						   $query($qry_campo);								   			   										   
					   $cnt++; 					  
					  }		
					 //////////////////////////// INSERTA LOS CAMPOS que se agregaron al formulario
							  $cnt=1; 		
							  while($cnt<=count($txt_campo))
							  {						
									$qry_campo ="insert into tb_campo";	
									$qry_campo.="(campo, codigo_tipo_campo, tb_origen, campo_origen, campo_llave, tamano, orden, tb_destino, campo_destino, tipo_combo, combo_destino, validar, texto_validacion, ayuda, etiqueta, activo, cambio_fila) ";
									$qry_campo.="values ('$txt_campo[$cnt]', '$cbo_tipocampo[$cnt]', '$txt_tborigen[$cnt]', '$txt_campoorigen[$cnt]', '$txt_campollave[$cnt]', '$txt_tamano[$cnt]', '$txt_orden[$cnt]', '$txt_tbdestino[$cnt]', '$txt_campodestino[$cnt]', '$cbo_tipocombo[$cnt]', '$cbo_combodestino[$cnt]', '$txt_validar[$cnt]', '$txt_textovalidacion[$cnt]', '$txt_tip[$cnt]', '$txt_etiqueta[$cnt]', 1, '$txt_posicion[$cnt]')";												
									$query($qry_campo);																
									//buscar el ultimo registro grabado
									$qry_ultimo_reg="select max(codigo_campo) as ultimo_registro from tb_campo";
									$res_qry_ultimo_reg=$query($qry_ultimo_reg);	
									while($row_qry_ultimo_reg=$fetch_array($res_qry_ultimo_reg))					
									{
										$codigo_campo=$row_qry_ultimo_reg["ultimo_registro"];										
									}
									//INSERTA EN TB_PLANTILLA LOS CAMPOS QUE CORRESPONDEN AL FORMULARIO																		
									if ($tipo_campo[$cnt]=='6') $campollave=1;
									else $campollave=2;									
									$qry_inserta_plantilla ="insert into tb_plantilla";	
									$qry_inserta_plantilla.="(codigo_formulario, codigo_campo, condicion, campo_llave) ";
									$qry_inserta_plantilla.="values ('$codigo_formulario', '$codigo_campo', '$txt_condicion[$cnt]', '$campollave')";			
									$query($qry_inserta_plantilla);									
									$cnt++;
							  }	
				} // fin del ingreso del encabezado
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">Se produjo un error durante la actualización, El registro NO ha cambiado<br><br>Para intentar nuevamente <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
				}	
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para continuar llenando los cat�logos <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
