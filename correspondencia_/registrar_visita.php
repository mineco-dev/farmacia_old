<?
	//Validar la sesion 
	session_start();	
	$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	include("../validate.php");
	$grupo_id=3;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");		
	if (isset($_SESSION['ultima_visita'])) 
	{
		session_unregister('ultima_visita');	
	}			
	require_once('../../connection/helpdesk.php'); 
					$consulta1="SELECT * FROM seg_visitante where codigo_visitante='$id'";
					$result1=$query($consulta1);	
					while($row1=$fetch_array($result1))
					{
						$nombre_visitante=$row1["nombre_visitante"];
					}
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
    if (form.chk_arma.value == "1" && form.txt_casillero.value=="")
  { 
  	alert("Escriba el n�mero de casillero donde deposit� el arma"); 
	form.txt_casillero.focus(); 
	return;
 } 
  if (form.txt_gafete.value == "")
  { 
  	alert("Escriba el N�mero de gafete proporcionado"); 
	form.txt_gafete.focus(); 
	return;
 }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_gafete.focus(); 
}
</script>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<link href="../../helpdesk.css" rel="stylesheet" type="text/css">
<style>
<!--
.bodyplainwhite { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: 98A2AB; font-weight: normal }
.bodyplain { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: #000000; font-weight: normal}
.credit { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; font-style: normal; color: #CCCCCC; font-weight: bold ; text-decoration: none }
-->
</style>



</head>

<body>

<div align="left">
  <table width="100%" border="0">
    <tr>
      <td><div align="center">Registro de visitas</div></td>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="gregistrar_visita.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td colspan="8">Datos Generales de la visita 
      <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>"></td>
    </tr>
    <tr>
      <td width="10%">Visitante:</td>
      <td colspan="7"><? echo $nombre_visitante; ?>	  </td>
    </tr>
    <tr>
      <td align="left" class="alt1">No. gafete: </td>
      <td colspan="7" align="left" class="alt1"><input name="txt_gafete" type="text" id="txt_gafete" size="10"></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Porta arma?</td>
      <td width="8%" align="left" class="alt1"><select name="chk_arma" id="chk_arma">
        <option value="0">- Seleccione -</option>
        <option value="1">SI</option>
        <option value="2">NO</option>
      </select></td>
      <td width="11%" align="left" class="alt1">Casillero:</td>
      <td width="4" colspan="5" align="left" class="alt1"><input name="txt_casillero" type="text" id="txt_casillero" size="5"></td>
    </tr>
    <tr>
      <td align="left" class="alt1"><span class="alt2">
        <input name="bt_enviar" onClick="Validar(this.form)" type="button" value="Continuar...">
      </span></td>
      <td colspan="7" align="left" class="alt1">&nbsp;</td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
