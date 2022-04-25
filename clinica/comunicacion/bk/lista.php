<?	
	session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
	if (!isset($_SESSION["departament_id"])) $dependencia=33;
	else $dependencia=($_SESSION["departament_id"]);	
?>
<?	
	
	if (isset($txt_buscar)) 
	{	
		if ($txt_buscar!="")
		{
			$consulta = "SELECT titulo, descripcion, fecha,link1, link2 FROM comsocial_notas
							WHERE titulo like'%$tx_busca%' ";
		}
		else
		{
			$consulta = "SELECT titulo, descripcion, fecha,link1, link2 FROM comsocial_notas
							WHERE titulo like'%$tx_busca%' ";	
		}	
	}
	else
	{
		$consulta = "SELECT titulo, descripcion, fecha,link1, link2 FROM comsocial_notas
						WHERE titulo like'%$tx_busca%' ";	
	}
?>
<html>
<head>
<STYLE TYPE="text/css">
<!--
a:link {text-decoration: none}
a:visited {text-decoration: none}
a:active {text-decoration: none}
a:hover {text-decoration: none}
-->
.menutitle{
	cursor:pointer;	
	text-decoration:none;	
	color : #006699;		
}

.submenu{	
	margin-top : 2px;
	padding-bottom : 1px;
	margin-bottom : 1px;
	margin-left : 22px;
	font-size : 11px;
	font-family : Tahoma,Verdana,Arial;
	text-align:left;
	text-decoration:none;		
}
</STYLE>
<script type="text/javascript">
/***********************************************
* Switch Menu script- by Martial B of http://getElementById.com/
* Modified by Dynamic Drive for format & NS4/IE4 compatibility
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/
var persistmenu="yes" //"yes" or "no". Make sure each SPAN content contains an incrementing ID starting at 1 (id="sub1", id="sub2", etc)
var persisttype="sitewide" //enter "sitewide" for menu to persist across site, "local" for this page only

if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
		if(el.style.display != "block"){ //DynamicDrive.com change
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") //DynamicDrive.com change
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function onloadfunction(){
if (persistmenu=="yes"){
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=get_cookie(cookiename)
if (cookievalue!="")
document.getElementById(cookievalue).style.display="block"
}
}

function savemenustate(){
var inc=1, blockid=""
while (document.getElementById("sub"+inc)){
if (document.getElementById("sub"+inc).style.display=="block"){
blockid="sub"+inc
break
}
inc++
}
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=(persisttype=="sitewide")? blockid+";path=/" : blockid
document.cookie=cookiename+"="+cookievalue
}

if (window.addEventListener)
window.addEventListener("load", onloadfunction, false)
else if (window.attachEvent)
window.attachEvent("onload", onloadfunction)
else if (document.getElementById)
window.onload=onloadfunction

if (persistmenu=="yes" && document.getElementById)
window.onunload=savemenustate
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="">
    <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" id="table17">
        <tr>
          <td width="161" class="tcat"><div align="right"></div></td>
          <td colspan="3" class="tcat"><div align="right">
            <input name="txt_buscar" type="text" id="txt_buscar" size="50">
            <input name="bt_buscar" type="submit" id="bt_buscar6" value="Buscar">
          </div></td>
        </tr>
        <tr>
          <td class="tcat"><div align="center"></div>            
          <div align="center"></div>            <div align="center"><strong></strong></div></td>
          <td colspan="3" class="tcat"><div align="center">Comunicaci&oacute;n Social</div></td>
        </tr>
        <tr align="center" bgcolor="#006699" class="thead">
          <td class="Estilo3 thead"><strong>Agrupada por </strong></td>
		  <td width="112" class="Estilo3 thead"><strong>Inciso</strong></td>
          <td width="587" class="Estilo3 thead"><strong>Descripci&oacute;n</strong></td>
          <td class="thead Estilo3" colspan="2"><strong>AGREGAR</strong></td>
        </tr>
		<?
				conectardb($comunicacion);		
				$result=$query($consulta);				
				$i = 1;		
				echo '<div id="masterdiv">';			
				while($row=$fetch_array($result))
				{
					$sub='sub$i';
					$grupo=$row["codigo_grupo"];
					$inciso=$row["codigo_inciso"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
						echo '<tr class='.$clase.'><td align="center">'.$row["nombre_grupo"].'</td><td align="center">'.$row["codigo_inciso"].'</td><td><div class="menutitle" onclick="SwitchMenu(\'sub'.$i.'\')">'.$row["titulo"].'</div></td><td><center><a href="agregar_link.php?group='.$grupo.'&item='.$inciso.'"><img src="../images/iconos/ico_explorer.gif" alt="Agregar un link a este inciso" border="0"></a></center></td><td><center><a href="agregar_archivo.php?group='.$grupo.'&item='.$inciso.'"><img src="../images/iconos/ico_acrobat.gif" alt="Agregar archivo a este inciso" border="0"></a></center></td></tr>';									
//						echo '<tr class='.$clase.'><td>'.$row["nombre_grupo"].'</td><td>'.$row["titulo"].'</td><td><center><img src="../images/iconos/ico_ver.jpg"></center></td><td><center><a href="editar_publicacion.php?id='.$row["codigo_archivo"].'"><img src="../images/iconos/ico_editar.jpg"></a></center></td><td><center><a href="borrar_publicacion.php?id='.$row["codigo_archivo"].'"><img src="../images/iconos/ico_borrar.jpg"></a></center></td></tr>';																
					echo '<tr><td colspan=3>';							
					echo '<span class="submenu" id="sub'.$i.'">';
					$consulta2= "Select * from uip_contenido where codigo_inciso='$inciso' and codigo_grupo='$grupo' order by codigo_inciso";
					$resulta2=$query($consulta2);							
					echo '<center>';					
					echo '<table border="1" width="100%" cellpadding="0" cellspacing="0">';
					echo '<tr class="titulotabla"><td align="center">Fecha publicado</td><td align="center">Usuario</td><td align="center">Contenido</td><td align="center">Modificar</td><td align="center">Estado</td><td align="center">Borrar</td></tr>';
					while($row4=$fetch_array($resulta2))
					{													
						if ($row4["activo"]==1)
						{
							if ($row4["tipo"]==2)
							echo '<tr><td align="center"><div class="estilo2">'.$row4["fecha_creado"].'</td><td align="center">'.$row4["usuario_creo"].'</td><td><a href="../planeacion/manuales/uipfiles/'.$row4["vinculo"].' "target=_blank"">'.$row4["titulo"].'</a></td><td align="center"><a href="editar_archivo.php?id='.$row4["codigo_contenido"].'"><img src="../images/iconos/ico_editar.gif" border="0" alt="modificar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=2"><img src="../images/iconos/ico_activo.gif" border="0" alt="Desactivar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=3"><img src="../images/iconos/ico_borrar.gif" border="0" alt="Borrar este registro"></a></td></div></tr>';						
							else
								echo '<tr><td align="center"><div class="estilo2">'.$row4["fecha_creado"].'</td><td align="center">'.$row4["usuario_creo"].'</td><td><a href="http://'.$row4["vinculo"].' "target=_blank"">'.$row4["titulo"].'&nbsp;</a></td><td align="center"><a href="editar_link.php?id='.$row4["codigo_contenido"].'"><img src="../images/iconos/ico_editar.gif" border="0" alt="modificar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=2"><img src="../images/iconos/ico_activo.gif" border="0" alt="Desactivar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=3"><img src="../images/iconos/ico_borrar.gif" border="0" alt="Borrar este registro"></a></td></div></tr>';						
						}
						else
						if ($row4["activo"]==2)		
						{
							if ($row4["tipo"]==2)
								echo '<tr><td align="center"><div class="estilo2">'.$row4["fecha_creado"].'</td><td align="center">'.$row4["usuario_creo"].'</td><td><a href="../planeacion/manuales/uipfiles/'.$row4["vinculo"].' "target=_blank"">'.$row4["titulo"].'</a></td><td align="center"><a href="editar_archivo.php?id='.$row4["codigo_contenido"].'"><img src="../images/iconos/ico_editar.gif" border="0" alt="modificar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=1"><img src="../images/iconos/ico_desactivado.gif" border="0" alt="Activar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=3"><img src="../images/iconos/ico_borrar.gif" border="0" alt="modificar este registro"></a></td></div></tr>';						
								else
									echo '<tr><td align="center"><div class="estilo2">'.$row4["fecha_creado"].'</td><td align="center">'.$row4["usuario_creo"].'</td><td><a href="http://'.$row4["vinculo"].' "target=_blank"">'.$row4["titulo"].'&nbsp;</a></td><td align="center"><a href="editar_link.php?id='.$row4["codigo_contenido"].'"><img src="../images/iconos/ico_editar.gif" border="0" alt="modificar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=1"><img src="../images/iconos/ico_desactivado.gif" border="0" alt="Activar este registro"></a></td><td align="center"><a href="cambia_stat.php?id='.$row4["codigo_contenido"].'&stat=3"><img src="../images/iconos/ico_borrar.gif" border="0" alt="modificar este registro"></a></td></div></tr>';						
						}			
						
					}		
					echo '</table>';
					echo '</center>';
					
					echo '</span>';					
					echo '</tr></td>';	
					$i++;
				}
				echo '</div>';
				$free_result($result);
			 ?>
    </table>
  </form>
</div>
</body>

</html>
