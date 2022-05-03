<?
session_start();
if ($_COOKIE['seguridad']==1)
{
}else{
	header('Location: ../error.php');
}
	
	
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
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
td.style.backgroundColor="#FFFFFF";
}
}

//-->
</SCRIPT>
</head>

<body>

<table width="864" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td width="864" background="IMAGENES/foncentral2.png"><div align="center">
      <table width="85%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="19" class="Error404SubTitle"><div align="right"><a href="menu.php" target="_self"><img src="../imagen/bac.jpg" width="71" height="18" border="0"></a></div></td>
        </tr>
        <tr>
          <td height="19" class="BiggerGrayWriting"><span class="Error404SubTitle">Transferencia de Expedientes </span></td>
        </tr>
        <tr>
          <td width="12" height="19" class="BiggerGrayWriting">&nbsp;</td>
          </tr>
      </table>
      <table width="85%" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" bgcolor="#FFFFFF">
        <tr>
          <td width="737" height="85" colspan="3"><div align="center">
              <div align="center">
                <table width="100%" 
                        border=0 align="center" cellpadding=0 cellspacing=1 bordercolor="#CCCCCC" bgcolor="#CCCCCC" class="TuringHelp" id="table27">
                  <tbody>
                    <tr>
                      <td width="95" align="center" bgcolor="#000000"><span class="style10"><font color="#FFFFFF">Codigo </font></span></td>
                      <td width="127" align="center" bgcolor="#000000"><span class="style10" lang="es-gt"><font color="#FFFFFF">Fecha</font></span></td>
                      <td width="421" align="center" bgcolor="#000000"><span class="GrayLink" lang="es-gt"><font color="#FFFFFF">Descripcion</font></span><font color="#FFFFFF"> del Bien </font></td>
                      <td width="80" align="center" bgcolor="#000000"><span class="GrayLink" lang="es-gt"><font color="#FFFFFF">Accion</font></span></td>
                    </tr>
                    <?
				  
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
			$result = mysql_query("SELECT concat('2008-',c.codigo_detalle_contrato),c.fecha_inicio,d.descripcion,c.codigo_detalle_contrato from tb_contrato_garantia_detalle c, detalle_contrato_bien d WHERE d.codigo_detalle_contrato = c.codigo_detalle_contrato and c.usuario='$codigo'");
			if ($result ) 
			{

				
					while($row = mysql_fetch_row($result))
					{
				
							  print"<tr > ";
							  print"<TD width='95'><div align='center'><span class='style9'><font color='#335B96'>$row[0]</font></span></div></TD>";
							  print"<TD width='127'><div align='center'><span class='style9'>$row[1]</span></div></TD>";
							  print"<TD width='421'><div align='center'><span class='style9'>$row[2]</span></div></TD>";
							  print"<TD width='80'><div align='center'><a href='cargar.php?codigo=".$row[3]."' target='_self'><img src='../imagen/buscar.png' width='28' height='38' border='0'></a></div></TD>";
							  print"</tr>";		 							
					}
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
    </div></td>
  </tr>
  <tr>
    <td background="IMAGENES/foncentral2.png">&nbsp;</td>
  </tr>
  <tr>
    <td background="IMAGENES/foncentral2.png">&nbsp;</td>
  </tr>
</table>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
</body>

</html>
