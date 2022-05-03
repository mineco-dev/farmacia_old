<?
session_start();
if (!isset($_SESSION["subgerencia"])) $dependencia=33;
else $dependencia=($_SESSION["subgerencia"]);
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<script src="../../includes/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../includes/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../../includes/calendar.js"></script>
<script type="text/javascript" src="select_dependientes_3_niveles.js"></script>

<script language="javascript">
function url(uri)
{
	location.href=uri; 
} 
</script>
<script type="text/javascript">
var peticion = false;
var  testPasado = false;
try {
  peticion = new XMLHttpRequest();
  } catch (trymicrosoft) {
  try {
  peticion = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (othermicrosoft) {
  try {
  peticion = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (failed) {
  peticion = false;
  }
  }
}
if (!peticion)
alert("ERROR AL INICIALIZAR!");

function cargarCombo (url, comboAnterior, element_id) {
    //Obtenemos el contenido del div
    //donde se cargaran los resultados
    var element =  document.getElementById(element_id);
    //Obtenemos el valor seleccionado del combo anterior
    var valordepende = document.getElementById(comboAnterior)
    var x = valordepende.value
    //construimos la url definitiva
    //pasando como parametro el valor seleccionado
    var fragment_url = url+'&Id='+x;
    element.innerHTML = '<img src="../../images/loading.gif" />';
    //abrimos la url
    peticion.open("GET", fragment_url);
    peticion.onreadystatechange = function() {
        if (peticion.readyState == 4) {
	//escribimos la respuesta
	element.innerHTML = peticion.responseText;
        }
    }
   peticion.send(null);
}
</script>
<style type="text/css">
<!--
.style3 {font-size: small}
.style4 {color: #FFFFFF}
.style5 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo1 {font-size: medium}

-->
</style>

</head>
<!--se agrego style="background:#CEECF5"-->
<body style="background:#CEECF5">
<table width="100%"  border="0">   
	  <form name="form1" method="post" action="gagregar.php" enctype="multipart/form-data">
	 <table width="90%"  border="0" align="center">
  <tr>
    <td height="8" colspan="5">    
    <img src="../../../images/linea_azul.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="2">
        <div align="left">
    <?		
		conectardb($inventarioadmin);
		generaSelect($dependencia); 
	?>
    
    </div>
    </div></td>
    <td width="52%"><div align="center">
        <select disabled="disabled" name="select2" id="select">
          <option value="0">---- Subcategoria ----</option>
        </select>
    </div></td>
    <td width="20%" height="25" colspan="2"><div align="right">
        <?
		if (isset($obj)) //filtro objeto seleccionado
		{	
			$qry_objeto="SELECT * FROM cat_objeto where codigo_objeto='$obj'"; 
			$res_qry_objeto=$query($qry_objeto);	
			while($row_qry_objeto=$fetch_array($res_qry_objeto))
			{
				$nombre_objeto=$row_qry_objeto["objeto"];
				$cat=$row_qry_objeto["codigo_categoria"];
				$subcat=$row_qry_objeto["codigo_subcategoria"];
			}
		}
		else
		{
				$nombre_objeto="---- Seleccione ----";
		}
		?>
		<select disabled="disabled" name="select3" id="select3">
          <option value="0"><? echo $nombre_objeto ?></option>
        </select>
  </div></td>
  </tr>
 <tr><td colspan="4">
 <?   
	require_once('../../connection/helpdesk.php');
	if (isset($obj)) //filtro objeto seleccionado
	{	
	switch ($obj)
		{
			case '19': $formulario=1; break;  //automovil
			case '20': $formulario=7; break;  //motocicleta
			case '21': $formulario=1; break;  //otros automoviles
			case '22': $formulario=1; break;  //camioneta
			case '23': $formulario=1; break;  //microbus
			case '24': $formulario=1; break;  //otros vehiculos
			case '25': $formulario=1; break;  //pickup
			case '26': $formulario=1; break;  //jeep
						
		}
		$qry_objeto="SELECT * FROM tb_formulario where codigo_formulario='$formulario'"; 
		$res_qry_objeto=$query($qry_objeto);	
		while($row_qry_objeto=$fetch_array($res_qry_objeto))
		{
			echo '<div align="center" class="tituloproducto">';
			echo $row_qry_objeto["descripcion"];
			echo '</div>';
			$mostrar_detalle=$row_qry_objeto["mostrar_detalle"];
		}
		$free_result($res_qry_objeto);	
	}
?></td></tr>
  </table>
	 
	  <table width="90%" align="center" cellpadding="0" cellspacing="0">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado
		{						
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda, c.cambio_fila, 
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$formulario' and c.activo=1
							order by orden"; 													
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($inventarioopera);		
			$i=1;
			$no_campos_detalle=1;
			$qry_datos_insertados="select tb_inventario.codigo_inventario_enc,";						
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				$tb_detalle=$row_qry_plantilla["tb_destino"];
				$qry_datos_insertados2="FROM $tb_detalle ";
				if ($row_qry_plantilla["validar"]==1)
				{
					$campo_validacion[$i]=$row_qry_plantilla["campo"];
					$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
					$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_campo"];														
					$i++;		
				}						
				if (strlen($row_qry_plantilla["etiqueta"])>3)
				{					
				if (($row_qry_plantilla["cambio_fila"]==1) || ($row_qry_plantilla["cambio_fila"]==3))				
				echo '<tr><td class="boxTitleBgMidGrey" width="20%">'.$row_qry_plantilla["etiqueta"].'&nbsp;';
				else
				if ($row_qry_plantilla["cambio_fila"]==2)
				echo '&nbsp;'.$row_qry_plantilla["etiqueta"].'&nbsp;';
				if ($row_qry_plantilla["validar"]==1) echo '<span class="error">**</span>';
				if (($row_qry_plantilla["cambio_fila"]==1) || ($row_qry_plantilla["cambio_fila"]==3)) 
				{
					echo '</td>';																					
					echo '<td class="boxTitleBgLightGrey">';				
				}
				if (($row_qry_plantilla["codigo_tipo_campo"]==1) || ($row_qry_plantilla["codigo_tipo_campo"]==7))
				{					
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
					$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
					$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
					$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
					$qry_orden2.="$campo_detalle, ";
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="text" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'">';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==2)
				{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campo_llave"];	
						$condicion=$row_qry_plantilla["condicion"];								
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];						
						$campo_detalle=$latabla.'.'.$campoorigen;
						$qry_datos_insertados.="$campo_detalle, ";
						$no_campos_detalle++;
						$qry_datos_insertados3.="INNER JOIN $latabla ON $tb_detalle.$campollave=$latabla.$campollave "; //parte 3 del qry del detalle						
						$qry_orden2.="$campo_detalle, ";
						$nombre_div=$row_qry_plantilla["codigo_campo"];						
						$qry_cbo="SELECT * FROM $latabla where $condicion order by $campoorigen"; 					
						$res_qry_cbo=$query($qry_cbo);							
						if ($row_qry_plantilla["tipo_combo"]==1)							
						{
							echo('<select name="'.$row_qry_plantilla["campo"].'">');
							echo'<option value="0">--Seleccione--</option>';				
							while($row_qry_cbo=$fetch_array($res_qry_cbo))
							{
								echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
							}
								echo('</select>');																	
						}	
						else
						if ($row_qry_plantilla["tipo_combo"]==3)
						{							
							$nombre_div=$row_qry_plantilla["combo_destino"];															
							echo('<select name="'.$row_qry_plantilla["campo"].'" id="'.$row_qry_plantilla["campo"].'" onChange="javascript:cargarCombo(\'cbo_dependiente.php?cbo='.$row_qry_plantilla["combo_destino"].'&llave_origen='.$campollave.'\', \''.$row_qry_plantilla["campo"].'\', \''.$nombre_div.'\')">');
							echo'<option value="0">--Seleccione--</option>';				
							while($row_qry_cbo=$fetch_array($res_qry_cbo))
							{
								echo'<option value="'.$row_qry_cbo["$campollave"].'">'.$row_qry_cbo["$campoorigen"].'</option>';
							}
								echo('</select>');																	
						}
						else	
						if (($row_qry_plantilla["tipo_combo"]==2) || ($row_qry_plantilla["tipo_combo"]==4))
						{								
							echo '<div id="'.$nombre_div.'">';
							echo '<select name="'.$row_qry_plantilla["campo"].'"  id="'.$row_qry_plantilla["campo"].'" disabled>';
							echo '</select>';
							echo '</div>';
						}
						$free_result($res_qry_cbo);					
				} // fin de cada combo.
				else				
				if ($row_qry_plantilla["codigo_tipo_campo"]==3)
				{				
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
					$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
					$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
					$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
					$qry_orden2.="$campo_detalle, ";
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="checkbox" id="'.$row_qry_plantilla["campo"].'" value="SI">'; }
				else				
				if ($row_qry_plantilla["codigo_tipo_campo"]==5)
				{					
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="file" id="'.$row_qry_plantilla["campo"].'">';
        			echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==6)
				{					
					$latabla=$row_qry_plantilla["tb_destino"];
					$campoorigen=$row_qry_plantilla["campo_destino"];					
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];
					$campo_detalle=$latabla.'.'.$campoorigen;
					$qry_datos_insertados.="$campo_detalle, ";
					$no_campos_detalle++;
					echo '<input name="'.$row_qry_plantilla["campo"].'" type="hidden" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'">';
				}	
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==9)
				{					
					echo '<textarea name="'.$row_qry_plantilla["campo"].'" cols="'.$row_qry_plantilla["tamano"].'" rows="4" '.$status.'></textarea>';
				}
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==11)
				{					
					echo '<a href="javascript:void(0)" onclick="buscar=window.open(\'../../frm_buscar_empleado/buscar.php?tipo='.$row_qry_plantilla["campo"].'&posi=0\',\'Buscar\',\'width=650,height=425,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;"><input name="'.$row_qry_plantilla["campo"].'_name" type="text" id="'.$row_qry_plantilla["campo"].'_name" value="[CLIC AQUI PARA SELECCIONAR RESPONSABLE O PILOTO]" size="55" disabled /></a>';
  					echo '<input type="hidden" name="'.$row_qry_plantilla["campo"].'_id" id="hiddenField"/>';					
				}
				if (strlen($row_qry_plantilla["ayuda"])>=5)
				{
					echo '&nbsp;&nbsp;';
					echo '<img src="../../images/iconos/ico_help.gif" alt="'.$row_qry_plantilla["ayuda"].'" border="0">';
				}
				if (($row_qry_plantilla["cambio_fila"]==1) || ($row_qry_plantilla["cambio_fila"]==2)) echo '</td></tr>';
			}	 //fin de creacion de campos.
			}
			echo '<tr><td class="boxTitleBgMidGrey">&nbsp;</td><td class="boxTitleBgLightGrey">&nbsp;</td></tr>';						
			$campo_detalle=$tb_detalle.'.activo';
			$qry_orden="order by ";
			$qry_datos_insertados.="$campo_detalle ";
			$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));
			$qry_detalle_condicion="where tb_inventario.codigo_objeto=$obj";
			$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_detalle_condicion.' '.$qry_orden.' '.$qry_orden2;													
		echo '<tr><td colspan="2"><span class="error">** Campos requeridos</span></td></tr>';
		$free_result($res_qry_plantilla);
	?>
	<tr>   	          
	</td>
  	<tr>   	
	<td colspan="2">
	
	<input type="hidden" name="nombre[0][1]" id="hiddenField"/>
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 	
	<input  name="txt_cat" type="hidden" id="txt_cat"  value="<? echo $cat?>"/> 
	<input  name="txt_subcat" type="hidden" id="txt_subcat"  value="<? echo $subcat?>"/>		 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar" ></td></tr>  	
</table>	  	 		  
</tr> 
<br>
  <table width="90%"  border="1" align="center" cellpadding="0" cellspacing="0"> 
  <?
 if (isset($obj)) //verifico si hay objeto seleccionado
 { 
    if ($mostrar_detalle=="1")	  
    {		    
		  $no_campos_detalle=8;
		  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="center">DATOS PREVIAMENTE INGRESADOS</td></tr>';
		  $res_qry_insertados=$query($qry_detalle);				   	 
		  $i=1;
		  
	  	    $cnt=2; //imprime etiquetas
			echo '<tr>';  						
			while ($cnt<=7) 
			{	
				echo '<td align="center" class="boxTitleBgLightBlue">';
				echo $etiqueta[$cnt];
				echo '</td>';
				$cnt++;
			}	
			echo '<td class="boxTitleBgLightBlue" align="center">Editar</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">Estado</td>';
			echo '</tr>';
		  $no_campos_detalle=$no_campos_detalle-2;
		  while($row_qry_insertados=$fetch_array($res_qry_insertados))
		  {
			  $status=$row_qry_insertados["activo"];
			  $clase = "boxTitleBgMidGrey";
			  if ($i % 2 == 0) 
			  {
				$clase = "boxTitleBgLightGrey";
			  }
			  $cnt=1;
			
			  while ($cnt<=$no_campos_detalle) 
			  {
				echo '<td class='.$clase.'>'.$row_qry_insertados["$cnt"].'</td>';
				$cnt++;
			  }	
				echo '<td class='.$clase.'><center><a href="editar.php?id='.$row_qry_insertados[0].'&obj='.$obj.'"><img src="../../images/iconos/ico_editar.gif" alt="Modificar" border="0"></a></center></td>';  					
			if ($status==1)				
		    echo '<td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados[0].'&st=2&txt_obj='.$obj.'"><img src="../../images/iconos/ico_activo.gif" alt="Desactivar" border="0"></a></center></td>';					
				else
				echo '<td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados[0].'&st=1&txt_obj='.$obj.'"><img src="../../images/iconos/ico_desactivado.gif" alt="Activar" border="0"></a></center></td>';					
			echo '</tr>';
			$i++;
		   }
		$free_result($res_qry_insertados);		
	}
}		
  ?>
  </table>  
 <?
 }
 ?>  
   </form>
</table>
 <td width="30%" height="25"><div align="center"><img src="../../images/pc.gif" width="120" height="95"></div></td>
</body>
<?	
	$i=1;
	echo '<script type="text/javascript">'; //funcion para las validaciones 
	echo 'function validar(form)';
	echo '{';							
			while($i<=count($campo_validacion))
			{				
				if ($tipo_campo[$i]=="1" || $tipo_campo[$i]=="5" || $tipo_campo[$i]=="7")
				{					
						echo 'if (form.'.$campo_validacion[$i].'.value == "")';
						echo '{ ';
								echo 'alert("'.$mensaje_validacion[$i].'");'; 
								echo 'form.'.$campo_validacion[$i].'.focus();'; 
								echo 'return;';
						echo '}';
				}
				else
				if ($tipo_campo[$i]=="2")
				{
						echo 'if (form.'.$campo_validacion[$i].'.value == "0")';
						echo '{ ';
							echo 'alert("'.$mensaje_validacion[$i].'");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}										
				if ($tipo_campo[$i]=="7")
				{						
						echo 'if (!isNumber(form.'.$campo_validacion[$i].'.value))';
						echo '{ ';
							echo 'alert("En este campo solo puede ingresar n�meros y punto decimal [NO se admiten comas]");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}	
			$i++;
			}
		echo 'form.submit();';
	echo '}';		
	echo '</script>';	
?>
<script LANGUAGE="JavaScript">
var defaultEmptyOK = false

function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}

function isNumber (s)
{   var i;
    var dotAppeared;
    dotAppeared = false;
    if (isEmpty(s)) 
       if (isNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isNumber.arguments[1] == true);
    
    for (i = 0; i < s.length; i++)
    {   
        var c = s.charAt(i);
        if( i != 0 ) {
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c)) return false;
        } else { 
            if ( c == "." ) {
                if( !dotAppeared )
                    dotAppeared = true;
                else
                    return false;
            } else     
                if (!isDigit(c) && (c != "-") || (c == "+")) return false;
        }
    }
    return true;
}
</script>
<?
function generaSelect($inv_dependencia)
{	
	$consulta=mssql_query("SELECT distinct(c.codigo_categoria), c.nombre_categoria FROM cat_categoria c
	inner join tb_inventario_x_dependencia d on c.codigo_categoria=d.codigo_categoria
	WHERE activo=1 and d.codigo_dependencia='$inv_dependencia' ORDER BY nombre_categoria");	
	echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>---- Categoria ----</option>";
	while($registro=mssql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
}
?>
</html>
