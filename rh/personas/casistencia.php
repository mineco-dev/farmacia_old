<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript">

function seleccion()
{
	if (window.document.form1.opfalta[0].checked)
	{
	   document.getElementById("div_horario1").style.display = "inline";
	   document.getElementById("div_horario2").style.display = "none";
   	   document.getElementById("div_faltardia").style.display = "none";
	}
	if (window.document.form1.opfalta[1].checked)
	{
	   document.getElementById("div_horario1").style.display = "none";
	   document.getElementById("div_horario2").style.display = "inline";
   	   document.getElementById("div_faltardia").style.display = "none";
	}
	if (window.document.form1.opfalta[2].checked)
	{
	   document.getElementById("div_horario1").style.display = "none";
	   document.getElementById("div_horario2").style.display = "none";
   	   document.getElementById("div_faltardia").style.display = "inline";
	}
}



function Validar(form)
{

	if (form.empleado.value == ""){ alert("Ingrese un Empleado Valido"); form.empleado.focus(); return;}
	


  	  if ((!form.opfalta[0].checked) && (!form.opfalta[1].checked) && (!form.opfalta[2].checked))
	  { 
	  	alert("Por favor ingrese El Tipo de Permiso"); 
		form.opfalta[0].focus(); 
		return; 		
	  }else{
	  
	   if(form.opfalta[0].checked)
	   {
	   		if(form.h1.value==""){ alert("Por Favor Seleccione la Hora"); form.h1.focus(); return; }
			if(form.m1.value==""){ alert("Por Favor Seleccione los Minutos"); form.m1.focus(); return; }
	   }
	   
	    if(form.opfalta[1].checked)
	   {
	   		if(form.h2.value==""){ alert("Por Favor Seleccione la Hora"); form.h2.focus(); return; }
			if(form.m2.value==""){ alert("Por Favor Seleccione los Minutos"); form.m2.focus(); return; }
	   		if(form.h3.value==""){ alert("Por Favor Seleccione la Hora"); form.h3.focus(); return; }
			if(form.m3.value==""){ alert("Por Favor Seleccione los Minutos"); form.m3.focus(); return; }

	   }
	   
	    if(form.opfalta[2].checked)
	   {
	   		if(form.dia.value==""){ alert("Por Favor Seleccione el Dia"); form.dia.focus(); return; }
			if(form.mes.value==""){ alert("Por Favor Seleccione el Mes"); form.mes.focus(); return; }
			if(form.anio.value==""){ alert("Por Favor Seleccione el A�o"); form.anio.focus(); return; }
	   }
	  
			
	  }

	  if (form.motivo.value == "0")
	  { alert("Por favor ingrese El Motivo"); form.motivo.focus(); return; }
	  
	  if (form.observaciones.value == "")
	  { alert("Por favor ingrese El detalle"); form.observaciones.focus(); return; }
	  
	




if (confirm('Esta Seguro que desea Generar Este Formulario?')){ 
    //  document.form.submit() 
		form.submit();
  	} 
}

</script>


<?

include('../includes/inc_header_sistema.inc');

function get_depe1()
{
	
$consulta = mssql_query("select iddireccion,nombre from direccion where activo=1 order by nombre");																									
	if ($consulta)
		{

			while($row = mssql_fetch_row($consulta))	
			{
				$opciones = $opciones."<option value = ".$row[0]. ">".$row[1]."</option>";
			}
			
	}
	return $opciones;
}


$p = get_depe1();



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

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo22 {font-size: 11px}
.style2 {color: #FFFFFF}
-->
</style>
<link rel="stylesheet" href="../includes/estilos.css">
</head>

<body>
<p><strong>MINISTERIO DE  ECONOMIA<br />
  Subgerencia de Recursos Humanos</strong></p>
<p>
<? print $x; ?>
</p>
<p align="center" class="titulo_docto"><strong>CONTROL DE ASISTENCIA</strong></p>
<form name="form1" id="form1" action="casistencia1.php" method="post" enctype="multipart/form-data" target="_blank">
<table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="29%" class="defaultfieldname">Empleado</td>
    <td width="71%" class="detalletabla2"><select name="empleado" id="empleado"> 
		<?
			$query = "select gafete,nombre+' '+nombre2+' '+nombre3+' '+apellido+' '+apellido2,idasesor from asesor";
			$x = mssql_query($query);
			while($vec=mssql_fetch_array($x))
			{
				print '<option value = "'.$vec[0].'">'.$vec[1].'</option>';
			}
		?>
	</select>&nbsp;</td>
  </tr>
  
  <tr>
    <td class="defaultfieldname">Tipo de Permiso </td>
    <td class="detalletabla2"><p>
      <label>
        <input type="radio" name="opfalta" id="opfalta" value="1" onclick="seleccion();" />
        Ausentarse Despues del Horario</label>
      <br />
      <label>
        <input type="radio" name="opfalta" id="opfalta" value="2" onclick="seleccion();"/>
        Ausentarse Durante el Horario</label>
      <br />
      <label>
        <input type="radio" name="opfalta"  id="opfalta" value="3" onclick="seleccion();"/>
        Faltar el Dia</label>
      <br />
    </p></td>
  </tr>
  <tr class="defaultfieldname">
    <td colspan="2">
	
	<span id="div_horario1" style="display:none">			
	
	
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#999999">
      
      <tr>
        <td width="36%">&nbsp;</td>
        <td width="64%"><table width="16%" border="0" cellpadding="0" cellspacing="0" bordercolor="#999999">
          <tr>
            <td width="36%" bgcolor="#000000"><span class="style2">Hora</span></td>
            <td width="8%" bgcolor="#000000">&nbsp;</td>
            <td width="56%" bgcolor="#000000"><span class="style2">Min</span></td>
          </tr>
          <tr>
            <td><select name="h1" id="h1" />
                              <option value="">--</option>
              <?
	$i=8;
		
	 while ($i<=17)
	  {
				print ' <option value="'.$i.'" >'.$i.'</option>';
			  
			  $i++;
	  }
		  
		  
		  ?></td>
            <td>: </td>
            <td><select name="m1" id="m1" />
                              <option value="">--</option>
              <?
	$i=1;
		
	 while ($i<=60)
	  {
				print ' <option value="'.$i.'" >'.$i.'</option>';
			  
			  $i++;
	  }
	
	?></td>
          </tr>
        </table>
          </td>
        </tr>
    </table>
	</span>
	<span id="div_horario2" style="display:none">			
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#666666">
        <tr>
          <td width="36%">&nbsp;</td>
          <td width="64%">
            <table width="34%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="21%" bgcolor="#000000"><span class="style2">Hora</span></td>
                <td width="3%" bgcolor="#000000"><span class="style2"></span></td>
                <td width="16%" bgcolor="#000000"><span class="style2">Min</span></td>
                <td width="12%" bgcolor="#000000"><span class="style2"></span></td>
                <td width="17%" bgcolor="#000000"><span class="style2">Hora</span></td>
                <td width="3%" bgcolor="#000000"><span class="style2"></span></td>
                <td width="28%" bgcolor="#000000"><span class="style2">Min</span></td>
              </tr>
              <tr>
                <td><select name="h2" id="h2" />
                <option value="">--</option>
                  <?
	$i=8;
		
	 while ($i<=17)
	  {
				print ' <option value="'.$i.'" >'.$i.'</option>';
			  
			  $i++;
	  }
		  
		  
		  ?></td>
                <td>:</td>
                <td><select name="m2" id="m2" />
                                <option value="">--</option>
                  <?
	$i=1;
		
	 while ($i<=60)
	  {
				print ' <option value="'.$i.'" >'.$i.'</option>';
			  
			  $i++;
	  }
	
	?></td>
                <td>&lt;--&gt;</td>
                <td><select name="h3" id="h3" />
                                <option value="">--</option>
                  <?
	$i=8;
		
	 while ($i<=17)
	  {
				print ' <option value="'.$i.'" >'.$i.'</option>';
			  
			  $i++;
	  }
		  
		  
		  ?></td>
                <td>:</td>
                <td><select name="m3" id="m3" />
                                <option value="">--</option>
                  <?
	$i=1;
		
	 while ($i<=60)
	  {
				print ' <option value="'.$i.'" >'.$i.'</option>';
			  
			  $i++;
	  }
	
	?></td>
              </tr>
            </table>            
           </td>
        </tr>
      </table>
	  </span>
	  <span id="div_faltardia"  style="display:none" >			
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#999999">
        <tr>
          <td width="36%">&nbsp;</td>
          <td width="64%"><span class="Estilo22">&nbsp;
              <!--input name="dia3" type="text" class="Estilo1" id="dia3" maxlength="2"  size="2"--><!--input name="mes3" type="text" class="Estilo1" id="mes3" size="2" maxlength="2"--><!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4"-->
          </span>
            <table width="19%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="6%" bgcolor="#000000"><span class="style2">Dia</span></td>
                <td width="7%" bgcolor="#000000"><span class="style2">Mes</span></td>
                <td width="87%" bgcolor="#000000"><span class="style2">A&ntilde;o</span></td>
              </tr>
              <tr>
                <td><span class="Estilo22">
                  <select name="dia" id="dia" class="Estilo1">
				                  <option value="">--</option>
                    <?
	$i=1;
		
	 while ($i<=31)
	  {

	  	print '<option value="'.$i.'">'.$i.'</option>';
	
	  
	  $i++;
	 } 
	
	 
	?>
                  </select>
                </span></td>
                <td><span class="Estilo22">
                  <select name="mes" id="mes" class="Estilo1">
                                    <option value="">--</option>
                    <?
	$i=1;
		
	 while ($i<=12)
	  {
				print '<option value="'.$i.'">'.$i.'</option>';
			
			  $i++;
	  }
	
	?>
                  </select>
                </span></td>
                <td><span class="Estilo22">
                <select name="anio" id="anio" class="Estilo1">
				                <option value="">--</option>
                  <?
	 $i=1900;		
	 while ($i<=date('Y'))
	  {
		
			print '<option value="'.$i.'">'.$i.'</option>';
			  
	  $i++;
	  }
	
	 
	?>
                </select>
                </span></td>
              </tr>
            </table></td>
        </tr>
      </table>
	  </span>
      </td>
    </tr>
  <tr>
    <td class="defaultfieldname">&nbsp;</td>
    <td class="detalletabla2">&nbsp;</td>
  </tr>
  <tr>
    <td class="defaultfieldname">Motivo</td>
    <td class="detalletabla2"><select name="motivo" id="motivo">
	<option value="0">----seleccione------</option>
	<option value="1">Comision Oficial</option>
		<option value="2">Temporal</option>
			<option value="3">Permiso Particular</option>
				<option value="4">Definitivo</option>
	</select>&nbsp;</td>
  </tr>
  <tr>
    <td class="defaultfieldname">Observaciones</td>
    <td class="detalletabla2"><label>
      <textarea name="observaciones" cols="60" rows="4" id="observaciones"></textarea>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>
      <input name="cmd_guardar" type="button" onClick="Validar(this.form)" id="cmd_guardar"  class="titulotabla" value="Generar Formulario" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p align="center">&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

