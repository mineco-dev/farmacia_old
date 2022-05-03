<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo22 {font-size: 11px}
.style7 {color: #FFFFFF; font-size: 12px; font-family: Arial, Helvetica, sans-serif; }
.style10 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
}
.style15 {font-size: 12px}
.style17 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #FFFFFF; }
.style18 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 16px;
}
.style27 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.style31 {font-family: Arial, Helvetica, sans-serif}
.style33 {color: #FFFFFF}
-->
</style>
<?
include('../includes/inc_header_sistema.inc');
	
	
	
	
	
$consulta = mssql_query("select d.nombre as dependencia,a.nombre+' '+a.nombre2+' '+a.apellido+' '+apellido2 as nombre,a.idasesor,a.iddireccion from asesor a, direccion d 
where a.iddireccion = d.iddireccion and gafete = '$empleado'");																									

if ($opfalta == 1)
{
	$permiso = 'Ausentarse Despues del Horario';	
}

if ($opfalta == 2)
{
	$permiso = 'Ausentarse Durante el Horario';	
}

if ($opfalta == 3)
{
	$permiso = 'Faltar el Dia';	
}

$row = mssql_fetch_array($consulta);


$idasesor = $row[2];
$iddireccion = $row[3];

	function fecha(){
	$mes = date("n");
	$mesArray = array(
		1 => "Enero", 
		2 => "Febrero", 
		3 => "Marzo", 
		4 => "Abril", 
		5 => "Mayo", 
		6 => "Junio", 
		7 => "Julio", 
		8 => "Agosto", 
		9 => "Septiembre", 
		10 => "Octubre", 
		11 => "Noviembre", 
		12 => "Diciembre"
	);

	$semana = date("D");
	$semanaArray = array(
		"Mon" => "Lunes", 
		"Tue" => "Martes", 
		"Wed" => "Miercoles", 
		"Thu" => "Jueves", 
		"Fri" => "Viernes", 
		"Sat" => "S�bado", 
		"Sun" => "Domingo", 
	);
	
	$mesReturn = $mesArray[$mes];
	$semanaReturn = $semanaArray[$semana];
	$dia = date("d");
	$a�o = date ("Y");
	
return $semanaReturn." ".$dia." de ".$mesReturn." de ".$a�o;
}

$x = fecha();


$fec = date("Y-m-d H:i:s");
$fec1 = date("Y-m-d");

$fecha = $anio.'-'.$mes.'-'.$dia;

$hora1 = $fec1.' '.$h1.':'.$m1.':00';
$hora2 = $fec1.' '.$h2.':'.$m2.':00';
$hora3 = $fec1.' '.$h3.':'.$m3.':00';

			if ($opfalta == 1)
			{
			$consulta = "insert into tb_asistencia (idasesor,gafete,iddireccion,fecha,hora1,motivo,observaciones) values ($idasesor,'$empleado',$iddireccion,'$fec','$hora1',$motivo,'$observaciones')";
			}
			
			if ($opfalta == 2)			
			{
			$consulta = "insert into tb_asistencia (idasesor,gafete,iddireccion,fecha,hora2,hora3,motivo,observaciones) values ($idasesor,'$empleado',$iddireccion,'$fec','$hora2','$hora3',$motivo,'$observaciones')";
			}
			
			if ($opfalta == 3)
			{
			$consulta = "insert into tb_asistencia (idasesor,gafete,iddireccion,fecha,fecha1,motivo,observaciones) values ($idasesor,'$empleado',$iddireccion,'$fec','$fecha',$motivo,'$observaciones')";
			}


//print $consulta;

mssql_query($consulta);


?>

</head>

<body>
<p>MINISTERIO DE  ECONOMIA<br />
Subgerencia de Recursos Humanos</p>
<p align="center" class="style18">CONTROL DE ASISTENCIA </p>
<table width="90%" border="0" cellpadding="0" cellspacing="5">
  <tr>
    <td width="19%" background="../imagen/fondos.gif" bgcolor="#FFFFFF"><span class="style7">Nombre  del Empleado /a</span></td>
    <td width="2%">&nbsp;</td>
    <td width="79%"><span class="style27"><? print $row[1]; ?></span></td>
  </tr>
  <tr>
    <td background="../imagen/fondos.gif" bgcolor="#FFFFFF"><span class="style7">No.  Carne</span></td>
    <td>&nbsp;</td>
    <td><span class="style27"><? print $empleado; ?></span></td>
  </tr>
  <tr>
    <td background="../imagen/fondos.gif" bgcolor="#FFFFFF"><span class="style7">Dependencia</span></td>
    <td>&nbsp;</td>
    <td><span class="style27"><? print $row[0]; ?></span></td>
  </tr>
  <tr>
    <td background="../imagen/fondos.gif" bgcolor="#FFFFFF"><span class="style7">Lugar  y Fecha</span></td>
    <td>&nbsp;</td>
    <td><span class="style27"><? print $x; ?></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="style31"></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="style31"></span></td>
  </tr>
  <tr>
    <td background="../imagen/fondos.gif"><span class="style7"><? print $permiso; ?></span></td>
    <td>&nbsp;</td>
    <td><span class="style27">&nbsp;<? 
		
			if ($opfalta == 1)
			{
				print $h1.':'.$m1;
			}
			
			if ($opfalta == 2)			
			{
				print $h2.':'.$m2.' - '.$h3.':'.$m3;
			}
			
			if ($opfalta == 3)
			{
				print $fecha;
			
			}
		
	
	 ?>
    </span></td>
  </tr>
  <tr>
    <td><span class="style33"></span></td>
    <td>&nbsp;</td>
    <td><span class="style31"></span></td>
  </tr>
  <tr>
    <td background="../imagen/fondos.gif" bgcolor="#FFFFFF"><span class="style7">Motivo</span></td>
    <td>&nbsp;</td>
    <td><span class="style27"><? 
	if ($motivo==1) 
	{	
		print 'Comision Oficial';
	}

	if ($motivo==2) 
	{	
			print 'Temporal';
	}

	if ($motivo==3) 
	{	
			print 'Permiso Particular';
	}
	
	if ($motivo==4) 
	{	
			print 'Definitivo';
	}

	?>
    </span></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td>&nbsp;</td>
    <td><span class="style31"></span></td>
  </tr>
  <tr>
    <td bgcolor="#000000"><span class="style7">Observaciones</span></td>
    <td>&nbsp;</td>
    <td><span class="style27">
      <label>
      <? print $observaciones; ?>      </label>
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="57">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td rowspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="27%">________________________</td>
        <td width="13%">&nbsp;</td>
        <td width="27%">_______________________</td>
        <td width="33%">&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><span class="style10">Firma y Sello Jefe Inmediato </span></div></td>
        <td>&nbsp;</td>
        <td><div align="center"><span class="style10">Firma Solicitante</span> </div></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td background="../imagen/fondos.gif"><span class="style17">Exclusivo Personal de Seguridad</span> </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="24%"><span class="style10">Fecha / Hora de Salida </span></td>
        <td width="35%">_________________________</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="style10">Fecha / Hora de Entrada </span></td>
        <td>_________________________</td>
        <td width="41%">&nbsp;</td>
      </tr>
      <tr>
        <td height="29"><span class="style15"></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><span class="style10">Firma:</span></td>
        <td>_________________________</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label><span class="style11">c.c. Expediente</span> </label></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
