<?
include('conectarse.php');
include('../includes/inc_header_sistema.inc');

	conectardb($reloj_marcaje);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'PERSONAS QUE DEBEN, 2015'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Deudores',
            data: [
			
			<?php
			$query = mssql_query("select vice.nombre, dlb.id_asesor  from tb_datos_laborales as dlb inner join dbo.tbl_viceministerio as vice on dlb.id_viceministerio= vice.id_viceministerio where dlb.activo=1");
			
			while($res = mssql_fetch_row($query)){
			?>
			
                ['<?php echo $res[0]; ?>', <?php echo $res[1] ?>],
			
			<?php
			}
			?>	

            ]
        }]
    });
});


		</script>
	</head>
	<body>

<script src="ReportDBKEV/reportes_graficos/Highcharts-4.1.5/js/modules/exporting.js"></script>
<script src="ReportDBKEV/reportes_graficos/Highcharts-4.1.5/js/highcharts.js"

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<br><br>
<center><a href="ejemplo2.php">Ver ejemplo 2</a></center>

	</body>
</html>
