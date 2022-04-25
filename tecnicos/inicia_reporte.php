<?
	$grupo_id=5;
	include("../restringir.php");	
?>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.cbo_usuario.value == "0")
  { 
  	alert("Seleccione nombre del usuario"); 
	form.cbo_usuario.focus(); 
	return;
  }
  if (form.cbo_estado.value!=2)
  {
    if (form.cbo_dia_inicia.value == "0")
  	{ 
		alert("Seleccione día inicial"); 
		form.cbo_dia_inicia.focus(); 
		return;
  	}
  	if (form.cbo_mes_inicia.value == "0")
  	{ 
		alert("Seleccione mes inicial"); 
		form.cbo_mes_inicia.focus(); 
		return;
  	}
    if (form.cbo_dia_finaliza.value == "0")
  	{ 
		alert("Seleccione dia final"); 
		form.cbo_dia_finaliza.focus(); 
		return;
	}
   if (form.cbo_mes_finaliza.value == "0")
   { 
		alert("Seleccione mes final"); 
		form.cbo_mes_finaliza.focus(); 
		return;
	}
   if (form.cbo_anio_inicia.value == "0")
  { 
  	alert("Seleccione anio inicial"); 
	form.cbo_anio_inicia.focus(); 
	return;
  }
     if (form.cbo_anio_finaliza.value == "0")
  { 
  	alert("Seleccione anio final"); 
	form.cbo_anio_final.focus(); 
	return;
  }
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_usuario.focus(); 
}
</script>

</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
   <p align="left">Par&aacute;metros generales para filtrar el reporte: </p>
   <form method="post" name="form1" action="reporte.php">
    <div align="center">
      <table width="100%" bgcolor="#CCCCCC" class="tborder" id="table3">
        <tr valign="baseline" bgcolor="#C9CDED" >
		<!--bgcolor="#CCFFCC"-->
          <td width="73" align="right" nowrap><div align="left"><b>Personal:</b></div></td>
          <td colspan="7">
            <?
					if (isset($id)) // los reportes para 029 no traen detalle de fechas.
					{
						$r029=1;
					}
					else
					{
						$r029=2;
					}
					if ($dependencia==46) $consulta="SELECT * FROM usuario WHERE activo=1 and codigo_usuario IN (20, 633, 96, 328, 384, 422, 572) ORDER BY nombres";
					else					
					if ($dependencia==10) $consulta="SELECT * FROM usuario WHERE activo=1 and codigo_usuario IN (780, 633, 328, 414, 365, 96,779,700) ORDER BY nombres";
					else $consulta="SELECT * FROM usuario WHERE activo=1 and codigo_dependencia='$dependencia' ORDER BY nombres";
					require_once('../Connection/helpdesk.php'); 					
					$result=mssql_query($consulta);	
					echo('<select name="cbo_usuario">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=mssql_fetch_array($result))
					{
						echo'<option value="'.$row["codigo_usuario"].'">'.$row["nombres"].' '.$row["apellidos"].'</option>';
					}
					echo('</select>');	
					mssql_close($s);					 								
				?>
<?
if (isset($id)) $r029=1;
else $r029=2;
?>
</td>
        </tr>
        <tr valign="baseline" bgcolor="#99CCFF">
          <td align="right" nowrap>Del</td>
          <td width="127"><select name="cbo_dia_inicia" size="1" id="cbo_dia_inicia">
            <option value="0" selected>-- Seleccione --</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
          </select></td>
          <td width="39"><b>Mes:</b></td>
          <td width="116"><select name="cbo_mes_inicia" size="1" id="cbo_mes_inicia">
            <option value="0">-- Seleccione --</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select></td>
          <td width="39"><b>A&ntilde;o:</b></td>
          <td colspan="3"><select name="cbo_anio_inicia" size="1" id="cbo_anio_inicia">
		  
		   <? for ($anio_i = 2006; $anio_i <= date('Y'); $anio_i++)
		   	{ ?>
			if 
			 <option value="<? echo $anio_i; ?>" <? if ($anio_i == date('Y')) { echo 'selected'; }  ?> ><? echo $anio_i; ?></option>
		   <? }
		    ?>
          </select></td>
        </tr>
        <tr valign="baseline" bgcolor="#99CCFF">
          <td align="right" nowrap>Al</td>
          <td><select name="cbo_dia_finaliza" size="1" id="cbo_dia_finaliza">
            <option value="0" selected>-- Seleccione --</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
          </select></td>
          <td><b>Mes:</b></td>
          <td><select name="cbo_mes_finaliza" size="1" id="cbo_mes_finaliza">
            <option value="0">-- Seleccione --</option>
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select></td>
          <td><b>A&ntilde;o:</b></td>
          <td colspan="3"><select name="cbo_anio_finaliza" size="1" id="cbo_anio_finaliza">
  		   <? for ($anio_f = 2006; $anio_f <= date('Y'); $anio_f++)
		   	{ ?>
			if 
			 <option value="<? echo $anio_f; ?>" <? if ($anio_f == date('Y')) { echo 'selected'; }  ?> ><? echo $anio_f; ?></option>
		   <? }
		    ?>
          </select></td>
        </tr>
        <tr valign="baseline" bgcolor="#99CCFF">
          <td colspan="2" align="right" nowrap><div align="left"><strong>Incluir seguimiento?</strong></div></td>
          <td colspan="6"><select name="cbo_seguimiento" size="1" id="select6">
            <option value="2" selected>No</option>
            <option value="1">Si</option>
          </select></td>		  
        </tr>
        <tr valign="baseline" bgcolor="#99CCFF">
          <td colspan="2" align="right" nowrap><div align="left"><strong>Estado de las actividades: </strong></div></td>
          <td colspan="6"><select name="cbo_estado" size="1" id="cbo_estado">
            <option value="2">EN PROCESO</option>
            <option value="3">COMPLETADO</option>
            <option value="4" selected>SUPERVISADO</option>
          </select></td>
        </tr>
        <tr valign="baseline" bgcolor="#99CCFF">
          <td align="right" nowrap><div align="left">
            <input name="r029" type="hidden" id="r029" value="<? echo $r029 ?>">
            </div></td>
          <td colspan="7"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Generar Reporte"></td>
        </tr>
      </table>
      <p align="left"><img src="../images/e03.gif" width="21" height="21"> Para generar un reporte de las actividades que se encuentran en proceso no necesita especificar rangos de fecha. </p>
    </div>
   </form>
</div>

