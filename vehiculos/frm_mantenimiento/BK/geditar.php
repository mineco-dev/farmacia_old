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
		$acceso=permisosdb($inventarioadmin);					
		if (($acceso>=4) && ($acceso<=8))
		{
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion,
							c.campo_origen, c.campo_llave as campollave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion, p.campo_llave
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj' and c.activo=1
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
								echo '<tr><td class="titulocategoria" colspan="3" align="center">La extensión o el TAMAÑO de los archivos no es correcta en el campo '.$campo[$cnt].'. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (10 MB) m�ximo.</td></tr>'; 
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
				conectardb($inventarioadmin);						
				$res_insert=$query($qry_insert);			
				if ($res_insert)
				{					
					echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA ACTUALIZADO CORRECTAMENTE<br><br>Para ingresar otro registro <a href="agregar.php">[HAGA CLIC AQUI]</a></td></tr>';															
				} // fin del ingreso del encabezado
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">Se produjo un error durante la actualización, El registro NO ha cambiado<br><br>Para intentar nuevamente <a href="agregar.php">[HAGA CLIC AQUI]</a></td></tr>';
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
		echo '<tr><td class="error" colspan="3" align="center">Para continuar llenando los cat�logos <a href="agregar.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
