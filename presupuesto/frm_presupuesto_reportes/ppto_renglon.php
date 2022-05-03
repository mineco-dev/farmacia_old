<?
		require("../../includes/funciones.php");
		require("../../includes/sqlcommand.inc");
		session_register("ingresando_obj");
		$_SESSION["ingresando_obj"]=true;
?>
<?
		//RECUPERA LOS DATOS DEL REGISTRO						
		$obj=34;
		if (isset($obj)) //verifico si hay objeto seleccionado
		{
			$acceso=permisosdb($presupuesto);					
			if (($acceso==1) || ($acceso==3) || ($acceso==4) || ($acceso==5) || ($acceso==6) || ($acceso==7) || ($acceso==8))
			{							
																																							
				require('../../connection/helpdesk.php');
				
		
		
		
		
		
		
		

function get_cantidad($id,$c)
{
	$sql="select sum(monto_asignado) canti
				 from
					tb_asignacion_cuatrimestral tb1
				 where
					tb1.codigo_periodo = $c and  
					tb1.codigo_financiamiento_actividad = $id";

	$result = mysql_query($sql);
	$Fields = mysql_fetch_row($result);
	
	return $Fields[0];
}


function getcantidad($id,$c)
{
	$sql="select sum(devengado) canti
				 from
					tb_ejecucion_presupuesto tb1
				 where
					month(tb1.fecha) = $c and  
					tb1.codigo_financiamiento_actividad = $id";

	$result = mysql_query($sql);
	$Fields = mysql_fetch_row($result);
	
	return $Fields[0];
}


function get_texto($id,$c,$ta)
{
	$texto = 'Asignado;'.get_cantidad($id,$c).'\n'.
			'Ejecutado;'.getcantidad($id,1);
/*			'Marzo;'.get_cantidad(3,$ta).'\n'.
			'Abril;'.get_cantidad(4,$ta).'\n'.
			'Mayo;'.get_cantidad(5,$ta).'\n'.
			'Junio;'.get_cantidad(6,$ta).'\n'.
			'Julio;'.get_cantidad(7,$ta).'\n'.
			'Agosto;'.get_cantidad(8,$ta).'\n'.
			'Septiembre;'.get_cantidad(9,$ta).'\n'.
			'Octubre;'.get_cantidad(10,$ta).'\n'.
			'Noviembre;'.get_cantidad(11,$ta).'\n'.
			'Diciembre;'.get_cantidad(12,$ta);*/
	return $texto;
}
		
		
	
		
		
}}		
		
				
	?> 

<!DOCTYPE html>
<html>
<head>




<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../includes/helpdesk.css" rel="stylesheet" type="text/css">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />

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

				if (confirm('Esta acción graba y finaliza el ingreso de datos, desea finalizar?')){  										
					form.submit();
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


<?
$estado = 1;

if ($estado ==0)
		$ta = " events ";
	else
		$ta = " cancelevents ";
?>
<div align="center">
  <!-- saved from url=(0013)about:internet -->
  <!-- amcolumn script-->
    <script type='text/javascript' src='amcolumn/swfobject.js'></script>
</div>
<div id='flashcontent'>
	<div align="center"><strong>You need to upgrade your Flash Player</strong>
      </div>
</div>

<script type='text/javascript'>
		// <![CDATA[
		var so = new SWFObject('amcolumn/amcolumn.swf', 'amcolumn', '98%', '380', '0', '#FFFFFF,#B0DE09');
		so.addVariable('path', 'amcolumn/');
		so.addVariable('chart_data', '<? $ta = date("Y"); echo ''.get_texto($id,$c,$ta).''; ?>');
		so.addVariable('chart_settings', '<settings><data_type>csv</data_type><depth>10</depth><angle>20</angle><column><spacing>1</spacing><grow_time>2</grow_time><grow_effect>strong</grow_effect><alpha>70</alpha><tick_length>40</tick_length><border_color>#FF9E01,#FFFFFF</border_color><border_alpha>5</border_alpha><balloon_text><![CDATA[{series}: {value}]]></balloon_text><gradient>vertical</gradient></column><background><color>#FF9E01,#FFFFFF</color><border_color>#FF9E01,#FFFFFF</border_color><border_alpha>5</border_alpha></background><axes><category><width>10</width></category><value><width>10</width></value><tick_length></tick_length><logarithmic></logarithmic></axes><legend><enabled>false</enabled></legend><labels><label><x>0</x><y>25</y><align>center</align><text><![CDATA[<b>TOTAL EJECUCIONES PRESUPUESTARIAS</b>]]></text></label></labels><graphs><graph><gradient_fill_colors>#FFFFFF,#B0DE09</gradient_fill_colors><color>#FCD202</color></graph></graphs></settings>')
		so.addVariable('preloader_color', '#999999');
		so.write('flashcontent');
		// ]]>
	</script>


</body>


</html>

