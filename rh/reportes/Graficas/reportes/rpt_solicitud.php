<?
include('../../../../includes/sqlcommand.inc');
include('../../../../includes/funciones.php');
conectardb($rrhh);


function get_cantidad($ids,$ta)
{
	$sql = "select count(idasesor) from asesor s  where	s.iddireccion = $ids and activo=1";
	$x = mssql_query($sql);
	$vec = mssql_fetch_array($x);
	return $vec[0];
}





function get_texto($f1,$f2,$ta)
{

/*$texto ='1;'.get_cantidad(1,$ta).'\n'.
			'2;'.get_cantidad(2,$ta).'\n'.
			'3;'.get_cantidad(3,$ta).'\n'.
			'4;'.get_cantidad(4,$ta).'\n'.
			'5;'.get_cantidad(5,$ta).'\n'.
			'6;'.get_cantidad(6,$ta).'\n'.
			'7;'.get_cantidad(7,$ta).'\n'.
			'8;'.get_cantidad(8,$ta).'\n'.
			'9;'.get_cantidad(9,$ta).'\n'.
			'10;'.get_cantidad(10,$ta).'\n'.
			'11;'.get_cantidad(11,$ta).'\n'.
			'12;'.get_cantidad(12,$ta).'\n'.
			'13;'.get_cantidad(13,$ta).'\n'.
			'14;'.get_cantidad(14,$ta).'\n'.
			'15;'.get_cantidad(15,$ta).'\n'.
			'16;'.get_cantidad(16,$ta).'\n'.
			'17;'.get_cantidad(17,$ta).'\n'.
			'18;'.get_cantidad(18,$ta).'\n'.
			'19;'.get_cantidad(19,$ta).'\n'.
			'20;'.get_cantidad(20,$ta).'\n'.
			'21;'.get_cantidad(21,$ta).'\n'.
			'22;'.get_cantidad(22,$ta).'\n'.
			'23;'.get_cantidad(23,$ta).'\n'.
			'25;'.get_cantidad(25,$ta).'\n'.
			'26;'.get_cantidad(26,$ta).'\n'.
			'27;'.get_cantidad(27,$ta).'\n'.
			'28;'.get_cantidad(28,$ta).'\n'.
			'29;'.get_cantidad(29,$ta).'\n'.
			'30;'.get_cantidad(30,$ta).'\n'.
			'31;'.get_cantidad(31,$ta).'\n'.
			'32;'.get_cantidad(32,$ta).'\n'.
			'33;'.get_cantidad(33,$ta).'\n'.
			'34;'.get_cantidad(34,$ta).'\n'.
			'35;'.get_cantidad(35,$ta).'\n'.
			'36;'.get_cantidad(36,$ta);*/

	$texto ='1) DESPACHO;'.get_cantidad(1,$ta).'\n'.
			'2) VICE-DESPACHO;'.get_cantidad(2,$ta).'\n'.
			'3) GERENCIA GENERAL;'.get_cantidad(3,$ta).'\n'.
			'4) INVERSION Y COMPETENCIA;'.get_cantidad(4,$ta).'\n'.
			'5) INTEG. Y COMERCIO EXT;'.get_cantidad(5,$ta).'\n'.
			'6) MIPYMES;'.get_cantidad(6,$ta).'\n'.
			'7) ASESORIA JURIDICA;'.get_cantidad(7,$ta).'\n'.
			'8) AUDITORIA INTERNA;'.get_cantidad(8,$ta).'\n'.
			'9) COMUNICACION SOCIAL;'.get_cantidad(9,$ta).'\n'.
			'10) DIR. DE POLITICA COMERCIAL;'.get_cantidad(10,$ta).'\n'.
			'11) DIR. DE COMER. EXTERIOR;'.get_cantidad(11,$ta).'\n'.
			'12) DIR. DE ANALISIS ECONOMICO;'.get_cantidad(12,$ta).'\n'.
			'13) DIR. DE PROG. Y PROY;'.get_cantidad(13,$ta).'\n'.
			'14) DIR. DE SERV. AL COMER;'.get_cantidad(14,$ta).'\n'.
			'15) DIR. DE COMPETENCIA;'.get_cantidad(15,$ta).'\n'.
			'16) DIR. DE SERV. FINAN. Y TEC. MYPIME;'.get_cantidad(16,$ta).'\n'.
			'17) DIR. DE SERV. EMPRESARIAL;'.get_cantidad(17,$ta).'\n'.
			'18) SUB - GERENCIA ADMINISTRATIVA;'.get_cantidad(18,$ta).'\n'.
			'19) SUB - GERENCIA FINANCIERA;'.get_cantidad(19,$ta).'\n'.
			'20) SUB - GERENCIA DE RECURSOS HUMANOS;'.get_cantidad(20,$ta).'\n'.
			'21) SUB - GERENCIA DE INFORMATICA;'.get_cantidad(21,$ta).'\n'.
			'22) SECRETARIA GENERAL;'.get_cantidad(22,$ta).'\n'.
			'23) MANTENIMIENTO;'.get_cantidad(23,$ta).'\n'.
			'25) ARCHIVO;'.get_cantidad(25,$ta).'\n'.
			'26) SIS. NAC. DE LA CALIDAD;'.get_cantidad(26,$ta).'\n'.
			'27) DIACO;'.get_cantidad(27,$ta).'\n'.
			'28) REG. DE VALORES Y MERCANCIAS;'.get_cantidad(28,$ta).'\n'.
			'29) RELACIONES PUBLICAS;'.get_cantidad(29,$ta).'\n'.
			'30) REG. DE LA PROPIEDAD INTELECTUAL;'.get_cantidad(30,$ta).'\n'.
			'31) METROLOGIA;'.get_cantidad(31,$ta).'\n'.
			'32) OTRAS DEPENDENCIAS;'.get_cantidad(32,$ta).'\n'.
			'33) SIGEMINECO;'.get_cantidad(33,$ta).'\n'.
			'34) SITRAME;'.get_cantidad(34,$ta).'\n'.
			'35) REG. MERCANTIL;'.get_cantidad(35,$ta).'\n'.
			'36) FOGUAMI;'.get_cantidad(36,$ta);
	return $texto;
}

 //echo ''.get_texto($date1,$date2,$ta).''; 
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../estilos/HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
a:link {
	color: #FFFFFF;
}
a:visited {
	color: #FFFFFF;
}
a:hover {
	color: #CCCCCC;
}
a:active {
	color: #CCCCCC;
}
-->
</style>
</head>

<body>
<table width="98%" border="0" align="left" class="panel">
  <tr>
    <td><div align="left"><? print "Del 01/01/".date("Y",time())." al 31/12/".date("Y",time());?></div></td>
  </tr>
</table>
<?
$estado = 0;

if ($estado ==0)
		$ta = " events ";
	else
		$ta = " cancelevents ";
?>
<div align="center">
  <!-- saved from url=(0013)about:internet -->
  <!-- amcolumn script-->
    <script type='text/javascript' src='amcolumn/swfobject.js'></script>
</div>
<div id='flashcontent'>
	<div align="center"><strong>You need to upgrade your Flash Player</strong>
  </div>
</div>

<p>
  <script type='text/javascript'>
		// <![CDATA[
		var so = new SWFObject('amcolumn/amcolumn.swf', 'amcolumn', '98%', '380', '0', '#FFFFFF,#BEDF66');
		so.addVariable('path', 'amcolumn/');
		so.addVariable('chart_data', '<? echo ''.get_texto($date1,$date2,$ta).''; ?>');
		so.addVariable('chart_settings', '<settings><data_type>csv</data_type><depth>10</depth><angle>20</angle><column><spacing>1</spacing><grow_time>2</grow_time><grow_effect>strong</grow_effect><alpha>70</alpha><tick_length>40</tick_length><border_color>#9FCD95,#FFFFFF</border_color><border_alpha>5</border_alpha><balloon_text><![CDATA[{series}: {value}]]></balloon_text><gradient>vertical</gradient></column><background><color>#9FCD95,#FFFFFF</color><border_color>#9FCD95,#FFFFFF</border_color><border_alpha>5</border_alpha></background><axes><category><width>70</width></category><value><width>10</width></value><tick_length></tick_length><logarithmic></logarithmic></axes><legend><enabled>false</enabled></legend><labels><label><x>25</x><y>0</y><align>center</align><text><![CDATA[<b>TOTAL DE EMPLEADOS POR VICEMINISTERIO</b>]]></text></label></labels><graphs><graph><gradient_fill_colors>#FFFFFF,#9FCD95</gradient_fill_colors><color>#9FCD95</color></graph></graphs></settings>')
		so.addVariable('preloader_color', '#999999');
		so.write('flashcontent');
		// ]]>
	</script>
</p>


<table cellspacing="0" cellpadding="0">
      <col width="83">
      <col width="286">
      
        
		
<?		
		$qry_cumple ="select iddireccion,nombre from direccion";
		$result = mssql_query($qry_cumple);	
					$cnt = 1;
					while ($vec = mssql_fetch_array($result))
					{	
		 					  print '';
		  					  print"<tr> ";
							  print"<TD width='83'><span class='style1'>$vec[0]</span></TD>";
							  print"<TD width='300'><span class='style1'><a href='verempleados.php?iddireccion=".$vec[0]."'>$vec[1]</a></span></TD>";							
							  print "<td width='60'> <a href='verempleados.php?iddireccion=".$vec[0]."'>ver</a></td>";
							  print"</tr>";		 																				

						$cnt ++;
					}
					
						
	
		?>
		
    
</table>


</p>
</body>
</html>
