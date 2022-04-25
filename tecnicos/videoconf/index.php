<head>
<link href="../estilo.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
if (form.cbo_dia.value == "0")
  { 
  	alert("Seleccione día"); 
	form.cbo_dia.focus(); 
	return;
  }
  if (form.cbo_mes.value == "0")
  { 
  	alert("Seleccione mes"); 
	form.cbo_mes.focus(); 
	return;
  }
    if (form.cbo_inicia.value == "0")
  { 
  	alert("Indique hora de inicio"); 
	form.cbo_inicia.focus(); 
	return;
  }
      if (form.cbo_finaliza.value == "0")
  { 
  	alert("Indique hora de finalización"); 
	form.cbo_finaliza.focus(); 
	return;
  }    	 
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_dia.focus(); 
}
</script>
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
  <form method="post" name="form1" action="comprobar.php">
    <div align="center">
      <p align="left">Fecha y hora de la videoconferencia: </p>
      <table width="100%" bgcolor="#CCCCCC" class="tborder" id="table3">
        <tr valign="baseline">
          <td align="right" nowrap><div align="left"><strong>Sal&oacute;n:</strong></div></td>
          <td colspan="3" align="right" nowrap><div align="left">
              <?
					require_once('../../connection/helpdesk.php'); 
					$query2="SELECT * FROM salon ORDER BY nombre_salon";
					$result2=mssql_query($query2);	
					echo('<select name="cbo_salon">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row2=mssql_fetch_array($result2))
					{
						echo'<option value="'.$row2["codigo_salon"].'">'.$row2["nombre_salon"].'</option>';
					}
					echo('</select>');				
					mssql_close($s);					
				?>
          </div></td>
          <td colspan="-1">&nbsp;</td>
          <td colspan="-1">&nbsp;</td>
          <td colspan="-1">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td width="55" align="right" nowrap><div align="left"><b>D&iacute;a:</b></div>            </td>
          <td width="111" align="right" nowrap><div align="left">
            <select name="cbo_dia" size="1" id="cbo_dia">
                <option value="0" selected>-- Seleccione --</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
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
            </select>
          </div></td>
          <td width="56" align="right" nowrap><b>Mes:</b></td>
          <td width="139" colspan="-1"><select name="cbo_mes" size="1" id="cbo_mes">
            <option value="0" selected>-- Seleccione --</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select></td>
          <td width="49" colspan="-1"><b>A&ntilde;o:</b></td>
          <td width="70" colspan="-1"><select name="cbo_anio" size="1" id="cbo_anio">
            <option value="2006">2006</option>
            <option value="2007" selected>2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
          </select></td>
          <td width="477" colspan="-1">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td align="right" nowrap><div align="left"><strong>De: </strong></div></td>
          <td align="right" nowrap><div align="left">
            <select name="cbo_inicia" size="1" id="cbo_inicia">
                <option value="0" selected>-- Seleccione --</option>
                <option value="6">06:00</option>
                <option value="7">07:00</option>
                <option value="8">08:00</option>
                <option value="9">09:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
                <option value="17">17:00</option>
                <option value="18">18:00</option>
                <option value="19">19:00</option>
            </select>
          </div></td>
          <td align="right" nowrap><strong>A:</strong></td>
          <td align="right" nowrap><div align="left">
            <select name="cbo_finaliza" size="1" id="cbo_finaliza">
              <option value="0" selected>-- Seleccione --</option>
              <option value="6">06:00</option>
              <option value="7">07:00</option>
              <option value="8">08:00</option>
              <option value="9">09:00</option>
              <option value="10">10:00</option>
              <option value="11">11:00</option>
              <option value="12">12:00</option>
              <option value="13">13:00</option>
              <option value="14">14:00</option>
              <option value="15">15:00</option>
              <option value="16">16:00</option>
              <option value="17">17:00</option>
              <option value="18">18:00</option>
              <option value="19">19:00</option>
                        </select>
          </div></td>
          <td colspan="2" align="right" nowrap>&nbsp;</td>
          <td align="right" nowrap>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td colspan="3" align="right" nowrap>&nbsp;</td>
          <td colspan="4" align="right" nowrap>&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td colspan="3" align="right" nowrap><div align="left">
            <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Comprobar disponibilidad...">
          </div></td>
          <td colspan="4" align="right" nowrap><div align="left">
          </div></td>
        </tr>
      </table>
    </div>
   </form>
</div>