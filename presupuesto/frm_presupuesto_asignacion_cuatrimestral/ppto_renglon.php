<style type="text/css">

   
/* Tablas */
   TH {font-size: 11pt; font-weight: bold; color: white; background: #0066CC; text-align: left;}
   TD {font-size: 11pt; background:#FFFFFF; }
  

-->
</style>

<?
		require("../../includes/funciones.php");
		require("../../includes/sqlcommand.inc");
		session_register("ingresando_obj");
		$_SESSION["ingresando_obj"]=true;
?>




<?
		//RECUPERA LOS DATOS DEL REGISTRO						
		require_once('../../connection/helpdesk.php');
		$obj=34;
		if (isset($obj)) //verifico si hay objeto seleccionado
		
		{	
		$qry_objeto="SELECT * FROM tb_formulario where codigo_formulario='$obj'"; 
		$res_qry_objeto=$query($qry_objeto);	
		while($row_qry_objeto=$fetch_array($res_qry_objeto))
		{
			$nombre_objeto=$row_qry_objeto["descripcion"];
			$mostrar_detalle=$row_qry_objeto["mostrar_detalle"];
		}
		$free_result($res_qry_objeto);	
	}
	
	?>
    <?
	if (isset($obj))
		
		{
			$acceso=permisosdb($presupuesto);					
			if (($acceso==1) || ($acceso==3) || ($acceso==4) || ($acceso==5) || ($acceso==6) || ($acceso==7) || ($acceso==8))
			{							
				if (($acceso==1) || ($acceso==3)) $status='disabled'; else $status='';	
				$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
								c.campo_origen, c.campo_llave as campollave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
								p.condicion, p.campo_llave
								FROM tb_campo c inner join tb_plantilla p
								on c.codigo_campo=p.codigo_campo
								where p.codigo_formulario='$obj' and c.activo=1
								order by orden";																																								
				require('../../connection/helpdesk.php');
				$res_qry_plantilla=$query($qry_plantilla);			
				$i=1;
				$cnt=1;	
								
				while($row_qry_plantilla=$fetch_array($res_qry_plantilla))				
				{	
					$campo[$cnt]=$row_qry_plantilla["campo"];									
					$tipo_campo2[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];
					
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
					$campotemp=$campo[$cnt];					
					if (($tipo_campo2[$cnt]==8) || ($tipo_campo2[$cnt]==10)) $campotemp="convert(nvarchar, $campo[$cnt], 126) as $campo[$cnt]"; //para MSSQL
					//if ($cnt==count($campo)) $qry_item_catalogo.=" $campotemp "; else
					$qry_item_catalogo.=" $campotemp, ";
					$cnt++;
				}
				$qry_item_catalogo.="usuario_creo from $tabla_destino where $campo_llave_destino='$pr'";				
				$res_qry_plantilla=$query($qry_plantilla);	
////////////////SI ES UNA DB DISTINTA AQUI CAMBIA LA CONEXION
				conectardb($presupuesto);															
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
								$contenido[$item]=$row_qry_cbo["$campoorigen"];																						
							}										
						} // fin de cada combo.									
						else
						if ($row_qry_plantilla["codigo_tipo_campo"]==8)
						{	
							$day=substr($contenido[$item],8,2);
							$month = strtolower(substr($contenido[$item],5,2));
							$year = substr($contenido[$item],0,4);
							$contenido[$item]=$day.'-'.$month.'-'.$year;
						}						
						else
						if ($row_qry_plantilla["codigo_tipo_campo"]==10)
						{							
							$day=substr($contenido[$item],8,2);
							$month = strtolower(substr($contenido[$item],5,2));
							$year = substr($contenido[$item],0,4);
							$hour = substr($contenido[$item],11,2);
							$min = substr($contenido[$item],14,2);
							$contenido[$item]=$day.'-'.$month.'-'.$year.' '.$hour.':'.$min;						
						}
						else
						if ($row_qry_plantilla["codigo_tipo_campo"]==11)
						{					
							conectardb($rrhh);
							$id_solicitante_actual=$contenido[$item];
							$qry_empleado= "select (a.nombre+' '+a.apellido+' '+a.apellido2) as empleado, d.nombre, d.id_jefe, (j.nombre+' '+j.apellido) as jefe  from asesor a 
											inner join tb_contratacion_gobierno c on a.idasesor=c.idasesor
											inner join direccion d on d.iddireccion=c.entidad_gobierno
											inner join asesor j on j.idasesor=d.id_jefe
											where a.idasesor=$id_solicitante_actual";						
							$res_qry_empleado=$query($qry_empleado);
							while($row_qry_empleado=$fetch_array($res_qry_empleado))
							{
								$contenido[$item]=$row_qry_empleado["empleado"];
								$dependencia=$row_qry_empleado["nombre"];
								$jefe=$row_qry_empleado["jefe"];
							}							
						}					
						$item++;

					}	 //fin de creacion de campos.				
				}		
				else
				{
					echo '<tr><td class="error" colspan="3" align="center">NO TIENE SUFICIENTES PERMISOS PARA ACCEDER A ESTA AREA <BR>CONTACTE AL ADMINISTRADOR DEL SERVICIO</a></td></tr>';
					$status='disabled';
				}			
	} //fin if isset obj
		$free_result($res_qry_plantilla);
?>
<?			
		$txt_obj=35;
		if (isset($txt_obj)) //verifico si hay objeto seleccionado
		{		
		$acceso=permisosdb($presupuesto);					
		if (($acceso>=1) && ($acceso<=8))
		{	
			
			if (($acceso==1) || ($acceso==4) || ($acceso==5)) $status='disabled'; else $status='';				
			$qry_plantilla="SELECT c.codigo_campo, c.campo, c.codigo_tipo_campo, c.tb_origen, c.validar, c.texto_validacion, c.ayuda,
							c.campo_origen, c.campo_llave, c.tamano, c.etiqueta, c.orden, c.tb_destino, c.campo_destino, c.combo_destino, c.combo_origen, c.tipo_combo,
							p.condicion
							FROM tb_campo c inner join tb_plantilla p
							on c.codigo_campo=p.codigo_campo
							where p.codigo_formulario='$txt_obj'
							order by orden";					  

				require('../../connection/helpdesk.php');			
				$res_qry_plantilla=$query($qry_plantilla);									
				$cnt=1;
				$no_campos_detalle=1;
				$qry_datos_insertados="select ";
				conectardb($presupuesto);
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
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];						
						$campo_detalle=$latabla.'.'.$campoorigen;
						$qry_datos_insertados.="$campo_detalle, ";
						$no_campos_detalle++;
						$qry_datos_insertados3.="LEFT JOIN $latabla ON $tb_detalle.$campollave=$latabla.$campollave "; //parte 3 del qry del detalle						
						$qry_orden2.="$campo_detalle, ";
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
					}	
					else
					if (($row_qry_plantilla["codigo_tipo_campo"]==8) && ($status==''))
					{							
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
						$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
						$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
						$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
						$qry_orden2.="$campo_detalle, ";							
					}
					else
					if (($row_qry_plantilla["codigo_tipo_campo"]==10) && ($status==''))
					{							
						$etiqueta[$no_campos_detalle]=$row_qry_plantilla["etiqueta"];	//etiqueta para la tabla que detalla los registros ingresados.
						$campo_detalle=$row_qry_plantilla["tb_destino"].'.'.$row_qry_plantilla["campo"]; //campo para concatenar al qry.				
						$qry_datos_insertados.="$campo_detalle, ";	//parte 1 del qry para la tabla que detalla los registros ingresados.
						$no_campos_detalle++;	//cantidad de campos que incluye el detalle.
						$qry_orden2.="$campo_detalle, ";
					}																							
					$campo[$cnt]=$row_qry_plantilla["campo"];
					$tipo_campo[$cnt]=$row_qry_plantilla["codigo_tipo_campo"];								
					$cnt++;
				}	 //fin del while que indica los campos que corresponden al objeto
					$free_result($res_qry_plantilla);
					$campo_detalle=$tb_detalle.'.codigo_presupuesto_anual';
					$qry_orden="order by ";
					$qry_datos_insertados.="$campo_detalle ";
					$qry_orden2=substr($qry_orden2,0,(strlen($qry_orden2)-2));	
					$qry_condicion="WHERE $campo_detalle='$id' ";	
				$cnt=1;
				while ($cnt<=count($campo)) //si los campos traen algun contenido, los compara para filtrarlos
				{
					$variable=strtoupper($_REQUEST["$campo[$cnt]"]);					
					if ((!$variable=="") && (!$variable=="0"))
					{						
						if ($tipo_campo[$cnt]==1)
						{	
							$qry_condicion.=" and $tb_detalle.$campo[$cnt] like '%$variable%' ";									
						}
						else
						if ($tipo_campo[$cnt]==2)
						{
							$qry_condicion.=" and $tb_detalle.$campo[$cnt]='$variable' ";									
						}			
						else
						if ($tipo_campo[$cnt]==7)
						{
							$qry_condicion.=" and $tb_detalle.$campo[$cnt]='$variable' ";									
						}
						else
						if (($tipo_campo[$cnt]==8) || ($tipo_campo[$cnt]==10))
						{
							$dia=substr($_REQUEST["$campo[$cnt]"],0,2);
							$mes=substr($_REQUEST["$campo[$cnt]"],3,2);								
							$anio=substr($_REQUEST["$campo[$cnt]"],6,4);							
							$variable=$anio.'-'.$mes.'-'.$dia;							
							$qry_condicion.=" and $tb_detalle.$campo[$cnt]>='$variable' ";									
						}
						else
						if ($tipo_campo[$cnt]==9)
						{	
							$qry_condicion.=" and $tb_detalle.$campo[$cnt] like '%$variable%' ";									
						}												
					}
					$cnt++;					
				}// fin del while que forma el qry_consulta																														
				$qry_detalle=$qry_datos_insertados.' '.$qry_datos_insertados2.' '.$qry_datos_insertados3.' '.$qry_condicion.' '.$qry_orden.' '.$qry_orden2;																																											
				$res_consulta=$query($qry_detalle);
				if ($res_consulta)
				{	   	  			
					 // echo '<tr><td align="right" colspan="'.$no_campos_detalle.'"><a href="../agregar.php"><img src="../../images/iconos/ico_agregar.gif" alt="Agregar registro" border="0"></a></td></tr>';
					  $no_campos_detalle++;				  					  	  			  					  
					  $res_qry_insertados=$query($qry_detalle);		 
					  $no_campos_detalle--;
					  $i=1;					  
						$cnt=2; //imprime etiquetas
						$no_campos_detalle=$no_campos_detalle-3;						
						while($row_qry_insertados=$fetch_array($res_qry_insertados))
						{
							  $nombre_grupo=$row_qry_insertados["1"];
							  $saldo=$row_qry_insertados["2"];
					    } //while $res_qry_insertados
					$free_result($res_qry_insertados);	
				} // if $res_consulta					
				else
				{
				echo '<tr><td class="error" colspan="3" align="center">NO SE ENCONTRARON REGISTROS QUE COINCIDAN CON LA BUSQUEDA<br><br>Para intentar nuevamente <a href="buscar.php?obj=34">[HAGA CLIC AQUI]</a></td></tr>';
				}
			}  // if acceso
		} // fin del if isset obj			
	?> 

<!DOCTYPE html>
<html>
<head>




<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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



<script>


function eliminaEspacios(cadena)
{
	var x=0, y=cadena.length-1;
	while(cadena.charAt(x)==" ") x++;	
	while(cadena.charAt(y)==" ") y--;	
	return cadena.substr(x, y-x+1);
}





function validarEntero(valor){ 
   // valor = parseInt(valor) 

//alert(valor);

    if (isNaN(valor)) { 
	//   alert("Escriba numeros enteros");
       return false; 
    }else{ 
       return true 
    } 
} 




function validar(form){	

if (validarEntero(document.all.$asignado_mes1.value)===true)

		{

if (confirm('Esta acción graba y finaliza el ingreso de datos, desea finalizar?')){  
					//cargaDatos(form);
					
						form.submit();
		} 
		}else{
			alert("Debe Ingresar un monto Valido menor al solicitado y Unicamente se admiten Numeros enteros el punto o la coma es un caracter invalido");
		}
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
    <td width="16%" height="25"><div align="left"><img src="../../images/logo_rpt.gif" width="82" height="95"></div></td>
    <td colspan="2"><p align="center" class="titulocategoria Estilo1">SUBGERENCIA FINANCIERA </p>
      <p align="center" class="titulocategoria"> MODULO DE PRESUPUESTO </p></td>
    <td width="14%"><div align="right"><img src="../../images/presupuesto.jpg" width="128" height="89"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="4">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="4"><div align="right" class="tituloproducto">     
    </div></td>
  </tr>
  <tr>
    <td rowspan="9">&nbsp;</td>
    <td width="11%" height="25" class="titulomenu">Fuente:</td>
    <td width="59%" class="tituloproducto"><span class="legal"><? echo $contenido[2]; ?></span></td>
    <td rowspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Actividad:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo $contenido[3]; ?></span></td>
  </tr>
  
  <tr>
    <td height="25" class="titulomenu"><div align="left">Programa:</div></td>
    <td height="25" class="tituloproducto"><span class="titulocategoria"><span class="legal"><? echo $contenido[4]; ?></span></span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Departamento:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo $contenido[5]; ?>&nbsp;</span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Subprograma:</td>
    <td height="25" class="tituloproducto"><span class="titulocategoria"><span class="legal"><? echo $contenido[7]; ?></span></span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Subproyecto:</td>
    <td height="25" class="tituloproducto"><span class="titulocategoria"><span class="legal"><? echo $contenido[6]; ?></span></span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Cuatrimestre:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo $c; ?> <span class="titulomenu">A&ntilde;o: </span><? echo $contenido[8]; ?> </span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Grupo:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo $nombre_grupo; ?></span></td>
  </tr>
  <tr>
    <td height="25" class="titulomenu">Saldo:</td>
    <td height="25" class="tituloproducto"><span class="legal"><? echo 'Q'.number_format($saldo, 2, '.', ','); ?></span></td>
  </tr> 
	  
      <form name="form1" method="post" action="gppto_renglon.php" enctype="multipart/form-data">	  	        	  	  	  	 
	  <input  name="saldo_comparativo" type="hidden" id="saldo_comparativo"  value="<? echo $saldo ?>"/>
	  <table width="90%"  border="1" align="center" cellpadding="0" cellspacing="0">
</table>

	<input  name="txt_codigo_presupuesto_anual" type="hidden" id="txt_codigo_presupuesto_anual"  value="<? echo $id?>"/> 		
	<input  name="txt_codigo_financiamiento_actividad" type="hidden" id="txt_codigo_financiamiento_actividad"  value="<? echo $pr?>"/> 		
	<input  name="txt_codigo_periodo" type="hidden" id="txt_codigo_periodo"  value="<? echo $c ?>"/>
	<input  name="txt_monto_solicitado" type="hidden" id="txt_monto_solicitado"  value="<? echo $txt_monto_solicitado_saldo ?>"/>
	<input  name="txt_nombre_grupo" type="hidden" id="txt_nombre_grupo"  value="<? echo $nombre_grupo ?>"/>
    <input  name="txt_codigo_renglon" type="hidden" id="txt_codigo_renlgon"  value="<? echo $codigo_renglon ?>"/>

</td></tr>  	  	 		  
</tr> 
<br>
<br>    
</table>

<table width="90%" border="0" align="center">		  
		   <tr>
		   <td>
			
			<div id="TabbedPanels1" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">
				<!-- <li class="TabbedPanelsTab style3" tabindex="0">Memoria</li> 
				<li class="TabbedPanelsTab style3" tabindex="0">Procesador</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Disco Duro</li>
				<li class="TabbedPanelsTab style3" tabindex="0">Lectores <span class="error">**</span></li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software OEM <span class="error">**</span></li>
				<li class="TabbedPanelsTab style3" tabindex="0">Software Instalado</li>	 -->			
				
                
           <li class="TabbedPanelsTab style3" tabindex="0">AUTORIZACION DE CUOTA CUATRIMESTRAL POR MES <span class="error">**</span></li>				
				</ul>
				
                <div class="TabbedPanelsContentGroup">																	
                
				<div class="TabbedPanelsContent">
								                                
                <? 
// Obtener datos
 
		$instruccion = "select tb_presupuesto_det.comprometido_mes1, tb_presupuesto_det.comprometido_mes2, 
		tb_presupuesto_det.comprometido_mes3, cat_renglon.codigo, tb_presupuesto_det.justificacion,
		tb_presupuesto_det.codigo_periodo, tb_presupuesto_anual.codigo_grupo, tb_presupuesto_anual.codigo_presupuesto_anual,
		tb_presupuesto_det.comprometido_mes4
		from tb_presupuesto_det 
		inner join
		cat_renglon on 
		tb_presupuesto_det.codigo_renglon = cat_renglon.codigo_renglon 
		inner join
		tb_presupuesto_anual on tb_presupuesto_det.codigo_presupuesto_anual = tb_presupuesto_anual.codigo_presupuesto_anual
		where tb_presupuesto_det.codigo_presupuesto_anual ='$id'
		and tb_presupuesto_det.codigo_periodo = '$c'"; 
		 
		
	$criterio_grupo = trim($nombre_grupo);	
		 
    $query_grupo = "select codigo_grupo from cat_grupo where nombre_grupo = '$criterio_grupo'";	
	$salida_grupo = mssql_query($query_grupo);
	$vector_grupo = mssql_fetch_row($salida_grupo);
	$vgrupo = $vector_grupo[0];
		 
		 $query_existe = "select a.codigo_asignacion_cuatrimestral,
					a.asignado_mes1,
					a.asignado_mes2,
					a.asignado_mes3,
					a.asignado_mes4
					from tb_asignacion_cuatrimestral a 
					where  a.codigo_financiamiento_actividad = '$pr' 
					and a.codigo_periodo = '$c'
					and a.codigo_grupo = '$vgrupo'";
					
					
			//print $query_existe;												
					
		$consulta_existe = mssql_query($query_existe) or die ("Fallo en la consulta");
							
		$consulta = mssql_query ($instruccion)
				 or die ("Fallo en la consulta");
 
// Mostrar resultados de la consulta

	
	
	

      $nfilas = mssql_num_rows($consulta);
	
	  $res = mssql_num_rows($consulta_existe);
	  
	
	  
      if ($nfilas > 0)
	  {
         print ("<TABLE>\n");
         print ("<TR>\n");
         print ("<TH>Renglon</TH>\n");
		 print ("<TH>Mes 1 </TH>\n");
		 print ("<TH>Mes 2 </TH>\n");	
		 print ("<TH>Mes 3 </TH>\n");
		 print ("<TH>Mes 4 </TH>\n");
		 print ("<TH>Justificacion </TH>\n");
		 print ("<TH>Mes 1 </TH>\n");
		 print ("<TH>Mes 2 </TH>\n");
		 print ("<TH>Mes 3 </TH>\n");
		 print ("<TH>Mes 4 </TH>\n");
		
		 print ("</TR>\n");
		$cnt = 1;
        for ($i=0; $i<$nfilas; $i++)
         {
            $resultado = mssql_fetch_array ($consulta);
            print ("<TR>\n");            
				print ("<TD><input name = code[".$cnt."][4] type=hidden size=8 value=".$resultado['codigo']."  /><input name = code1[".$cnt."][4] type=text size=8 value=".$resultado['codigo']." disabled /></TD>\n");

			print ("<TD>" .$resultado['comprometido_mes1']. "</TD>\n");
			print ("<TD>" .$resultado['comprometido_mes2']. "</TD>\n");
			print ("<TD>" .$resultado['comprometido_mes3']. "</TD>\n");
			print ("<TD>" .$resultado['comprometido_mes4']. "</TD>\n");
		    print ("<TD>" .$resultado['justificacion']. "</TD>\n");

	
	
	
	
	if ($res > 0)	 
	{

		$vector_existe = mssql_fetch_array($consulta_existe);	
		
		print '<td>';
        print('<input  name="sasignado['.$cnt.'][0]" value='.$vector_existe[1].' type="text" size="8" id="txt_asignado_mes1"/><input  name="sasignado['.$cnt.'][5]" value='.$vector_existe[0].' type="hidden" size="8" id="txt_asignado_mes0"/><input  name="sw" value="'.$res.'" type="hidden" size="8" id="txt_asignado_mes100"/>');
        print '</td>';  
       
		
	    print '<td>';
        print('<input  name="sasignado['.$cnt.'][1]"  value='.$vector_existe[2].' type="text" size="8" id="txt_asignado_mes2"/>');
        print '</td>';  
		
		print '<td>';
        print('<input  name="sasignado['.$cnt.'][2]" value='.$vector_existe[3].' type="text" size="8" id = "txt_asignado_mes3"/>');
        print '</td>';  
		   
	    print '<td>';
        print('<input  name="sasignado['.$cnt.'][3]" value='.$vector_existe[4].' type="text" size="8" id="txt_asignado_mes4"/>');
        print '</td>';  		
	

	}else{
	 //en caso de que venga un valor nuevo
        print '<td>';
        print('<input  name="asignado['.$cnt.'][0]" type="text" size="8" id="txt_asignado_mes1"/>');
        print '</td>';  
       
		
	    print '<td>';
        print('<input  name="asignado['.$cnt.'][1]" type="text" size="8" id="txt_asignado_mes2"/>');
        print '</td>';  
		
		print '<td>';
        print('<input  name="asignado['.$cnt.'][2]" type="text" size="8" id = "txt_asignado_mes3"/>');
        print '</td>';  
		   
	    print '<td>';
        print('<input  name="asignado['.$cnt.'][3]" type="text" size="8" id="txt_asignado_mes4"/>');
        print '</td>';  		
	}
		
		 
		
		$cnt++;					
} 
			   print ("</TABLE>\n");
			   print "<ul> </ul>";
			 }
 	 
     else
         print ("No Existe Presupuesto Planificado para este Mes");           
  ?>
  

					  <? // include("asignacion_det.php"); ?>
			
       
		  
			<script type="text/javascript">
				<!--
					var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
				//-->
			</script>			
	</td>   
	</tr>
	<tr>
	  
   
     <td><center><input name="cmd_guardar" type="submit"  id="cmd_guardar" value="Guardar" <? echo $status?> > </center></td>
     
	</tr>
</table>  
 



     
		
</form>

	
</body>
<?
include("../../includes/validaciones.php");
?>
</html>

