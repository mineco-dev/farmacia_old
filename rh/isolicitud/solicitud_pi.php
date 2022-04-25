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
.style200 { width:220px; }
.Estilo5 {color: #F8F8F8}
</style>
		
</head>
<body>

<h2 align="center"><a id="selflink_examples"> Solicitud de Inscripcion de Garantias Mobiliarias</a></h2>
<div id="formContenedor">
<FORM ACTION="../mail1.php" method="post" name="form1" style="margin-bottom: 0">
		<div id="transparencia">
			<div id="transparenciaMensaje">aaaaaaaaaaaa</div>
		</div>
	<table width="823" align="left" class="dp-vb">
		<tbody>
		  
		  
		  <tr align="left">
            <td colspan="4" bgcolor="#328DCF"><div align="center" class="vars"></div></td>
          </tr>

				<tr>
				  <td width="109" align="left"><div align="left"></div></td>
				  <td width="292">&nbsp;</td>
				  <td width="112" class="ayuda">&nbsp;</td>
				  <td width="287" class="ayuda">&nbsp;</td>
		  </tr>
				<tr>
				  <td align="left"><div align="left">Cedula Vecindad:</div></td>
				  <td align="left"><input class="iMask" id="myId" name="cedula" value="A1 000001" alt="{
					type:'fixed',
					mask:'[[X-9  999999]]',
					stripMask: true
				}" type="text" /></td>
				  <td align="left">&nbsp;</td>
				  <td align="left" bgcolor="#F8F8F8">&nbsp;</td>
		  </tr>
				<tr>
				  <td align="left"><div align="left">Tipo de Persona: </div></td>
				  <td align="left"><span class="campo">
                    <?				  	
					require ('../class/conexion.inc');
					$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
					mysql_select_db($BASE_DATOS,$db);
					$fecha= date("Y-m-d");
					
					$consulta=mysql_query("SELECT id_tipo_persona, descripcion FROM tb_tipo_persona");
					
					
					echo "<select name='id_tipo_persona' id='id_tipo_persona'>";
					echo "<option value='0'>---------------</option>";
					while($registro=mysql_fetch_row($consulta))
					{
						echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
					}
					echo "</select>";
					
					mysql_close($db);
		    	?>
                  </span></td>
				  <td align="left">&nbsp;</td>
				  <td align="left" bgcolor="#F8F8F8">&nbsp;</td>
		  </tr>
				<tr>
				  <td height="34" align="left" class="label">&nbsp;</td>
				  <td class="campo">&nbsp;</td>
				  <td align="left">&nbsp;</td>
				  <td align="left" bgcolor="#F8F8F8">&nbsp;</td>
		  </tr>
				<tr>
				  <td align="left" class="label">&nbsp;</td>
				  <td class="campo">&nbsp;</td>
				  <td align="left">&nbsp;</td>
				  <td align="left" bgcolor="#F8F8F8">&nbsp;</td>
		  </tr>
				<tr>
				  <td colspan="4" align="left" bgcolor="#CCCCCC" class="Estilo3"><div align="center">Datos del Deudor Garante  </div></td>
		  </tr>
				<tr>
				  <td align="left" class="label">&nbsp;</td>
				  <td class="campo">&nbsp;</td>
				  <td align="left">&nbsp;</td>
				  <td align="left" bgcolor="#F8F8F8">&nbsp;</td>
		  </tr>
				<tr>
				  <td align="left" class="label"><div align="left">Pimer Nombre:</div></td>
				  <td class="campo"><input class="inputNormal" type="text" id="inputNombre" /></td>
				  <td align="left" class="label"><div align="left">Segundo Nombre: </div></td>
				  <td class="campo"><input name="text" type="text" class="inputNormal" id="text" /></td>
		  </tr>
				<tr>
				  <td align="left" class="label"><div align="left">Tercer Nombre: </div></td>
				  <td class="campo"><input name="text2" type="text" class="inputNormal" id="text2" /></td>
				  <td align="left" class="label"><div align="left">Primer Apellido: </div></td>
				  <td class="campo"><input name="text3" type="text" class="inputNormal" id="text3" /></td>
		  </tr>
				<tr>
				  <td align="left" class="label"><div align="left">Segundo Apellido: </div></td>
				  <td class="campo"><input name="text4" type="text" class="inputNormal" id="text4" /></td>
				  <td align="left" class="label"><div align="left">Apell. de Casada:</div></td>
				  <td class="campo"><input name="text5" type="text" class="inputNormal" id="text5" /></td>
		  </tr>
				<tr>
				  <td align="left"><label>
                      <div align="left">Fecha Nacimiento </div>
				    </label>                  </td>
				  <td class="inputNormal"><div align="left">
                      <input class="iMask" id="myFecha" name="myFecha" value="" alt="{
					type:'fixed',
					mask:'99/99/9999',
					stripMask: true
				}" type="text" />
                  </div></td>
				  <td align="left"><label>
                      <div align="left">Codigo Postal :</div>
				    </label>                  </td>
				  <td class="inputNormal"><div align="left">
                      <input class="iMask" id="myCode2" name="myCode2" value="01004" alt="{
					type:'fixed',
					mask:'99-99-99',
					stripMask: true
				}" type="text" />
                  </div></td>
		  </tr>
				<tr>
				  <td align="left"><div align="left">Numero de NIT</div></td>
				  <td class="inputNormal"><div align="left"><span class="campo">
                      <input name="text7" type="text" class="inputNormal" id="text7" />
                  </span></div></td>
				  <td align="left"><div align="left">Nacionalidad</div></td>
				  <td align="left"><div align="left"><span class="campo">
                      <?
				  	require ('../class/conexion.inc');
					$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
					mysql_select_db($BASE_DATOS,$db);
					$fecha= date("Y-m-d");
					$consulta=mysql_query("SELECT codigo_pais_origen, nombre_pais FROM tb_pais_origen");
					//desconectar();
				
					// Voy imprimiendo el primer select compuesto por los paises
					echo "<select name='codigo_pais_origen' id='codigo_pais_origen'>";
					echo "<option value='0'>----------</option>";
					while($registro=mysql_fetch_row($consulta))
					{
						echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
					}
					echo "</select>";
					mysql_close($db);
	?>
                  </span></div></td>
		  </tr>
				<tr>
				  <td align="left"><div align="left">
                      <label>Departamento</label>
                  </div></td>
				  <td align="left" bgcolor="#F8F8F8"><?php generaPaises();?>
                      <div align="left"></div>
				    <div align="center"></div>
				    <div align="center"></div>
				    <div align="center"></div>
				    <div align="center"></div></td>
				  <td align="left"><div align="left">
                      <label>Municipio</label>
                  </div></td>
				  <td align="left" bgcolor="#F8F8F8"><div align="left"> <span class="Estilo5">.</span>
                          <select name="estados" disabled="disabled" class="inputNormal" id="select">
                            <option value="0">--------------</option>
                          </select>
                  </div></td>
		  </tr>
				<tr>
				  <td align="left" class="label"><div align="left">Edificio:</div></td>
				  <td class="campo"><input class="inputNormal" type="text" id="inputEmpresa" /></td>
				  <td align="left" class="label"><div align="left">Colonia:</div></td>
				  <td class="campo"><input class="inputNormal" type="text" id="input1" /></td>
		  </tr>
				<tr>
				  <td align="left" class="label"><div align="left">Zona:</div></td>
				  <td align="left" class="campo"><?
				  	conectar();
					$consulta=mysql_query("SELECT codigo_zona, numero_zona FROM tb_zona");
					//desconectar();
				
					// Voy imprimiendo el primer select compuesto por los paises
					echo "<select name='zona' id='zona'>";
					echo "<option value='0'>Numero Zona</option>";
					while($registro=mysql_fetch_row($consulta))
					{
						echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
					}
					echo "</select>";
	?>
  &nbsp;</td>
				  <td align="left" class="label"><div align="left">Aldea/Caserio:</div></td>
				  <td class="campo"><input name="text6" type="text" class="inputNormal" id="text6" /></td>
		  </tr>
				<tr>
				  <td align="left" class="label"><div align="left">Calle/Avenida:</div></td>
				  <td class="campo"><input class="inputNormal" type="text" id="input2" /></td>
				  <td align="left" class="label"><div align="left">Apartamento:</div></td>
				  <td class="campo"><input class="inputNormal" type="text" id="inputNombre44" /></td>
		  </tr>
				<tr>
				  <td align="left"><div align="left">
                      <label>Telefono:</label>
                  </div></td>
				  <td class="inputNormal"><div align="left">
				    <input class="iMask" id="myPhone2" name="myPhone2" value="50200000000" alt="{
					type:'fixed',
					mask:'9999-9999',
					stripMask: true
				}" type="text" />
                  </div></td>
				  <td align="left" class="label"><div align="left">Correo Electronico </div></td>
				  <td class="inputNormal"><div align="left">
				    <input class="inputNormal" type="text" id="inputNombre778" />
                  </div></td>
		  </tr>
				<tr>
				  <td>&nbsp;</td>
				  <td class="inputNormal">&nbsp;</td>
				  <td class="ayuda">&nbsp;</td>
				  <td class="ayuda">&nbsp;</td>
		  </tr>
				
				<tr>
				  <td class="label">&nbsp;</td>
				  <td class="campo"><input name="btnInsertar"type="submit"id="btnInsertar" value="Enviar Datos" /></td>
				  <td class="ayuda">&nbsp;</td>
				  <td class="ayuda">&nbsp;</td>
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
