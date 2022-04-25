<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
session_register("ingresando_obj");
$_SESSION["ingresando_obj"]=true;
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
    <td><p align="center" class="titulocategoria Estilo1">SUBGERENCIA ADMINISTRATIVA </p>
      <p align="center" class="titulocategoria">M&Oacute;DULO: VISITANTES</p></td>
    <td width="14%"><div align="right"><img src="../../images/visitantes.gif" width="124" height="96"></div></td>
  </tr>
  <tr>
    <td height="8" colspan="3">    
    <img src="../../images/linea.gif" width="100%" height="6"></td>   
  </tr>
  <tr>
    <td height="25" colspan="3"><div align="right" class="tituloproducto">
      <div align="center"><span class="legal2">INFORMACION GENERAL DEL VISITANTE</span>        </div>
    </div></td>
  </tr>
	  <form name="form1" method="post" action="gperfil_visitante.php" enctype="multipart/form-data">
	  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr><td colspan="2">
    <table width="100%" border="0" align="center">		  
		   <tr>
		   <td>
			
			<div id="TabbedPanels1" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">				
				<li class="TabbedPanelsTab style3" tabindex="0">Datos personales<span class="error">**</span></li>				
   				<li class="TabbedPanelsTab style3" tabindex="0">Comentarios de seguimiento<span class="error">**</span></li>	 			
           		<li class="TabbedPanelsTab style3" tabindex="0">Historial de visitas</li>	 			
				</ul>
				<div class="TabbedPanelsContentGroup">					
					<div class="TabbedPanelsContent">
						<?  include("datos_visitante.php"); ?>
						<br>
					</div>							
                    <div class="TabbedPanelsContent">
						<?  include("seguimiento.php"); ?>
						<br>
					</div>		
                    <div class="TabbedPanelsContent">
						<?  include("historial.php"); ?>
						<br>
					</div>										
				</div>
			</div>
			<script type="text/javascript">
				<!--
					var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
				//-->
			</script>	</td>   
	</tr></table> 
    <tr>
    <td colspan="2">
	<span class="error">**Campos requeridos</span>	</td></tr>
    <tr><td colspan="2" align="center">
	<input  name="txt_obj" type="hidden" id="txt_obj"  value="<? echo $obj?>"/> 		
	<input  name="txt_tabladestino" type="hidden" id="txt_tabladestino"  value="<? echo $tabladestino?>"/>
	<input  name="txt_id" type="hidden" id="txt_id"  value="<? echo $id?>"/>
    <input  name="txt_ids" type="hidden" id="txt_ids"  value="<? echo $ids?>"/>
    <input  name="txt_visitante" type="hidden" id="txt_visitante"  value="<? echo $contenido[2]?>"/> 		
	<input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar Cambios" <? echo $status?>></td></tr>  
</table>	  	 		  
</tr> 
<br>
<br>   
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
							echo 'alert("En este campo solo puede ingresar n�meros");'; 
							echo 'form.'.$campo_validacion[$i].'.focus();'; 
							echo 'return;';
						echo '}';
				}
				if ($tipo_campo[$i]=="10")
				{
						echo 'if (form.'.$campo_validacion[$i].'_hora.value == "0")';
						echo '{ ';
							echo 'alert("Seleccione la hora");'; 
							echo 'form.'.$campo_validacion[$i].'_hora.focus();'; 
							echo 'return;';
						echo '}';
				}
				if ($tipo_campo[$i]=="10")
				{
						echo 'if (form.'.$campo_validacion[$i].'_minutos.value == "0.5")';
						echo '{ ';
							echo 'alert("Seleccione los minutos");'; 
							echo 'form.'.$campo_validacion[$i].'_minutos.focus();'; 
							echo 'return;';
						echo '}';
				}	
			$i++;
			}
				echo 'if (form.codigo_motivo.value == "0")';
						echo '{ ';
							echo 'alert("Seleccione el motivo de la visita, en la pesta�a SEGUIMIENTO");'; 
							echo 'form.codigo_motivo.focus();'; 
							echo 'return;';
						echo '}';
				echo 'if (form.especifique_motivo.value == "")';
						echo '{ ';
							echo 'alert("Describa en forma concisa y breve el motivo de la visita");'; 
							echo 'form.especifique_motivo.focus();'; 
							echo 'return;';
						echo '}';		
				echo 'if (confirm("�Esta acción guarda y finaliza el ingreso de datos para esta visita, desea continuar?")) form.submit();';			
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
<script type="text/javascript">
function valor(objeto)
{
	try {
		if ((objeto.value+0) == 0)
			return false;
		else
			return true;
	} catch(e) 
	{
		return false;
	}
}
function validar_subformularios(form)
{	
		if (contLin4>1)
		{
			var i = 1;			
			while (i<contLin4) 
			{ 	
						setValue = 0;
						if (valor(form['bien['+i+'][1]'])) setValue = 1; 	 	
							if (setValue == 0) {
								alert('Dar clic en el cuadro de texto para seleccionar el empleado a quien visitan'); 
							//	form['bien['+i+'][0]'].focus();
								return;
						}						
						i++;			
			}
		}	
		else
		{
			alert('Por favor seleccione a que empleado visitan'); 
			return;
		}
	if (confirm('�Esta acción guarda y finaliza el ingreso de datos para esta visita, desea continuar?')) form.submit();
}
</script>
</html>