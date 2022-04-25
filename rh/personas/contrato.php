<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
		//session_start();
		include('conectarse.php');
		include('../includes/inc_header_sistema.inc');
		include('funcion.php');
	
	
	
	
	
	
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
	
	
	
	
		

		function anotaciones($codpersona)
{	
		
	$value = "select gafete from asesor where idasesor = '$codpersona'";
	$gaf = mssql_query($value);
	$gafete = mssql_fetch_array($gaf);
	
							
		$qry_insertar_notas ="select x.id_observaciones, y.observacion, x.observacion, x.adjunto,convert(varchar(10),x.fecha,21) from tb_observaciones x,
 tb_observacion y where x.tipo_observacion = y.codigo_observacion and x.idasesor = '$codpersona'";
		$result = mssql_query($qry_insertar_notas);	
					$cnt = 1;
					$x = fecha();
					while ($vec = mssql_fetch_array($result))
					{	
					
					
		 					  print '';
		  					  print"<tr> ";
  							  print "<input type='hidden' name='cuenta[".$cnt."]'/>";
							  print"<input name='masterkey[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<input name='mllave[".$cnt."]' type='hidden' value=".$vec[0].">";
							  print"<TD width='120'><span class='style9'>$vec[1]</span></TD>";
  							  print"<TD width='200'><span class='style9'>$vec[4]</span></TD>";							  
							  print"<TD width='350'><span class='style9'>$vec[2]</span></TD>";							  						  							
							  print "<td width='110'> <a href='fotos/".$gafete[0]."/notas/".$vec[3]."' target = '_blank'>ver</a></td>";
							  						
							  print"</tr>";		 																				
							  
					
						
					
						
						$cnt ++;
					}
					print "<tr> ".$x." </tr>";
					
						
		}

		
		
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

<script language="JavaScript" src="calendar_db.js"></script>
<link rel="stylesheet" href="calendar.css">
<link href="../css/cssWeb.css" type=text/css rel=StyleSheet>
<style type="text/css">
<!--
.Estilo1 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo67 {font-size: 9px}
.Estilo68 {font-size: 16px}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo22 {font-size: 11px}
.Estilo6 {color: #FF0000}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo47 {color: #000000}
.style9 {font-size: 13px}
-->
</style>

</head>
<body >
<p>
  <?
		$fecha_naci =  "$ano-$mes-$dia";  

		$sqpersona = "SELECT nombre,nombre2,nombre3,apellido,apellido2, 
		apellidocasada, sexo, cedula,  nit, activo, colonia, aldea1, caserio, calle, numero,idmunicipio_nac, idregistro, estadocivil, nacionalidad, codigo_profesion, idmunicipio_reside, pasaporte,
		nombre_estado_provincia, year(fecha_nacimiento),month(fecha_nacimiento),day(fecha_nacimiento),zona,tipolicencia,licencia,iddepartamento_reside,gafete,idgrupoetnico,direccion_para_notificaciones,igss,empadronamiento,gruposanguineo,altura,peso,idasesor,userfilefoto FROM asesor WHERE gafete = '$num_gafete'";
		
		$resultado = mssql_query($sqpersona);
		$row = mssql_fetch_array($resultado);
		
		

		

?>
</p>
<p align="center" class="MenuUnderline"><em>Ministerio de Economia Guatemala, CONTRATO EMPLEADO</em></p>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td height="318">
  <table width="100%" border="0" align="left" cellspacing="0">
  <tr class="Estilo7">
    <td width="743" height="87" class="Estilo7" align="center" style= "LINE-HEIGHT:30px;"><div align="justify">
	  <p><img src="contratologo.png" />
          <br />
          <br />
		  
          <strong>CONTRATO  DE SERVICIOS T&Eacute;CNICOS N&Uacute;MERO GG-101-175-029-2016</strong>. En la ciudad de  Guatemala,
        el tres de octubre del a&ntilde;o dos mil diecis&eacute;is, <strong>POR UNA PARTE: ENMER SA&Uacute;L LUCH ESTRADA</strong> de 
  &nbsp;cincuenta y  cuatro (54) a&ntilde;os de edad, casado, guatemalteco, Contador P&uacute;blico y Auditor, de  este
  &nbsp;domicilio, me  identifico con el Documento Personal de Identificaci&oacute;n &ndash;DPI- en el que consta  que mi 
  &nbsp;C&oacute;digo &Uacute;nico de  Identificaci&oacute;n es el Un mil seiscientos uno, ochenta y tres mil ciento setenta,  cero 
  &nbsp;cuatrocientos  once (1601 83170 0411), emitido por el Registro Nacional de las Personas de la  Rep&uacute;blica
  &nbsp;de Guatemala  (RENAP). Act&uacute;o en mi calidad de Viceministro Administrativo y Financiero, lo  cual
  &nbsp;acredito con certificaci&oacute;n  del Acuerdo Gubernativo de nombramiento n&uacute;mero veintisiete (27), de fecha 
  &nbsp;treinta de mayo  de dos mil diecis&eacute;is y Acta de toma de posesi&oacute;n del cargo n&uacute;mero ochenta y  siete (87)
        de fecha treinta y uno de mayo de dos mil diecis&eacute;is  que obra a folio ciento trece (113) del libro de Actas 
  &nbsp;de la  Secretar&iacute;a General del Ministerio de Econom&iacute;a, comparezco para la suscripci&oacute;n  del presente 
  &nbsp;contrato de  conformidad con lo establecido en el Acuerdo Ministerial n&uacute;mero seiscientos  ochenta y 
  &nbsp;cuatro gui&oacute;n  dos mil quince (684-2015), de fecha diecis&eacute;is de diciembre de dos mil quince,  en el que se 
  &nbsp;dispone en el  Art&iacute;culo uno (1) &quot;Delegar en los responsables de las Unidades Ejecutoras  la facultad de 
  &nbsp;suscribir los  contratos por servicios t&eacute;cnicos y profesionales sin relaci&oacute;n de dependencia,  para el 
  &nbsp;ejercicio  fiscal dos mil diecis&eacute;is (2016), con cargo al rengl&oacute;n de gasto 029 &quot;Otras  remuneraciones de 
  &nbsp;personal  temporal&quot;, subgrupo 08 &quot;Personal Contratado por Organismos  Internacionales&quot;, rengl&oacute;n 081  &quot;Personal Administrativo, T&eacute;cnico, Profesional y  Operativo&quot;, y del subgrupo 18 &quot;Servicios T&eacute;cnicos y 
  &nbsp;Profesionales&quot;, siempre que exista  autorizaci&oacute;n del viceministro que corresponda y se cuente con 
  &nbsp;disponibilidad  presupuestaria&quot;; Acuerdo Gubernativo n&uacute;mero ciento setenta gui&oacute;n dos mil  diecis&eacute;is&nbsp; 
  &nbsp;(170-2016), de  fecha veinticinco de junio de dos mil diecis&eacute;is, &quot;Reglamento Org&aacute;nico  Interno del 
  &nbsp;Ministerio de  Econom&iacute;a&quot;, y Acuerdo Ministerial Doscientos cuarenta y siete gui&oacute;n dos mil  diecis&eacute;is (247-
        2016), de fecha veinte de junio de dos mil diecis&eacute;is, y <strong>POR LA OTRA PARTE: <? echo $row[0]," ",$row[1];?> </strong>  
        <strong><? echo $row[3]," ",$row[4];?> </strong>de cincuenta y siete (57) a&ntilde;os de edad, soltero,  guatemalteco, Perito en Administraci&oacute;n 
  &nbsp;P&uacute;blica, de este domicilio, me  identifico con Documento Personal de Identificaci&oacute;n -DPI- en el que 
  &nbsp;consta que mi  C&oacute;digo &Uacute;nico de Identificaci&oacute;n es el Dos mil  quinientos sesenta y tres, treinta y cuatro mil 
  &nbsp;trescientos setenta y cuatro, cero ciento uno (2563  34374 0101), extendido por el Registro  Nacional de 
  &nbsp;las Personas de  la Rep&uacute;blica de Guatemala, asimismo poseo el n&uacute;mero de identificaci&oacute;n  tributaria (NIT) 
        Setecientos veitiocho mil ciento  setenta y ocho gui&oacute;n uno (728178-1) y  resido en Novena calle &quot;A&quot; 
        diecis&eacute;is avenida &quot;A&quot; Lote  ochenta y ocho zona uno, Guatemala, lugar que se&ntilde;alo para recibir citaciones, 
        notificaciones o emplazamientos. Ambos otorgantes,  aseguramos: <strong>a)</strong> Ser de los datos de  identificaci&oacute;n 
  &nbsp;personal  consignados; <strong>b)</strong> Hallarnos en el  libre ejercicio de nuestros derechos civiles; <strong>c)</strong> Que hemos 
  &nbsp;tenido a la  vista los documentos de identificaci&oacute;n indicados y la documentaci&oacute;n con la que  se acredita la 
  &nbsp;calidad con que  se act&uacute;a, la que de conformidad con la ley y a nuestro juicio es suficiente  para la 
  &nbsp;celebraci&oacute;n del  presente contrato; <strong>d)</strong> Que en lo  sucesivo <strong>el Ministerio de Econom&iacute;a y</strong> <strong><? echo $row[0]," ",$row[1];?> </strong>
        <strong>&nbsp;<? echo $row[3]," ",$row[4];?>, </strong>se  denominar&aacute;n simplemente como &ldquo;EL CONTRATANTE&rdquo; y &ldquo;EL CONTRATISTA&rdquo;, 
        respectivamente; y, <strong>e)</strong> Que convenimos en otorgar <strong>CONTRATO  DE SERVICIOS T&Eacute;CNICOS</strong>, de 
  &nbsp;conformidad con  las cl&aacute;usulas siguientes: <strong><u>PRIMERA</u></strong>: <em>FUNDAMENTO LEGAL DEL CONTRATO</em>. El 
  &nbsp;presente  contrato se suscribe de conformidad con lo preceptuado por los art&iacute;culos  cuarenta y cuatro, 
        cuarenta y siete, cuarenta y ocho, sesenta y cinco y,  sesenta y nueve de la Ley de Contrataciones del 
  &nbsp;Estado, Decreto  cincuenta y siete gui&oacute;n noventa y dos del Congreso de la Rep&uacute;blica de Guatemala  y 
  &nbsp;sus reformas; y  veintis&eacute;is de su Reglamento, contenido en Acuerdo Gubernativo n&uacute;mero un mil 
  &nbsp;cincuenta y  seis gui&oacute;n noventa y dos, de fecha veintid&oacute;s de diciembre del a&ntilde;o mil  novecientos noventa y 
  &nbsp;dos y sus  reformas del Presidente de la Rep&uacute;blica de Guatemala, art&iacute;culos del dos mil  veintisiete al dos 
  &nbsp;mil treinta y  seis del C&oacute;digo Civil, Decreto Ley n&uacute;mero ciento seis, Decreto n&uacute;mero catorce  gui&oacute;n dos mil 
  &nbsp;quince  (14-2015) del Congreso de la Rep&uacute;blica Ley del Presupuesto General de Ingresos  y Egresos del 
  &nbsp;Estado para el  Ejercicio Fiscal dos mil diecis&eacute;is y la Circular  Conjunta del Ministerio de Finanzas 
  &nbsp;P&uacute;blicas,  Contralor&iacute;a General de Cuentas y Oficina Nacional de Servicio Civil. <strong><u>SEGUNDA</u>:</strong><em> OBJETO </em>
        <em>&nbsp;DEL CONTRATO</em>.&nbsp; &ldquo;EL CONTRATISTA&rdquo; se obliga a prestar sus  SERVICIOS DE CAR&Aacute;CTER T&Eacute;CNICO 
  &nbsp;a &ldquo;EL  CONTRATANTE&rdquo;, en la Direcci&oacute;n Administrativa del  Ministerio de Econom&iacute;a, con toda su 
  &nbsp;dedicaci&oacute;n, diligencia y con  arreglo a las prescripciones en la realizaci&oacute;n de las actividades que se 
  &nbsp;describen a  continuaci&oacute;n, sin ser estas limitativas, sino &uacute;nicamente enunciativas: 1. Apoyar 
  &nbsp;t&eacute;cnicamente en actualizaci&oacute;n de tarjetas de  responsabilidad de empleados del Ministerio de Econom&iacute;a, 
        obtenci&oacute;n de firmas del personal que  tiene a su cargo el bien o bienes que se describen en las tarjetas de 
  &nbsp;responsabilidad, actualizaci&oacute;n permanente de  la base de datos interno, al Sicoin Web de inventarios, al
  &nbsp;libro de inventarios, informaci&oacute;n  complementarios de la Constancia de Ingreso al almac&eacute;n y a 
  &nbsp;inventarios. 2. Apoyar t&eacute;cnicamente en  codificar el mobiliario y equipo de bienes activos y bienes 
  &nbsp;fungibles. 3. Apoyar t&eacute;cnicamente en la  elaboraci&oacute;n de oficios y suscripci&oacute;n de actas. 4. Apoyar 
  &nbsp;t&eacute;cnicamente en levantar el inventario f&iacute;sico  de los bienes en mal estado, formar expedientes, para 
  &nbsp;tramitar la baja de mobiliario y equipo en mal  estado. 5. Apoyo t&eacute;cnico en la actualizaci&oacute;n de los 
  &nbsp;resguardos en Sicoin web de inventarios, a  cada empleado quien tenga asignado los bienes, liberaci&oacute;n 
  &nbsp;de los bienes y asignaci&oacute;n a los nuevos  responsables. 6. Brindar apoyo t&eacute;cnico en otras actividades 
  &nbsp;importantes a realizar en el departamento de  inventarios, de conformidad con las disposiciones por las 
  &nbsp;cuales se le contratan sus servicios. <strong><u>TERCERA:</u></strong> DEL PRECIO DE LOS  SERVICIOS PACTADOS Y 
  &nbsp;FORMA DE PAGO. <strong>a)</strong> &ldquo;EL CONTRATANTE&rdquo; pagar&aacute;: &ldquo;EL  CONTRATISTA&rdquo; por los servicios que le 
  &nbsp;preste, la  cantidad integra total de ONCE MIL SETECIENTOS  CUARENTA Y UN QUETZALES CON 
  &nbsp;NOVENTA Y TRES CENTAVOS (Q.11,741.93),  monto que incluye el Impuesto al Valor Agregado &ndash; IVA, 
        en concepto de honorarios, contra la presentaci&oacute;n de  la factura contable que extender&aacute; a nombre del 
  &nbsp;Ministerio de  Econom&iacute;a con n&uacute;mero de identificaci&oacute;n tributaria - NIT- trescientos cuarenta y  cuatro mil 
  &nbsp;cuarenta y  nueve gui&oacute;n cuatro&nbsp; (344049-4), e informe  de las actividades realizadas durante el mes que 
  &nbsp;se cancela,  documentos que deber&aacute;n ser debidamente aceptados y a satisfacci&oacute;n de &ldquo;EL 
  &nbsp;CONTRATANTE&quot;. Los  honorarios descritos ser&aacute;n cancelados de la siguiente forma: Un primer pago de 
  &nbsp;TRES MIL  SETECIENTOS CUARENTA Y UN QUETZALES CON NOVENTA Y TRES CENTAVOS 
  &nbsp;(Q.3,741.93) y  pagos mensuales de CUATRO MIL QUETZALES EXACTOS (Q.4,000.00), monto que 
  &nbsp;incluye el  Impuesto al Valor Agregado &ndash; IVA, a partir del inicio de la vigencia del plazo  del presente 
  &nbsp;contrato;  siendo condici&oacute;n indispensable de &ldquo;EL CONTRATISTA&rdquo;, entregar su factura e  informe en las 
  &nbsp;fechas en que  le sean solicitados por &ldquo;EL CONTRATANTE&rdquo;, un informe final al vencimiento del  contrato 
  &nbsp;a solicitud de  &ldquo;EL CONTRATANTE&rdquo;, cuando este lo considere necesario; caso contrario no se har&aacute; 
  &nbsp;efectivo el  pago correspondiente. Los pagos ser&aacute;n cubiertos con cargo a la partida  presupuestaria 
  &nbsp;&ldquo;2016-11130011-101-00-01-00-000-004-0101-029-11&rdquo;,  financiados con fondos del Presupuesto General 
  &nbsp;de Ingresos y  Egresos del Estado, propios del ejercicio fiscal del a&ntilde;o dos mil diecis&eacute;is  (2016), de 
  &nbsp;Servicios  Generales. Unidad Ejecutora identificada con  Cuentadancia n&uacute;mero M2-9-2. <strong>b)</strong> El  Contratista 
  &nbsp;tiene derecho a  que, adem&aacute;s de la retribuci&oacute;n, se le pague los gastos en que incurra cuando con  motivo 
  &nbsp;de los  servicios prestados, tenga que trasladarse al interior o exterior del pa&iacute;s, los  cuales no constituyen 
  &nbsp;ni incrementan  los honorarios pactados en el presente contrato. <strong><u>CUARTA:</u> </strong>PLAZO<em> DEL  CONTRATO</em>.&nbsp; El 
  &nbsp;plazo de este  contrato es del uno de octubre al treinta y uno  de diciembre de dos mil diecis&eacute;is. Dicha 
  &nbsp;contrataci&oacute;n es  de car&aacute;cter temporal. <strong><u>QUINTA:</u></strong> FIANZA<em> DE CUMPLIMIENTO</em>. El  Contratista como 
  &nbsp;requisito  previo para la aprobaci&oacute;n del presente Contrato, deber&aacute; constituir a favor y a  entera 
  &nbsp;satisfacci&oacute;n de  &ldquo;EL CONTRATANTE&rdquo;, en&nbsp; una Instituci&oacute;n  afianzadora debidamente autorizada para 
  &nbsp;operar en la Rep&uacute;blica  de Guatemala y de reconocida capacidad y solvencia financiera, una fianza 
  &nbsp;equivalente al <strong>diez por ciento (10%),</strong> del valor total  del contrato, que garantizar&aacute; el cumplimiento de las 
  &nbsp;obligaciones  contractuales, su correcta ejecuci&oacute;n y en su caso las sanciones que se impongan  a &ldquo;EL 
  &nbsp;CONTRATISTA&rdquo;,  debiendo entregarla en original.&nbsp; En caso  de incumplimiento del contrato que se
  &nbsp;suscribe, la  fianza se har&aacute; efectiva por la instituci&oacute;n afianzadora, con base en el reclamo  que se haga a
  &nbsp;&ldquo;EL  CONTRATISTA&rdquo;, sin necesidad de juicio alguno y/o expediente administrativo,  extremos que se 
  &nbsp;har&aacute;n constar  en la p&oacute;liza respectiva. <strong><u>SEXTA:</u></strong> APROBACI&Oacute;N: De conformidad con la Ley de 
  &nbsp;Contrataciones  del Estado, este contrato de servicios T&Eacute;CNICOS necesita  aprobaci&oacute;n por medio de 
  &nbsp;Acuerdo Ministerial, mismo  que es necesario para su plena validez.&nbsp; <strong><u>S&Eacute;PTIMA:</u> </strong><em>IMPUESTOS Y </em>
        <em>&nbsp;RETENCIONES</em>.&nbsp; El Contratista bajo su estricta  responsabilidad debe satisfacer los tributos acorde a su 
  &nbsp;sistema de  contabilidad que del presente contrato se deriven, en consecuencia cada pago de  honorarios 
  &nbsp;que se haga a  &ldquo;EL CONTRATISTA&rdquo;, estar&aacute; afecto a las retenciones y al pago de los impuestos  que le 
  &nbsp;fueren  aplicables. <strong><u>OCTAVA:</u></strong> DISPOSICIONES<em> GENERALES</em>.&nbsp; Forman parte del presente contrato y 
  &nbsp;quedan  incorporados al mismo el expediente que sirvi&oacute; de base para su faccionamiento,  as&iacute; como toda 
  &nbsp;documentaci&oacute;n  que se produzca hasta el otorgamiento del correspondiente y rec&iacute;proco finiquito  entre los 
  &nbsp;otorgantes. <strong><u>NOVENA:</u></strong> EVALUACI&Oacute;N<em> DE LOS SERVICIOS</em>.&nbsp; La evaluaci&oacute;n de los servicios de &ldquo;EL 
  &nbsp;CONTRATISTA&rdquo;,  ser&aacute; efectuada de acuerdo a &ldquo;EL CONTRATANTE&rdquo;, por lo que el informe que rinda  &ldquo;EL 
  &nbsp;CONTRATISTA&rdquo;,  deber&aacute; ser aprobado por quien coordina sus actividades y a trav&eacute;s del cual, de 
  &nbsp;conformidad con  la naturaleza del servicio prestado, evaluar&aacute; el producto del servicio y la  calidad del 
  &nbsp;mismo.&nbsp; En tal virtud en cualquier momento que decida  &ldquo;EL CONTRATANTE&rdquo;, podr&aacute; designar a la 
  &nbsp;persona o  personas que eval&uacute;en los servicios que &ldquo;EL CONTRATISTA&rdquo; realice. <strong><u>D&Eacute;CIMA:</u></strong> 
        PROHIBICIONES. A &ldquo;EL CONTRATISTA&rdquo; le queda  expresamente prohibido ceder los derechos 
  &nbsp;provenientes  del presente contrato, as&iacute; como proporcionar informaci&oacute;n a terceros sobre los  asuntos que 
  &nbsp;son o sean de  su conocimiento como consecuencia de los servicios que preste a &ldquo;EL  CONTRATANTE&rdquo;.&nbsp; 
        Las actividades, documentos e informes que se originen  de este contrato ser&aacute;n propiedad exclusiva de 
  &nbsp;&ldquo;EL  CONTRATANTE&rdquo;. <strong><u>D&Eacute;CIMA PRIMERA:</u></strong> OTRAS<em> CONDICIONES</em>.&nbsp; Los servicios que prestar&aacute; &ldquo;EL 
  &nbsp;CONTRATISTA&rdquo;  ser&aacute;n de car&aacute;cter estrictamente T&Eacute;CNICO y  el contratista no tiene calidad de servidor o 
  &nbsp;funcionario  p&uacute;blico, por lo que no tiene derecho a las prestaciones administrativo &ndash;  funcionales que la 
  &nbsp;Ley de Servicio  Civil otorga a los servidores p&uacute;blicos, tales como: Indemnizaci&oacute;n, vacaciones,  aguinaldo, 
        bonificaciones, pago de tiempo extraordinario,  licencias y permisos, etc&eacute;tera, por cuanto que la 
  &nbsp;retribuci&oacute;n  acordada no tiene la calidad de sueldo o salario sino de honorarios y, como  consecuencia, 
        este contrato no crea relaci&oacute;n laboral entre los  otorgantes, tal como se regula en la Circular Conjunta del 
  &nbsp;Ministerio de  Finanzas P&uacute;blicas, Contralor&iacute;a General de Cuentas y Oficina Nacional de  Servicio Civil de 
  &nbsp;fecha dos de  enero de mil novecientos noventa y siete, por lo que cualquier reclamaci&oacute;n que  tuviere en 
  &nbsp;relaci&oacute;n al  presente instrumento en los t&eacute;rminos pactados deber&aacute; dilucidarla en los &oacute;rganos 
  &nbsp;jurisdiccionales competentes por raz&oacute;n de la  materia; as&iacute; mismo el Ministerio de Econom&iacute;a le 
  &nbsp;proporcionara  al CONTRATISTA los gastos en que incurran cuando por motivo de los servicios que 
  &nbsp;presta tenga  que trasladarse al interior o exterior del pa&iacute;s. <strong><u>D&Eacute;CIMA SEGUNDA:</u></strong> SANCIONES. En caso 
  &nbsp;de  incumplimiento de sus obligaciones contractuales &ldquo;EL CONTRATISTA&rdquo; deber&aacute; pagar  en concepto de 
  &nbsp;sanci&oacute;n  pecuniaria por cada d&iacute;a de incumplimiento de las mismas, una suma equivalente  al cero punto 
  &nbsp;cinco por  millar del valor total del Contrato. No obstante lo anterior, en caso de  incumplimiento de las 
  &nbsp;condiciones  establecidas en el presente contrato, se ejecutar&aacute; la fianza respectiva, salvo  caso fortuito o 
  &nbsp;causa de fuerza  mayor debidamente comprobadas y aceptadas por &ldquo;EL CONTRATANTE&rdquo;. &ldquo;EL 
  &nbsp;CONTRATISTA&rdquo; al  concluir el contrato ya sea por rescisi&oacute;n de mutuo acuerdo o bien unilateral  antes del 
  &nbsp;vencimiento del  plazo, as&iacute; como a la finalizaci&oacute;n del contrato, est&aacute; obligado a devolver el  mobiliario y 
  &nbsp;equipo que le  fuera asignado, obteniendo posteriormente la solvencia en la Direcci&oacute;n  Financiera y 
  &nbsp;Direcci&oacute;n Administrativa de  &ldquo;EL CONTRATANTE&rdquo;.&nbsp; Caso contrario &ldquo;EL  CONTRATANTE&rdquo;, proceder&aacute; a 
  &nbsp;realizar las  acciones legales que estime pertinente.&nbsp; <strong><u>D&Eacute;CIMA TERCERA:</u></strong><em> CONTROVERSIAS.</em>&nbsp; Las 
  &nbsp;Controversias  que surjan relativas al cumplimiento, interpretaci&oacute;n, aplicaci&oacute;n y efectos de  este contrato, 
        se resolver&aacute;n con car&aacute;cter conciliatorio y en caso de  no llegarse a un acuerdo, se someter&aacute;n a la 
  &nbsp;jurisdicci&oacute;n  del Tribunal de lo Contencioso Administrativo.&nbsp;  Para el cumplimiento de las obligaciones 
  &nbsp;provenientes  del presente contrato, &ldquo;EL CONTRATISTA&rdquo; renuncia al fuero de su domicilio y se  somete a 
  &nbsp;los Tribunales  de Justicia que &ldquo;EL CONTRATANTE&rdquo; elija, se&ntilde;alando para recibir citaciones, 
        emplazamientos o notificaciones la direcci&oacute;n de  residencia proporcionada en este instrumento p&uacute;blico, 
        teniendo como bien hechas las que all&iacute; se le  hagan.&nbsp; <strong><u>D&Eacute;CIMA CUARTA:</u></strong><em> TERMINACI&Oacute;N Y FINIQUITO</em>.&nbsp;
        El presente contrato se dar&aacute; por terminado cuando  ocurran cualesquiera de las circunstancias siguientes: 
        <strong>a)</strong> Por vencimiento del plazo;&nbsp; <strong>b)</strong> Por rescisi&oacute;n acordada de mutuo  acuerdo; <strong>c)</strong> Por caso fortuito o de 
  &nbsp;fuerza mayor,  para cualquiera de las partes contratantes que hagan imposible continuar con el 
  &nbsp;cumplimiento  del contrato, eximi&eacute;ndolas de todas las responsabilidades derivadas del mismo,  dando 
  &nbsp;aviso por escrito  de tal circunstancia a la otra parte. <strong>d) </strong>&ldquo;EL CONTRATANTE&rdquo; se reserva del derecho de
  &nbsp;dar por  terminado unilateralmente el presente contrato, sin responsabilidad alguna y  sin necesidad de 
  &nbsp;agotar  previamente ning&uacute;n tr&aacute;mite administrativo o judicial.&nbsp; El finiquito que se otorgue, deber&aacute; ser 
  &nbsp;reciproco entre  las partes.&nbsp; <strong><u>D&Eacute;CIMA QUINTA:</u></strong><em> DECLARACI&Oacute;N JURADA</em>.&nbsp; De manera  expresa &ldquo;EL 
  &nbsp;CONTRATISTA&rdquo;  declara bajo juramento de ley y debidamente enterado de las penas relativas al  delito 
  &nbsp;de perjurio,  que no est&aacute; comprendido dentro de las prohibiciones que establece el Art&iacute;culo  ochenta de la 
  &nbsp;Ley de  Contrataciones del Estado, y que no es deudor moroso del Estado de Guatemala,  ni de las
  &nbsp;entidades a que  se refiera el Art&iacute;culo uno del mismo cuerpo legal.&nbsp; Declara adem&aacute;s que no tiene proceso 
  &nbsp;administrativo  o judicial pendiente en contra de &ldquo;EL CONTRATANTE&rdquo; o sus unidades ejecutoras, 
        garantizando el cumplimiento de tal condici&oacute;n con  todos sus bienes presentes y futuros, sin que esto lo 
  &nbsp;exima de las  dem&aacute;s responsabilidades en que pudiera incurrir.&nbsp; <strong><u>D&Eacute;CIMA  SEXTA:</u></strong><em> ACEPTACI&Oacute;N</em>.&nbsp; En 
  &nbsp;los t&eacute;rminos  relacionados y condiciones descritas &ldquo;EL CONTRATANTE&rdquo; y &ldquo;EL CONTRATISTA&rdquo;, 
        manifestamos nuestra expresa aceptaci&oacute;n a todas y cada  una de las cl&aacute;usulas del presente contrato.&nbsp; 
        Le&iacute;mos &iacute;ntegramente lo escrito y enterados de  contenido, objeto, validez y efectos legales, lo ratificamos, 
        aceptamos y firmamos en cinco (5) hojas de papel bond  tama&ntilde;o oficio con membrete del Ministerio de 
  &nbsp;Econom&iacute;a,  impresas &uacute;nicamente en su anverso. <br /> 
        <br />    
                                                                        </p></div>
    </div></td>
  </tr>
  <tr class="Estilo7">
    <td height="87" class="Estilo7" align="center"> <br /></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
