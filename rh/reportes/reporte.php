<?
require("../../includes/funciones.php");
require("../../includes/sqlcommand.inc");
	conectardb($reloj_marcaje);

?>


<?
//funcion que suma las horas
$horas='23:30';

 function calcular_tiempo_trasnc($hora1,$hora2){ 
    $separar[1]=explode(':',$hora1); 
    $separar[2]=explode(':',$hora2); 

$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1]; //se toman los minutos de la primera hora y se multiplica por 60
$total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1]; // se toman los minutos de la segunda hora y se multiplica por 60
$total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2]; //diferencia entre hora 1 y hora 2

 	if($total_minutos_trasncurridos<=59) 
	 	
	return($total_minutos_trasncurridos.' Minutos');
	
 elseif($total_minutos_trasncurridos>59)
 	{ 
		$HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60); // calcula las horas cuando llega a 59 para divirlo en 60 minutos
		
	if($HORA_TRANSCURRIDA<=9) $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA; 
		$MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60; //calcula los minutos transcurridos para cuando es 9 mod

		 if($MINUITOS_TRANSCURRIDOS<=9) $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS;
			 return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.' Horas'); 

	} 
} 
//llamamos la función e imprimimos 
echo calcular_tiempo_trasnc($horas,'17:30'); 
?> 
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	
	background-color: #CCCCCC;
}
.style1 {
	font-size: 9;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style></head>

<body>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table23">
  <TBODY>
  <?
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
    <TR>
      <TD colSpan=3 height=15 style="font-size: 10pt; font-family: verdana,arial"></TD>
    </TR>
    <TR>
      <TD width="1%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
      <TD width="95%" align="center" style="font-size: 10pt; font-family: verdana,arial"><TABLE width="94%" 
      border=2 cellPadding=40 cellSpacing=0 borderColor=#999999 bgcolor="#FFFFFF" id="table24">
          <TBODY>
            <TR>
              <TD width="100%" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial" align="center"><TABLE cellSpacing=0 cellPadding=0 width="83%" border=0 id="table25">
                  <TBODY>
                    <TR>
                      <TD width="26%" height="113" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
                      <TD width="57%" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><p align="center" class="style1">Reporte </p>                        
                      <p align="center" class="style1">&nbsp;</p></TD>
                      <TD width="17%" align=right vAlign=bottom style="font-size: 10pt; font-family: verdana,arial"><p align="center"><img src="img/logo_rpt.gif" width="107" height="113"></TD>
                    </TR>
                  </TBODY>
                </TABLE>
                <p>&nbsp;</p>
                  <table width="75%" height="24" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="14%" height="24" bordercolor="#0000FF" bgcolor="#000000"><span lang="es-gt"><font color="#FFFFFF">Nombre</font></span></td>
                      <td><a href="javascript:void(0)" onclick="buscar=window.open('busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;"><input name="nombre[0][0]" type="text" id="textfield3" value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]" size="55" disabled />
	  </a>
	  <input name="nombre[0][2]" type="hidden" id="hiddenField" size="55"/>
      <input type="hidden" name="nombre[0][1]" id="hiddenField"/>  </td>                  

                    </tr> 
                  </table>
                  <p style="margin-top: 0; margin-bottom: 0">&nbsp;</p>
                  <form name="form1" method="post" action="rep.php" target="_blank">
                    <table cellspacing=10 cellpadding=0 
                        border=0 id="table27" width="59%">
                      <tr>
                        <td align="center" bordercolor="#0000FF" bgcolor="#000000"><span lang="es-gt"><font color="#FFFFFF">Fecha inicial </font></span></td>
                        <td align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboDiai" size="1" id="cboDiai" onkeypress="return handleEnter(this, event)">
                            <?
					   			for ($x=1; $x<=31; $x++)
								{
									if (date("j") == $x)
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
                        </span></span><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                        <select name="cboMesi" size="1" id="cboMesi" >
                          <?	
					  			$m = 0;
					   			for ($x=0; $x<=11; $x++)
								{
									$m++;
									if (date("n") == $m)
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
                        </span></span></span></span><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                        <select name="cboAnioi" size="1" id="cboAnioi">
                          <?	
					  			$m = date("Y"); //mes
								$mA = date("Y")-1;
								$mA1 = date("Y")-2;
								$mA2 = date("Y")-3;
								$mA3 = date("Y")-4; // mes anterior
								$d = date("j");
								echo "<option value='$m' selected>$m</option>";
								echo "<option value='$mA'>$mA</option>";								
								echo "<option value='$mA1'>$mA1</option>";
								echo "<option value='$mA2'>$mA2</option>";
								echo "<option value='$mA3'>$mA3</option>";
					  ?>
                        </select>
                        </span></span></span></span></span></span></span></span></td>
                      </tr>
                      <tr>
                        <td align="center" bordercolor="#0000FF" bgcolor="#000000"><span lang="es-gt"><font color="#FFFFFF">Fecha final </font></span></td>
                        <td align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboDiaf" size="1" id="cboDiaf" onkeypress="return handleEnter(this, event)">
                            <?
					   			for ($x=1; $x<=31; $x++)
								{
									if (date("j") == $x)
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
                          <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboMesf" size="1" id="cboMesf" >
                            <?	
					  			$m = 0;
					   			for ($x=0; $x<=11; $x++)
								{
									$m++;
									if (date("n") == $m)
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
                          <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
                          <select name="cboAniof" size="1" id="cboAniof">
                            <?	
					  			$m = date("Y"); //mes
								$mA = date("Y")-1;
								$mA1 = date("Y")-2;
								$mA2 = date("Y")-3;
								$mA3 = date("Y")-4; // mes anterior
								$d = date("j");
								echo "<option value='$m' selected>$m</option>";
								echo "<option value='$mA'>$mA</option>";								
								echo "<option value='$mA1'>$mA1</option>";
								echo "<option value='$mA2'>$mA2</option>";
								echo "<option value='$mA3'>$mA3</option>";
					  ?>
                          </select>
                        </span></span></span></span></span></span></span></span> </span></span></span></span> </span></span></td>
                      </tr>
                      <tr>
                        <td width="175" align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt"></span></td>
                        <td width="314" align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt">
                          <input type="submit" name="Submit" value="Generar Reporte">
                        </span></td>
                      </tr>
                      <tbody>
                        <?
						
			
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */ 
		
?>
                        <tr>
                          <td width="175"></td>
                        </tr>
                      </tbody>
                    </table>
                </form>
                <p style="margin-bottom: 0"></p>
              </TD>
            </TR>
          </TBODY>
      </TABLE></TD>
      <TD width="4%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
    <TR>
      <TD colSpan=3 style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
<hr>

</body>
</html>
