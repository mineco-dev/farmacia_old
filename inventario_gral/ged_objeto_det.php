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
					$campo[$cnt]=$row_qry_plantilla["propiedad"];					
					echo '<br>';
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
				$free_result($res_qry_plantilla);				
				$qry_insert="update tb_inventario set ";
				$cnt=1;
				while ($cnt<=count($campo)) //concatena lista de campos a grabar
				{
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);			
					if ($variable=="0") 
					{
						$variable_temp=$campo[$cnt]."_temp";						
						$variable=($_REQUEST["$variable_temp"]);
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
					echo '<tr><td class="error" colspan="3" align="center">EL REGISTRO SE HA ACTUALIZADO CORRECTAMENTE<br><br>Para modificar otro registro <a href="ed_objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
					//buscar el ultimo registro grabado
					$codigo_inventario_enc=$_REQUEST["txt_id"];					
					
					//insertar detalles cuando sea un cpu
					if ($txt_obj==2)  
					{ 
					  // actualizar memoria
					  $cnt=1; 		
				      while($cnt<=count($marca_upd))
					  {
					   if ($marca_upd[$cnt]=="0") $marca_upd[$cnt]=$marca_upd_temp[$cnt];
					   if ($capacidad_upd[$cnt]=="0") $capacidad_upd[$cnt]=$capacidad_upd_temp[$cnt];
  					   if ($tipo_upd[$cnt]=="0") $tipo_upd[$cnt]=$tipo_upd_temp[$cnt];
   					   if ($velocidad_upd[$cnt]=="0") $velocidad_upd[$cnt]=$velocidad_upd_temp[$cnt];		
					   if (!isset($estado_mem_upd[$cnt])) $estado_mem_upd[$cnt]=2;			
					   $numero_parte_upd[$cnt]=strtoupper($numero_parte_upd[$cnt]);
					   $serie_upd[$cnt]=strtoupper($serie_upd[$cnt]);					   		   
						   $qry_memoria ="update tb_inventario_memoria_det set ";
						   $qry_memoria.="codigo_marca='$marca_upd[$cnt]', serie='$serie_upd[$cnt]', codigo_capacidad_memoria='$capacidad_upd[$cnt]', codigo_tipo_memoria='$tipo_upd[$cnt]', codigo_velocidad='$velocidad_upd[$cnt]',"; 
						   $qry_memoria.="numero_parte='$numero_parte_upd[$cnt]', usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo='$estado_mem_upd[$cnt]'";
						   $qry_memoria.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_memoria[$cnt]'";					   	  
						   $query($qry_memoria);							   
					   $cnt++; 					  
					  }					  
					  // insertar memoria					  
					  $cnt=1; 		
					  while($cnt<=count($marca))
					  {						
							$numero_parte[$cnt]=strtoupper($numero_parte[$cnt]);
					   		$serie[$cnt]=strtoupper($serie[$cnt]);	
							$qry_memoria ="insert into tb_inventario_memoria_det";	
							$qry_memoria.="(codigo_inventario_enc, codigo_marca, serie, codigo_capacidad_memoria, codigo_tipo_memoria, codigo_velocidad, numero_parte, usuario_creo, fecha_creado, activo) ";
							$qry_memoria.="values ($codigo_inventario_enc, '$marca[$cnt]', '$serie[$cnt]', '$capacidad[$cnt]', '$tipo_memoria[$cnt]', '$velocidad[$cnt]', '$numero_parte[$cnt]', '$nombre_usuario', getdate(), 1)";			
							$query($qry_memoria);							
							$cnt++;							
					  }	
					  // actualizar procesador
					  $cnt=1; 		
				      while($cnt<=count($marca_proc_upd))
					  {
					   if ($marca_proc_upd[$cnt]=="0") $marca_proc_upd[$cnt]=$marca_proc_upd_temp[$cnt];
					   if ($slot_upd[$cnt]=="0") $slot_upd[$cnt]=$slot_upd_temp[$cnt];
   					   if ($velocidad_proc_upd[$cnt]=="0") $velocidad_proc_upd[$cnt]=$velocidad_proc_upd_temp[$cnt];		  					 
					   if ($tipo_proc_upd[$cnt]=="0") $tipo_proc_upd[$cnt]=$tipo_proc_upd_temp[$cnt];
					   if (!isset($estado_proc_upd[$cnt])) $estado_proc_upd[$cnt]=2;								  
					   $serie_proc_upd[$cnt]=strtoupper($serie_proc_upd[$cnt]);					   		   
						   $qry_proc ="update tb_inventario_procesador_det set ";
						   $qry_proc.="codigo_marca='$marca_proc_upd[$cnt]', serie='$serie_proc_upd[$cnt]', codigo_tipo_slot='$slot_upd[$cnt]', codigo_tipo_procesador='$tipo_proc_upd[$cnt]', codigo_velocidad_procesador='$velocidad_proc_upd[$cnt]',"; 
						   $qry_proc.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo='$estado_proc_upd[$cnt]'";
						   $qry_proc.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_procesador[$cnt]'";					   	  
						   $query($qry_proc);							   
					   $cnt++; 					  
					  }	
					  				  
					  // insertar procesador					  
					  $cnt=1; 		
					  while($cnt<=count($marcaproc))
					  {						
							$qry_proc ="insert into tb_inventario_procesador_det";	
							$qry_proc.="(codigo_inventario_enc, codigo_marca, serie, codigo_tipo_slot, codigo_velocidad_procesador, codigo_tipo_procesador, activo) ";
							$qry_proc.="values ($codigo_inventario_enc, '$marcaproc[$cnt]', '$serieproc[$cnt]', '$socket[$cnt]', '$velocidadproc[$cnt]', '$tipoproc[$cnt]', 1)";			
							$query($qry_proc);							
							$cnt++;							
					  }					  
					 // actualizar disco duro
					  $cnt=1; 		
				      while($cnt<=count($marca_disco_upd))
					  {
					   if ($marca_disco_upd[$cnt]=="0") $marca_disco_upd[$cnt]=$marca_disco_upd_temp[$cnt];
					   if ($capacidad_disco_upd[$cnt]=="0") $capacidad_disco_upd[$cnt]=$capacidad_disco_upd_temp[$cnt];
   					   if ($velocidad_disco_upd[$cnt]=="0") $velocidad_disco_upd[$cnt]=$velocidad_disco_upd_temp[$cnt];		  					 
					   if ($tipo_disco_upd[$cnt]=="0") $tipo_disco_upd[$cnt]=$tipo_disco_upd_temp[$cnt];
					   if (!isset($estado_disco_upd[$cnt])) $estado_disco_upd[$cnt]=2;								  
					   $serie_disco_upd[$cnt]=strtoupper($serie_disco_upd[$cnt]);					   		   
						   $qry_disco ="update tb_inventario_disco_det set ";
						   $qry_disco.="codigo_marca='$marca_disco_upd[$cnt]', serie='$serie_disco_upd[$cnt]', codigo_tipo='$tipo_disco_upd[$cnt]', codigo_capacidad_disco='$capacidad_disco_upd[$cnt]', codigo_velocidad_disco='$velocidad_disco_upd[$cnt]',"; 
						   $qry_disco.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo='$estado_disco_upd[$cnt]'";
						   $qry_disco.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_disco[$cnt]'";					   	  
						   $query($qry_disco);							   
					   $cnt++; 					  
					  }	
					  // insertar discos duros					  
					  $cnt=1; 		
					  while($cnt<=count($marcadisco))
					  {						
							$qry_hd ="insert into tb_inventario_disco_det";	
							$qry_hd.="(codigo_inventario_enc, codigo_marca, serie, codigo_capacidad_disco, codigo_velocidad_disco, codigo_tipo, activo) ";
							$qry_hd.="values ($codigo_inventario_enc, '$marcadisco[$cnt]', '$seriedisco[$cnt]', '$capacidaddisco[$cnt]', '$velocidaddisco[$cnt]', '$tipodisco[$cnt]', 1)";			
							$query($qry_hd);
							$cnt++;
					  }		
					  // actualizar lector
					  $cnt=1; 		
				      while($cnt<=count($marca_lector_upd))
					  {
					   if ($marca_lector_upd[$cnt]=="0") $marca_lector_upd[$cnt]=$marca_lector_upd_temp[$cnt];
					   if ($tipo_lector_upd[$cnt]=="0") $tipo_lector_upd[$cnt]=$tipo_lector_upd_temp[$cnt];
   					   if ($velocidad_lector_upd[$cnt]=="0") $velocidad_lector_upd[$cnt]=$velocidad_lector_upd_temp[$cnt];		  					 
					   if ($tipo_disco_upd[$cnt]=="0") $tipo_disco_upd[$cnt]=$tipo_disco_upd_temp[$cnt];
					   if (!isset($estado_lector_upd[$cnt])) $estado_lector_upd[$cnt]=2;								  
					   $serie_lector_upd[$cnt]=strtoupper($serie_lector_upd[$cnt]);		
					   $modelo_lector_upd[$cnt]=strtoupper($modelo_lector_upd[$cnt]);							   			   		   
						   $qry_lector ="update tb_inventario_lector_det set ";
						   $qry_lector.="codigo_marca='$marca_lector_upd[$cnt]', serie='$serie_lector_upd[$cnt]', codigo_tipo_lector='$tipo_lector_upd[$cnt]', modelo='$modelo_lector_upd[$cnt]',"; 
						   $qry_lector.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo='$estado_lector_upd[$cnt]'";
						   $qry_lector.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_lector[$cnt]'";					   	  
						   $query($qry_lector);							   
					   $cnt++; 					  
					  }				 
					  // insertar lectores		  
					  $cnt=1; 		
					  while($cnt<=count($marcalector))
					  {						
							$qry_lector ="insert into tb_inventario_lector_det";	
							$qry_lector.="(codigo_inventario_enc, codigo_tipo_lector, serie, codigo_velocidad_lector, codigo_marca, modelo, activo) ";
							$qry_lector.="values ($codigo_inventario_enc, '$tipolector[$cnt]', '$serielector[$cnt]', '$velocidadlector[$cnt]', '$marcalector[$cnt]', '$modelolector[$cnt]', 1)";			
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
							$qry_oem ="insert into tb_inventario_software_det";	
							$qry_oem.="(codigo_inventario_enc, cdkey, serie, codigo_version, codigo_idioma, activo) ";
							$qry_oem.="values ($codigo_inventario_enc, '$cdkey[$cnt]', '$seriesoftwareoem[$cnt]', '$version[$cnt]', '$idioma[$cnt]', 1)";			
							$query($qry_oem);
							$cnt++;
					  }
					   // actualizar software instalado
					  $cnt=1; 		
				      while($cnt<=count($tipo_softwareinstall_upd))
					  {
					   if ($tipo_softwareinstall_upd[$cnt]=="0") $tipo_softwareinstall_upd[$cnt]=$tipo_softwareinstall_upd_temp[$cnt];
   					   if ($casa_softwareinstall_upd[$cnt]=="0") $casa_softwareinstall_upd[$cnt]=$casa_softwareinstall_upd_temp[$cnt];
				       if ($version_softwareinstall_upd[$cnt]=="0") $version_softwareinstall_upd[$cnt]=$version_softwareinstall_upd_temp[$cnt];					   
					   if ($idioma_softwareinstall_upd[$cnt]=="0") $idioma_softwareinstall_upd[$cnt]=$idioma_softwareinstall_upd_temp[$cnt];					
					   $serie_softwareinstall_upd[$cnt]=strtoupper($serie_softwareinstall_upd[$cnt]);		
					   if (!isset($estado_softwareinstall_upd[$cnt])) $estado_softwareinstall_upd[$cnt]=2;						   
					   if (!isset($licencia_softwareinstall_upd[$cnt])) $licencia_softwareinstall_upd[$cnt]=2;
					   else	$licencia_softwareinstall_upd[$cnt]=1;					   							
						   $qry_install ="update tb_inventario_softwareinstall_det set ";
						   $qry_install.="codigo_version='$version_softwareinstall_upd[$cnt]', serie='$serie_softwareinstall_upd[$cnt]', codigo_idioma='$idioma_softwareinstall_upd[$cnt]', codigo_tipo_software='$tipo_softwareinstall_upd[$cnt]', codigo_casa_software='$casa_softwareinstall_upd[$cnt]',"; 
						   $qry_install.="usuario_modifico='$nombre_usuario', fecha_modificado=getdate(), activo='$estado_softwareinstall_upd[$cnt]', licencia='$licencia_softwareinstall_upd[$cnt]'";
						   $qry_install.=" where codigo_inventario_enc=$codigo_inventario_enc and rowid='$rowid_softwareinstall[$cnt]'";					   	  
						   $query($qry_install);							   
					   $cnt++; 					  
					  }							
					   // insertar software instalado	  
					  $cnt=1; 		
					  while($cnt<=count($tipoinstall))
					  {						
							if (!isset($conlicencia[$cnt])) $conlicencia=2;
							else $conlicencia=1;
							$qry_install ="insert into tb_inventario_softwareinstall_det";	
							$qry_install.="(codigo_inventario_enc, codigo_tipo_software, codigo_casa_software, codigo_version, codigo_idioma, serie,  licencia, activo) ";
							$qry_install.="values ($codigo_inventario_enc, '$tipoinstall[$cnt]', '$fabricante[$cnt]', '$versioninstall[$cnt]', '$idiomainstall[$cnt]', '$serieinstall[$cnt]', '$conlicencia', 1)";			
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
				echo '<tr><td class="error" colspan="3" align="center">Ya se ha ingresado un objeto de este tipo con este número de '.$mensaje_error.' <br><br>Para ingresar otro <a href="objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
			}			
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para continuar modificando bienes <a href="ed_objeto.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
