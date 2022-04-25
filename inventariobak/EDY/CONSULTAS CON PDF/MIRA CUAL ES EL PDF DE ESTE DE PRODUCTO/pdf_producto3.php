<?php
require('fpdf/fpdf.php');
//include('../../conectarse.php');

//include('../../INCLUDES/inc_header.inc');

require_once('helpdesk.php');  
		include("conectarse.php");

$pdf=new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial','B',8);


$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->Cell(0,0,'Ministerio de Economía, Guatemala',0,1,'C');
$pdf->Ln(4);
$pdf->Cell(0,1,'Productos',0,1,'C');
$pdf->SetFont('Arial','',8);

$pdf->Ln(4);
$pdf->SetFillColor(250 , 250, 0); 
$pdf->cell(0,4,'',0,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'CODIGO',1,1,'L',1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,4,'PRODUCTO',1,1,'L',1);


$SQL = "SELECT id_producto, descripcion FROM cat_producto";
//			print $SQL;

$result = mssql_query($SQL);
	while ( $row = mssql_fetch_row ($result))
{

//$result = mssql_query($SQL); // elimina informacion temporal
//$row = mssql_fetch_row($result);







$pdf->Cell(50,4,$row[0],1,0,'L',0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,4,$row[1],1,1,'L');



 }

$pdf->Output(); 


      
?>


