<?	
$grupo_id=5;
include("../restringir.php");	
?>
<?
$emp=$_SESSION["tareasxemp"];
if (($emp==5000) || ($emp==5001))//tareas en espera o todas las tareas
{
 if (isset($st))  //filtro por estado del ticket 	
	$consulta = "SELECT * FROM view_soporte where codigo_estado='$st' and codigo_dependencia='$dependencia'";	
	else
	if (isset($tk)) //filtro por numero de ticket
	$consulta = "SELECT * FROM view_soporte where ticket='$tk' and codigo_dependencia='$dependencia'";
		else
			if (isset($sol)) //filtro por solicitante
			$consulta = "SELECT * FROM view_soporte where codigo_usuario='$sol' and codigo_dependencia='$dependencia'";
				else
					if (isset($cat)) //filtro por categoria
					$consulta = "SELECT * FROM view_soporte where codigo_categoria='$cat' and codigo_dependencia='$dependencia'";
						else
						if (isset($niv)) //filtro por nivel
						$consulta = "SELECT * FROM view_soporte where nivel='$niv' and codigo_dependencia='$dependencia'";
							else
								if (isset($tec)) //filtro por tecnico								
								$consulta = "SELECT * FROM view_soporte where codigo_tecnico='$tec' and codigo_dependencia='$dependencia'";
									else //muestra todas las actividades que se encuentren en espera, por dependencia.
										if ($emp==5000)
										$consulta = "SELECT * FROM view_soporte where codigo_estado=8 and codigo_dependencia='$dependencia'";			
											else //muestra todas las actividades, por dependencia.
												$consulta = "SELECT * FROM view_soporte where codigo_estado in (1,2,3,8) and codigo_dependencia='$dependencia'";
}					
else
{
 if (isset($st))  //filtro por estado del ticket
	$consulta = "SELECT * FROM view_soporte where codigo_estado='$st' and codigo_dependencia='$dependencia' and codigo_tecnico='$emp'";
	else
		if (isset($tk)) //filtro por numero de ticket
		$consulta = "SELECT * FROM view_soporte where ticket='$tk' and codigo_dependencia='$dependencia' and codigo_tecnico='$emp'";
			else
				if (isset($sol)) //filtro por solicitante
				$consulta = "SELECT * FROM view_soporte where codigo_usuario='$sol' and codigo_dependencia='$dependencia' and codigo_tecnico='$emp'";
					else
						if (isset($cat)) //filtro por categoria
						$consulta = "SELECT * FROM view_soporte where codigo_categoria='$cat' and codigo_dependencia='$dependencia' and codigo_tecnico='$emp'";
							else
							if (isset($niv)) //filtro por nivel
							$consulta = "SELECT * FROM view_soporte where nivel='$niv' and codigo_dependencia='$dependencia' and codigo_tecnico='$emp'";
							else
								if (isset($tec)) //filtro por tecnico
								$consulta = "SELECT * FROM view_soporte where codigo_tecnico='$tec' and codigo_dependencia='$dependencia'";
									else //muestra todas las actividades filtradas por dependencia y empleado seleccionado en el menu izquierdo.
										$consulta = "SELECT * FROM view_soporte where codigo_tecnico='$emp' and codigo_dependencia='$dependencia'";			
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
	cursor:pointer;
	margin-top : 2px;
	padding-bottom : 1px;
	margin-bottom : 1px;
	margin-left : 22px;
	font-size : 11px;
	font-family : Tahoma,Verdana,Arial;
	text-align:left;
	text-decoration:none;		
}

.Estilo1 {color: #FFFFFF}
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

<script language="javascript">
function url(uri)
{
	location.href=uri; 
} 
</script>

<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=pendientes.php">
</head>
<body>
<center>
  <form name="form1" method="post" action="">
    <input name="$emp" type="hidden" id="$emp" value="<? echo $emp ?>">
    <table width="90%" border="0" bordercolor="#0000FF">
      <tr>
        <td><div align="center"><strong>Detalle de actividades pendientes</strong></div></td>
      </tr>
      <tr>
        <td><center>
            <table width="99%" border="0" class="tablaazul">
              <tr class="detalletabla2">
                <td width="8%"><div align="center"><span class="Estilo10">		
				<?
					if ($emp==5000)
					{
						$qry_ticket="SELECT * FROM soporte where codigo_estado=8 and codigo_dependencia='$dependencia' ORDER BY codigo_soporte";
					}
					else
					if ($emp==5001)
					{
						$qry_ticket="SELECT * FROM soporte where codigo_estado in (1,2,3,8) and codigo_dependencia='$dependencia' ORDER BY codigo_soporte";
					}
					else
					if ($emp==3)
						$qry_ticket="SELECT * FROM soporte where codigo_estado=1 and codigo_dependencia='$dependencia' ORDER BY codigo_soporte";
					else
						$qry_ticket="SELECT * FROM soporte where codigo_estado in (1,2,3,8) and codigo_tecnico='$emp' ORDER BY codigo_soporte";
						
					$resp_ticket=mssql_query($qry_ticket);	
					echo('<select name="cbo_ticket" onchange="url(this.value);">');		
					echo'<option value="0">Ticket</option>';
					while($row3=mssql_fetch_array($resp_ticket))
					{
						echo'<option value="pendientes.php?tk='.$row3["codigo_soporte"].'">'.$row3["codigo_soporte"].'</option>';
					}
					echo('</select>');											 								
				?>
                </span></div></td>
                <td width="11%"><div align="center"><strong>Fecha</strong></div></td>
                <td bordercolor="#000000"><div align="center"><span class="Estilo10">
                  <?
				  	if ($emp==5000) //en espera
					{
					  	$qry_solicitante="SELECT distinct s.codigo_usuario, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_solicitante.="ON s.codigo_usuario=u.codigo_usuario WHERE codigo_estado=8 AND s.codigo_dependencia='$dependencia' order by nombres";					
					}	
					else
					if ($emp==5001) //todos
					{
					  	$qry_solicitante="SELECT distinct s.codigo_usuario, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_solicitante.=" ON s.codigo_usuario=u.codigo_usuario WHERE codigo_estado in (1,2,3,8) AND s.codigo_dependencia='$dependencia' order by nombres";					
					}	
				  	else
					if ($emp==3) //sin asignar
				  	{
					  	$qry_solicitante="SELECT distinct s.codigo_usuario, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_solicitante.=" ON s.codigo_usuario=u.codigo_usuario WHERE codigo_estado=1 AND s.codigo_dependencia='$dependencia' order by nombres";					
					}	
					else
					{  
						$qry_solicitante="SELECT distinct s.codigo_usuario, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_solicitante.=" ON s.codigo_usuario=u.codigo_usuario WHERE (codigo_estado>1 and codigo_estado<4) AND codigo_tecnico='$emp' order by nombres";					
					}	
					$resp_solicitante=mssql_query($qry_solicitante);	
					echo('<select name="cbo_solicitante" onchange="url(this.value);">');		
					echo'<option value="0">Solicitado por</option>';
					while($row4=mssql_fetch_array($resp_solicitante))
					{
						echo'<option value="pendientes.php?sol='.$row4["codigo_usuario"].'">'.$row4["nombres"].'&nbsp;'.$row4["apellidos"].'</option>';
					}
					echo('</select>');											 								
				?>
                </span></div>
                    <div align="center"></div> <div align="center"></div></td>
                <td width="20%"><div align="center" class="Estilo2"><span class="Estilo10">
                  <?
				  	if ($emp==5000) //en espera
					{
						echo $emp;
				  		$qry_categoria="SELECT distinct s.codigo_categoria, c.categoria FROM soporte s INNER JOIN categoria c"; 
						$qry_categoria.="ON s.codigo_categoria=c.codigo_categoria WHERE codigo_estado=8 AND s.codigo_dependencia='$dependencia' ORDER BY categoria";
				  	}
				  	if ($emp==5001) //todos
					{
						$qry_categoria="SELECT distinct c.codigo_categoria, c.categoria FROM soporte s INNER JOIN categoria c"; 
						$qry_categoria.=" ON s.codigo_categoria=c.codigo_categoria WHERE codigo_estado in (1,2,3,8) AND s.codigo_dependencia='$dependencia'";
					}
					else
					if ($emp==3) //sin asignar
				  	{
						$qry_categoria="SELECT distinct s.codigo_categoria, c.categoria FROM soporte s INNER JOIN categoria c"; 
						$qry_categoria.=" ON s.codigo_categoria=c.codigo_categoria WHERE codigo_estado=1 AND s.codigo_dependencia='$dependencia'";
					}
					else
					{
						$qry_categoria="SELECT distinct s.codigo_categoria, c.categoria FROM soporte s INNER JOIN categoria c"; 
						$qry_categoria.=" ON s.codigo_categoria=c.codigo_categoria WHERE (codigo_estado>1 and codigo_estado<4) AND codigo_tecnico='$emp'";
					}
					$resp_categoria=mssql_query($qry_categoria);
					echo('<select name="cbo_categoria" onchange="url(this.value);">');		
					echo'<option value="0">Asistencia para</option>';
					while($row5=mssql_fetch_array($resp_categoria))
					{
						echo'<option value="pendientes.php?cat='.$row5["codigo_categoria"].'">'.$row5["categoria"].'</option>';
					}
					echo('</select>');											 								
				?>
                </span></div></td>
                <td width="13%"><div align="center"><strong><span class="Estilo12"><span class="Estilo11">
                <?
					if ($emp==3)
					{
						$query2="SELECT * FROM estado where codigo_estado=1 ORDER BY nombre_estado";					
					}
					else
					if ($emp==5000)
					{
						$query2="SELECT * FROM estado where codigo_estado=8 ORDER BY nombre_estado";					
					}
					else
					if ($emp==5001)
					{
						$query2="SELECT * FROM estado where codigo_estado IN (1,2,3,8) ORDER BY codigo_estado";					
					}
					else
					{
						$query2="SELECT * FROM estado where codigo_estado IN (2,3,8) ORDER BY codigo_estado";
					}
					
					
					$result2=mssql_query($query2);					
					echo('<select name="cbo_estado" onchange="url(this.value);">');					
					echo'<option value="0">Estado</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="pendientes.php?st='.$row2["codigo_estado"].'">'.$row2["nombre_estado"].'</option>';
					}
					echo('</select>');											 								
				?>
                </span></span></strong></div></td>
                <td width="6%"><div align="center"><span class="Estilo10">
                  <?	
				  	if ($emp==5001) 
					{
						$qry_nivel="SELECT distinct(nivel) FROM usuario u INNER JOIN soporte s";
						$qry_nivel.=" ON s.codigo_usuario=u.codigo_usuario WHERE codigo_estado IN (1,2,3,8)";
					}
					else
				  	if ($emp==5000) 
					{
						$qry_nivel="SELECT distinct(nivel) FROM usuario u INNER JOIN soporte s";
						$qry_nivel.=" ON s.codigo_usuario=u.codigo_usuario WHERE codigo_estado=8";
					}
					else
				  	if ($emp==3) 
					{
						$qry_nivel="SELECT distinct(nivel) FROM usuario u INNER JOIN soporte s";
						$qry_nivel.=" ON s.codigo_usuario=u.codigo_usuario WHERE codigo_estado=1 and s.codigo_dependencia='$dependencia'";
					}
					else
					{
						$qry_nivel="SELECT distinct(nivel) FROM usuario u INNER JOIN soporte s";
						$qry_nivel.=" ON s.codigo_usuario=u.codigo_usuario WHERE (codigo_estado>1 and codigo_estado<4) AND codigo_tecnico='$emp'";
					}
					$resp_nivel=mssql_query($qry_nivel);	
					echo('<select name="cbo_nivel" onchange="url(this.value);">');			
					echo'<option value="0">nivel</option>';
					while($row6=mssql_fetch_array($resp_nivel))
					{						
						echo'<option value="pendientes.php?niv='.$row6["nivel"].'">'.$row6["nivel"].'</option>';
					}
					echo('</select>');											 								
				?>
                </span></div></td>
               <td width="6%"><div align="center"><strong>Fecha Asignacion</strong></div></td>
                <td width="13%"><div align="center"><span class="Estilo10">
                  <?
				  	if ($emp==5000) //en espera
					{
					  	$qry_tecnico="SELECT distinct s.codigo_tecnico, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_tecnico.=" ON s.codigo_tecnico=u.codigo_usuario WHERE codigo_estado=8 AND s.codigo_dependencia='$dependencia' order by nombres";					
					}	
					else
					if ($emp==5001) //todos
					{
					  	$qry_tecnico="SELECT distinct s.codigo_tecnico, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_tecnico.=" ON s.codigo_tecnico=u.codigo_usuario WHERE codigo_estado in (1,2,3,8) AND s.codigo_dependencia='$dependencia' order by nombres";					
					}	
				  	else
					if ($emp==3) //sin asignar
				  	{
					  	$qry_tecnico="SELECT distinct s.codigo_tecnico, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_tecnico.=" ON s.codigo_tecnico=u.codigo_usuario WHERE codigo_estado=1 AND s.codigo_dependencia='$dependencia' order by nombres";					
					}	
					else
					{  
						$qry_tecnico="SELECT distinct s.codigo_tecnico, u.nombres, u.apellidos FROM soporte s INNER JOIN usuario u"; 
						$qry_tecnico.=" ON s.codigo_tecnico=u.codigo_usuario WHERE (codigo_estado>1 and codigo_estado<4) AND codigo_tecnico='$emp' order by nombres";					
					}	
					$resp_tecnico=mssql_query($qry_tecnico);	
					echo('<select name="cbo_tecnico" onchange="url(this.value);">');		
					echo'<option value="0">Atiende</option>';
					while($row7=mssql_fetch_array($resp_tecnico))
					{
						echo'<option value="pendientes.php?tec='.$row7["codigo_tecnico"].'">'.$row7["nombres"].'</option>';
					}
					echo('</select>');											 								
				?>
                </span> </div></td>
              </tr>
              <?	
				echo '<div id="masterdiv">';		  	
				$result3=mssql_query($consulta);
				$i = 0;								
				while($row3=mssql_fetch_array($result3))
				{
					$tecnico=$row3["codigo_tecnico"];
					$ticket=$row3["ticket"];
					$alerta=$row3["alerta"];
					$sub='sub$ticket';	//para crear un area con el nombre del ticket, la cual contendra el seguimiento del ticket										
					$color_estado="color_rojo";
					if ($row3["codigo_estado"]==1) $color_estado="color_rojo";
					else 
						if ($row3["codigo_estado"]==2) $color_estado="color_amarillo";
						else 
						if ($row3["codigo_estado"]==8) $color_estado="color_naranja";
						else
							$color_estado="color_verde";
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
                	echo '<tr class='.$clase.'><td><center>'.$row3["ticket"].'</center></td><td><center>'.$row3["fecha"].'</center></td><td><center>'.$row3["nombre"].'&nbsp;'.$row3["apellido"].'<br>(IP '.$row3["ip"].')</center></td><td><center>'.$row3["categoria"].'</center></td><td class='.$color_estado.'><center><a href="up_pendientes.php?id='.$row3["ticket"].'">'.$row3["estado"].'</a></center></td><td><center>'.$row3["nivel"].'</center></td><td><center>'.$row3["fecha_inicio"].'</center></td><td><center>'.$row3["tecnico"].'</center></td></tr>';
					if ($alerta==1)  
					{
						if ($user==$tecnico)  //si el que esta atendiendo el ticket es el que inicio sesion
						{
							echo '<tr class='.$clase.'><td><center><div class="menutitle" onclick="SwitchMenu(\'sub'.$ticket.'\')"><img src="imagenes/iconos/ico_ver.jpg" alt="Ver comentarios de seguimiento"></div></center></td><td><center><a href="quitar_alerta.php?id='.$row3["ticket"].'"><img src="imagenes/iconos/ico_alert.gif" alt="Quitar alerta"></a></center></td><td colspan="7"><center>'.$row3["detalle"].'</center></td></tr>';																										
						}
						else
						{
							echo '<tr class='.$clase.'><td><center><div class="menutitle" onclick="SwitchMenu(\'sub'.$ticket.'\')"><img src="imagenes/iconos/ico_ver.jpg" alt="Ver comentarios de seguimiento"></div></center></td><td><center><a href="comentar.php?id='.$row3["ticket"].'"><img src="imagenes/iconos/ico_alert.gif" alt="Agregar comentario"></a></center></td><td colspan="7"><center>'.$row3["detalle"].'</center></td></tr>';																										
						}
					}
					else
					{
						echo '<tr class='.$clase.'><td><center><div class="menutitle" onclick="SwitchMenu(\'sub'.$ticket.'\')"><img src="imagenes/iconos/ico_ver.jpg" alt="Ver comentarios de seguimiento"></div></center></td><td><center><a href="comentar.php?id='.$row3["ticket"].'"><img src="imagenes/iconos/ico_msj.jpg" alt="Agregar un comentario de seguimiento"></a></center></td><td colspan="7"><center>'.$row3["detalle"].'</center></td></tr>';																										
					}	
					echo '<tr><td colspan=9>';							
					echo '<span class="submenu" id="sub'.$ticket.'">';
					$consulta2= "Select * from view_seguimiento where codigo_soporte='$ticket' order by codigo_seguimiento desc";
					$resulta2=mssql_query($consulta2);							
					while($row4=mssql_fetch_array($resulta2))
					{	
						
						echo '<div class="estilo2"> El '.$row4["fecha"].'&nbsp;'.$row4["nombres"].' ESCRIBI�: -->'.$row4["detalle"].'</div><br>';						
					}		
					
					echo '</span>';					
					echo '</tr></td>';							
					$i++;					
				}		
				echo '</div>';
			  mssql_close($s);				
			  ?>
            </table>
        </center></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>	  
    <input name="emp" type="hidden" id="emp" value="<? echo $emp ?>">
  </form>
</center>
</body>
</html>