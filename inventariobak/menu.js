// JavaScript Document
<html>
<head>

<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

<script type="text/javascript">
<!--

/*
copyright � maximus 1999-2000, all rights reserved.
site: http://www.absolutegb.com/maximus
e-mail: maximus@nsimail.com
*/

ie=document.all;
ns=document.layers;

/*
configure menu styles below
note: to edit the link colors, go to the style tags and edit the ssm2items colors
*/
hdrfontfamily="verdana";
hdrfontsize="2";
hdrfontcolor="white";
hdrbgcolor="#666666";
linkfontfamily="verdana";
linkfontsize="1";
linkbgcolor="white";
linkoverbgcolor="#cccccc";
linktarget="_top";
yoffset=20;
staticyoffset=20;
menubgcolor="black";
menuisstatic="yes";
menuheader="gamarod.com.ar"
menuwidth=150; // must be a multiple of 5!
staticmode="advanced"
barbgcolor="#333333";
barfontfamily="verdana";
barfontsize="2";
barfontcolor="white";
bartext="gamarod javascript";

function moveout() {
if (window.cancel) {cancel="";}
if (window.moving2) {cleartimeout(moving2); moving2="";}
if ((ie && ssm2.style.pixelleft<0)||(ns && document.ssm2.left<0)) {
if (ie) {ssm2.style.pixelleft += (5%menuwidth);}
if (ns) {document.ssm2.left += (5%menuwidth);}
moving1 = settimeout('moveout()', 5)}
else {cleartimeout(moving1)}};
function moveback() {
cancel = moveback1()}
function moveback1() {
if (window.moving1) {cleartimeout(moving1)}
if ((ie && ssm2.style.pixelleft>(-menuwidth))||(ns && document.ssm2.left>(-140))) {
if (ie) {ssm2.style.pixelleft -= (5%menuwidth);}
if (ns) {document.ssm2.left -= (5%menuwidth);}
moving2 = settimeout('moveback1()', 5)}
else {cleartimeout(moving2)}};

lasty = 0;
function makestatic(mode) {
if (ie) {winy = document.body.scrolltop;var nm=ssm2.style}
if (ns) {winy = window.pageyoffset;var nm=document.ssm2}
if (mode=="smooth") {
if ((ie||ns) && winy!=lasty) {
smooth = .2 * (winy - lasty);
if(smooth > 0) smooth = math.ceil(smooth);
else smooth = math.floor(smooth);
if (ie) nm.pixeltop+=smooth;
if (ns) nm.top+=smooth;
lasty = lasty+smooth;}
settimeout('makestatic("smooth")', 1)}
else if (mode=="advanced") {
if ((ie||ns) && winy>yoffset-staticyoffset) {
if (ie) {nm.pixeltop=winy+staticyoffset}
if (ns) {nm.top=winy+staticyoffset}}
else {
if (ie) {nm.pixeltop=yoffset}
if (ns) {nm.top=yoffset-7}}
settimeout('makestatic("advanced")', 1)}}

function init() {
if (ie) {
ssm2.style.pixelleft = -menuwidth;
ssm2.style.visibility = "visible"}
else if (ns) {
document.ssm2.left = -menuwidth;
document.ssm2.visibility = "show"}
else {alert('choose either the "smooth" or "advanced" static modes!')}}

//-->
</script>
<style>
a.ssm2items:link {color:black;text-decoration:none;}
a.ssm2items:hover {color:black;text-decoration:none;}
a.ssm2items:active {color:black;text-decoration:none;}
a.ssm2items:visited {color:black;text-decoration:none;}
</style>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="init()">
<script language="javascript1.2">
if (ie) {document.write('<div id="ssm2" style="visibility:hidden;position : absolute ;left : 0px ;top : '+yoffset+'px ;z-index : 20;width:1px" onmouseover="moveout()" onmouseout="moveback()">')}
if (ns) {document.write('<layer visibility="hide" top="'+yoffset+'" name="ssm2" bgcolor="'+menubgcolor+'" left="0" onmouseover="moveout()" onmouseout="moveback()">')}
tempbar=""
for (i=0;i<bartext.length;i++) {
tempbar+=bartext.substring(i, i+1)+"<br>"}
document.write('<table border="0" cellpadding="0" cellspacing="1" width="'+(menuwidth+16+2)+'" bgcolor="'+menubgcolor+'"><tr><td bgcolor="'+hdrbgcolor+'" width="'+menuwidth+'"> <font face="'+hdrfontfamily+'" size="'+hdrfontsize+'" color="'+hdrfontcolor+'"><b>'+menuheader+'</b></font></td><td align="center" rowspan="100" width="16" bgcolor="'+barbgcolor+'"><p align="center"><font face="'+barfontfamily+'" size="'+barfontsize+'" color="'+barfontcolor+'"><b>'+tempbar+'</b></font></p></td></tr>')
function additem(text, link, target) {
if (!target) {target=linktarget}
document.write('<tr><td bgcolor="'+linkbgcolor+'" onmouseover="bgcolor=\''+linkoverbgcolor+'\'" onmouseout="bgcolor=\''+linkbgcolor+'\'"><ilayer><layer onmouseover="bgcolor=\''+linkoverbgcolor+'\'" onmouseout="bgcolor=\''+linkbgcolor+'\'" width="100%"><font face="'+linkfontfamily+'" size="'+linkfontsize+'"> <a href="'+link+'" target="'+target+'" class="ssm2items">'+text+'</layer></ilayer></td></tr>')}
function addhdr(text) {
document.write('<tr><td bgcolor="'+hdrbgcolor+'" width="140"> <font face="'+hdrfontfamily+'" size="'+hdrfontsize+'" color="'+hdrfontcolor+'"><b>'+text+'</b></font></td></tr>')}

//only edit the script between here

additem('buscador de rutinas', 'buscar.htm', '');
additem('foros de discusi�n', '/foros/', '');
additem('lista de correo', '/lista.htm', '');
additem('comentarios', '/comentarios.htm', '');
additem('contribuci�n', '/contribuir.htm', '');
additem('firmar el libro', '/firmar.htm', '');
additem('enlaces', '/enlaces.htm', '');
additem('agregar url', 'agregar.htm', '');
addhdr('todos los script');
additem('alertas', 'alertas.htm', '');
additem('banner', 'banner.htm', '');
additem('cookies', 'cookies.htm', '');
additem('dhtml', 'dhtml.htm', '');
additem('enlaces', 'enlaces.htm', '');
additem('fecha', 'fecha.htm', '');
additem('imagen', 'imagen.htm', '');
additem('juegos', 'juegos.htm', '');
additem('midis', 'midis.htm', '');
additem('otras', 'otras.htm', '');
additem('prompt', 'prompt.htm', '');
additem('reloj', 'reloj.htm', '');
additem('seguridad', 'seguridad.htm', '');
additem('texto', 'texto.htm', '');
additem('ventana', 'ventana.htm', '');

// and here! no more!

document.write('<tr><td bgcolor="'+hdrbgcolor+'"><font size="0" face="arial"> </font></td></tr></table>')
if (ie) {document.write('</div>')}
if (ns) {document.write('</layer>')}
if ((ie||ns) && (menuisstatic=="yes"&&staticmode)) {makestatic(staticmode);}
</script>


<br><br><br>

</body>
</html> 

