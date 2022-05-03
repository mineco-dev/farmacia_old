<?php 
	
	
						require ('../class/conexion.inc');
						$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
						mysql_select_db($BASE_DATOS,$db);
if ($tbusqueda == 1)
{
	$consulta = mysql_query("select no_colegiado,fecha_colegiado,activo,nombre1_abogado,nombre2_abogado,apellido1_abogado,apellido2_abogado from tb_abogado where no_colegiado = '$termino'");
	if ($consulta)
	{
		$vector = mysql_fetch_row($consulta);
		if ($vector[☺2]==1)
		{
			$estado = "ACTIVO";
		}else{
			$estado = "INACTIVO";
		}
	}
	
}
if ($tbusqueda == 2)
{
	$consulta = mysql_query("select no_colegiado,fecha_colegiado,activo,nombre1_abogado,nombre2_abogado,apellido1_abogado,apellido2_abogado from tb_abogado where nombre1_abogado like '%$termino%'");
	if ($consulta)
	{
		$vector = mysql_fetch_row($consulta);
		if ($vector[☺2]=="1")
		{
			$estado = "ACTIVO";
		}else{
			$estado = "INACTIVO";
		}
		
	}
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
	<link rel="stylesheet" type="text/css" href="../css/clasificacion.css">
	
	<script type="text/javascript" src="../js/clasificar.js"></script>
	<script type="text/javascript" src="../js/prototype.js"></script>
	<script type="text/javascript" src="../js/effects.js"></script>
	<script type="text/javascript" src="../js/controls.js"></script>
	
	<style>
		#search, ul { padding: 3px; width: 150px; border: 1px solid #999; font-family: verdana; arial, sans-serif; font-size: 12px;}
	ul { list-style-type: none; font-family: verdana; arial, sans-serif; font-size: 12px;  margin: 5px 0 0 0}
	li { margin: 0 0 5px 0; cursor: default; color: red;}
	li:hover { background: #ffc; }
    body {
	background-color: #f8f8f8;
	background-image: url(../imagen/bg.gif);
}
.style1 {font-family: Arial, Helvetica, sans-serif}
.style3 {
	font-size: 13px;
	font-weight: bold;
}
    .style4 {font-family: Verdana, Arial, Helvetica, sans-serif; }
.style8 {font-family: Geneva, Arial, Helvetica, sans-serif; color: #990000; font-size: 12px;}
    </style>
	
</head>

<body>
<FORM ACTION="<?=$_SERVER['PHP_SELF'];?>">
  <table width="59%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#f8f8f8" class="GrayBasicFont">
  <tr>
    <td><table width="77%" border="0" align="center" cellpadding="0" cellspacing="0.">
      <tr>
        <td>&nbsp;</td>
        <td><div align="center"><strong>[</strong><a href="javascript:window.close()" target="_self">cerrar</a><strong>]</strong></div></td>
        </tr>
      <tr>
        <td width="654"><img src="../imagen/abogados.png" alt="." width="237" height="30" /></td>
        <td width="71">&nbsp;</td>
        </tr>
      <tr>
        <td>                    <table width="576" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="160">Seleccione el Criterio </td>
            <td width="416">Escriba el Termino </td>
          </tr>
          <tr>
            <td><select name="tbusqueda" id="tbusquejda">
			<option value="1"> Numero de Colegiado</option>
			<option value="2"> Nombre del Abogado </option>
			</select>&nbsp;</td>
            <td><input name="termino" id="termino" size="40" />&nbsp; </td>
          </tr>
          <tr>
		  
            <td><input name="btnInsertar2"type="submit"id="btnInsertar25" value="BUSCAR" /></td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="HelloUser">No Colegiado </td>
            <td><input name="colegiado" type="text"   size="20" value="<? print $vector[0];?>" /></td>
          </tr>
          <tr>
            <td class="HelloUser">Fecha Colegiado </td>
            <td><input name="fecha" type="text"   size="20" value="<? print $vector[1];?>" />
&nbsp;</td>
          </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="HelloUser">Estatus Actual </td>
            <td><input name="estatus" type="text"   size="30" value="Activo" /></td>
          </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="19%" class="HelloUser">&nbsp;</td>
            <td width="81%">&nbsp;</td>
          </tr>
          <tr>
            <td class="HelloUser">Primer Nombre </td>
            <td><input name="nombre1" type="text"   size="50" value="<? print $vector[3];?>" />
          &nbsp;</td>
          </tr>
          <tr>
            <td class="HelloUser">Segundo  Nombre </td>
            <td><input name="nombre2" type="text"   size="50" value="<? print $vector[4];?>" />
          &nbsp;</td>
          </tr>
          <tr>
            <td class="HelloUser">Primer Apellido </td>
            <td><input name="apellido1" type="text"   size="50" value="<? print $vector[5];?>" />
          &nbsp;</td>
          </tr>
          <tr>
            <td class="HelloUser">Segundo Apellido </td>
            <td><input name="apellido2" type="text"   size="50" value="<? print $vector[6];?>" /></td>
          </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="HelloUser">&nbsp;</td>
            <td><input name="btnInsertar"type="submit"id="btnInsertar" value="ACTUALIZAR" />&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</FORM>


	
</body>
</html>
