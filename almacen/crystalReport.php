<?php 
ob_start();
session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
    
	


 $cboDiai = $p1;
 $cboMesi = $p2;
 $cboAnioi = $p3;
 $cboDiaf = $p4;
 $cboMesf = $p5;
 $cboAniof = $p6;
 $select1 = $p7;
 $select2 = $p8;
 $select3 = $p9;



$categoria = $select1;
$subcategoria =  $select2;
$producto = $select3;

// $cboDiai = 01;
// $cboMesi = 10;
// $cboAnioi = 2017;
// $cboDiaf = 30;
// $cboMesf = 10;
// $cboAniof = 2017;
// $select1 = 211;
// $select2 = 1400;
// $select3 = 1;


  if ($cboMesi < 10)
	 {
	  	$cboMesi = '0'.$cboMesi;
	 }
    if ($cboMesf < 10)
     {
	 	$cboMesf = '0'.$cboMesf;
	 }
    if ($cboDiai < 10)
     {
	 	$cboDiai = '0'.$cboDiai;
	 }
    if ($cboDiaf < 10)
     {
	 	$cboDiaf = '0'.$cboDiaf;
	 }		  
				$fecha1 = $cboDiai.'/'.$cboMesi.'/'.$cboAnioi;
				$fecha2 = $cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
				$fechahora1 = $cboAnioi.'-'.$cboMesi.'-'.$cboDiai.' 00:00:00';
				$fechahora2 = $cboAniof.'-'.$cboMesf.'-'.$cboDiaf.' 24:59:59';								
				$fecha1h = $fecha1.' 00:00:00';
				$fecha2h = $fecha2.' 24:59:59';	
conectardb($almacen);
	 $query = "
			select CONVERT(nvarchar(10), k.fecha, 103) as fecha,
			CONVERT(nvarchar(10), k.fecha, 108) as hora,
			 m.tipo_movimiento,
			k.no_despacho, 
			k.no_ingreso, 
			k.entrada,
			k.salida, 
			k.saldo, 
			k.costo_promedio, 
			k.costo_factura, 
			costo_movimiento,
			 costo_total, 
			 d.nombre
			 from tb_kardex k
			inner join cat_tipo_movimiento m
			on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
			inner join direccion d
			on k.id_dependencia = d.iddireccion 
				where 
				CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
			 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
			 order by codigo_kardex asc";


 $consulta=mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida   where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");



$do=mssql_query($query);


ob_start();
$template = '

<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<style>
@page {
margin-top: 1.5cm;
margin-bottom: 0.5cm;
margin-left: 0.2cm;
margin-right: 0.5cm;

}
	.td{
		width: 15%;
		
	}
	.kardex{
		text-align: center;
		font-size: 14px;
		color: #fff;
	}

	.fila{
		height: 80px;
	}
	.tdchildren{
		width: 30%;
		
	}

	.tdchildren1{
			width:28%;
			font-size:11px;
			padding-top:20px;
			padding-bottom: 20px;
			
			
	}

	.titulo{
		width: 50px;
		text-align: center;
		border: 1px solid #fff;
		font-size:10px;
		color: #fff;
	}
	.titulopro{
		width: 200px;
		text-align: center;
		border: 1px solid #fff;
		color: #fff;
	}
	.spam{
		padding-left:55px;
	}
</style>

<page>

<div >
	<table style="width:100%">
		<tr class="fila">
			<td class="td"></td>
			<td class="kardex">DIRECCIÓN DE ATENCION Y ASISTENCIA AL CONSUMIDOR <br>-DIACO- <br>TARJETA KARDEX DE ALMACEN</td>
			<td class="td"></td>
		</tr>
	</table>
	<table style=" width:100%; ">
		<tr >
			<td class="tdchildren1">Codigo Articulo:
			';
			 $template .= $categoria; 
			 $template .=  ' - '; 
			 $template .=  $subcategoria;  
			 $template .=  ' - ';	
			 $template .=  $producto;
			
			$template .='	
			</td>
			<td style="width:10px;"></td>
			<td class="tdchildren1">Articulo:       ';


	while($registro=mssql_fetch_row($consulta))
	{
		 $template .= '<span style="padding-left: 15px;text-align:center;">'; $template .= $registro['0']; $template .=" - "; $template .= $registro['1']; $template .='</span>'; 
		
	}
			$template .='</td>
			<td ></td>
			<td class="tdchildren1" style="padding-left:70px;">Saldo Inicial:</td>
		</tr>
		<tr>
			<td class="tdchildren1"></td>
			<td ></td>
			<td class="tdchildren1" style="padding-left:70px;padding-top:-10px;">Unidad:</td>
			<td ></td>
			<td class="tdchildren1"></td>
		</tr>
	</table>
	<table style=" width:100%">
		<tr>
			<td class="titulo">Fecha</td>
			<td class="titulo">Tipo Movimiento</td>
			<td class="titulo">No. Despacho</td>
			<td class="titulo">No. Ingreso de Almácen</td>
			<td class="titulo">Entrada</td>
			<td class="titulo">Salida</td>
			<td class="titulo">Saldo</td>
			<td class="titulo">Costo Promedio</td>
			<td class="titulo">Costo Factura</td>
			<td class="titulo">Costo Total Movimiento</td>
			<td class="titulo">Costo Total Existencia</td>
			<td class="titulopro">Proveedor / Dependencia</td>
		</tr>
<tbody>';

				$gt=0;
				$i = 0;									
				$tmp = 0;
				$k=array();
				$x=0;
				$paso = 0;
				
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$x++;
					$err = 0;
					
				$cantidad=$vector[7]*$vector[8];
					include("css/format_table.php");
					
					if ($x <= 36) {
						$template .=  '
						<tr style="height:17px;">
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[0]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[2]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[3]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[4]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[5]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[6]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;text-align:center;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[7]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;padding-left:25px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[8]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;padding-left:25px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[9]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;padding-left:25px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[10]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[11]; $template .='</td>
							<td height="8" style="font-size:10px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[12]; $template .='</td>
							
						</tr>';		
						
				 	
					}else{
						$paso = 1;

					}
						
				 }	


				mssql_free_result($do);		
			

$template .='</tbody>

	</table>
	';
conectardb($almacen);
	 $query = "
			select CONVERT(nvarchar(10), k.fecha, 103) as fecha,
			CONVERT(nvarchar(10), k.fecha, 108) as hora,
			 m.tipo_movimiento,
			k.no_despacho, 
			k.no_ingreso, 
			k.entrada,
			k.salida, 
			k.saldo, 
			k.costo_promedio, 
			k.costo_factura, 
			costo_movimiento,
			 costo_total, 
			 d.nombre
			 from tb_kardex k
			inner join cat_tipo_movimiento m
			on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
			inner join direccion d
			on k.id_dependencia = d.iddireccion 
				where 
				CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
			 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
			 order by codigo_kardex asc";


 $consulta=mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida   where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");



$do=mssql_query($query);
    if ($paso == 1) {
    	$template .='<span style="page-break-after:always;"></span>';
    	$template .='<table style=" width:100%;"">
		<tr >
			<td class="tdchildren1">Codigo Articulo:
			';
			 $template .= $categoria; 
			 $template .=  ' - '; 
			 $template .=  $subcategoria;  
			 $template .=  ' - ';	
			 $template .=  $producto;
			
			$template .='	
			</td>
			<td style="width:10px;"></td>
			<td class="tdchildren1">Articulo:       ';


	while($registro=mssql_fetch_row($consulta))
	{
		 $template .= '<span style="padding-left: 15px;text-align:center;">'; $template .= $registro['0']; $template .=" - "; $template .= $registro['1']; $template .='</span>'; 
		
	}
	$template .='</td>
			<td ></td>
			<td class="tdchildren1" style="padding-left:70px;">Saldo Inicial:</td>
		</tr>
		<tr>
			<td class="tdchildren1"></td>
			<td ></td>
			<td class="tdchildren1" style="padding-left:70px;padding-top:-10px;">Unidad:</td>
			<td ></td>
			<td class="tdchildren1"></td>
		</tr>
	</table>
	<table style=" width:100%">
		<tr>
			<td class="titulo">Fecha</td>
			<td class="titulo">Tipo Movimiento</td>
			<td class="titulo">No. Despacho</td>
			<td class="titulo">No. Ingreso de Almácen</td>
			<td class="titulo">Entrada</td>
			<td class="titulo">Salida</td>
			<td class="titulo">Saldo</td>
			<td class="titulo">Costo Promedio</td>
			<td class="titulo">Costo Factura</td>
			<td class="titulo">Costo Total Movimiento</td>
			<td class="titulo">Costo Total Existencia</td>
			<td class="titulopro">Proveedor / Dependencia</td>
		</tr>
<tbody>';
		$gt=0;
				$i = 0;									
				$tmp = 0;
				$k=array();
				$x=0;
				$paso = 0;
				
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$x++;
					$err = 0;
					
				$cantidad=$vector[7]*$vector[8];
					include("css/format_table.php");
					
					if ($x > 36) {
						$template .=  '
						<tr style="height:17px;">
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[0]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[2]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[3]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[4]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[5]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[6]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;text-align:center;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[7]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;padding-left:25px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[8]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;padding-left:25px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[9]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;padding-left:25px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[10]; $template .='</td>
							<td height="8" style="font-size:10px;width:50px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">         Q '; $template .=$vector[11]; $template .='</td>
							<td height="8" style="font-size:10px;border-left:1px solid #DCDCDC;border-right:1px solid #DCDCDC;border-bottom:1px solid #DCDCDC;">'; $template .=$vector[12]; $template .='</td>
							
						</tr>';		
						
				 	
					}
				 }	


				mssql_free_result($do);	
    }

$template .='

	</table>
</div>
</page>
';



 //print $template;

	  // include('mpdf60/mpdf.php');
	  // $pdf = new mPDF('L','A4-L');
	  // //$css = file_get_contents('bootstrap/css/bootstrap.css');
	  // $pdf->charset_in='UTF-8';

	  // $pdf->setFooter("Page {PAGENO} of {nb}");
	  // //$pdf->writeHTML($css,1);
	  // $pdf->writeHTML($template);
	
	  // $filename = 'Solicitud No. ';
	
	  // $filename .= '.pdf';
	  // $pdf->output($filename,'F',true);
	  // $pdf->output($filename,'I',true);
	  // exit;


$template = mb_convert_encoding($template,'UTF-8', 'windows-1252');
require_once('dompdf/pdf/dompdf_config.inc.php');
$dompdf = new DOMPDF();
$dompdf ->set_paper("legal", "landscape");
$dompdf ->load_html($template);
$dompdf ->render();
$dompdf ->stream("ACTA.pdf", array("Attachment" => false));

 ?>


