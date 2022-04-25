<?php
require('fpdf/fpdf.php');
//include('../../conectarse.php');

//include('../../INCLUDES/inc_header.inc');

require_once('helpdesk.php');  


$pdf=new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','B',8);

$pdf->cell(0,4,'',0,1,'L');
$pdf->cell(0,4,'',0,1,'L');
$pdf->Cell(0,0,'Ministerio de Economía, Guatemala',0,1,'C');
$pdf->Ln(4);
$pdf->Cell(0,1,'PROVEEDORES',0,1,'C');
$pdf->SetFont('Arial','',8);

$SQL1 = "SELECT id_sistema, sistema, unidad FROM cat_parametros_sistema where id_sistema = 1";
$result1 = mssql_query($SQL1); 
$row = mssql_fetch_row($result1);

$pdf->Ln(4);
$pdf->Cell(0,2,$row[1],0,1,'C');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,3,$row[2],0,1,'C');
$pdf->SetFont('Arial','',8);



$pdf->Ln(4);
$pdf->SetFillColor(250 , 250, 0); 
$pdf->cell(0,4,'',0,1,'L');
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,4,'NIT',1,0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,4,'PROVEEDOR',1,0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(50,4,'DIRECCION',1,0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(25,4,'TELEFONO',1,0,'L',0);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(35,4,'EMAIL',1,1,'L',0);







$SQL = "SELECT nit, proveedor, direccion, telefono, email FROM cat_proveedor";
//			print $SQL;

$result = mssql_query($SQL);
 while ( $row = mssql_fetch_row ($result))
  {
	//$result = mssql_query($SQL); // elimina informacion temporal
	//$row = mssql_fetch_row($result);
	$pdf->Cell(25,4,$row[0],1,0,'L',0);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(60,4,$row[1],1,0,'L');
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(50,4,$row[2],1,0,'L');

	$pdf->SetFont('Arial','',8);
	$pdf->Cell(25,4,$row[3],1,0,'L');

	$pdf->SetFont('Arial','',8);
	$pdf->Cell(35,4,$row[4],1,1,'L');

	
  }

$pdf->Output(); 


      
?>
