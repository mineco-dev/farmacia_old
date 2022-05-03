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
<script language='javascript' src="../../includes/calendario/popcalendar.js"></script>
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
.Estilo1 {
	font-size: medium;
	color: #0000FF;
}
.Estilo2 {color: #000033}

.titulo 

{
font-size:24px;
font-family:Arial, Helvetica, sans-serif, Courier, monospace, sans-serif, sans-serif;
color:#0000FF;
}
<!-- cambia el tipo de letra en subgerencia administrativa-->
-->
</style>

</head>
<!-- se agrego codigo indica color pagina-->
<body style="background:#CEECF5">
<table width="100%"  border="0">
  <tr>
   <!-- <td width="18%" height="25"><div align="left"><img src="../../images/solicitud.jpg" width="90" height="50"></div></td>-->
    <td width="72%"><p align="center" class="titulocategoria titulo">SUBGERENCIA ADMINISTRATIVA</p>
      <p align="center" class="titulocategoria Estilo2"> MODULO DE VEHICULOS </p></td>
    <td width="10%"><div align="right"><img src="../../images/carro.gif" width="129" height="126"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3"> 
	   <!--<img src="../../images/linea_azul.gif" width="100%" height="6"> --></td>   
   <!-- <img src="../../images/linea.gif" width="100%" height="6"></td>-->   
  </tr>
  <?   
	require_once('../../connection/helpdesk.php');
	$obj=14;
	if (isset($obj)) //filtro objeto seleccionado
	{	
		$qry_objeto="SELECT * FROM tb_formulario where codigo_formulario='$obj'"; 
		$res_qry_objeto=$query($qry_objeto);	
		while($row_qry_objeto=$fetch_array($res_qry_objeto))
		{
			$nombre_objeto="SOLICITUDES PENDIENTES DE APROBACION";
			$mostrar_detalle=$row_qry_objeto["mostrar_detalle"];
		}
		$free_result($res_qry_objeto);	
	}

	?><tr>
    <td height="25" colspan="3"><div align="right" class="tituloproducto">
      <div align="center"><? echo $nombre_objeto; ?>      </div>
    </div></td>
    </tr>  
	  <form name="form1" method="post" action="gagregar.php" enctype="multipart/form-data">
	  <table width="50%" align="center" cellpadding="0" cellspacing="0">
        <?		
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
		$acceso=permisosdb($inventarioadmin);					
		if (($acceso>=1) && ($acceso<=8))
		{			
			if (($acceso==1) || ($acceso==4) || ($acceso==5)) $status='disabled'; else $status='';					
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$obj' and c.activo=1
							order by orden"; 													
			$res_qry_plantilla=$query($qry_plantilla);	
			conectardb($inventarioadmin);		
			$i=1;
			$no_campos_detalle=1;
			$qry_datos_insertados="select ";						
			while($row_qry_plantilla=$fetch_array($res_qry_plantilla))
			{
				$tb_detalle=$row_qry_plantilla["tb_destino"];
				$qry_datos_insertados2="FROM $tb_detalle ";														
				if (($row_qry_plantilla["codigo_tipo_campo"]==1) || ($row_qry_plantilla["codigo_tipo_campo"]==7))
				{					
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
					$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
					$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
					$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
					$qry_orden2.="$campo_detalle, ";					
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
				} // fin de cada combo.				
				else
				if ($row_qry_plantilla["codigo_tipo_campo"]==6)
				{					
					$latabla=$row_qry_plantilla["tb_destino"];
					$campoorigen=$row_qry_plantilla["campo_destino"];					
					$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];
					$campo_detalle=$latabla.'.'.$campoorigen;
					$qry_datos_insertados.="$campo_detalle, ";
					$no_campos_detalle++;
				}			
			}	 //fin de creacion de campos.					
			$campo_detalle=$tb_detalle.'.activo';
			$condicion_detalle="where $campo_detalle=1";
			$qry_orden="order by ";
			$qry_datos_insertados.="$campo_detalle ";
			$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));
			$condicion_detalle.="and codigo_estado_salida_vehiculo=1";
			$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$condicion_detalle.' '.$qry_orden.' '.$qry_orden2;													
			$free_result($res_qry_plantilla);
		}		
	?>	 	
</table>	  	 		  
</tr> 
<br>
<!--<table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0">-->
  <table width="70%"  border="10" align="center" cellpadding="0" cellspacing="0"> 
  <?  		
  if ($mostrar_detalle=="1")	  
  {	 
   		if (($acceso==1) || ($acceso==3) || ($acceso==4) || ($acceso==5) || ($acceso==6) || ($acceso==7) || ($acceso==8))
		{
		  $no_campos_detalle=$no_campos_detalle+2;
		  echo '<tr><td class="boxTitleBgLightBlue" colspan="'.$no_campos_detalle.'" align="center">DATOS PREVIAMENTE INGRESADOS</td></tr>';
		  $res_qry_insertados=$query($qry_detalle);		  	 
		  $i=1;
		  
	  	    $cnt=2; //imprime etiquetas
			echo '<tr>';  			
			
			while ($cnt<=count($etiqueta)) 
			{	
				echo '<td align="center" class="boxTitleBgLightBlue">';
				echo $etiqueta[$cnt];
				echo '</td>';
				$cnt++;
			}	
			echo '<td class="boxTitleBgLightBlue" align="center">Editar</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">Eliminar</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">Vista Previa</td>';
			echo '<td class="boxTitleBgLightBlue" align="center">Enviar</td>';
			echo '</tr>';
		  $no_campos_detalle=$no_campos_detalle-4;
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
		    echo '<td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados[0].'&st=3&txt_obj='.$obj.'"><img src="../../images/iconos/ico_borrar.gif" alt="Eliminar" border="0"></a></center></td>';					
				//else
				//echo '<td class='.$clase.'><center><a href="status.php?id='.$row_qry_insertados[0].'&st=1&txt_obj='.$obj.'"><img src="../../images/iconos/ico_borrar.gif" alt="Activar" border="0"></a></center></td>';					
			echo '<td class='.$clase.'><center><a href="imprimir.php?id='.$row_qry_insertados[0].'&st=1&txt_obj='.$obj.'" target="_blank"><img src="../../images/iconos/ico_ver.jpg" alt="Vista previa" border="0"></a></center></td>';	
			echo '<td class='.$clase.'><center><a href="transferencia.php?id='.$row_qry_insertados[0].'&txt_obj='.$obj.'"><img src="../../images/iconos/transferencia.gif" alt="Transferir a Subgerencia Administrativa" border="0"></a></center></td>';	
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
 <td width="30%" height="25"><div align="center"><img src="../../images/pc.gif" width="120" height="95"></div></td><!-- se agrego  <td width="30%" height="25"><div align="center"><img src="../../images/pc.gif" width="120" height="95"></div></td>-->
</body>
<?
include("../../includes/validaciones.php");
?>
</html>
