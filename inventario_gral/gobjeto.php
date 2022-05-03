<?
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0">
  <tr>
    <td width="18%" height="25"><div align="left"><img src="../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td width="72%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORM&Aacute;TICA</p>
    <p align="center" class="titulocategoria"> INVENTARIO DE HARDWARE Y SOFTWARE </p></td>
    <td width="10%"><div align="right"><img src="../images/hard_soft.jpg" width="112" height="113"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../images/linea.gif" width="100%" height="6"></td>   
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
			conectardb($inventarioopera);
			/////////////////////// consultar sino se ha ingresado previamente el No. de SICOIN ///////////////////////////////////////
			$existe=false;
			$qry_consultasicoin="select * from tb_inventario where numero_sicoin='$numero_sicoin' and codigo_objeto='$txt_obj'";
			$res_qry_consultasicoin=$query($qry_consultasicoin);	
			while($row_qry_consultasicoin=$fetch_array($res_qry_consultasicoin))
			{
				$existe=true;
				$mensaje_error="SICOIN";
			}
			//////////////////////// verifica que este numero de etiqueta no est� ingresado /////////////////////////////////////////////
			if ($obj==2) 
			{
				$qry_consultaet="select * from tb_inventario_etiqueta_det where numero_etiqueta='$txt_etiqueta' and codigo_dependencia_et=1";
				$res_qry_consultaet=$query($qry_consultaet);	
				while($row_qry_consultaet=$fetch_array($res_qry_consultaet))
				{
					$existe=true;
					$mensaje_error="ETIQUETA DE SEGURIDAD";
				}
			}			
			if ($existe==false)
			{
				///////////////////////////fin de la consulta ////////////////////////////////////////////////////////////////////////////
				
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
					$campo[$cnt]=$row_qry_plantilla["propiedad"];
					$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_propiedad"];					
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
				$free_result($res_qry_plantilla);
				$qry_insert="insert into tb_inventario(codigo_categoria, codigo_subcategoria, codigo_objeto, ";
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista de campos a grabar
				{
					$qry_insert.="$campo[$cnt], ";				
					$cnt++;
				}// fin del while que forma el qry_insert			
				$qry_insert.="usuario_creo, fecha_creado, activo) values ('$txt_cat', '$txt_subcat', '$txt_obj', ";			
				$cnt=1;			
				while ($cnt<=count($campo))  //concatena el contenido a grabar en los campos
				{
					//inicia carga de archivo
					if ($tipo_campo[$cnt]=='5')
					{
						$nombre_archivo = $HTTP_POST_FILES['archivo']['name'];
						$tipo_archivo = $HTTP_POST_FILES['archivo']['type']; 
						$extension = split('[.]',$nombre_archivo);
						$extension = $extension[sizeof($extension)-1];		
						$tamano_archivo = $HTTP_POST_FILES['archivo']['size']; 		
						//compruebo si las caracter�sticas del archivo son las que deseo 		
						if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "htm") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 25024000))) 
						{ 
							$mensaje_error= "La extensión o el tama�o de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (25 MB) m�ximo.</td></tr></table>"; 
						}
						else
						{ 
							//el nombre del archivo ser� el codigo_archivo seg�n la tabla publicación mas la extensión			
							$qry_ultimo_reg="select max(codigo_inventario_enc) as ultimo_registro  from tb_inventario where codigo_objeto='$txt_obj'";
							$res_qry_ultimo_reg=$query($qry_ultimo_reg);	
							while($row_qry_ultimo_reg=$fetch_array($res_qry_ultimo_reg))					
							{
								$codigo_archivo=$row_qry_ultimo_reg["ultimo_registro"]+1;
							}							  
							$nombre_archivo_def=$campo[$cnt]."_".$codigo_archivo.".".$extension;		   
							if (move_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'], "detallepc/".$nombre_archivo_def))
								{ 
								  $mensaje_error= "El archivo ha sido cargado correctamente."; 						   
								  $campo[$cnt]=$nombre_archivo_def;
								}
								else
								{ 
								   $mensaje_error= "Ocurri� alg�n error al subir el fichero. No pudo guardarse."; 
								} // hasta aqui corresponde al archivo
						}
					}	
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);				
					$qry_insert.="'$variable', ";				
					$cnt++;
				}// fin del while que forma el qry_insert			
				$nombre_usuario=$_SESSION["user_name"];
				$qry_insert.="'$nombre_usuario', getdate(), 1)";
				session_unregister("ingresando_obj");	
				$res_insert=$query($qry_insert);			
				if ($res_insert)
				{
					echo '<tr><td class="error" colspan="3" align="center">EL REGISTRO SE HA GRABADO CORRECTAMENTE<br><br>Para ingresar otro registro <a href="objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
					//buscar el ultimo registro grabado
					$qry_ultimo_reg="select max(codigo_inventario_enc) as ultimo_registro from tb_inventario where codigo_objeto='$txt_obj'";
					$res_qry_ultimo_reg=$query($qry_ultimo_reg);	
					while($row_qry_ultimo_reg=$fetch_array($res_qry_ultimo_reg))					
					{
						$codigo_inventario_enc=$row_qry_ultimo_reg["ultimo_registro"];
					}
					//inserta registro en tb_inventario_responsable_det					
						$responsable=$nombre[0][1];
						$qry_responsable="insert into tb_inventario_responsable_det(codigo_inventario_enc, codigo_usuario_responsable, fecha_entrega) values ($codigo_inventario_enc, $responsable, getdate())";										
						$query($qry_responsable);	
					//fin del insert en tb_inventario_responsable_det
					//insertar detalles cuando sea un cpu
					if ($txt_obj==2)  
					{
					  // inserta no de etiqueta
					  $qry_etiqueta="insert into tb_inventario_etiqueta_det(codigo_inventario_enc, numero_etiqueta, fecha_colocacion, motivo, usuario_creo) values ($codigo_inventario_enc, '$txt_etiqueta', '$date1', '$txt_motivo', '$nombre_usuario')";
 					  $query($qry_etiqueta);						  
					  
					  // insertar memoria					  
					/*  $cnt=1; 		
					  while($cnt<=count($marca))
					  {						
							$qry_memoria ="insert into tb_inventario_memoria_det";	
							$qry_memoria.="(codigo_inventario_enc, codigo_marca, serie, codigo_capacidad_memoria, codigo_tipo_memoria, codigo_velocidad, numero_parte) ";
							$qry_memoria.="values ($codigo_inventario_enc, '$marca[$cnt]', '$serie[$cnt]', '$capacidad[$cnt]', '$tipo_memoria[$cnt]', '$velocidad[$cnt]', '$numero_parte[$cnt]')";			
							$query($qry_memoria);							
							$cnt++;
					  }					  
					  // insertar procesador					  
					  $cnt=1; 		
					  while($cnt<=count($marcaproc))
					  {						
							$qry_proc ="insert into tb_inventario_procesador_det";	
							$qry_proc.="(codigo_inventario_enc, codigo_marca, serie, codigo_tipo_slot, codigo_velocidad_procesador, codigo_tipo_procesador) ";
							$qry_proc.="values ($codigo_inventario_enc, '$marcaproc[$cnt]', '$serieproc[$cnt]', '$socket[$cnt]', '$velocidadproc[$cnt]', '$tipoproc[$cnt]')";			
							$query($qry_proc);							
							$cnt++;							
					  }					  
					  // insertar discos duros					  
					  $cnt=1; 		
					  while($cnt<=count($marcadisco))
					  {						
							$qry_hd ="insert into tb_inventario_disco_det";	
							$qry_hd.="(codigo_inventario_enc, codigo_marca, serie, codigo_capacidad_disco, codigo_velocidad_disco, codigo_tipo) ";
							$qry_hd.="values ($codigo_inventario_enc, '$marcadisco[$cnt]', '$seriedisco[$cnt]', '$capacidaddisco[$cnt]', '$velocidaddisco[$cnt]', '$tipodisco[$cnt]')";			
							$query($qry_hd);
							$cnt++;
					  }					*/ 
					  // insertar lectores		  
					  $cnt=1; 		
					  while($cnt<=count($tipolector))
					  {						
							$qry_lector ="insert into tb_inventario_lector_det";	
							$qry_lector.="(codigo_inventario_enc, codigo_tipo_lector) ";
							$qry_lector.="values ($codigo_inventario_enc, '$tipolector[$cnt]')";			
							$query($qry_lector);
							$cnt++;
					  }
					   // insertar software oem	  
					  $cnt=1; 		
					  while($cnt<=count($version))
					  {						
							$qry_oem ="insert into tb_inventario_software_det";	
							$qry_oem.="(codigo_inventario_enc, cdkey, serie, codigo_version, codigo_idioma, activo) ";
							$qry_oem.="values ($codigo_inventario_enc, '$cdkey[$cnt]', '$seriesoftwareoem[$cnt]', '$version[$cnt]', '$idioma[$cnt]', 1)";			
							$query($qry_oem);
							$cnt++;
					  }					 
					   // insertar software instalado	  
					  $cnt=1; 		
					  while($cnt<=count($fabricante))
					  {						
							$qry_install ="insert into tb_inventario_softwareinstall_det";	
							$qry_install.="(codigo_inventario_enc, codigo_casa_software, software, serie,  licencia) ";
							$qry_install.="values ($codigo_inventario_enc, '$fabricante[$cnt]', '$software[$cnt]', '$serieinstall[$cnt]', '$conlicencia[$cnt]')";			
							$query($qry_install);
							$cnt++;
					  }					  					 			  
					} //fin de ingreso de los detalles				
				} // fin del ingreso del encabezado
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, El registro NO se ha grabado<br><br>Para intentar nuevamente <a href="objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
				}	
				
			} //fin del if si existe es false
			else
			{
				echo '<tr><td class="error" colspan="3" align="center">Ya se ha ingresado un objeto de este tipo con este n�mero de '.$mensaje_error.' <br><br>Para ingresar otro <a href="objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
			}			
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para continuar ingresando bienes <a href="objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
