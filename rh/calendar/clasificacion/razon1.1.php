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

	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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

<table width="85%" border="0" align="center" cellpadding="0" cellspacing="6" bgcolor="#f8f8f8">
<tbody>
          
          <tr >
            <td colspan="6" class="BasicFont"><p class="ToolBoxInnerFrames">REGISTRO  DE GARANTÍAS MOBILIARIAS</p></td>
          </tr>
          <tr >
            <td colspan="6">&nbsp;</td>
          </tr>
          <tr >
            <td width="3600" colspan="6" class="BasicFont"><?php 
	
	
	require ('../class/conexion.inc');
	$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
	mysql_select_db($BASE_DATOS,$db);
	$numero_contrato = $codigo;
	$SQL = mysql_query("SELECT p.primer_nombre FROM tb_persona p, tb_contrato_involucrado ci, tb_contrato_garantia_detalle de WHERE  de.codigo_detalle_contrato = ci.codigo_detalle_contrato AND p.codigo_persona_individual = ci.codigo_persona_individual AND  ci.codigo_actuacion = 1 AND de.codigo_detalle_contrato = '$numero_contrato'");

	if ($SQL)
	{		
		while($test = mysql_fetch_array($SQL))
		{			
				print "<span class='BoldBasicFont'>".$test[0].", "."</span>";
		}						
	}		
	mysql_close($db);
	
?> se reconoce (n) deudor (a) (es) de 
              <?php 
	
	require ('../class/conexion.inc');
	$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
	mysql_select_db($BASE_DATOS,$db);
	$numero_contrato = $codigo;
	$SQL = mysql_query("SELECT p.primer_nombre FROM tb_persona p, tb_contrato_involucrado ci, tb_contrato_garantia_detalle de WHERE  de.codigo_detalle_contrato = ci.codigo_detalle_contrato AND p.codigo_persona_individual = ci.codigo_persona_individual AND  ci.codigo_actuacion = 2 AND de.codigo_detalle_contrato = '$numero_contrato'");

	if ($SQL)
	{		
		while($test = mysql_fetch_array($SQL))
		{			
				print "<span class='BoldBasicFont'>".$test[0].", "."</span>";
		}									
	}
		
	mysql_close($db);
	
?>
            por la suma de 
            <?php 
			
		
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
			$contador = 0;
		
			$documento = mysql_query("SELECT e.monto FROM tb_contrato_garantia_detalle de, tb_contrato_garantia e WHERE de.codigo_contrato = e.codigo_contrato and de.codigo_detalle_contrato = '$codigo'");
			if ($documento)
			{
				$vector = mysql_fetch_array($documento);
				echo  "<span class='BoldBasicFont'>".$vector[0]."</span>";
			}else{
				echo "...";
			}
			mysql_close($db);
?>
            , que pagará (n)
            en un plazo de 
           <?php 
			      
			
		
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
			$contador = 0;
		
			$documento = mysql_query("SELECT e.plazo_o_condicion FROM tb_contrato_garantia_detalle de, tb_contrato_garantia e WHERE de.codigo_contrato = e.codigo_contrato and de.codigo_detalle_contrato = '$codigo'");
			if ($documento)
			{
				$vector = mysql_fetch_array($documento);
				echo  "<span class='BoldBasicFont'>".$vector[0]." "."</span>";
			}else{
				echo "...";
			}
			mysql_close($db);

		/*function restaFechas($d2,$m2,$a2,$d1,$m1,$a1)
		{
			$date1 = mktime(0,0,0,$m1,$d1,$a1);
			$date2 = mktime(0,0,0,$m2,$d2,$a2);
			$segundos = ($date2 - $date1);	
			$dias_diferencia = $segundos / (60 * 60 * 24);
			$dias_diferencia = abs($dias_diferencia);
			$dias_diferencia = floor($dias_diferencia);
			return ($dias_diferencia);
		}
			
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
		
			$consulta = mysql_query("SELECT dayofmonth(de.fecha_final),month(de.fecha_final),year(de.fecha_final),dayofmonth(de.fecha_inicio),month(de.fecha_inicio),year(de.fecha_inicio)  FROM tb_contrato_garantia_detalle de WHERE  de.codigo_detalle_contrato = '$codigo'");
			if ($consulta)
			{
				$vector = mysql_fetch_array($consulta);
				$resultado_resta = restaFechas($vector[0],$vector[1],$vector[2],$vector[3],$vector[4],$vector[5]);
				echo $resultado_resta;			
			}else{
			
			}
				mysql_close($db);*/
?>
contado (s) a partir del 
 <?php 
			
		
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
		
			$consulta = mysql_query("SELECT dayofmonth(de.fecha_inicio),month(de.fecha_inicio),year(de.fecha_inicio)  FROM tb_contrato_garantia_detalle de WHERE  de.codigo_detalle_contrato = '$codigo'");
			if ($consulta)
			{
				$vector = mysql_fetch_array($consulta);
				echo "<span class='BoldBasicFont'>".$vector[0]."/".$vector[1]."/".$vector[2]."</span>";			
			}else{
			
			}
				mysql_close($db);
?>
. Interes 
          <?php 
			
		
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
			$contador = 0;
		
			$documento = mysql_query("SELECT e.interes FROM tb_contrato_garantia_detalle de, tb_contrato_garantia e WHERE de.codigo_contrato = e.codigo_contrato and de.codigo_detalle_contrato = '$codigo'");
			if ($documento)
			{
				$vector = mysql_fetch_array($documento);
				echo  "<span class='BoldBasicFont'>".$vector[0]."</span>";
			}else{
				echo "...";
			}
			mysql_close($db);
?>
%. En garantia del cr&eacute;dito el (la) (los) deudor (a) (es) otorgan la siguiente (s) garant&iacute;a (s) mobiliairia (s) : 
<?php 
			
		
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
			$contador = 0;
		
			$bienes = mysql_query("SELECT b.descripcion FROM tb_contrato_garantia_detalle de, detalle_contrato_bien b WHERE b.codigo_detalle_contrato = de.codigo_detalle_contrato and de.codigo_detalle_contrato = '$codigo' ");
			$cantidad_bienes = mysql_query("SELECT count(b.codigo_detalle_contrato_bien) FROM tb_contrato_garantia_detalle de, detalle_contrato_bien b WHERE b.codigo_detalle_contrato = de.codigo_detalle_contrato and de.codigo_detalle_contrato = '$codigo'");
			if ($bienes)
			{
				//$inscripcion = mysql_fetch_array($cantidad_bienes);
			print "<hr />";
				while($descripcion = mysql_fetch_array($bienes))
				{
						//print "</br>";
						print "<span class='BoldBasicFont'>"; print $descripcion[0]."</span>";
						print "<hr />";
				}							
			}else{
				echo "...";
			}
			mysql_close($db);
?> Escritura (documento) autorizado el dia 
<?php 
			
		
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
		
			$documento = mysql_query("SELECT dayofmonth(e.fecha_celebracion),month(e.fecha_celebracion),year(e.fecha_celebracion) FROM tb_contrato_garantia_detalle de, tb_contrato_garantia e WHERE de.codigo_contrato = e.codigo_contrato and de.codigo_detalle_contrato = '$codigo'");
			if ($documento)
			{

				$vector = mysql_fetch_array($documento);
				echo  "<span class='BoldBasicFont'>".$vector[0]." de ";
				
				if ($vector[1] == 1)
				echo "Enero";
				if ($vector[1] == 2)
				echo "Febrero";
				if ($vector[1] == 3)
				echo "Marzo";
				if ($vector[1] == 4)
				echo "Abril";
				if ($vector[1] == 5)
				echo "Mayo";
				if ($vector[1] == 6)
				echo "Junio";
				if ($vector[1] == 7)
				echo "Julio";
				if ($vector[1] == 8)
				echo "Agosto";
				if ($vector[1] == 9)
				echo "Septiembre";
				if ($vector[1] == 10)
				echo "Octubre";
				if ($vector[1] == 11)
				echo "Noviembre";
				if ($vector[1] == 12)
				echo "Diciembre";
					
				echo  " de ".$vector[2]." "."</span>";
			}else{
				echo "...";
			}
			mysql_close($db);
?>por el Notario 
<?php 
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
		
			$documento = mysql_query("SELECT concat((a.nombre1_abogado),' ',(a.nombre2_abogado),' ',(a.apellido1_abogado),' ',(a.apellido2_abogado)) FROM tb_contrato_garantia_detalle de, tb_abogado a WHERE de.codigo_contrato = a.codigo_abogado and de.codigo_detalle_contrato = '$codigo' and de.codigo_abogado = a.codigo_abogado ");
			if ($documento)
			{
				$vector = mysql_fetch_array($documento);
				echo  "<span class='BoldBasicFont'>".$vector[0].". "."</span>";
			}else{
				echo "...";
			}
			mysql_close($db);
?> Documeno presentado del dia 
<?php 
			
		
		
			require ('../class/conexion.inc');
			$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
			mysql_select_db($BASE_DATOS,$db);
		
			$documento = mysql_query("SELECT dayofmonth(de.fecha_creado),month(de.fecha_creado),year(de.fecha_creado),hour(de.fecha_creado),minute(de.fecha_creado),second(de.fecha_creado) FROM tb_contrato_garantia_detalle de WHERE  de.codigo_detalle_contrato = '$codigo'");
			if ($documento)
			{

				$vector = mysql_fetch_array($documento);
				echo  "<span class='BoldBasicFont'>".$vector[0]." de ";
				
				if ($vector[1] == 1)
				echo "Enero";
				if ($vector[1] == 2)
				echo "Febrero";
				if ($vector[1] == 3)
				echo "Marzo";
				if ($vector[1] == 4)
				echo "Abril";
				if ($vector[1] == 5)
				echo "Mayo";
				if ($vector[1] == 6)
				echo "Junio";
				if ($vector[1] == 7)
				echo "Julio";
				if ($vector[1] == 8)
				echo "Agosto";
				if ($vector[1] == 9)
				echo "Septiembre";
				if ($vector[1] == 10)
				echo "Octubre";
				if ($vector[1] == 11)
				echo "Noviembre";
				if ($vector[1] == 12)
				echo "Diciembre";
					
				echo  " de ".$vector[2]." "."a las ".$vector[3]." horas con ".$vector[4]." minutos y ".$vector[5]." segundos, "."</span>";
			}else{
				echo "...";
			}
			mysql_close($db);
?> ingresado &eacute;ste y sus copias electronicas con n&uacute;mero <? print "<span class='BoldBasicFont'>"; print "2008-".$codigo.".</span>"  ;?> Honorario <? print "<span class='BoldBasicFont'>"; ?>Q.150.00.<? print "</span>"?> Guatemala, el dia <? print "<span class='BoldBasicFont'>".date("d")." "."</span>"; ?>de <? print "<span class='BoldBasicFont'>";
if (date("m")==1)
print "Enero ";
if (date("m")==2)
print "Febrero ";
if (date("m")==3)
print "Marzo ";
if (date("m")==4)
print "Abril ";
if (date("m")==5)
print "Mayo ";
if (date("m")==6)
print "Junio ";
if (date("m")==7)
print "Julio ";
if (date("m")==8)
print "Agosto ";
if (date("m")==9)
print "Septiembre ";
if (date("m")==10)
print "Octubre ";
if (date("m")==11)
print "Noviembre ";
if (date("m")==12)
print "Diciembre "; print "</span>"; ?>de <? print "<span class='BoldBasicFont'>"; print date("Y")." "."</span>";?> .</td>
          </tr>
          <tr >
            <td height="32" colspan="6" class="BasicFont2">ESTA INSCRIPCION SURTE EFECTO CONTRA TERCEROS DESDE LA FECHA DE LA ENTREGA DEL DOCUMENTO AL REGISTRO. </td>
          </tr>
          <tr >
            <td height="57" colspan="6" class="BottomShadow2">&nbsp;</td>
          </tr>

    </tbody> 
  </table>
<p align="center">&nbsp;</p>


</body>
</html>
