<?php
/*********************************** PARAMETROS Y VALIDACIONES ********************************************/
					require ('../class/conexion.inc');
					$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
					mysql_select_db($BASE_DATOS,$db);
		//print $logico;			
					$mostrar = date("d-m-Y h:i:s A");
					$fec = date("Y-m-d h:i:s");
					
					if ($logico == 'lleno')
					{
						$num_acreedor = $acreedor;
					}else
					{
						
						mysql_query("INSERT INTO tb_persona_individual (primer_nombre,numero_registro,segundo_nombre,tercer_nombre,apellido_paterno,apellido_materno,apellido_casada,fecha_nacimiento,nit,edificio,colonia,aldea,calle,casa,codigo_postal,codigo_pais_origen,codigo_departamento,codigo_municipio,telefono,correo) values ('$primer_nombre','$cedula','$segundo_nombre','$tercer_nombre','$apellido_paterno','$apellido_materno','$apellido_casada','$fecha_nacimiento','$nit','$edificio','$colonia','$aldea','$calle','$casa','$codigo_postal','$codigo_pais_origen','$paises','$estados','$telefono','$correo')");				
						$consulta = mysql_query("SELECT  max(id_codigo_persona_individual) FROM tb_persona_individual");				
						$row = mysql_fetch_row($consulta);
						if ($consulta)
						{ 
							$num_acreedor = $row[0];
						}
						
						
											
					}
				    $codi = date("Y").'-'.$num_contrato;								
					
					/*print $num_acreedor;
					print "</br>";
					print $num_persona;
					print "</br>";
					print $num_contrato;*/
					
					mysql_query("INSERT INTO tb_contrato_acreedor (rowid,id_codigo_persona_individual,id_tipo_persona,fechahora,inscripcion) VALUES ('$num_contrato','$num_persona','5','$fec','$codi')");
					mysql_query("INSERT INTO tb_contrato_acreedor (rowid,id_codigo_persona_individual,id_tipo_persona,fechahora,inscripcion) VALUES ('$num_contrato','$num_acreedor','1','$fec','$codi')");
					
					
					
mysql_close($db);
/************************                           PAISES                        *********************/




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
</style>
		
</head>
<body>

<h2 align="center"><a id="selflink_examples"> REGISTRO DE GARANTIAS MOBILIARIAS </a></h2>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<div id="formContenedor">
<FORM ACTION="" method="post" name="form1" style="margin-bottom: 0">
		<div id="transparencia">
			<div id="transparenciaMensaje">aaaaaaaaaaaa</div>
		</div>
	<table width="823" align="left" class="dp-vb">
		<tbody>
		  
		  
		  <tr align="left">
		    <td colspan="4">&nbsp;</td>
	      </tr>
		  <tr align="left">
		    <td colspan="4">&nbsp;</td>
	      </tr>
		  
		  <tr align="left">
            <td colspan="4" bgcolor="#328DCF"><div align="center" class="vars"></div></td>
          </tr>
				<tr>
				  <td colspan="4" align="left" bgcolor="#CCCCCC" class="Estilo3"><div align="center">
				    <blockquote>
				      <blockquote>
				        <blockquote>
				          <blockquote>
				            <blockquote>
				              <blockquote>
				                <blockquote>
				                  <p align="left">LA SOLICITUD DE INSCRIPCION FUE INGRESADA EXITOSAMENTE </p>
				                  <p align="left">FECHA/HORA: <? print $mostrar;?></p>
				                  <p align="left">NUMERO DE EXPEDIENTE ASIGNADO: <? print date("Y")."-".$num_contrato;?> </p>
				                  <p align="center"><a href="../centro.php"><img src="../imagen/regresar.jpg" width="108" height="34" border="0" /></a></p>
				                </blockquote>
				              </blockquote>
				            </blockquote>
				          </blockquote>
				        </blockquote>
				      </blockquote>
				    </blockquote>
				  </div></td>
		  </tr>
				<tr>
				  <td width="109" align="left" class="label">&nbsp;</td>
				  <td width="292" class="campo">&nbsp;</td>
				  <td width="112" align="left">&nbsp;</td>
				  <td width="287" align="left" bgcolor="#F8F8F8">&nbsp;</td>
		  </tr>
				<tr>
					<td colspan="4" align="center" class="label"><div align="center"></div></td>
				</tr>
	</tbody></table>
	  <div></div>
</form>
</div>

<!-- Capa para mostrar los mensajes de ayuda al presionar los iconos correspondientes -->
<div id="mensajesAyuda">
	<div id="ayudaTitulo"></div>
	<div id="ayudaTexto"></div>
</div>


			
	
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
