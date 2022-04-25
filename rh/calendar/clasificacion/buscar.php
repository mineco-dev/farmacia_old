
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<base target="principal">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<style type="text/css">
<!--
body {
	background-image: url(../imagen/bg.gif);
}
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 13px;
}
.style10 {font-family: Arial, Helvetica, sans-serif}
.style6 {font-size: 14px; font-weight: bold; }
.style8 {font-size: 12px; font-weight: bold; }
.box {background: #fff;
}
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
td.style.backgroundColor="#f2f2f2";
}
}

function validar()
{
	document.form1.nombre.disabled = true;
	if(document.getElementById("criterio").value == 3)
		document.form1.nombre.disabled = true;
}


function toggleSelect()
{

	if (document.getElementById("chk1").checked == true)
	{
	document.frm1.select1.disabled = true;
	}
	else
	{
	document.getElementById("select1").disabled = false;
	}

}



//document.getElementById('mySelect').disabled = true;
//-->
</SCRIPT>
</head>

<body>

<table width="891" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td background="IMAGENES/foncentral2.png"><div align="center">
      <table width="83%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="62" height="47" background="../imagen/chromebg.gif">&nbsp;</td>
          <td width="401" background="../imagen/chromebg.gif">&nbsp;</td>
          <td width="22" background="../imagen/chromebg.gif">&nbsp;</td>
        </tr>
        
        <tr>
          <td class="BiggerGrayWriting">&nbsp;</td>
          <td class="BiggerGrayWriting"><img src="../imagen/busquedas.jpg" alt="." width="237" height="30"></td>
          <td class="BiggerGrayWriting">&nbsp;</td>
        </tr>
      </table>
      <FORM name="form1" id="form1" ACTION="buscar.php" target="_self">
        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table1">
          <TBODY>
            <TR>
              <TD background="../images/fondo5.jpg">&nbsp;</TD>
            </TR>
          </TBODY>
        </TABLE>
        <table width="83%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
          <tr>
            <td width="737" height="85" colspan="3"><div align="center">
                <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#333333">
                  <tr class="TuringHelp">
                    <td width="22%" height="26" bgcolor="#EBF1F1" class="BlueBasicFont">Termino:</td>
                    <td width="1%" class="weight6"><span class="PaymentTableCaption"><span class="style10">
                    </span></span></td>
                    <td width="77%" bgcolor="#EBF1F1"><span class="PaymentTableCaption"><span class="style10">
                      <input name="termino" type="text" size="30" maxlength="30">
                    </span></span></td>
                  </tr>
                  <tr class="TuringHelp">
                    <td height="26" bgcolor="#EBF1F1" class="BlueBasicFont">Criterio:</td>
                    <td class="weight6">&nbsp;</td>
                    <td bgcolor="#EBF1F1"><select name="criterio" id="criterio"  onChange="validar();">
					<option value="1">Numero de Expediente</option>
  					<option value="2">Cedula</option>
					<option value="3">Nombre del Deudor</option>
					</select> <select name="nombre" id="nombre" disabled>
					<option value="1">Primer Nombre</option>
  					<option value="2">Segundo Nombre</option>
					<option value="3">Primer Apellido</option>
					<option value="4">Segundo Apellido</option>					
					<option value="5">Nombre Completo</option>
					</select>


                    &nbsp;</td>
                  </tr>
                  <tr class="TuringHelp">
                    <td height="26" bgcolor="#EBF1F1">&nbsp;</td>
                    <td class="weight6"><span class="PaymentTableCaption"><span class="style10">
                    </span></span></td>
                    <td bgcolor="#EBF1F1"><span class="weight6"><span class="PaymentTableCaption"><span class="style10">
                      <input name="btnInsertar"type="submit" class="TuringHelp"id="btnInsertar" value="Buscar" >
                    </span></span></span></td>
                  </tr>
                </table>
              <div align="center">
                  <table width="735" 
                        border=0 align="center" cellpadding=0 cellspacing=1 bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                    <tbody>
                      <tr>
                        <td width="95" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style10"><font color="#FFFFFF">Codigo </font></span></td>
                        <td width="127" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style10" lang="es-gt"><font color="#FFFFFF">Fecha/Hora </font></span></td>
                        <td width="154" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt"><font color="#FFFFFF">Nombre del Deudor </font></span></td>
                        <td width="210" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Descripcion General del Bien </font></td>
                        <td width="125" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt"><font color="#FFFFFF">Accion</font></span></td>
                      </tr>
<?
if ($termino=="")
{					  
	echo "Escriba el termino de busqueda";
}else{


			list($anio,$codigo_contrato) = split( '-', $termino );
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
			
//			SELECT tb3.descripcion,concat('2008-',(tb1.codigo_contrato)),concat(dayofmonth(tb1.fecha_inicio),'/',month(tb1.fecha_inicio),'/',year(tb1.fecha_inicio),' ',hour(tb1.fecha_inicio),':',minute(tb1.fecha_inicio),':',second(tb1.fecha_inicio)),concat(tb2.primer_nombre,'-',tb2.segundo_nombre,'-',tb2.primer_apellido,'-',tb2.segundo_apellido),tb1.fecha_inicio,tb1.codigo_detalle_contrato FROM detalle_contrato_bien tb3,  tb_contrato_garantia_detalle tb1, tb_contrato_involucrado tb4, tb_persona tb2 WHERE  tb1.codigo_detalle_contrato = tb4.codigo_detalle_contrato AND tb4.codigo_persona_individual = tb2.codigo_persona_individual AND tb4.codigo_actuacion = 1 AND tb3.descripcion like '%all%'  AND tb1.codigo_detalle_contrato = tb3.codigo_detalle_contrato ;
	if($criterio == 1)
		{
			//$result = mysql_query("SELECT concat('2008-',(tb1.codigo_contrato)),concat(dayofmonth(tb1.fecha_inicio),'/',month(tb1.fecha_inicio),'/',year(tb1.fecha_inicio),' ',hour(tb1.fecha_inicio),':',minute(tb1.fecha_inicio),':',second(tb1.fecha_inicio)),tb2.primer_nombre,tb1.fecha_inicio,tb1.codigo_detalle_contrato FROM  tb_contrato_garantia_detalle tb1, tb_contrato_involucrado tb4, tb_persona tb2 WHERE  tb1.codigo_detalle_contrato = tb4.codigo_detalle_contrato AND tb4.codigo_persona_individual = tb2.codigo_persona_individual AND tb4.codigo_actuacion = 1 AND tb1.codigo_contrato = '$codigo_contrato'");
			$result = mysql_query("SELECT concat('2008-',(tb1.codigo_contrato)),concat(dayofmonth(tb1.fecha_inicio),'/',month(tb1.fecha_inicio),'/',year(tb1.fecha_inicio),' ',hour(tb1.fecha_inicio),':',minute(tb1.fecha_inicio),':',second(tb1.fecha_inicio)),concat(tb2.primer_nombre,'-',tb2.segundo_nombre,'-',tb2.primer_apellido,'-',tb2.segundo_apellido),tb1.fecha_inicio,tb1.codigo_detalle_contrato FROM  tb_contrato_garantia_detalle tb1, tb_contrato_involucrado tb4, tb_persona tb2 WHERE  tb1.codigo_detalle_contrato = tb4.codigo_detalle_contrato AND tb4.codigo_persona_individual = tb2.codigo_persona_individual AND tb4.codigo_actuacion = 1 AND tb1.codigo_contrato = '$codigo_contrato'");
		}
	if($criterio == 2)
		{
				$result = mysql_query("SELECT concat('2008-',(tb1.codigo_contrato)),concat(dayofmonth(tb1.fecha_inicio),'/',month(tb1.fecha_inicio),'/',year(tb1.fecha_inicio),' ',hour(tb1.fecha_inicio),':',minute(tb1.fecha_inicio),':',second(tb1.fecha_inicio)),tb2.primer_nombre,tb3.descripcion,tb1.codigo_detalle_contrato FROM detalle_contrato_bien tb3, tb_contrato_garantia_detalle tb1, tb_contrato_involucrado tb4, tb_persona tb2 WHERE  tb1.codigo_detalle_contrato = tb3.codigo_detalle_contrato AND tb1.codigo_detalle_contrato = tb4.codigo_detalle_contrato AND tb4.codigo_persona_individual = tb2.codigo_persona_individual AND tb4.codigo_actuacion = 1 AND tb2.cedula LIKE '%$termino%'");
		}
		
	if($criterio ==3)		
		{
				$result = mysql_query("SELECT concat('2008-',(tb1.codigo_contrato)),concat(dayofmonth(tb1.fecha_inicio),'/',month(tb1.fecha_inicio),'/',year(tb1.fecha_inicio),' ',hour(tb1.fecha_inicio),':',minute(tb1.fecha_inicio),':',second(tb1.fecha_inicio)),concat(tb2.primer_nombre,'-',tb2.segundo_nombre,'-',tb2.primer_apellido,'-',tb2.segundo_apellido),tb1.fecha_inicio,tb1.codigo_detalle_contrato FROM  tb_contrato_garantia_detalle tb1, tb_contrato_involucrado tb4, tb_persona tb2 WHERE  tb1.codigo_detalle_contrato = tb4.codigo_detalle_contrato AND tb4.codigo_persona_individual = tb2.codigo_persona_individual AND tb4.codigo_actuacion = 1 AND concat(tb2.primer_nombre,'-',tb2.segundo_nombre,'-',tb2.primer_apellido,'-',tb2.segundo_apellido) LIKE '%$termino%'");
		}
							
			if ($result ) 
			{

				
					while($row = mysql_fetch_row($result))
					{

							  print"<tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
							  print"<TD width='84'><span class='style9'><font color='#335B96'>$row[0]</font></span></TD>";
							  print"<TD width='113'><span class='style9'>$row[1]</span></TD>";
							  print"<TD width='135'><span class='style9'>$row[2]</span></TD>";
							  print"<TD width='200'><span class='style9'>".substr($row[3],0,35)."...</span></TD>";			
							  print"<TD width='125'><div align='left'><span class='Estilo1'><a href='vercontrato1.php?codigo=".$row[4]."' target='_self'><img src='../imagen/edit-paste.gif' width='32' height='32' border='0'></a></span></div></TD>";
							  print"</tr>";		 							
						}
mysql_close($db);	

			}						
		}			
		
		


?>
                      <tr>
                        <td width="95"></td>
                      </tr>
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
      <p>&nbsp;</p>
    </div></td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
</body>

</html>
