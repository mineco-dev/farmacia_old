<?

require('../../class/conectiongas.php');
/*$dbms=new DBMS(conectardb($uipopera));
$dbms->bdd=$database_cnn;
require('../includes/funciones.php');*/

function get_cantidad($ids,$ta)
{

/*'select sum(tb1.codigo_galones) from tb_detalle_combustible tb1, tb_encabezado_combustible tb2 where 
tb1.codigo_encabezado_combustible = tb2.codigo_encabezado_combustible and tb2.codigo_bomba = 1 
and tb1.codigo_descripcion = 1 and tb2.fecha >= "'.$fecha1.'" and tb2.fecha <= "'.$fecha2.'" and tb2.activo = 1'*/

	$sql="select sum(tb1.codigo_galones) canti
				 from
					tb_detalle_combustible tb1,
					tb_encabezado_combustible tb2
				 where
					tb1.codigo_encabezado_combustible = tb2.codigo_encabezado_combustible and
					month(tb2.fechahora) = $ids and  tb1.codigo_descripcion = 3 and
					year(tb2.fechahora) = year(curdate())";

	$result = mysql_query($sql);
	$Fields = mysql_fetch_row($result);
	
	return $Fields[0];
}

function get_texto($f1,$f2,$ta)
{
	$texto = 'Enero;'.get_cantidad(1,$ta).'\n'.
			'Febrero;'.get_cantidad(2,$ta).'\n'.
			'Marzo;'.get_cantidad(3,$ta).'\n'.
			'Abril;'.get_cantidad(4,$ta).'\n'.
			'Mayo;'.get_cantidad(5,$ta).'\n'.
			'Junio;'.get_cantidad(6,$ta).'\n'.
			'Julio;'.get_cantidad(7,$ta).'\n'.
			'Agosto;'.get_cantidad(8,$ta).'\n'.
			'Septiembre;'.get_cantidad(9,$ta).'\n'.
			'Octubre;'.get_cantidad(10,$ta).'\n'.
			'Noviembre;'.get_cantidad(11,$ta).'\n'.
			'Diciembre;'.get_cantidad(12,$ta);
	return $texto;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />

</head>

<body>
<table width="98%" border="0" align="left" class="panel">
  <tr>
    <td><div align="left"><? print "Del 01/01/".date("Y",time())." al 31/12/".date("Y",time());?></div></td>
  </tr>
</table>
<?
$estado = 1;

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

<script type='text/javascript'>
		// <![CDATA[
		var so = new SWFObject('amcolumn/amcolumn.swf', 'amcolumn', '98%', '380', '0', '#FFFFFF,#B0DE09');
		so.addVariable('path', 'amcolumn/');
		so.addVariable('chart_data', '<? echo ''.get_texto($date1,$date2,$ta).''; ?>');
		so.addVariable('chart_settings', '<settings><data_type>csv</data_type><depth>10</depth><angle>20</angle><column><spacing>1</spacing><grow_time>2</grow_time><grow_effect>strong</grow_effect><alpha>70</alpha><tick_length>40</tick_length><border_color>#FF9E01,#FFFFFF</border_color><border_alpha>5</border_alpha><balloon_text><![CDATA[{series}: {value}]]></balloon_text><gradient>vertical</gradient></column><background><color>#FF9E01,#FFFFFF</color><border_color>#FF9E01,#FFFFFF</border_color><border_alpha>5</border_alpha></background><axes><category><width>10</width></category><value><width>10</width></value><tick_length></tick_length><logarithmic></logarithmic></axes><legend><enabled>false</enabled></legend><labels><label><x>0</x><y>25</y><align>center</align><text><![CDATA[<b>TOTAL DE GALONES DE DIESEL VENDIDOS EN EL A�O</b>]]></text></label></labels><graphs><graph><gradient_fill_colors>#FFFFFF,#B0DE09</gradient_fill_colors><color>#FCD202</color></graph></graphs></settings>')
		so.addVariable('preloader_color', '#999999');
		so.write('flashcontent');
		// ]]>
	</script>
<br>
</body>
</html>
