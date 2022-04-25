<?
	session_start();
	include("validate.php");
	$grupo_id=15;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("logout.php");		
?>
<head>
<link href="estilo.css" rel="stylesheet" type="text/css">
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.cbo_mes.value == "0")
  { 
  	alert("Seleccione mes"); 
	form.cbo_mes.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_mes.focus(); 
}
</script>
</head>
<body background="fondos/fondo.gif" style="background-attachment: fixed">
 <div align="center">
  <form method="post" name="form1" action="det_bitacora.php">
    <div align="center">
      <table width="100%" bgcolor="#CCCCCC" class="tborder" id="table3">
        <tr valign="baseline">
          <td width="28" align="right" nowrap><div align="left"><b>Del:</b></div>            </td>
          <td width="29" align="right" nowrap><select name="cbo_dia_del" size="1" id="cbo_dia_del">
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
          </select></td>
          <td width="21" align="right" nowrap><b>Al:</b></td>
          <td width="22" align="right" nowrap><select name="cbo_dia_al" size="1" id="cbo_dia_al">
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
          </select></td>
          <td width="45" align="right" nowrap><b>Mes:</b></td>
          <td width="124" colspan="-1"><select name="cbo_mes" size="1" id="cbo_mes">
            <option value="0">-- Seleccione --</option>
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
          <td width="42" colspan="-1"><b>A&ntilde;o:</b></td>
          <td width="74" colspan="-1"><select name="cbo_anio" size="1" id="cbo_anio">
            <option value="2006">2006</option>
            <option value="2007">2007</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
            <option value="2010">2010</option>
          </select></td>
          <td width="615" colspan="-1"><input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Generar Reporte"></td>
        </tr>
        <tr valign="baseline">
          <td colspan="9" align="right" nowrap><div align="left"></div></td>
        </tr>
      </table>
    </div>
   </form>
</div>
