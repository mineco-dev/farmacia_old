<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="13%">&nbsp;</td>
    <td width="72%"><div align="center" class="legal1">
      <p>Listado </p>
    </div></td>
    <td width="15%"><div align="center"><img src="img/logo_rpt.gif" alt="logo_mineco" width="107" height="113" /></div></td>
  </tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" ><form id="form1" name="form1" method="post" action="">
      <label >Nombre
      <input type="text" name="name" id="name" />
      </label>
        </form>
    </td>
    <td width="82%"><form id="form2" name="form2" method="post" action="">
        <input type="submit"  id="enviar" value="Enviar" />

    </form></td>
  </tr>
</table>
<form action="rep.php" method="post" name="form1" target="_blank" id="form3">
  <table cellspacing="10" cellpadding="0" 
                        border="0" id="table27" width="59%">
    <tr>
      <td align="center" bordercolor="#0000FF" bgcolor="#000000"><span lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha inicial </font></span></td>
      <td align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt">
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
        </span></span><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt">
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
          </span></span></span></span><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt">
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
      <td align="center" bordercolor="#0000FF" bgcolor="#000000"><span lang="es-gt" xml:lang="es-gt"><font color="#FFFFFF">Fecha final </font></span></td>
      <td align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt">
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
        <span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt">
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
          <span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt"><span lang="es-gt" xml:lang="es-gt">
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
      <td width="175" align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt" xml:lang="es-gt"></span></td>
      <td width="314" align="center" bordercolor="#0000FF" bgcolor="#FFFFFF"><span lang="es-gt" xml:lang="es-gt">
        <input type="submit" name="Submit" value="Generar Reporte" />
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
<p>&nbsp;</p>
</body>
</html>
