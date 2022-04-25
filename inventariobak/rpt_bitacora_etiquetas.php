<?
require('fpdf/fpdf.php');
	$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
	mssql_select_db("inventario",$conection);
/*   $q = $_GET['q'];
   $fe = $_GET['fe'];
   $fi = $_GET['fi'];
   $ff = $_GET['ff'];*/

function muestra_fecha3(&$fe)
{
//	$dia=date("l");
  if ( (!isset($_POST['fecha_final'])) || ($_POST['fecha_final'] == '') )
   {
	$dia=date("l");
	if ($dia=="Monday") $dia="LUNES";
	if ($dia=="Tuesday") $dia="MARTES";
	if ($dia=="Wednesday") $dia="MIERCOLES";
	if ($dia=="Thursday") $dia="JUEVES";
	if ($dia=="Friday") $dia="VIERNES";
	if ($dia=="Saturday") $dia="SABADO";
	if ($dia=="Sunday") $dia="DOMINGO";
   }
  else
   {
   $dia='';
   }
	
//	$dia2=date("d");
	$dia2=substr($fe,0,2);
	
//	$mes=date("F");	
	$mes=substr($fe,3,2);
/*	if ($mes=="January") $mes="ENERO";
	if ($mes=="February") $mes="FEBRERO";
	if ($mes=="March") $mes="MARZO";
	if ($mes=="April") $mes="ABRIL";
	if ($mes=="May") $mes="MAYO";
	if ($mes=="June") $mes="JUNIO";
	if ($mes=="July") $mes="JULIO";
	if ($mes=="August") $mes="AGOSTO";
	if ($mes=="September") $mes="SEPTIEMBRE";
	if ($mes=="October") $mes="OCTUBRE";
	if ($mes=="November") $mes="NOVIEMBRE";
	if ($mes=="December") $mes="DICIEMBRE";*/
	
	if ($mes=="01") $mes="ENERO";
	if ($mes=="02") $mes="FEBRERO";
	if ($mes=="03") $mes="MARZO";
	if ($mes=="04") $mes="ABRIL";
	if ($mes=="05") $mes="MAYO";
	if ($mes=="06") $mes="JUNIO";
	if ($mes=="07") $mes="JULIO";
	if ($mes=="08") $mes="AGOSTO";
	if ($mes=="09") $mes="SEPTIEMBRE";
	if ($mes=="10") $mes="OCTUBRE";
	if ($mes=="11") $mes="NOVIEMBRE";
	if ($mes=="12") $mes="DICIEMBRE";

//	$ano=date("Y");
	$ano=substr($fe,6,4);

	$fe = "$dia $dia2 DE $mes DEL $ano";
}


function muestra_fechas2(&$fe)
{
	$dia=date("l",$fe);
//	$dia=substr($fe,9,2);
	if ($dia=="Monday") $dia="LUNES";
	if ($dia=="Tuesday") $dia="MARTES";
	if ($dia=="Wednesday") $dia="MIËRCOLES";
	if ($dia=="Thursday") $dia="JUEVES";
	if ($dia=="Friday") $dia="VIERNES";
	if ($dia=="Saturday") $dia="SABADO";
	if ($dia=="Sunday") $dia="DOMINGO";
	
	$dia2=substr($fe,8,2);
	
	$mes=substr($fe,5,2);
/*	if ($mes=="January") $mes="ENERO";
	if ($mes=="February") $mes="FEBRERO";
	if ($mes=="March") $mes="MARZO";
	if ($mes=="April") $mes="ABRIL";
	if ($mes=="May") $mes="MAYO";
	if ($mes=="June") $mes="JUNIO";
	if ($mes=="July") $mes="JULIO";
	if ($mes=="August") $mes="AGOSTO";
	if ($mes=="September") $mes="SEPTIEMBRE";
	if ($mes=="October") $mes="OCTUBRE";
	if ($mes=="November") $mes="NOVIEMBRE";
	if ($mes=="December") $mes="DICIEMBRE";*/
	
	if ($mes=="01") $mes="ENERO";
	if ($mes=="02") $mes="FEBRERO";
	if ($mes=="03") $mes="MARZO";
	if ($mes=="04") $mes="ABRIL";
	if ($mes=="05") $mes="MAYO";
	if ($mes=="06") $mes="JUNIO";
	if ($mes=="07") $mes="JULIO";
	if ($mes=="08") $mes="AGOSTO";
	if ($mes=="09") $mes="SEPTIEMBRE";
	if ($mes=="10") $mes="OCTUBRE";
	if ($mes=="11") $mes="NOVIEMBRE";
	if ($mes=="12") $mes="DICIEMBRE";
	$ano=substr($fe,0,4);

//	$fe = "$dia $dia2 DE $mes DEL $ano";
	$fe = "$dia2 DE $mes DEL $ano";
}
   
	
 function fecha_std_inv($fecha_std)
  {
	$fechard= substr($fecha_std,8,2);
//		echo $fechard."<br>";
	$fecharm= substr($fecha_std,5,2);
//		echo $fecharm."<br>";
	$fechara= substr($fecha_std,0,4);
//		echo $fechara."<br>";
	$hora = substr($fecha_std,12,10);
//		echo $hora."<br>";
	$fechar_in = $fechard."/".$fecharm."/".$fechara." ".$hora;
//		echo "-$fechar_in-";
    return $fechar_in;
  }

 function fecha_std($fecha_std)
  {
	$fechard= substr($fecha_std,0,2);
//		echo $fechard."<br>";
	$fecharm= substr($fecha_std,3,2);
//		echo $fecharm."<br>";
	$fechara= substr($fecha_std,6,4);
//		echo $fechara."<br>";
	$hora = substr($fecha_std,10,10);
//		echo $hora."<br>";
	$fechar_in = $fechara."/".$fecharm."/".$fechard." ".$hora;
//		echo "-$fechar_in-";
    return $fechar_in;
  }



class PDF extends FPDF
 {
  //Cabecera de página
  function Header()
   {
/*    $q = $_GET['q'];
   $fe = $_GET['fe'];
   $fi = $_GET['fi'];
   $ff = $_GET['ff'];*/
   //Logo
	$this->Image('imagenes/escudo_2008.jpg',10,8,15);
	//Arial bold 15
	$this->SetFont('Arial','B',8);
	//Movernos a la derecha
//	$this->Cell(80);
	$this->Cell(1);
	//Título
	//Salto de línea
//	$this->Ln(10);
	$this->Cell(0,3,'MINISTERIO DE ECONOMIA ',0,1,'C');
	$this->Cell(0,3,'SUBGERENCIA FINANCIERA - SUBGERENCIA DE INFORMATICA',0,1,'C');
	$this->Cell(0,3,'SECCION DE INVENTARIOS',0,1,'C');
	$this->SetFont('Arial','',8);	
	$this->Ln(5);	 

   if ( (!isset($_POST['fecha_final'])) || ($_POST['fecha_final'] == '')  )
    {
  	 $hoy = date('d/m/Y');
//	$this->Cell(0,4,'No existe el post, '.$hoy,0,1,'R');		
	}
   else
    {
     $hoy = $_POST['fecha_final'];
//	$this->Cell(0,4,'Si existe el Post, '.$hoy,0,1,'R');	
	}
	//	$hoy = date('d/m/Y');
	$hhoy = muestra_fecha3($hoy);

/*	$this->Cell(0,4,'GUATEMALA, '.$_POST['fecha_final'],0,1,'R');	
	$this->Cell(0,4,'GUATEMALA, '.$hoy,0,1,'R');		*/
	$this->SetFont('Arial','B',8);	
	$this->Cell(0,4,'BITACORA DE ETIQUETAS DE SEGURIDAD ASIGNADAS A EQUIPOS DE COMPUTO',0,1,'C');		
	$this->SetFont('Arial','',8);	
	$this->Ln(2);
//	$this->Cell(0,4,'GUATEMALA, '.$hoy.' '.$hhoy,0,1,'R');	
/*	$this->Cell(0,4,'INFORME No. '.$_GET['num'],0,1,'R');		
	$this->Cell(0,4,'REFERENCIA MP No. '.$ref_mp,0,1,'R');			
	$this->Ln(10);	 	*/
	
//	$this->Cell(0,3,'BOLETA DE RECEPCION PARA ALMACENAMIENTO FISICO',0,1,'C');
//	$this->Cell(0,3,$mes_act.' '.$ac,0,1,'C');
//	 pdf_show($p, "DEL ".fecha_std_inv($fi)." AL ".fecha_std_inv($ff));
/*	if ($fe != 0 )
	 {
		$this->Cell(0,3,'DEL '.fecha_std_inv($fi).' AL '.fecha_std_inv($ff),0,1,'C');		 	 
//	  pdf_show($p, "DEL ".fecha_std_inv($fi)." AL ".fecha_std_inv($ff));
	 }
	else
	 {
	 	$this->Cell(0,3,'GENERAL',0,1,'C');		 
	 }*/
	$this->SetFont('Arial','',10);
   }

  //Pie de página
  function Footer()
   {
	//Posición: a 1,5 cm del final
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Número de página
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
//	$this->Cell(0,10,'Generado el '.date('d/m/Y H:i'),0,0,'R');
	$hoy = date('d/m/Y');
//	$hhoy = muestra_fecha2($hoy);
	$this->Cell(0,10,'Generado: '.$hoy.' '.$hhoy,0,0,'R');
   }
 } // termina class pdf

//Creación del objeto de la clase heredada
$pdf=new PDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$pdf->AliasNbPages();
$margen = 1;
//if ($margen = 1) { $pdf->Cell(5); }
	 
	 
// Encabezado de la bitacora muestra los datos del inventario


// Encabezado de la bitacora muestra los datos del inventario
 $sele_caso = "select b.id_registro_inventario, b.id_producto, d.descripcion producto,  b.id_anio_reg_it, b.id_institucion_reg_it, 
				b.id_registro_informatica, b.modelo, b.no_serie, b.sicoin, b.id_marca, e.marca
				from m_inventario b, cat_producto d, cat_marca e
				where b.id_producto = d.id_producto and b.id_marca = e.id_marca
				and b.id_inventario = ".$_GET['idi'];
// $pdf->MultiCell(0,4,"$sele_caso",0,1,'L');	   
 $resultc = mssql_query($sele_caso);
$pdf->SetFont('Arial','B',8);  
     $pdf->Cell(1);
     $pdf->Cell(40,4,"COD INVENTARIO ",1,0,'C');
     $pdf->Cell(50,4,"DISPOSITIVO ",1,0,'C');     
	 $pdf->Cell(30,4,"MODELO ",1,0,'C');
 	 $pdf->Cell(30,4,"SERIE ",1,0,'C');
	 $pdf->Cell(20,4,"SICOIN ",1,0,'C');	 
	 $pdf->Cell(40,4,"MARCA ",1,0,'C');
 	 $pdf->Cell(40,4,"ETIQUETA DE SEGURIDAD ",1,1,'C');
$pdf->SetFont('Arial','',8); 
 while ($rowc = mssql_fetch_array($resultc))	
  {
		   $ind++;
       $pdf->Cell(1);
//	   $pdf->Cell(20,4,$ind,1,0,'L');
	   $pdf->Cell(40,4,$rowc['id_registro_inventario'],1,0,'L');	 
	   $pdf->Cell(50,4,$rowc['producto'],1,0,'L');	 	   
	   $pdf->Cell(30,4,$rowc['modelo'],1,0,'L');	 	   	   
   	   $pdf->Cell(30,4,$rowc['no_serie'],1,0,'L');	 	   	   
	   $pdf->Cell(20,4,$rowc['sicoin'],1,0,'L');	 	   	   	   
	   $pdf->Cell(40,4,$rowc['marca'],1,0,'L');	 	   	   	   	   
   	   $pdf->Cell(40,4,$rowc['id_anio_reg_it'].'-'.$rowc['id_institucion_reg_it'].'-'.$rowc['id_registro_informatica'],1,1,'L');	 	   	   	   	   
	    
	}

$pdf->Ln(2);	
//CONVERT(varchar,a.fecha_registro,105) fecha_registro
 $sele_caso = "select a.motivo_cambio, b.id_registro_inventario,
				c.nombre, c.nombre2, c.nombre3, c.apellido, c.apellido2, c.apellidocasada, 
				a.fecha_registro, a.id_anio_reg_it, a.id_institucion_reg_it, id_reg_it
				from bitacora_etiqueta a, m_inventario b, RRHH.dbo.asesor c
				where a.id_inventario = b.id_inventario and a.id_usuario_registro = c.idasesor
				and a.id_inventario = ".$_GET['idi']." order by a.fecha_registro asc";
// $pdf->MultiCell(0,4,"$sele_caso",0,1,'L');	   
 $resultc = mssql_query($sele_caso);
$pdf->SetFont('Arial','B',8); 
     $pdf->Cell(1);
	 $pdf->Cell(35,4,"FECHA MOVIMIENTO",1,0,'C');	 
 	 $pdf->Cell(40,4,"ETIQUETA DE SEGURIDAD ",1,0,'C');	 
 	 $pdf->Cell(85,4," EMPLEADO QUE REGISTRO",1,0,'C');
	 $pdf->Cell(110,4,"MOTIVO DE CAMBIO ",1,1,'C');	 
$pdf->SetFont('Arial','',8); 	 
 while ($rowc = mssql_fetch_array($resultc))	
  {
		   $ind++;
       $pdf->Cell(1);
	   $pdf->Cell(35,4,$rowc['fecha_registro'],1,0,'L');	 	   	   	   	   
   	   $pdf->Cell(40,4,$rowc['id_anio_reg_it'].'-'.$rowc['id_institucion_reg_it'].'-'.$rowc['id_reg_it'],1,0,'L');	 	   	   	   	      	   	   	   
	   $pdf->Cell(85,4,$rowc['nombre'].' '.$rowc['nombre2'].' '.$rowc['apellido'].' '.$rowc['apellido2'],1,0,'L');	 	   	   	   	   	   
	   $pdf->MultiCell(110,4,$rowc['motivo_cambio'],1);	 	   	   	   	   	   
	    
	}	
	$pdf->Ln(1);	
	 $pdf->Cell(0,4,"===================================================== ULTIMA LINEA =====================================================",0,0,'C');	 
$pdf->Output();	

?>
