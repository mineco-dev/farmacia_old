
<?
/*
session_start();
if (  $_SESSION['seguridad']==1 )
{
}
else
{
header("Location: error.php");
}
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<base target="principal">
<style type="text/css">
<!--
body {
	background-color: #CCCCCC;
	background-image: url();
}
a:link {
	color: #E0DFE3;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>
<?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */
   session_start();
		
?>
<SCRIPT language=javascript>
function cOn(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#006699";
}
}

function cOut(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#9DAFD3";
}
}

//-->
</SCRIPT>
<body>
<TABLE width="125%" border=0 cellPadding=0 cellSpacing=0 bordercolor="#666666" id="table1">
  <TBODY>
    <TR>
      <TD bgcolor="#CCCCCC"><div align="left"><img src="imagen/encabezado.jpg" alt="ARIANE" width="990" height="66"></div></TD>
    </TR>
  </TBODY>
</TABLE>
<TABLE height=20 cellSpacing=0 cellPadding=0 width="100%" border=0 id="table2">
  <TBODY>
    <TR>
      <TD width="100%" colspan="2" bgColor=#9DAFD3><TABLE width=990 border=0 align="left" cellPadding=0 cellSpacing=0 bgcolor="#000000" id="table3">
          <TBODY>
            <TR bgColor=#FF9900>
              <a href="centro.php"> </a>
              <TD 
          width=153 height="27" align=middle bgcolor="#9DAFD3" onmouseover=cOn(this); onmouseout=cOut(this);><font size="2" face="Arial, Helvetica, sans-serif"><a href="personas/apersona.php" target="mainFrame"><FONT class=bar_lnk><font color="#FFFFFF">Ingresar Personas</font></a></font></TD>
              <a href="centro.php"></a>
              
              <a href="QuejasAdmon/quejas.php">              </a>
              <TD 
          width=159 align=middle bgcolor="#9DAFD3" onmouseover=cOn(this); onmouseout=cOut(this);><font size="2" face="Arial, Helvetica, sans-serif"><a href="arancel/calcular.php" target="mainFrame"><FONT class=bar_lnk><font color="#FFFFFF">Buscar Personas</font></a></font></TD>
              <a href="QuejasAdmon/quejas.php"></a>
              <a href="Buscar/detalle_queja.php"></a>
              <TD 
          width=168 align=middle bgcolor="#9DAFD3" onmouseover=cOn(this); onmouseout=cOut(this);><font size="2" face="Arial, Helvetica, sans-serif"><a href="estadisticas/cdeudor.php" target="mainFrame"><FONT class=bar_lnk><font color="#FFFFFF">Consultas Electronicas </font></a></font></TD>
              <a href="Buscar/detalle_queja.php"></a>
              <a href="Reportes/Reportes.php"></a>
              <TD 
          width=84 align=middle bgcolor="#9DAFD3" onmouseover=cOn(this); onmouseout=cOut(this);><font size="2" face="Arial, Helvetica, sans-serif"><a href="estadisticas/reportes.php" target="mainFrame"><FONT class=bar_lnk><font color="#FFFFFF">Reportes </font></a></font></TD>
              <a href="Reportes/Reportes.php"></a>
              <a href="administrativo/quejasnovistas.php">              </a>
              <TD 
          width=115 align=middle bgcolor="#9DAFD3" onmouseover=cOn(this); onmouseout=cOut(this);><font size="2" face="Arial, Helvetica, sans-serif"><a href="http://WWW.MINECO.GOB.GT" target="_parent"><FONT class=bar_lnk><font color="#FFFFFF">MINECO</font></a></font></TD>
              <TD 
          width=112 align=middle bgcolor="#9DAFD3" onmouseover=cOn(this); onmouseout=cOut(this);><font size="2" face="Arial, Helvetica, sans-serif"><a href="centro.php" target="mainFrame"><FONT class=bar_lnk><font color="#FFFFFF">Principal</font></a></font></TD>
              <a href="administrativo/quejasnovistas.php"></a>
		  <a href="index.php" target="_top"></a>
		  <TD 
          width=89 align=middle bgcolor="#9DAFD3" onmouseover=cOn(this); onmouseout=cOut(this);><font size="2" face="Arial, Helvetica, sans-serif"><a href="index.php" target="_parent"><FONT class=bar_lnk><font color="#FFFFFF">Cerrar Sesion </font></a><a href="http://master_diaco/sic/index.php" target="_parent"></a></font></TD>
		  <a href="index.php" target="_top"></a>            </TR>
          </TBODY>
      </TABLE></TD>
    </TR>
  </TBODY>
</TABLE>

</body>
</html>
