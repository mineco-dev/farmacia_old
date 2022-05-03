<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>



<style type="text/css">
<!--
body {
	background-image: url(images/FONDO.png);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
.style9 {font-size: 10px}
.style10 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
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
.style13 {font-size: 12px}
.style18 {
	font-family: "Courier New", Courier, monospace;
	font-size: 11px;
}
.style23 {
	color: #FFFFFF;
	font-size: 14px;
}
.style24 {color: #669999}
.style29 {color: #999999}
.style30 {color: #FFFFFF}
</style>


<body onload="MM_CheckFlashVersion('7,0,19,0','Content on this page requires a newer version of Macromedia Flash Player. Do you want to download it now?');">
<table width="56%" align="left" background="images/fondo1.png">
  <tr>
    <td width="51%" height="15" bgcolor="#4682B4"><span class="style30">SISTEMA DE GESTION DE LA CALIDAD DIACO </span></td>
  </tr>
  
  <tr>
    <td height="354"><h1 align="right" class="style2"><span class="style9 style18">Ciudad de Guatemala,
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
        <h1 align="center" class="style2">
          <script language="JavaScript" src="ts_files/scroll.js" type="text/javascript"></script>
          <script language="JavaScript" type="text/javascript">Tscroll_init (0)</script>
      </h1>
      <hr />
        <table width="99%" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <tr>
            <td width="6%" bgcolor="#C0C0C0">&nbsp;</td>
            <td width="49%" bgcolor="#4682B4"><div align="center"><span class="style23">Documentos de Interes </span></div></td>
            <td width="45%" rowspan="8" bgcolor="#FFFFFF"><table width="12%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#92BDDA" id="table3">
              <tbody>
                <tr>
                  <td height="22" bgcolor="#0262AC"><p style="margin-top: 0; margin-bottom: 0"> <font 
                    class="boxtitle" face="Verdana" size="2" color="#FFFFFF">Bienvenido </font> <span class="style29">Ariane System</span> </p></td>
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
            <td width="45%" rowspan="8" bgcolor="#FFFFFF"><!-- FreeStyle Menu v1.0RC by Angus Turnbull http://www.twinhelix.com -->
              <script type="text/javascript" src="fsmenu.js"></script>
              <!-- Demo CSS layouts for the list menu. Pick your favourite one and customise! -->
              <!-- Remove all but one and change "alternate stylesheet" to "stylesheet" to enable -->
              <link rel="stylesheet" type="text/css" id="listmenu-o"
  href="listmenu_o.css" title="Vertical 'Office'" />
              <link rel="alternate stylesheet" type="text/css" id="listmenu-v"
  href="listmenu_v.css" title="Vertical 'Earth'" />
              <link rel="alternate stylesheet" type="text/css" id="listmenu-h"
  href="listmenu_h.css" title="Horizontal 'Earth'" />
              <!-- Fallback CSS menu file allows list menu operation when JS is disabled. -->
              <!-- This is automatically disabled via its ID when the script kicks in. -->
              <link rel="stylesheet" type="text/css" id="fsmenu-fallback"
  href="listmenu_fallback.css" />
              <!-- Alternatively, this CSS file is for the second div-based demo menu. -->
              <link rel="stylesheet" type="text/css" href="divmenu.css" />
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
 <li><a href="manuales.php" target="mainFrame"><span class="Estilo1">Manuales </span></a></li>
 <li><a href="procesos.php" target="mainFrame"><span class="Estilo1">Procesos</span></a></li>
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
              <!-- ***** END OF EXAMPLE 1: LIST MENU ***** -->&nbsp;</td>
          </tr>
          <tr>
            <td height="17"><img src="images/bulletblue.gif" alt="b2" width="12" height="12" /></td>
            <td><span class="style33"><a href="files/Seguridad Internet.pdf" target="_blank">SEGURIDAD INTERNET</a> <img src="images/nuevo.gif" alt="Seguridad" width="32" height="9" /></span></td>
          </tr>
          <tr>
            <td><img src="images/bulletblue.gif" alt="b5" width="12" height="12" /></td>
            <td><span class="style33"><a href="documentos/posturascorrectas.pdf" target="_blank" class="style24">Seguridad Industrial (Posturas Correctas)</a>  </span></td>
          </tr>
          <tr>
            <td><img src="images/bulletblue.gif" alt="b5" width="12" height="12" /></td>
            <td><a href="documentos/publicidadenganosa.pps" target="_blank" class="style33">Publicidad Enga&ntilde;osa Lic. Corvalan (Sernac )</a> </td>
          </tr>
          <tr>
            <td width="6%" bgcolor="#C0C0C0">&nbsp;</td>
            <td width="49%" bgcolor="#4682B4"><div align="center" class="style31">Secci&oacute;n Multimedia </div></td>
          </tr>
          <tr>
            <td><img src="images/bulletblue.gif" alt="b1" width="12" height="12" /></td>
            <td><a href="multimedia/gunho.php" target="_blank" class="style33">Video de GunHo </a></td>
          </tr>
          <tr>
            <td><img src="images/bulletblue.gif" alt="b4" width="12" height="12" /></td>
            <td><a href="multimedia/institucional1.php" target="_blank" class="style33">Video Institucional </a></td>
          </tr>
          <tr>
            <td><img src="images/bulletblue.gif" alt="b8" width="12" height="12" /></td>
            <td><a href="multimedia/derechosc.php" target="_blank" class="style33">Video Derechos del Consumidor </a></td>
          </tr>
          
          
          <tr>
            <td height="222" colspan="4" bgcolor="#FFFFFF">
			      <form action="<?=$_SERVER['PHP_SELF'];?>">
        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table1">
          <TBODY>
            <TR>
              <TD background="../images/fondo5.jpg">&nbsp;</TD>
            </TR>
          </TBODY>
        </TABLE>
        <table width="89%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
          <tr>
            <td width="667" height="116" colspan="3"><div align="center">
                <span class="style9"><span class="style10"><span class="style8"><span class="style6">
                <?
				
				  
				   if (!($link=mysql_connect("localhost","",""))) 
				   { 
					  echo "Error conectando a la base de datos."; 
					  exit(); 
				   } 
				   if (!mysql_select_db("documentos",$link)) 
				   { 
					  echo "Error seleccionando la base de datos."; 
					  exit(); 
				   } 

					
				  
				  ?>
                </span></span></span></span>
                <table width="93%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#333333">
                  <tr>
                    <td width="58%" bgcolor="#FFFFCC"><div align="left" class="style9"><span class="style10">
                      <INPUT NAME="termino" TYPE="text" SIZE="30" MAXLENGTH="30">
&nbsp;
<input name="btnInsertar"type="submit"id="btnInsertar" value="Buscar">
                    </span></div></td>
                    <td width="10%"><span class="style10">Paginas:</span></td>
                    <td width="32%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <?
                        
						/* contador de paginas */

						/*require ('conexion.inc');
						$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						mysql_select_db($BASE_DATOS,$db);*/
						$SQL = mysql_query("select count(documents.id) from documents",$link);
						
						//$result = mysql_query($SQL);
						$row = mysql_fetch_row($SQL);
						
						$paginas = round($row[0]/20);
						for($p=0;$p<=$paginas;$p++)
						{
							echo "<a href='left.php?conta=$p' ><td onmouseover=cOn(this); onmouseout=cOut(this);> $p </td> </a>";
						}                   
			/********** fin de contador de paginas ************/	
//			           mysql_close($db);
						?>
                        </tr>
                    </table></td>
                  </tr>
                </table>
              <div align="center">
                  <table cellspacing=10 cellpadding=0 
                        border=0 id="table27" width="551">
                    <tbody>
                      <tr>
                        <td width="100" bgcolor="#000000" align="center" bordercolor="#0000FF"><span class="style10" lang="es-gt"><font color="#FFFFFF">Fecha/Hora </font></span></td>
                        <td width="340" bgcolor="#000000" align="center" bordercolor="#0000FF"><span class="style10" lang="es-gt"><font color="#FFFFFF">Documento</font></span></td>
                        <td width="71" bgcolor="#000000" align="center" bordercolor="#0000FF"><font color="#FFFFFF">Tipo </font></td>
                      </tr>
                      <?

if (!empty($termino))
{




			$result = mysql_query("select s.id,concat(dayofmonth(s.fechahora),'/',month(s.fechahora),'/',year(s.fechahora),' ',hour(s.fechahora),':',minute(s.fechahora),':',second(s.fechahora)),s.enlace,s.archivo from documents s where s.archivo like '%$termino%'",$link);
			
			
			
/*			$result = mysql_query("select s.caso,concat(dayofmonth(a.fecha_i),'/',month(a.fecha_i),'/',year(a.fecha_i),' ',hour(a.fecha_i),':',minute(a.fecha_i),':',second(a.fecha_i)),e.descripcion,s.reporte,s.id_status  from solicitud s, asignar a, status e WHERE s.caso = a.caso AND s.id_status = e.id_status and a.id_usuarios = ".$_SESSION['usuario_id']  ,$link);*/
			
			//$result = mysql_query($SQL);
			if ($result ) // verifica si la base de datos dejo hacer la insercion
			{
				/* Insercion con exito*/	
				
			$val23=0; // este es un contador del vector para crear las paginas	
				while($row = mysql_fetch_row($result))
				{
				
				if (($val23>=$conta*20) && ($val23<$conta*20+20))
				{	
				
				
                        //print"<tr>";
						  print"<tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
                          print"<TD width='100'><span class='style9'><font color='#335B96'>$row[1]</font></span></TD>";
						  print"<TD width='340'><div align='left'><span class='Estilo1'><a href='http://localhost/sic/".$row[2]."' target='mainFrame'>$row[3]</a></span></div></TD>";
						  print"<TD width='71'><div align='left'><span class='Estilo1'><a href='http://localhost/sic/".$row[2]."' target='mainFrame'><img src='images/pdf.gif' width='20' height='22' border='0'></a></span></div></TD>";						  
                          /*print"<TD width='200'><span class='style9'>$row[3]</span></TD>";
						  
						if ($tecnic == "Pendiente")
						{
						 print"<TD width='48'><div align='left'><span class='Estilo1'><a href='actualiza.php?codigo=".$row[2]."'><img src='images/abcmodifica.gif' width='20' height='22' border='0'></a></span></div></TD>";
						 }
						  
//						  print"<TD width='154'>$row[4]</TD>";
                        // print "<TD width='139'><div align='center'><span class='Estilo1'><a href='detalle_expediente.php?exp=". $row[0] ."'><img src='../images/abcmodifica.gif' width='20' height='22' border='0'></a><a href='vercronologia.php?exp=". $row[0] ."'><img src='../images/abcbusca.gif' width='20' height='22' border='0'></a><a href='finalizaexpediente.php?exp=". $row[0] ."'><img src='../IMAGES/finqueja.gif' width='22' height='22' border='0'></a><a href='transferirexpediente.php?exp=". $row[0] ."'><img src='../IMAGES/transConcilia.gif' width='22' height='22' border='0'></a><a href='devolver.php?exp=". $row[0] ."'><img src='../IMAGES/queja23.gif' width='22' height='22' border='0'></span></div></TD>";*/
				                        print"</tr>";		 
				
			
				}		
				} // cierra el if y while que coordina la impresion de una sola pagina
					$val23++;
				
			}// result
						
			}else{
			
// busqueda por numero de codigo			
		/*	
				$result = mysql_query("select s.codigo,concat(dayofmonth(s.fechahora),'/',month(s.fechahora),'/',year(s.fechahora),' ',hour(s.fechahora),':',minute(s.fechahora),':',second(s.fechahora)),s.id_documentos,s.viene,s.firma from documentos s where s.codigo = '$termino' order by s.id_documentos desc",$link);
			
			
			
/*			$result = mysql_query("select s.caso,concat(dayofmonth(a.fecha_i),'/',month(a.fecha_i),'/',year(a.fecha_i),' ',hour(a.fecha_i),':',minute(a.fecha_i),':',second(a.fecha_i)),e.descripcion,s.reporte,s.id_status  from solicitud s, asignar a, status e WHERE s.caso = a.caso AND s.id_status = e.id_status and a.id_usuarios = ".$_SESSION['usuario_id']  ,$link);
			
			//$result = mysql_query($SQL);
			if ($result ) // verifica si la base de datos dejo hacer la insercion
			{
				/* Insercion con exito
				
			$val23=0; // este es un contador del vector para crear las paginas	
				while($row = mysql_fetch_row($result))
				{
				
				if (($val23>=$conta*20) && ($val23<$conta*20+20))
				{	
				
				if (empty($row[4]))
				{
					$tecnic = "Pendiente";
				}else{
					$tecnic = "Entregado";
				}	
                        //print"<tr>";
						  print"<tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
                          print"<TD width='84'><span class='style9'><font color='#335B96'>$row[0]</font></span></TD>";
						  print"<TD width='113'><span class='style9'>$row[1]</span></TD>";
                          print"<TD width='135'><span class='style9'>$tecnic</span></TD>";
                          print"<TD width='200'><span class='style9'>$row[3]</span></TD>";
						  if ($tecnic == "Pendiente")
						{
						 print"<TD width='48'><div align='left'><span class='Estilo1'><a href='actualiza.php?codigo=".$row[2]."'><img src='images/abcmodifica.gif' width='20' height='22' border='0'></a></span></div></TD>";
						 } 
//						  print"<TD width='154'>$row[4]</TD>";
                        // print "<TD width='139'><div align='center'><span class='Estilo1'><a href='detalle_expediente.php?exp=". $row[0] ."'><img src='../images/abcmodifica.gif' width='20' height='22' border='0'></a><a href='vercronologia.php?exp=". $row[0] ."'><img src='../images/abcbusca.gif' width='20' height='22' border='0'></a><a href='finalizaexpediente.php?exp=". $row[0] ."'><img src='../IMAGES/finqueja.gif' width='22' height='22' border='0'></a><a href='transferirexpediente.php?exp=". $row[0] ."'><img src='../IMAGES/transConcilia.gif' width='22' height='22' border='0'></a><a href='devolver.php?exp=". $row[0] ."'><img src='../IMAGES/queja23.gif' width='22' height='22' border='0'></span></div></TD>";
				                        print"</tr>";		
			
			
			}
			}
			}
			}*/
			}//fin del else
		mysql_close($link);		

?>
                    </tbody>
                  </table>
              </div>
              <p>&nbsp;</p>
            </div></td>
          </tr>
        </table>
        <p>&nbsp;</p>
  
        <p align="center" style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
      </form>
			
			�</td>
          </tr>
        </table>
      <hr /></td>
  </tr>
</table>
</body>
</html>
