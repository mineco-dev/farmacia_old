
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

//-->
</SCRIPT>
</head>

<body>

<table width="891" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td background="IMAGENES/foncentral2.png"><div align="center">
      <table width="83%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td height="47" background="../imagen/chromebg.gif">&nbsp;</td>
          <td background="../imagen/chromebg.gif">&nbsp;</td>
          <td width="219" background="../imagen/chromebg.gif">&nbsp;</td>
          <td background="../imagen/chromebg.gif">&nbsp;</td>
        </tr>
        
        <tr>
          <td class="BiggerGrayWriting">&nbsp;</td>
          <td class="BasicFontInBorder3">Clasificacion de Bienes </td>
          <td rowspan="4" class="TuringHelp"><table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
            <tr>
              <td height="96"><table width="258" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2" class="BasicFontInBorder4"><? print "Bienvenido ".$_COOKIE['login1'];?>&nbsp;</td>
                  </tr>
                <tr>
                  <td width="217" class="TuringHelp">Clasificacion de Bienes</td>
                  <td width="34" class="TuringHelp"><img src="../imagen/editar.gif" width="26" height="26"></td>
                </tr>
                <tr>
                  <td class="TuringHelp">&nbsp;</td>
                  <td class="TuringHelp">&nbsp;</td>
                </tr>
                <tr>
                  <td class="TuringHelp">&nbsp;</td>
                  <td class="TuringHelp">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td class="BiggerGrayWriting">&nbsp;</td>
        </tr>
        <tr>
          <td width="62" class="BiggerGrayWriting">&nbsp;</td>
          <td width="401" class="BiggerGrayWriting"><div align="left"></div></td>
          <td width="22" class="BiggerGrayWriting">&nbsp;</td>
        </tr>
        <tr>
          <td height="32" class="BiggerGrayWriting">&nbsp;</td>
          <td rowspan="2" class="BiggerGrayWriting"><table width="91%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="52%" class="LearnMoreRow">Lectura y Atencion de los Expedientes del Verificador </td>
                <td width="4%" height="36" class="LearnMoreRow">&nbsp;</td>
                <td width="16%" class="BiggerGrayWriting"><a href="buscar.php"><img src="../imagen/buscar.gif" width="50" height="50" border="0"></a></td>
                <td width="14%" class="BiggerGrayWriting"><span class="LearnMoreRow"><a href="abogados.php" target="_blank"><img src="../imagen/U.gif" alt="." width="50" height="50" border="0"></a></span></td>
                <td width="14%" class="BiggerGrayWriting"><a href="busbienes.php"><img src="../imagen/consulta.gif" width="50" height="50" border="0"></a></td>
                </tr>
            <tr>
              <td class="LearnMoreRow">&nbsp;</td>
              <td height="18" class="LearnMoreRow"><div align="center" class="MenuFooterSite"></div></td>
                <td class="TuringHelp">Busquedas</td>
                <td class="BiggerGrayWriting"><span class="TuringHelp">Abogados</span></td>
                <td class="TuringHelp">Bienes</td>
                </tr>
                    </table></td>
          <td class="BiggerGrayWriting">&nbsp;</td>
        </tr>
        <tr>
          <td height="19" class="BiggerGrayWriting">&nbsp;</td>
          <td class="BiggerGrayWriting">&nbsp;</td>
        </tr>
      </table>
      <FORM ACTION="repdoctos.php" target="_self">
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
                  <tr>
                    <td width="54%" height="26" bgcolor="#EBF1F1"><div align="left" class="PaymentTableCaption"><span class="style10">
                      <INPUT NAME="termino" TYPE="text" SIZE="30" MAXLENGTH="30">
&nbsp;
<input name="btnInsertar"type="submit" class="TuringHelp"id="btnInsertar" value="Buscar">
                    </span><span class="style10"><span class="style8"><span class="style6">
         
                    </span></span></span></div></td>
                    <td width="8%" class="weight6"><div align="center">Paginas:</div></td>
                    <td width="38%" bgcolor="#EBF1F1"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
					<?PHP 
						require ('../class/conexion.inc');
						$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						mysql_select_db($BASE_DATOS,$db);																		
						$SQL = mysql_query("SELECT count(tb1.codigo_detalle_contrato_bien) FROM detalle_contrato_bien tb1 WHERE  tb1.codigo_detalle_contrato = '$codigo'");
						$rows = mysql_fetch_row($SQL);
						$h = $rows[0];
						$paginas = round($h/10);

						for($p=0;$p<=$paginas;$p++)
						{

							 echo "<a href='verbienes.php?conta=$p' target='_self' ><td class='MenuFooterSite' onmouseover=cOn(this); onmouseout=cOut(this);> $p </td> </a>";
						}
						
						mysql_close($db);            						
					?>
					
					<div align="left"></div></tr></table></td>
                  </tr>
                </table>
              <div align="center">
                  <table width="735" 
                        border=0 align="center" cellpadding=0 cellspacing=1 bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                    <tbody>
                      <tr>
                        <td width="95" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style10"><font color="#FFFFFF">Codigo </font></span></td>
                        <td width="127" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="style10" lang="es-gt"><font color="#FFFFFF">Numero Unico de ID </font></span></td>
                        <td width="154" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt"><font color="#FFFFFF">Dominio Registral </font></span></td>
                        <td width="210" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><font color="#FFFFFF">Descripcion General del Bien </font></td>
                        <td width="125" align="center" bordercolor="#990066" background="../imagen/blue_bg.gif" bgcolor="#000000"><span class="GrayLink" lang="es-gt"><font color="#FFFFFF">Accion</font></span></td>
                      </tr>
<?
	require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
			$result = mysql_query("SELECT tb3.codigo_detalle_contrato_bien,tb3.numero_unico_identificacion,tb3.codigo_detalle_contrato_bien,tb3.descripcion, tb3.codigo_detalle_contrato_bien FROM detalle_contrato_bien tb3 WHERE   tb3.codigo_detalle_contrato = '$codigo' ");
			if ($result ) 
			{
				$val23=0; // este es un contador del vector para crear las paginas	
				
					while($row = mysql_fetch_row($result))
					{
						if (($val23>=$conta*10) && ($val23<$conta*10+10))
						{	
							  print"<tr onmouseover=cOn(this); onmouseout=cOut(this);> ";
							  print"<TD width='84'><span class='style9'><font color='#335B96'>$row[0]</font></span></TD>";
							  print"<TD width='113'><span class='style9'>$row[1]</span></TD>";
							  print"<TD width='135'><span class='style9'>$row[2]</span></TD>";
							  print"<TD width='200'><span class='style9'>".substr($row[3],0,50)."...</span></TD>";			
							  print"<TD width='125'><div align='left'><span class='Estilo1'><a href='consultar.php?codigo=".$row[4]."' target='_self'><img src='../imagen/editar.gif' width='26' height='26' border='0'></a></span></div></TD>";
							  print"</tr>";		 							
						}
						$val23++;
					}// fin del WHILE						
			}						
		mysql_close($db);	


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
