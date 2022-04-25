<?
	session_start();
	if ($_SESSION['this_cookie']== "")
	{
		$grupo=1;
	}
	else
		{					    
			$grupo = $_SESSION['group_id'];;		
		}
?>
<HTML>
<HEAD>
<meta http-equiv="Content-Language" content="es">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <style type="text/css"><!--
   .header {font-family:Tahoma, sans-serif; font-size: 12px; COLOR:#2FFFFF; padding-left:10; padding-right:5; font-weight:900 }
   .text {font-family:Tahoma,sans-serif; font-size: 11px; color:#000000; padding-left:20; padding-right:10 }
   .text2 {font-family:Verdana,sans-serif; font-size: 10px; color:#ffffff; padding-left:20; padding-right:10 }
    .news {font-family:Arial, sans-serif; font-size: 9px; color:#ffffff; padding-left:10; padding-right:5; font-weight:900; }
   a:link{text-decoration: none; color:#FFFFFF}
  a:visited{text-decoration: none; color: #FFFFFF}
  a:hover{text-decoration: underline; color: #FFFFFF}
  a:active{text-decoration: none; color: #FFFFFF}
li {
	list-style : url(images/pic.jpg);
}

--></style>
<?
	$gisett=(int)date("w");
	$mesnum=(int)date("m");
	$hora = date(" H:i",time());
?>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_usuario.value == "0")
  { 
  	alert("Seleccione su nombre"); 
	form.cbo_usuario.focus(); 
	return;
  }
  if (form.cbo_categoria.value == "0")
  { 
  	alert("Seleccione el tipo de asistencia que desea"); 
	form.cbo_soporte.focus(); 
	return;
  }
  if (form.txt_detalle_solicita.value == "")
  { 
  	alert("Describa en forma concisa su solicitud"); 
	form.txt_detalle_solicita.focus(); 
	return;
  }  
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_usuario.focus(); 
}
</script>
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 background="imagenes/bg.jpg">
<!--Julio Chavarria -->
<div align="center">
<TABLE WIDTH=780 BORDER=0 CELLPADDING=0 CELLSPACING=0 height=100% bgcolor="#FFFFFF">
	<TR><td bgcolor=#000000 rowspan=99><img src="imagenes/spacer.gif" width="1" height="1" with=1></td>
		<TD WIDTH=780 HEIGHT=174 COLSPAN=14>
			<IMG SRC="imagenes/01.jpg" WIDTH=780 HEIGHT=174 ALT=""></TD>
			<td bgcolor=#000000 rowspan=99><img src="imagenes/spacer.gif" width="1" height="1" with=1></td>
	</TR>
	<TR>
		<TD WIDTH=64 HEIGHT=42>
				<IMG SRC="imagenes/02.jpg" WIDTH=64 HEIGHT=42 BORDER=0 ALT=""></A></TD>
		<TD WIDTH=58 HEIGHT=42>
				<IMG SRC="imagenes/03.jpg" WIDTH=58 HEIGHT=42 BORDER=0 ALT=""></A></TD>
		<TD WIDTH=58 HEIGHT=42 COLSPAN=2>
				<IMG SRC="imagenes/04.jpg" WIDTH=58 HEIGHT=42 BORDER=0 ALT=""></A></TD>
		<TD WIDTH=71 HEIGHT=42 COLSPAN=2>
				<IMG SRC="imagenes/05.jpg" WIDTH=71 HEIGHT=42 BORDER=0 ALT=""></A></TD>
		<TD WIDTH=76 HEIGHT=42>
				<IMG SRC="imagenes/06.jpg" WIDTH=76 HEIGHT=42 BORDER=0 ALT=""></A></TD>
		<TD WIDTH=77 HEIGHT=42 COLSPAN=2>
				<IMG SRC="imagenes/07.jpg" WIDTH=77 HEIGHT=42 BORDER=0 ALT=""></A></TD>
		<TD WIDTH=100 HEIGHT=42 COLSPAN=2>
			<A HREF="#">
				<IMG SRC="imagenes/08.jpg" WIDTH=100 HEIGHT=42 BORDER=0 ALT=""></A></TD>
		<TD WIDTH=276 HEIGHT=42 COLSPAN=3>
			<IMG SRC="imagenes/09.jpg" WIDTH=276 HEIGHT=42 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=780 HEIGHT=29 COLSPAN=14>
			<IMG SRC="imagenes/10.jpg" WIDTH=780 HEIGHT=29 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=140 HEIGHT=28 COLSPAN=3>
			<IMG SRC="imagenes/11.jpg" WIDTH=140 HEIGHT=28 ALT=""></TD>
		<TD WIDTH=82 HEIGHT=28 COLSPAN=2>			<img src="imagenes/12.jpg" width=82 height=28 alt=""></TD>
		<TD  COLSPAN=2 background="imagenes/13.jpg" WIDTH=105 HEIGHT=28 ALT="">
		<p align="center"></TD>
		<TD WIDTH=67 HEIGHT=28>
			<IMG SRC="imagenes/14.jpg" WIDTH=67 HEIGHT=28 ALT=""></TD>
		<TD   COLSPAN=2 background="imagenes/15.jpg" WIDTH=101 HEIGHT=28 ALT="">
		<p align="center"><b>Portal Mineco</b></TD>
		<TD WIDTH=23 HEIGHT=28 COLSPAN=2>
			<a href="http://www.mineco.gob.gt" target="_blank">
				<IMG SRC="imagenes/16.jpg" WIDTH=23 HEIGHT=28 BORDER=0 ALT="Portal Ministerio de Econom�a"></a></TD>
		<TD WIDTH=262 HEIGHT=28 COLSPAN=2>
			<IMG SRC="imagenes/17.jpg" WIDTH=262 HEIGHT=28 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=780 HEIGHT=25 COLSPAN=14>
			<IMG SRC="imagenes/18.jpg" WIDTH=780 HEIGHT=25 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=563 HEIGHT=100% valign="top" COLSPAN=13>
			<form method="post" action="solicitud2.php">
				
				<div align="center">
				    <p align="center"><b>
												  <font size="5" face="Book Antiqua">
												  Sistema Inform&aacute;tico SISTEC</font></b><iframe name="body" width="545" height="319" src="solicita.php" border="0" frameborder="0">El explorador no admite los marcos flotantes o no est� configurado actualmente para mostrarlos.</iframe>
			  </div>
			</form>	  </TD>
		<TD WIDTH=217 HEIGHT=100% valign="top" background="imagenes/rbg.jpg">
			<address><IMG SRC="imagenes/r1.jpg" width="217" height="52">
			</address>
			<address><font color="#ffffff">&nbsp;&nbsp;&nbsp;</font></address>
			<table border="0" width="209" id="table1">
				<tr>
					<td width="16">&nbsp;</td>
					<td>
					<p align="center"><b><u>MEN�</u></b></td>
				</tr>
				
              <?
				include("menu.php");
			  ?>
			</table>
			<address><font color="#ffffff">&nbsp;</font><IMG SRC="imagenes/r1.jpg" width="217" height="52">
			</address>
			<address>
			<?
				include("login.php");
			?>
			
			</address></TD>
	</TR>
	<TR>
		<TD COLSPAN=14 background="imagenes/21.jpg" WIDTH=780 HEIGHT=31 ALT="">
	  <p align="center">� Inform&aacute;tica Mineco Septiembre 2006<IMG height=3 src="imagenes/line_red.gif" width="1" border=0></TD>
	</TR>
	<TR>
		<TD WIDTH=64 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=64 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=58 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=58 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=18 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=18 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=40 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=40 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=42 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=42 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=29 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=29 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=76 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=76 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=67 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=67 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=10 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=10 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=91 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=91 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=9 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=9 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=14 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=14 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=45 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=45 HEIGHT=1 ALT=""></TD>
		<TD WIDTH=217 HEIGHT=1>
			<IMG SRC="imagenes/spacer.gif" WIDTH=217 HEIGHT=1 ALT=""></TD>
	</TR>
</TABLE>
</div>
</BODY>
</HTML>