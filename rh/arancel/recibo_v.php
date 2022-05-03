<?
//  Autentificator
//  Gestión de Usuarios PHP+Mysql+sesiones
//  by Pedro Noves V. (Cluster)
//  clus@hotpop.com
// ------------------------------------------
		require("aut_verifica.inc.php");
		$nivel_acceso=5; // Nivel de acceso para esta p�gina.
// se chequea si el usuario tiene un nivel inferior
// al del nivel de acceso definido para esta p�gina.
// Si no es correcto, se mada a la p�gina que lo llamo con
// la variable de $error_login definida con el n� de error segun el array de
// aut_mensaje_error.inc.php
	if ($nivel_acceso <= $_SESSION['usuario_nivel']){
	header ("Location: $redir?error_login=5");
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
	background-image: url(FONDO1.JPG);
}
.style14 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style20 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style21 {	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style33 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #990000; }
-->
</style>


<script>



var checkobj

function agreesubmit(el){
checkobj=el
if (document.all||document.getElementById){
for (i=0;i<checkobj.form.length;i++){  
var tempobj=checkobj.form.elements[i]
if(tempobj.type.toLowerCase()=="submit")
tempobj.disabled=!checkobj.checked
}
}
}

function defaultagree(el){
if (!document.all&&!document.getElementById){
if (window.checkobj&&checkobj.checked)
return false
else{
alert("Please read/accept terms to submit form")
return true
}
}
}

</script>
</head>

<body>

<title>ASEGGYS - SISTEMA FARMACIA MINECO</title> 

<?php 
require "./conversor.php";


 if (!($link=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("diaco",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
 	   $result=mysql_query("select id_rubro,descripcion,valor from rubro where id_rubro = '$id_rubro'",$link); 
		if ($result) // verifica si la base de datos dejo hacer la insercion
		{
		/* Insercion con exito*/		
			while ($row = mysql_fetch_row($result))
			{
				//print "<option value='$row[0]'>$row[1]</option>";
  			  $importe = $row[2] * $cantidad;
			}
		} else {
			/* Error en la insercion*/
			print "<p class='Estilo1'>No se pudo insertar la inforci&oacute;n !!!ERROR!!</p>";
		}			
		mysql_close($link);
		
		


if ($importe)
	 {
	 	$resultado = convertir($importe);
//		print("<p>$resultado</p>");
		print("<p>");
//		echo number_format($numero);
		print("</p>");
	 }
	 
	 

?>

<FORM ACTION="irecibo.php" method="get" name="form1" style="margin-bottom: 0" onSubmit="return defaultagree(this)"> 
<div align="center">
  <table width="904" border="1" align="center">
      <tr>
        <td width="894" bgcolor="#FFFFFF"><div align="left"><img src="imagenes/programa-caja.jpg" width="376" height="35"> </div>
            <hr>
        </td>
      </tr>
      <tr>
        <td height="218" bgcolor="#FFFFFF"><div align="center">
            <div align="left">
              <TABLE border="1" align="center">
                <TR bgcolor="#FFDAA5">
                  <TD height="21" colspan="4" bgcolor="#FFFFFF">&nbsp;</TD>
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD height="38" colspan="4"><div align="center"><span class="style21">Ingreso de Formularios 63A </span></div></TD>
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD height="26" colspan="3">&nbsp;</TD>
                  <TD bgcolor="#FFDAA5"><?php  
	
	if (!($k=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("diaco",$k)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   }  
   
   $consulta = mysql_query("Select id_multa,empresa from expjuridico where id_multa = '$multa'",$k);
   if ($consulta) {
   		$h = mysql_fetch_row($consulta);
		
		if ($h[0]>0)
		{
		
		print "<font color='#335B96'>La multa corresponde a '$h[1]'</font>";
		
		mysql_query("UPDATE expjuridico SET smulta = 2 WHERE id_multa = '$multa'",$k);
		}
		
		mysql_close($k);


   }
   
   ?>&nbsp;</TD>
                </TR>
                
                <TR bgcolor="#FFDAA5">
                  <TD height="32"><span class="style20">Nro. Recibo</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="id_recibo" TYPE="text" SIZE="15" MAXLENGTH="15" VALUE = "<? print $id_recibo; ?>"></TD>
                  <TD height="32"><span class="style20">Nro. Deposito:</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="deposito" TYPE="text" SIZE="15" MAXLENGTH="15" VALUE = "<? print $deposito; ?>"></TD>
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD width="83" height="28"><span class="style20">Regional:</span></TD>
                  <TD width="240" bgcolor="#FFFFFF"><span class="style20">
                    <select name="id_regional" size="1" id="nombre_r">
                      <?
		/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
	   el mensaje que se despliegue */  
    if (!($link=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("diaco",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
 	   $result=mysql_query("select id_regional,nombre_r from regional where id_regional = '$id_regional'",$link); 
		if ($result) // verifica si la base de datos dejo hacer la insercion
		{
		/* Insercion con exito*/		
			while ($row = mysql_fetch_row($result))
			{
				print "<option value='$row[0]'>$row[1]</option>";
			}
		} else {
			/* Error en la insercion*/
			print "<p class='Estilo1'>No se pudo insertar la inforci&oacute;n !!!ERROR!!</p>";
		}			
		mysql_close($link);
?>
                    </select>
                  </span></TD>
                  <TD><span class="style20">Oficina:</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="oficina" TYPE="text" SIZE="50" MAXLENGTH="60" VALUE = "<? print $oficina;?>"></TD>
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD height="28"><span class="style20">Fecha:</span></TD>
                  <td bgcolor="#FFFFFF"><span class="style20">
				 <?PHP 
  			$fecha[] = "Enero";	
			$fecha[] = "Febrero";	
			$fecha[] = "Marzo";	
			$fecha[] = "Abril";	
			$fecha[] = "Mayo";	
			$fecha[] = "Junio";	
			$fecha[] = "Julio";	
			$fecha[] = "Agosto";	
			$fecha[] = "Septiembre";	
			$fecha[] = "Octubre";	
			$fecha[] = "Noviembre";	
			$fecha[] = "Diciembre";    
		?>
				  <select name="fdia" size="1" id="fdia" onkeypress="return handleEnter(this, event)">
                            <?
					   			for ($x=1; $x<=31; $x++)
								{
									if ($fdia == $x)
									{
										echo "<option value='$x' selected>$x</option>";
									}
									else
									{
					   					echo "<option value='$x'>$x</option>";
									}
								}					   	
					   ?>
           </select>
          <select name="fmes" size="1" id="fmes" >
                          <?	
					  			$m = 0;
					   			for ($x=0; $x<=11; $x++)
								{
									$m++;
									if ($fmes == $m)
									{
										echo "<option value='$m' selected>$fecha[$x]</option>";
									}
									else
									{
					   					echo "<option value='$m'>$fecha[$x]</option>";
									}
								}					   	

					  ?>
                                                </select>
         
				 <select name="fanio" size="1" id="fanio">
                          <?	
					  			$m = $fanio; //mes
								$mA = $fanio+1; // mes anterior
								$d = date("j");
									echo "<option value='$mA'>$mA</option>";
								echo "<option value='$m' selected>$m</option>";
							?>
			</select>			  
                  </span></td>
                  <TD width="63"><span class="style20">Rubro:</span></TD>
                  <TD width="510" bgcolor="#FFFFFF"><span class="style20">
                    <select name="id_rubro" size="1" id="descripcion">
                      <?
		/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
	   el mensaje que se despliegue */  
    if (!($link=mysql_connect("localhost","",""))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("diaco",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
 	   $result=mysql_query("select id_rubro,descripcion,valor from rubro where id_rubro = '$id_rubro'",$link); 
		if ($result) // verifica si la base de datos dejo hacer la insercion
		{
		/* Insercion con exito*/		
			while ($row = mysql_fetch_row($result))
			{
				print "<option value='$row[0]'>$row[1]</option>";
			}
		} else {
			/* Error en la insercion*/
			print "<p class='Estilo1'>No se pudo insertar la inforci&oacute;n !!!ERROR!!</p>";
		}			
		mysql_close($link);
?>
                    </select>
&nbsp;</span></TD>
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD height="26"><span class="style20">Consumidor:</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="consumidor" TYPE="text" SIZE="40" MAXLENGTH="40" VALUE = "<? print $consumidor;?>"></TD>
                  <TD><span class="style20">Cantidad:</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="cantidad" TYPE="text" SIZE="15" MAXLENGTH="15" VALUE = "<? print $cantidad;?>" ></TD>
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD height="26"><span class="style20">Lugar:</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="lugar" TYPE="text" SIZE="40" MAXLENGTH="40" VALUE = "<? print $lugar; ?>"></TD>
                  <TD><span class="style33">Importe:</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="importe" TYPE="text" SIZE="15" MAXLENGTH="15" VALUE = "<? print $importe; ?>" ></TD>
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD height="26">&nbsp;</TD>
                  <TD bgcolor="#FFFFFF">&nbsp;</TD>
                  <TD><span class="style33">En Letras:</span></TD>
                  <TD bgcolor="#FFFFFF"><INPUT NAME="cletras" TYPE="text" SIZE="85" MAXLENGTH="85" value = "<? print $resultado; ?>"  ></TD>				  
                </TR>
                <TR bgcolor="#FFDAA5">
                  <TD height="43" colspan="4"><div align="left"><span class="Estilo29 style14" lang="es-gt">Si los datos estan correcto haga clic sobre la casilla de verificaci&oacute;n:</span></div>
                    <div align="center"><span class="style14">Si</span>
                      <input name="chkOK" type="checkbox" id="chkOK" value="1" onClick="agreesubmit(this)">
                      <input name = "btnInsertar" type = "submit" id = "btnInsertar" value = "Enviar" disabled >
                  </div></TD>
                </TR>
                <TR bgcolor="#FFFFFF">
                  <TD height="23" colspan="4">&nbsp;</TD>
                </TR>
              </TABLE>
            </div>
            </div></td>
      </tr>
    </table>
  </div>
</FORM> 

</body> 
</html> 