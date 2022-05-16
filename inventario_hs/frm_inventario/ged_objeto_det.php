<?
	require("../../includes/funciones.php");
	require("../../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
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
			conectardb($inventarioadmin);/////////////////////// consultar sino se ha ingresado previamente el No. de SICOIN ///////////////////////////////////////
			$existe=false;			
			if ($existe==false)
			{
				///////////////////////////consulta plantilla por tipo de objeto ////////////////////////////////////////////////////////////////////////////
				$qry_plantilla="SELECT o.codigo_objeto, p.propiedad, p.codigo_tipo_propiedad, p.tb_origen, 
							  p.campo_origen, p.campo_llave, p.tamano, p.etiqueta
							  FROM tb_plantilla pl INNER JOIN
							  tb_propiedad p ON pl.codigo_propiedad = p.codigo_propiedad INNER JOIN
							  cat_objeto o ON pl.codigo_objeto = o.codigo_objeto
							  where pl.codigo_objeto='$txt_obj'"; 					  
				$res_qry_plantilla=$query($qry_plantilla);	
				$cnt=1;
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
				{
					if ($row_qry_plantilla["codigo_tipo_propiedad"]!= '6')
					{									
						$campo[$cnt]=$row_qry_plantilla["propiedad"];				
						$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_propiedad"];	
						$cnt++;					
					}
					if ($row_qry_plantilla["codigo_tipo_propiedad"]==6)  //para saber en que tabla se grabara y a traves de que campo se realizara el filtro del reg. seleccionado.
					{
						$tabla_destino=$row_qry_plantilla["tb_destino"];
						$campo_llave_destino=$row_qry_plantilla["propiedad"];										
					}					
				}	 //fin del while que indica los campos que corresponden al objeto
				$free_result($res_qry_plantilla);				
				$qry_insert="update tb_inventario set ";
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista de campos a grabar
				{													
					if ($tipo_campo[$cnt]=='5')
					{	
						$nombre_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['name'];						
						if ($nombre_archivo=="") //inicia carga de archivo
						{							
							$variable_temp=$campo[$cnt]."_temp";						
							$variable=($_REQUEST["$variable_temp"]);											
							$mensaje= "No se reemplaz� el archivo"; 							
						}
						else //si viene vacio no se sobreescribe el archivo
						{								
							//$nombre_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['name'];
							$tipo_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['type']; 
							$extension = split('[.]',$nombre_archivo);
							$extension = $extension[sizeof($extension)-1];																							
							$tamano_archivo = $HTTP_POST_FILES["$campo[$cnt]"]['size']; 		
							//compruebo si las caracter�sticas del archivo son las que deseo 		
							if (((strpos($tipo_archivo, "exe") || strpos($tipo_archivo, "com") || strpos($tipo_archivo, "bat") || strpos($tipo_archivo, "php")) && ($tamano_archivo < 25024000))) 
							{ 
								$mensaje= "La extensión o el TAMAÑO de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (25 MB) m�ximo.</td></tr></table>"; 
							}
							else
							{ 
								//el nombre del archivo ser� el codigo_archivo seg�n la tabla publicación mas la extensión			
								$codigo_archivo=$_REQUEST["txt_id"];														  
								$nombre_archivo_def=$campo[$cnt]."_".$codigo_archivo.".".$extension;															   																
								if (move_uploaded_file($HTTP_POST_FILES["$campo[$cnt]"]['tmp_name'], "detallepc/".$nombre_archivo_def))
									{ 

									  $mensaje= "El archivo ha sido cargado correctamente."; 													     
									  $variable=$nombre_archivo_def;
									}
									else
									{ 									  
									   $mensaje= "Ocurri� alg�n error al subir el fichero. No pudo guardarse."; 
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
				$qry_insert.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo=1 where codigo_inventario_enc=$txt_id";			
				$cnt=1;	
				session_unregister("ingresando_obj");									
				$res_insert=$query($qry_insert);							
				if ($res_insert)
				{					
					echo '<tr><td class="titulocategoria" colspan="3" align="center">'.$mensaje.'<br></td></tr>';	
					echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA ACTUALIZADO CORRECTAMENTE<br><br>Para modificar otro registro <a href="ed_objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
					//buscar el ultimo registro grabado
					$codigo_inventario_enc=$_REQUEST["txt_id"];										
					
					//insertar detalles cuando sea un cpu
					if ($txt_obj==2)  
					{ 
					  $label=$_REQUEST["txt_etiqueta"];
					  echo $label;
					  //inserta no de etiqueta						 
						 if (!($label==""))						 
						  {							 
							 $qry_etiqueta="insert into tb_inventario_etiqueta_det(codigo_inventario_enc, numero_etiqueta, fecha_colocacion, motivo, usuario_creo, activo) values ($codigo_inventario_enc, '$txt_etiqueta', '$date1', '$txt_motivo', '$nombre_usuario', 1)";							  
							 $query($qry_etiqueta);	
							 $qry_actualiza_etiqueta="update tb_inventario_etiqueta_det set activo=2 where codigo_inventario_enc='$codigo_inventario_enc' and numero_etiqueta<>'$txt_etiqueta'";
							 $query($qry_actualiza_etiqueta);	
						  }
					  
					  $cnt=1; 		
				      while($cnt<=count(tipo_lector_upd))
					  {					 
					   if ($tipo_lector_upd[$cnt]=="0") $tipo_lector_upd[$cnt]=$tipo_lector_upd_temp[$cnt];   					  
					   if (!isset($estado_lector_upd[$cnt])) $estado_lector_upd[$cnt]=2;								  		   			   		   
						   $qry_lector ="update tb_inventario_lector_det set ";
						   $qry_lector.="codigo_tipo_lector='$tipo_lector_upd[$cnt]',"; 
						   $qry_lector.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo='$estado_lector_upd[$cnt]'";
						   $qry_lector.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_lector[$cnt]'";					   	  
						   $query($qry_lector);											   
					   $cnt++; 					  
					  }				 
					  // insertar lectores		  
					  $cnt=1; 		
					  while($cnt<=count($tipolector))
					  {						
							$qry_lector ="insert into tb_inventario_lector_det";	
							$qry_lector.="(codigo_inventario_enc, codigo_tipo_lector, activo) ";
							$qry_lector.="values ($codigo_inventario_enc, '$tipolector[$cnt]', 1)";			
							$query($qry_lector);
							$cnt++;
					  }
					   // actualizar software oem
					  $cnt=1; 		
				      while($cnt<=count($version_software_upd))
					  {
					   if ($version_software_upd[$cnt]=="0") $version_software_upd[$cnt]=$version_software_upd_temp[$cnt];
					   if ($idioma_software_upd[$cnt]=="0") $idioma_software_upd[$cnt]=$idioma_software_upd_temp[$cnt];					
					   $cdkey_software_upd[$cnt]=strtoupper($cdkey_software_upd[$cnt]);		
					   $serie_software_upd[$cnt]=strtoupper($serie_software_upd[$cnt]);							   			   		   
						   $qry_oem ="update tb_inventario_software_det set ";
						   $qry_oem.="codigo_version='$version_software_upd[$cnt]', serie='$serie_software_upd[$cnt]', codigo_idioma='$idioma_software_upd[$cnt]', cdkey='$cdkey_software_upd[$cnt]',"; 
						   $qry_oem.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate()";
						   $qry_oem.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_software[$cnt]'";					   	  
						   $query($qry_oem);							   
					   $cnt++; 					  
					  }									   
					   // insertar software oem	  
					  $cnt=1; 		
					  while($cnt<=count($version))
					  {						
							$cdkey[$cnt]=strtoupper($cdkey[$cnt]);
							$seriesoftwareoem[$cnt]=strtoupper($seriesoftwareoem[$cnt]);
							$qry_oem ="insert into tb_inventario_software_det";	
							$qry_oem.="(codigo_inventario_enc, cdkey, serie, codigo_version, codigo_idioma, activo) ";
							$qry_oem.="values ($codigo_inventario_enc, '$cdkey[$cnt]', '$seriesoftwareoem[$cnt]', '$version[$cnt]', '$idioma[$cnt]', 1)";										
							$query($qry_oem);
							$cnt++;
					  }
					   // actualizar software instalado
					  $cnt=1; 		
				      while($cnt<=count($software_upd))
					  {					
   					   if ($casa_softwareinstall_upd[$cnt]=="0") $casa_softwareinstall_upd[$cnt]=$casa_softwareinstall_upd_temp[$cnt];				
					   $software_upd[$cnt]=strtoupper($software_upd[$cnt]);		
					   $serie_softwareinstall_upd[$cnt]=strtoupper($serie_softwareinstall_upd[$cnt]);		
					   if (!isset($estado_softwareinstall_upd[$cnt])) $estado_softwareinstall_upd[$cnt]=2;						   
					   if (!isset($licencia_softwareinstall_upd[$cnt])) $licencia_softwareinstall_upd[$cnt]=2;
					   else	$licencia_softwareinstall_upd[$cnt]=1;					   							
						   $qry_install ="update tb_inventario_softwareinstall_det set ";
						   $qry_install.="software='$software_upd[$cnt]', serie='$serie_softwareinstall_upd[$cnt]', codigo_casa_software='$casa_softwareinstall_upd[$cnt]',"; 
						   $qry_install.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo='$estado_softwareinstall_upd[$cnt]', licencia='$licencia_softwareinstall_upd[$cnt]'";
						   $qry_install.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_softwareinstall[$cnt]'";					   	  
						   $query($qry_install);											   
					   $cnt++; 					  
					  }							
					   // insertar software instalado	  
					  $cnt=1; 		
					  while($cnt<=count($fabricante))
					  {						
							if (!isset($conlicencia[$cnt])) $conlicencia=2;
							else $conlicencia=1;
							$software[$cnt]=strtoupper($software[$cnt]);
							$serieinstall[$cnt]=strtoupper($serieinstall[$cnt]);
							$qry_install ="insert into tb_inventario_softwareinstall_det";	
							$qry_install.="(codigo_inventario_enc, codigo_casa_software, software, serie, licencia, activo) ";
							$qry_install.="values ($codigo_inventario_enc, '$fabricante[$cnt]', '$software[$cnt]', '$serieinstall[$cnt]', '$conlicencia', 1)";			
							$query($qry_install);							
							$cnt++;
					  }	  					 			  
					} //fin de ingreso de los detalles				
				} // fin del ingreso del encabezado
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, los cambios NO se han grabado<br><br>Para intentar nuevamente <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
				}	
				
			} //fin del if si existe es false
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">Ya se ha ingresado un objeto de este tipo con este número de '.$mensaje_error.' <br><br>Para ingresar otro <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
			}			
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para continuar modificando bienes <a href="buscar/buscar.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
