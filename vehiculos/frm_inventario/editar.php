<?
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

<body>
<table width="100%"  border="0">
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="2"><div align="right" class="tituloproducto">
      <div align="left">FORMULARIO PARA MODIFICACION DE DATOS  DEL INVENTARIO DE VEHICULOS   
      </div>
    </div></td>
    <td width="10%" height="25">&nbsp;</td>
  </tr>  
	  <form name="form1" method="post" action="geditar.php" enctype="multipart/form-data">
	  <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">
        <?
		if (isset($obj)) //verifico si hay objeto seleccionado		
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
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda, c.cambio_fila, 
							c.campo_origen, c.campo_llave as campollave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion, p.campo_llave
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$formulario' and c.activo=1
							order by orden"; 																		
			require_once('../../connection/helpdesk.php');				
			$res_qry_plantilla=$query($qry_plantilla);	
			$i=1;
			$cnt=1;					
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{						
				$campo[$cnt]=$row_qry_plantilla["campo"];
				if ($row_qry_plantilla["validar"]==1)
				{
					$campo_validacion[$i]=$row_qry_plantilla["campo"];
					$mensaje_validacion[$i]=$row_qry_plantilla["texto_validacion"];
					$tipo_campo[$i]=$row_qry_plantilla["codigo_tipo_campo"];									
					$i++;							
				}			
				if ($row_qry_plantilla["campo_llave"]==1)  //para saber en que tabla y a traves de que campo se realizara el filtro del reg. seleccionado.
				{
					$tabla_destino=$row_qry_plantilla["tb_destino"];
					$campo_llave_destino=$row_qry_plantilla["campo"];							
				}		
				$cnt++;		
			}					
			$cnt=1;	
			$qry_item_catalogo="select";
			while($cnt<=count($campo))  //para que devuelva el contenido de los campos del registro que se esta editando
			{	
				if ($cnt==count($campo)) $qry_item_catalogo.=" $campo[$cnt] ";
				else $qry_item_catalogo.=" $campo[$cnt], ";
				$cnt++;
			}
			$qry_item_catalogo.="from $tabla_destino where $campo_llave_destino=$id";
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($inventarioadmin);			
			$res_qry_item_catalogo=$query($qry_item_catalogo);	//devuelve datos del objeto que se esta editando										
			$cnt=1;
			while($row_qry_item_catalogo=$fetch_array($res_qry_item_catalogo))
			{
				while ($cnt<=count($campo))  // arreglo que contiene el contenido del registro editado
				{
					$contenido[$cnt]=$row_qry_item_catalogo["$campo[$cnt]"];						
				 	$cnt++;
				}				
			}
			$item=1;
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{							
				if (strlen($row_qry_plantilla["etiqueta"])>=0)
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
						echo '<input name="'.$row_qry_plantilla["campo"].'" type="text" id="'.$row_qry_plantilla["campo"].'" size="'.$row_qry_plantilla["tamano"].'" value="'.$contenido[$item].'">';
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==2)
					{
						$latabla=$row_qry_plantilla["tb_origen"];
						$campoorigen=$row_qry_plantilla["campo_origen"];
						$campollave=$row_qry_plantilla["campollave"];			
						$condicion=$row_qry_plantilla["condicion"];				
						$nombre_div=$row_qry_plantilla["codigo_campo"];	
						$qry_cbo="SELECT * FROM $latabla where $campollave=$contenido[$item] order by $campoorigen";						 																		
						$res_qry_cbo=$query($qry_cbo);
						while($row_qry_cbo=$fetch_array($res_qry_cbo))
						{
							$valoractual=$row_qry_cbo["$campoorigen"];
							$codigo_valoractual=$row_qry_cbo["$campollave"];							
						}
						$qry_cbo="SELECT * FROM $latabla where $campollave<>$contenido[$item] and $condicion order by $campoorigen"; 	
						$res_qry_cbo=$query($qry_cbo);						
						echo('<input  name="'.$row_qry_plantilla["campo"].'_temp" type="hidden" id="'.$row_qry_plantilla["campo"].'_temp"  value="'.$codigo_valoractual.'"/>');
						if ($row_qry_plantilla["tipo_combo"]==1)							
						{
							echo('<select name="'.$row_qry_plantilla["campo"].'">');
							echo'<option value="'.$codigo_valoractual.'">'.$valoractual.'</option>';				
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
							echo'<option value="'.$codigo_valoractual.'">'.$valoractual.'</option>';				
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
							echo'<option value="'.$codigo_valoractual.'">'.$valoractual.'</option>';				
							echo '</select>';
							echo '</div>';
						}
						$free_result($res_qry_cbo);							
					} // fin de cada combo.	
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==3)
					{				
						if ($contenido[$item]=='SI')
							echo '<input name="'.$row_qry_plantilla["campo"].'" type="checkbox" id="'.$row_qry_plantilla["campo"].'" value="'.$contenido[$item].'" checked>';
							else
							   echo '<input name="'.$row_qry_plantilla["campo"].'" type="checkbox" id="'.$row_qry_plantilla["campo"].'" value="'.$contenido[$item].'">';
					}		
					else				
					if ($row_qry_plantilla["codigo_tipo_campo"]==5)
					{																	
						echo '<input name="'.$row_qry_plantilla["campo"].'" type="file" id="'.$row_qry_plantilla["campo"].'">';
						echo '<input type="hidden" name="MAX_FILE_SIZE" value="100000">';
						if ($contenido[$item]!="NA")						
						{
							echo '<a href="archivos/'.$contenido[$item].'"><img src="../../../images/iconos/ico_ver.jpg" alt="Para ver la fotografia de este vehiculo, pulse aqu�" border="0"></a>';
							echo('<input name="'.$row_qry_plantilla["campo"].'_temp" type="hidden" id="'.$row_qry_plantilla["campo"].'_temp"  value="'.$contenido[$item].'"/>');
						}	
					}	
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==9)
					{					
						echo '<textarea name="'.$row_qry_plantilla["campo"].'" cols="'.$row_qry_plantilla["tamano"].'" rows="4" '.$status.'>'.$contenido[$item].'</textarea>';
					}
					else
					if ($row_qry_plantilla["codigo_tipo_campo"]==11)
					{					
						conectardb($rrhh);
						$id_solicitante_actual=$contenido[$item];
						$qry_empleado="select * from asesor where idasesor=$id_solicitante_actual";						
						$res_qry_empleado=$query($qry_empleado);
						while($row_qry_empleado=$fetch_array($res_qry_empleado))
						{
							$solicitante_actual=$row_qry_empleado["nombre"].' '.$row_qry_empleado["nombre2"].' '.$row_qry_empleado["apellido"].' '.$row_qry_empleado["apellido2"];
						}	
						echo '<a href="javascript:void(0)" onclick="buscar=window.open(\'../../frm_buscar_empleado/buscar.php?tipo='.$row_qry_plantilla["campo"].'&posi=0\',\'Buscar\',\'width=650,height=425,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250\'); return false;"><input name="'.$row_qry_plantilla["campo"].'_name" type="text" id="'.$row_qry_plantilla["campo"].'_name" value="'.$solicitante_actual.'" size="55" disabled /></a>';
						echo '<input type="hidden" name="'.$row_qry_plantilla["campo"].'_id" id="hiddenField" value="'.$id_solicitante_actual.'"/>';					
					}			
					if (strlen($row_qry_plantilla["ayuda"])>=5)
					{
						echo '&nbsp;&nbsp;';
						echo '<img src="../../images/iconos/ico_help.gif" alt="'.$row_qry_plantilla["ayuda"].'" border="0">';
					}
				$item++;
				if (($row_qry_plantilla["cambio_fila"]==1) || ($row_qry_plantilla["cambio_fila"]==2)) echo '</td></tr>';
			}
			}	 //fin de creacion de campos.	
			echo '<tr><td colspan="2"><span class="error">** Campos requeridos</span></td></tr>';
		$free_result($res_qry_plantilla);
	?>
	<tr>   	          
	</td>
  	<tr>   	
	<td colspan="2">
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $id?>"/> 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Actualizar" ></td></tr>  
	
</table>	  	 		  
</tr> 
<br>
<br>  
 <?
 }
 ?>  
   </form>
</table>
</body>
<?	
	$i=1;
	echo '<script type="text/javascript">'; //funcion para las validaciones 
	echo 'function validar(form)';
	echo '{';							
			while($i<=count($campo_validacion))
			{				
				if ($tipo_campo[$i]=="1" || $tipo_campo[$i]=="5" || $tipo_campo[$i]=="7" || $tipo_campo[$i]=="9")
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
							echo 'alert("En este campo solo puede ingresar números");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}	
			$i++;
			}
		echo 'if (confirm("�Esta acción guarda las modificaciones realizadas, desea continuar?")) form.submit();';
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
</html>