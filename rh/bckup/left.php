<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>



<style type="text/css">
<!--
body {
	background-image: url(imagen/fondoizq.png);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
.style9 {font-size: 10px}
-->
</style>

<SCRIPT language=javascript>
function cOn(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#F2DD9E";
}
}

function cOut(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#FFFFFF";
}
}

//-->
</SCRIPT>


<script type="text/javascript">
function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
</script>
</head>

<style>
	a, A:link, a:visited, a:active
		{color: #0000aa; text-decoration: none; font-family: Tahoma, Verdana; font-size: 11px}
	A:hover
		{color: #ff0000; text-decoration: none; font-family: Tahoma, Verdana; font-size: 11px}
	p, tr, td, ul, li
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px}
	form
		{margin: 5px;}
	.header1, h1
		{color: #ffffff; background: #4682B4; font-weight: bold; font-family: Tahoma, Verdana; font-size: 13px; margin: 0px; padding: 2px;}
	.header2, h2
		{color: #000000; background: #DBEAF5; font-weight: bold; font-family: Tahoma, Verdana; font-size: 12px;}
	.intd
		{color: #000000; font-family: Tahoma, Verdana; font-size: 11px; padding-left: 15px;}
	form
		{ margin: 5px;}
.style18 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style29 {color: #999999}
.style30 {
	color: #FFFFFF;
	font-size: 10px;
}
</style>


<body onload="MM_CheckFlashVersion('7,0,19,0','Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?');">
<table width="25%" align="left" background="images/fondo1.png">
  <tr>
    <td width="51%" height="15" bgcolor="#000000"><span class="style30">REGISTRO DE GARANTIAS MOBILIARIAS MINISTERIO DE ECONOMIA </span></td>
  </tr>
  
  <tr>
    <td height="354"><h1 align="left" class="style2"><span class="style9 style18">Ciudad de Guatemala,
      <? 
		$fecha[0] = "Enero";	
		$fecha[1] = "Febrero";	
		$fecha[2] = "Marzo";	
		$fecha[3] = "Abril";	
		$fecha[4] = "Mayo";	
		$fecha[5] = "Junio";	
		$fecha[6] = "Julio";	
		$fecha[7] = "Agosto";	
		$fecha[8] = "Septiembre";	
		$fecha[9] = "Octubre";	
		$fecha[10] = "Noviembre";	
		$fecha[11] = "Diciembre";	
		
		
								$m = 0;
					   			for ($x=0; $x<=11; $x++)
								{
									$m++;
									if ($m == date('n'))
									{
										$mes = $fecha[$x];
									}
								}					   	
    $dia = date('d');
	$anio = date('Y');
	
	print $dia.' de '.$mes.' del '.$anio;?>
      &nbsp;</span></h1>
       
      <hr />
        <table width="100%" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr>
            <td width="45%" height="17" bgcolor="#FFFFFF"><!-- FreeStyle Menu v1.0RC by Angus Turnbull http://www.twinhelix.com -->
             <script type="text/javascript" src="fsmenu.js"></script>
              <!-- Demo CSS layouts for the list menu. Pick your favourite one and customise! -->
              <!-- Remove all but one and change "alternate stylesheet" to "stylesheet" to enable -->
              <link rel="stylesheet" type="text/css" id="listmenu-o"
  href="menu/listmenu_o.css" title="Vertical 'Office'" />
              <link rel="alternate stylesheet" type="text/css" id="listmenu-v"
  href="menu/listmenu_v.css" title="Vertical 'Earth'" />
              <link rel="alternate stylesheet" type="text/css" id="listmenu-h"
  href="menu/listmenu_h.css" title="Horizontal 'Earth'" />
              <!-- Fallback CSS menu file allows list menu operation when JS is disabled. -->
              <!-- This is automatically disabled via its ID when the script kicks in. -->
              <link rel="stylesheet" type="text/css" id="fsmenu-fallback"
  href="menu/listmenu_fallback.css" />
              <!-- Alternatively, this CSS file is for the second div-based demo menu. -->
              <link rel="stylesheet" type="text/css" href="menu/divmenu.css" />
              </head>
              <!-- <body style=" font-family: Verdana,Arial	font-size: 10px background-color: #FFF"> >






<!--

***** EXAMPLE 1: LIST MENU (v5+ browsers only) *****

You just need a series of <ul> lists, one nested inside another, with <a> tags in each item,
and <ul> tags after <a> tags to trigger another level of submenus.
The script will then automatically manage them as a multilevel popup menu.
Paste your data into here to get started, and be careful to close all your </li> tags!

-->


<ul class="menulist" id="listMenuRoot">
 <li><a href="solicitud.php" target="mainFrame"><span class="Estilo1">Solicitud de Inscripcion</span></a></li>
 <li><a href="arancel/calcular.php" target="mainFrame"><span class="Estilo1">Calcular Arancel</span></a></li>
 <li>
  <a href="#"><span class="Estilo1">Procedimientos de Direccion</span></a>
  <ul>
   <li><a href="acciones.php" target="mainFrame"><span class="Estilo1">Accion Preventiva Correctiva y Correccion</span></a></li>
   <li><a href="auditoria.php" target="mainFrame"><span class="Estilo1">Auditoria Interna</span></a></li>
   <li><a href="comunicacionint.php" target="mainFrame"><span class="Estilo1">Comunicacion Interna</span></a></li>
   <li><a href="controldoctos.php" target="mainFrame"><span class="Estilo1">Control de Documentos</span></a></li>
   <li><a href="controlreg.php" target="mainFrame"><span class="Estilo1">Control de Registros</span></a></li>
   <li><a href="controlserv.php" target="mainFrame"><span class="Estilo1">Control de Servicio no Conforme</span></a></li>
   <li><a href="integralidad.php" target="mainFrame"><span class="Estilo1">Integralidad del SGC en Planes de Contingencia</span></a></li>
   <li><a href="revision.php" target="mainFrame"><span class="Estilo1">Revision por la Direccion</span></a></li>
  </ul>
 </li>
 <li>
  <a href="#"><span class="Estilo1">Procedimientos de Apoyo</span></a>
  <ul>
   <li><a href="capacitacion.php" target="mainFrame"><span class="Estilo1">Capacitacion</span></a></li>
   <li><a href="evaluacion.php" target="mainFrame"><span class="Estilo1">Evaluacion del Desempe�o</span></a></li>
   <li><a href="inventariorh.php" target="mainFrame"><span class="Estilo1">Inventario de Recursos Humanos</span></a></li>
  </ul>
 </li>
   <li>
    <a href="#"><span class="Estilo1">Procedimientos Operativos</span></a>
    <ul>
     <li><a href="administrativo.php" target="mainFrame"><span class="Estilo1">Administrativo Sancionatorio</span></a></li>
     <li><a href="archivoq.php" target="mainFrame"><span class="Estilo1">Archivo Expedientes de Queja</span></a></li>
	 <li><a href="atencionq.php" target="mainFrame"><span class="Estilo1">Atencion y Resolucion de la Queja</span></a></li>
	 <li><a href="comunicacionc.php" target="mainFrame"><span class="Estilo1">Comunicacion Permanente con el Consumidor</span></a></li>
	 <li><a href="retroalimentacion.php" target="mainFrame"><span class="Estilo1">Retroalimentacion de los Consumidores</span></a></li>
	 <li><a href="verificacion.php" target="mainFrame"><span class="Estilo1">Verificacion de la Queja</span></a></li>
    </ul>
   </li>
   <li>
   <a href="#"><span class="Estilo1">Informatica</span></a>   </li>
</ul>



          <script type="text/javascript">
//<![CDATA[

// For each menu you create, you must create a matching "FSMenu" JavaScript object to represent
// it and manage its behaviour. You don't have to edit this script at all if you don't want to;
// these comments are just here for completeness. Also, feel free to paste this script into the
// external .JS file to make including it in your pages easier!

// Here's a menu object to control the above list of menu data:
var listMenu = new FSMenu('listMenu', true, 'display', 'block', 'none');

// The parameters of the FSMenu object are:
//  1) Its own name in quotes.
//  2) Whether this is a nested list menu or not (in this case, true means yes).
//  3) The CSS property name to change when menus are shown and hidden.
//  4) The visible value of that CSS property.
//  5) The hidden value of that CSS property.
//
// Next, here's some optional settings for delays and highlighting:
//  * showDelay is the time (in milliseconds) to display a new child menu.
//    Remember that 1000 milliseconds = 1 second.
//  * switchDelay is the time to switch from one child menu to another child menu.
//    Set this higher and point at 2 neighbouring items to see what it does.
//  * hideDelay is the time it takes for a menu to hide after mouseout.
//    Set this to a negative number to disable hiding entirely.
//  * cssLitClass is the CSS classname applied to parent items of active menus.
//  * showOnClick will, suprisingly, set the menus to show on click. Pick one of 3 values:
//    0 = all mouseover, 1 = first level click, sublevels mouseover, 2 = all click.
//  * hideOnClick hides all visible menus when one is clicked (defaults to true).
//  * animInSpeed and animOutSpeed set the animation speed. Set to a number
//    between 0 and 1 where higher = faster. Setting both to 1 disables animation.

//listMenu.showDelay = 0;
//listMenu.switchDelay = 125;
//listMenu.hideDelay = 500;
//listMenu.cssLitClass = 'highlighted';
//listMenu.showOnClick = 0;
//listMenu.hideOnClick = true;
//listMenu.animInSpeed = 0.2;
//listMenu.animOutSpeed = 0.2;


// Now the fun part... animation! This script supports animation plugins you
// can add to each menu object you create. I have provided 3 to get you started.
// To enable animation, add one or more functions to the menuObject.animations
// array; available animations are:
//  * FSMenu.animSwipeDown is a "swipe" animation that sweeps the menu down.
//  * FSMenu.animFade is an alpha fading animation using tranparency.
//  * FSMenu.animClipDown is a "blind" animation similar to 'Swipe'.
// They are listed inside the "fsmenu.js" file for you to modify and extend :).

// I'm applying two at once to listMenu. Delete this to disable!
listMenu.animations[listMenu.animations.length] = FSMenu.animFade;
listMenu.animations[listMenu.animations.length] = FSMenu.animSwipeDown;
//listMenu.animations[listMenu.animations.length] = FSMenu.animClipDown;


// Finally, on page load you have to activate the menu by calling its 'activateMenu()' method.
// I've provided an "addEvent" method that lets you easily run page events across browsers.
// You pass the activateMenu() function two parameters:
//  (1) The ID of the outermost <ul> list tag containing your menu data.
//  (2) A node containing your submenu popout arrow indicator.
// If none of that made sense, just cut and paste this next bit for each menu you create.

var arrow = null;
if (document.createElement && document.documentElement)
{
 arrow = document.createElement('span');
 arrow.appendChild(document.createTextNode('>'));
 // Feel free to replace the above two lines with these for a small arrow image...
 //arrow = document.createElement('img');
 //arrow.src = 'arrow.gif';
 //arrow.style.borderWidth = '0';
 arrow.className = 'subind';
}
addEvent(window, 'load', new Function('listMenu.activateMenu("listMenuRoot", arrow)'));


// You may wish to leave your menu as a visible list initially, then apply its style
// dynamically on activation for better accessibility. Screenreaders and older browsers will
// then see all your menu data, but there will be a 'flicker' of the raw list before the
// page has completely loaded. If you want to do this, remove the CLASS="..." attribute from
// the above outermost UL tag, and uncomment this line:
//addEvent(window, 'load', new Function('getRef("listMenuRoot").className="menulist"'));


// To create more menus, duplicate this section and make sure you rename your
// menu object to something different; also, activate another <ul> list with a
// different ID, of course :). You can hae as many menus as you want on a page.

//]]>
  </script>
              <!-- ***** END OF EXAMPLE 1: LIST MENU ***** -->&nbsp;
              <table width="12%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#92BDDA" id="table3">
                <tbody>
                  <tr>
                    <td height="22" bgcolor="#0262AC"><p style="margin-top: 0; margin-bottom: 0"> <font 
                    class="boxtitle" face="Verdana" size="2" color="#FFFFFF">Bienvenido </font> <span class="style29">Accesl System </span></p></td>
                  </tr>
                  <tr>
                    <td height="136" bgcolor="#FFFFFF"><form action="./informatica/acceso.php" method="post" target="_parent">
                        <center>
                          <p align="left" style="margin-top: 0; margin-bottom: 0"><strong><font size="2" face="Verdana">Login </font> </strong> </p>
                          <table width="141" border="0">
                            <tr>
                              <td width="135"><div align="left"><span class="Estilo1">Usuario</span></div></td>
                            </tr>
                            <tr>
                              <td><input name = "login2" type = "text" /></td>
                            </tr>
                            <tr>
                              <td><div align="left"><span class="Estilo1">Password</span></div></td>
                            </tr>
                            <tr>
                              <td><input name="pass2" type="password" value="" /></td>
                            </tr>
                            <tr>
                              <td><input name="submit" type="submit" value="Ingresar" /></td>
                            </tr>
                            <tr>
                              <td><hr /></td>
                            </tr>
                          </table>
                        </center>
                    </form></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>

          
          <tr>
            <td height="222" bgcolor="#FFFFFF">
	        �</td>
          </tr>
      </table>
      <hr /></td>
  </tr>
</table>
</body>
</html>
