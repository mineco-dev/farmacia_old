

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<style type="text/css">
<!--
.style9 {font-size: 10px}
-->
</style>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
	<link rel="stylesheet" type="text/css" href="../css/clasificacion.css">
	<link href="images/cssWeb.css" type=text/css rel=StyleSheet>
	<link rel="stylesheet" type="text/css" media="all" href="calendar/calendar-win2k-1.css" title="win2k-1" />
	<script type="text/javascript" src="calendar/calendar.js"></script>
	<script type="text/javascript" src="calendar/lang/calendar-en.js"></script>
	<script type="text/javascript" src="calendar/calendar-setup.js"></script>
		
	<style>
		#search, ul { padding: 3px; width: 150px; border: 1px solid #999; font-family: verdana; arial, sans-serif; font-size: 12px;}
	ul { list-style-type: none; font-family: verdana; arial, sans-serif; font-size: 12px;  margin: 5px 0 0 0}
	li { margin: 0 0 5px 0; cursor: default; color: red;}
	li:hover { background: #ffc; }
.Estilo3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
    body {
	background-color: #f8f8f8;
	background-image: url(../imagen/bg.gif);
}
.style1 {font-family: Arial, Helvetica, sans-serif}
    .style4 {font-family: Verdana, Arial, Helvetica, sans-serif; }
    </style>
	
</head>

<body>

<h2 class="style4">&nbsp;</h2>
<FORM ACTION="iseguimiento.php">
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#f8f8f8" class="GrayBasicFont">
  <tr>
    <td><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td></td>
        </tr>
      <tr>
        <td width="583"><img src="../imagen/seguimiento.jpg" alt="." width="237" height="30" /></td>
        <td width="71">&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
          <tr class="BasicFontInBorder2">
            <td class="HelpGrayOption">&nbsp;</td>
            <td colspan="6" class="HelpGrayOption">Expediente: <? print "2008-".$codigo;?>&nbsp;
              <input type="hidden" name="expediente" value="<? print "2008-".$codigo;?>" />
              <input name="cod" type="hidden" id="cod" value="<? print $codigo;?>" /></td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td class="HelloUser">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td class="TuringHelp">Fecha</td>
            <td>&nbsp;</td>
            <td class="label">       <input type="text" name="fecha" id="x_fec_nacimiento"  />
	                    &nbsp;<img src="images/ew_calendar.gif" id="cx_fec_nacimiento" alt="Seleccione una fecha" style="cursor:pointer;cursor:hand;" />
                <script type="text/javascript">
							/*Calendar.setup(
							{
							inputField : "x_fec_nacimiento", // ID of the input field
							ifFormat : "%d/%m/%Y", // the date format
							button : "cx_fec_nacimiento" // ID of the button
							}
							);*/
							
							
							Calendar.setup(
							{
							inputField : "fecha", // ID of the input field
							ifFormat : "%Y/%m/%d", // the date format
							button : "cx_fec_nacimiento" // ID of the button
							}
							);
							
</script>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td width="3%" class="HelloUser">&nbsp;</td>
            <td width="21%" class="TuringHelp">Observaciones:</td>
            <td width="3%">&nbsp;</td>
            <td width="60%" class="label"><textarea name="observaciones" cols="50" rows="8"> </textarea></td>
            <td width="4%">&nbsp;</td>
            <td width="4%">&nbsp;</td>
            <td width="5%">&nbsp;</td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td class="TuringHelp"><span class="EditPreferencesBrackets">Asignacion de Estatus </span></td>
            <td>&nbsp;</td>
            <td class="label">
              <select name="codigo_estado" size="8">
                <?
						require ('../class/conexion.inc');
						$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						mysql_select_db($BASE_DATOS,$db);
						$select = mysql_query("SELECT codigo_estado,detalle FROM tb_estado");
						if ($select)
						{
							while($vec = mysql_fetch_row($select))
							{	
								print "<option value ='$vec[0]' selected> $vec[1]</option>";
							}
							
						}else{
							print "los datos no se pudieron mostrar ERROR 401";
							
						}
						mysql_close($db);

			?>
              </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td class="HelloUser">&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="btnInsertar" type="submit" value="Insertar Seguimiento" /></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td class="HelloUser">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td class="HelloUser">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<p class="style1">&nbsp;</p>

	
</body>
</html>
