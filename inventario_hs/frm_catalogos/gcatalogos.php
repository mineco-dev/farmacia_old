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
    <td width="77%"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA DE INFORM&Aacute;TICA</p>
    <p align="center" class="titulocategoria"> INVENTARIO DE HARDWARE Y SOFTWARE </p></td>
    <td width="12%"><div align="right"><img src="../../images/hard_soft.jpg" width="112" height="113"></div></td>
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
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj'
							order by orden"; 			
			require_once('../../connection/helpdesk.php');				
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($inventarioadmin);
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
								//compruebo si las caracter�sticas del archivo son las que deseo 		
								if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "pdf")) && ($tamano_archivo < 25024000))) 
								{ 
									$mensaje= "La extensión o el TAMAÑO de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif - .jpg - .pdf<br><li>se permiten archivos de (25 MB) m�ximo.</td></tr></table>"; 
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
									$nombre_archivo_def=$campo[$cnt]."_".$codigo_archivo.".".$extension;								   
									if (move_uploaded_file($HTTP_POST_FILES["$campo[$cnt]"]['tmp_name'], "archivos/".$nombre_archivo_def))
										{ 
										  $mensaje= "El archivo ha sido cargado correctamente."; 													     
										  $variable=$nombre_archivo_def;
										}
										else
										{ 
										   $mensaje= "Ocurri� alg�n error al subir el fichero. No pudo guardarse."; 
										} // hasta aqui corresponde al archivo
								}
							}	// fin si el tipo de campo es archivo
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
							echo '<tr><td class="titulocategoria" colspan="3" align="center">'.$mensaje.'<br></td></tr>';															
							echo '<tr><td class="titulocategoria" colspan="3" align="center">EL REGISTRO SE HA GRABADO CORRECTAMENTE<br><br>Para ingresar otro registro <a href="index.php">[HAGA CLIC AQUI]</a></td></tr>';															
						} // fin del ingreso del encabezado
						else
						{
							echo '<tr><td class="error" colspan="3" align="center">Se produjo un error al grabar, El registro NO se ha grabado<br><br>Para intentar nuevamente <a href="index.php">[HAGA CLIC AQUI]</a></td></tr>';
						}
					}	//fin sino encontro registros coincidentes.
					else
					{
						echo '<tr><td class="error" colspan="3" align="center">ESTE REGISTRO YA EXISTE!!<br><br>Para ingresar otro registro <a href="index.php">[HAGA CLIC AQUI]</a></td></tr>';
					}
		} // fin del if isset obj		
	} // fin del if isset ingresando_obj
	else
	{
		echo '<tr><td class="error" colspan="3" align="center">Para continuar llenando los catálogos <a href="index.php">[HAGA CLIC AQUI]</a></td></tr>';
	}
	?>            
	</td>
  </tr>
</table>
</body>
</html>
