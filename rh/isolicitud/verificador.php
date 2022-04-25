<?php
function generaPaises()
{
	include '../conexion.php';
	conectar();
	$consulta=mysql_query("SELECT id, opcion FROM lista_paises");
	desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
	

}
	//header("Content-Type: image/jpg");
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

<link rel="stylesheet" type="text/css" href="../java/reset-fonts.css">

		<meta name="description" content="iMask is an open source (free) javascript tool for creating input and textarea masking.">
		<meta name="keywords" content="iMask, mask, form mask, input mask, text mask, javascript mask, moo.fx, mootools, plugin, input format, text format, unobtrusive JavaScript, Fabio Zendhi Nagao">
		<link type="text/css" rel="stylesheet" href="../java/zend.css">
		<link type="text/css" rel="stylesheet" href="../java/moodalbox.css" media="screen">
		<link type="text/css" rel="stylesheet" href="../java/syntaxHighlighter.css">  
		<link type="text/css" rel="stylesheet" href="../java/this_002.css">  
		<link type="text/css" rel="stylesheet" href="../java/this.css">
		<link rel="stylesheet" type="text/css" href="../css/select_dependientes.css">
		<!---!--->
		<link rel="stylesheet" type="text/css" href="../css/estilos.css">
		
		<script type="text/javascript" src="../java/mootools.js"></script>
		<script type="text/javascript" src="../java/moodalbox.js"></script>
		<script type="text/javascript" src="../java/shCore.js"></script>
		<script type="text/javascript" src="../java/shBrushXml.js"></script>
		<script type="text/javascript" src="../java/shBrushJScript.js"></script>
		<script type="text/javascript" src="../java/imask-full.js"></script>
		<!---!validacion--->
		<script type="text/javascript" src="../js/funciones.js"></script>
		<!----calendario-->
		<script type="text/javascript" src="../js/DatePicker.js"></script>
		<!----combos----->
		<script type="text/javascript" src="../js/select_dependientes.js"></script>
		<!----autocomplete--
		<script type="text/javascript" src="js/prototype.js"></script>
		<script type="text/javascript" src="js/effects.js"></script>
		<script type="text/javascript" src="js/controls.js"></script>
	--->
		
		<script type="text/javascript">

function Abrir_ventana (pagina) {
var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=yes, width=508, height=365, top=85, left=140";
window.open(pagina,"",opciones);
}
			
//<![CDATA[
var Page = {
	initialize: function() {
		dp.SyntaxHighlighter.HighlightAll('usage_include');
		dp.SyntaxHighlighter.HighlightAll('usage_initialize');
		dp.SyntaxHighlighter.HighlightAll('usage_xhtml');

		new SmoothScroll({
			transition: Fx.Transitions.backOut,
			fps: 60,
			duration: 1500
		});

		new iMask({
			onFocus: function(obj) {
				obj.setStyles({"background-color":"#ff8", border:"1px solid #880"});
			},

			onBlur: function(obj) {
				obj.setStyles({"background-color":"#fff", border:"1px solid #ccc"});
			},

			onValid: function(event, obj) {
				obj.setStyles({"background-color":"#8f8", border:"1px solid #080"});
			},

			onInvalid: function(event, obj) {
				if(!event.shift) {
					obj.setStyles({"background-color":"#f88", border:"1px solid #800"});
				}
			}
		});
	}
};
window.onDomReady(Page.initialize);
//se agrego para el codigo del calendario
window.addEvent('domready', function(){

	$$('input.DatePicker').each( function(el){
		new DatePicker(el);
	});

});

//]]>
</script>


					<script type="text/javascript">
var type = 'fixed'
var m = '9999-9999'
var patron = new Array(2,2,4)
var patron2 = new Array(1,3,3,3,3)
var sep = '/'
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
	val = d.value
	largo = val.length
	val = val.split(sep)
	val2 = ''
	for(r=0;r<val.length;r++){
		val2 += val[r]	
	}
	if(nums){
		for(z=0;z<val2.length;z++){
			if(isNaN(val2.charAt(z))){
				letra = new RegExp(val2.charAt(z),"g")
				val2 = val2.replace(letra,"")
			}
		}
	}
	val = ''
	val3 = new Array()
	for(s=0; s<pat.length; s++){
		val3[s] = val2.substring(0,pat[s])
		val2 = val2.substr(pat[s])
	}
	for(q=0;q<val3.length; q++){
		if(q ==0){
			val = val3[q]
		}
		else{
			if(val3[q] != ""){
				val += sep + val3[q]
				}
		}
	}
	d.value = val
	d.valant = val
	}
}
</script>

       
<style type="text/css">

/* ---- calendar and input styles ---- */

#search, ul { 
	padding: 3px; 
	width: 150px; 
	border: 1px solid #999; 
	font-family: verdana; 
	arial, sans-serif; font-size: 12px;
	}
	ul { 
	list-style-type: none; 
	font-family: verdana; 
	arial, sans-serif; font-size: 12px;  
	margin: 5px 0 0 0;
	}
	li { 
	margin: 0 0 5px 0; 
	cursor: default; 
	color: red;
	}
	li:hover { 
	background: #ffc; 
	}
	
input.DatePicker{
	display: block;
	width: 150px;
	padding: 3px 3px 3px 24px;
	border: 1px solid #0070bf;
	font-size: 13px;
	background: #fff url(../date.gif) no-repeat top left;
	cursor: pointer;
}
input:focus.DatePicker{
	background: #fffce9 url(datefocus.gif) no-repeat top left;
}
.dp_container{
	position: relative;
	padding: 0;
	z-index: 500;
}
.dp_cal{
	background-color: #fff;
	border: 1px solid #0070bf;
	position: absolute;
	width: 177px;
	top: 24px;
	left: 0;
	margin: 0px 0px 3px 0px;
}
.dp_cal table{
	width: 100%;
	border-collapse: collapse;
	border-spacing: 0;
}
.dp_cal select{
	margin: 2px 3px;
	font-size: 11px;
}
.dp_cal select option{
	padding: 1px 3px;
}
.dp_cal th,
.dp_cal td{
	width: 14.2857%;
	text-align: center;
	font-size: 11px;
	padding: 2px 0;
}
.dp_cal th{
	border: solid #aad4f2;
	border-width: 1px 0;
	color: #797774;
	background: #daf2e6;
	font-weight: bold;
}
.dp_cal td{
	cursor: pointer;
}
.dp_cal thead th{
	background: #d9eefc;
}
.dp_cal td.dp_roll{
	color: #000;
	background: #fff6bf;
}
/* must have this for the IE6 select box hiding */
.dp_hide{
	visibility: hidden;
}
.dp_empty{
	background: #eee;
}
.dp_today{
	background: #daf2e6;
}
.dp_selected{
	color: #fff;
	background: #328dcf;
}
.Estilo3 {color: #990000}
.Estilo5 {color: #F8F8F8}
.style3 {font-size: 100%}
</style>
		
</head>
<body>

<?

					require ('../class/conexion.inc');
					$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
					mysql_select_db($BASE_DATOS,$db);
					$fecha= date("Y-m-d");


					




					mysql_query("INSERT INTO tb_contrato_garantia (fecha_celebracion,activo,edificio,colonia,aldea,calle,casa,codigo_zona,descripcion_del_bien,numero_unico_identificacion,boleta,banco,fecha_inicio,fecha_final,codiciones_generales,tipo_inscripcion,codigo_departamento,codigo_pais_origen,id_tipo_garantia,id_dominio_registral,codigo_municipio,codigo_tipo_bien) VALUES ('$fecha_celebracion',1,'$edificio','$colonia','$aldea','$calle','$casa','$codigo_zona','$descripcion_del_bien','$numero_unico_identificacion','$boleta','$banco','$fecha_inicio','$fecha_final','$condiciones_generales',1,'$paises','$codigo_pais_origen','$id_tipo_garantia','$id_dominio_registral','$estados','$codigo_tipo_bien')");																		
					
					
					
					
					$contrato = mysql_query("SELECT max(rowid) FROM tb_contrato_garantia");
					if($contrato)
					{
							$ncontrato = mysql_fetch_row($contrato);
							$num_contrato = $ncontrato[0];
							//print $num_contrato;						
					}
				
					
					
					
mysql_close($db);
					
					

if ($link == 'dgarante.php')
{
	$vari = '5';
}
if ($link == 'dgaranteg.php')
{
	$vari = '4';
}
if ($link == 'dgaranter.php')
{
	$vari = '2';
}



 //print $link; ?>

<h2 align="center"><a id="selflink_examples">Solicitud de Inscripcion de Garantias Mobiliarias</a></h2>
<div id="formContenedor">
<FORM ACTION="<? print $link?>" method="get" name="form1" style="margin-bottom: 0">
		<div id="transparencia">
			<div id="transparenciaMensaje">aaaaaaaaaaaa</div>
		</div>
	<table width="560" class="dp-vb">
		<tbody>
		  <tr>
		    <td colspan="2" class="dp_selected"><div align="left" class="vars"> </div></td>
	      </tr>
		  
		  <tr>
		    <td colspan="2" class="mb_loading">VERIFICACION DE DATOS DEL DEUDOR GARANTE </td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td align="left">&nbsp;</td>
	      </tr>
		  <tr>
		    <td><span class="style3">Cedula Vecindad:</span></td>
		    <td align="left"><input name="cedula" type="text" class="iMask " id="myId" value="A1 000001" alt="{
					type:'fixed',
					mask:'[[X-9  999999]]',
					stripMask: true
				}" /></td>
	      </tr>
		  <tr>
		    <td><span class="style3">Tipo de Persona: </span></td>
		    <td align="left"><span class="campo style3">
		      <?				  	
					require ('../class/conexion.inc');
					$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
					mysql_select_db($BASE_DATOS,$db);
					$fecha= date("Y-m-d");					
					$consulta=mysql_query("SELECT id_tipo_persona, descripcion FROM tb_tipo_persona where id_tipo_persona = '$vari'");					
					echo "<select name='id_tipo_persona' id='id_tipo_persona'>";
					echo "<option value='0'>----------------------------</option>";
					while($registro=mysql_fetch_row($consulta))
					{
						echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
					}
					echo "</select>";
					
					mysql_close($db);
		    	?>
		    </span></td>
	      </tr>
		  <tr>
		  <td width="108">&nbsp;</td>
		  <td width="238" align="left"><input type="hidden" name="num_contrato" value="<? print $num_contrato;?>" /></td>
		  </tr>
		  
				<tr>
				  <td class="label style3">&nbsp;</td>
				  <td class="campo"><input name="btnInsertar"type="submit"id="btnInsertar" value="Verificar Datos" /></td>
		  </tr>
				<tr>
				  <td height="27" class="label style3">&nbsp;</td>
				  <td class="campo style3">&nbsp;</td>
		  </tr>
  </tbody></table>
	

	
</form>  
	
<!-- Capa para mostrar los mensajes de ayuda al presionar los iconos correspondientes -->
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>


			
	
<p>&nbsp;</p>
</body>
</html>
