<?
//Validar la sesion 
	session_start();	
	$usuario_id=($_SESSION["user_id"]);   //codigo del usuario que inicio la sesion
	include("../validate.php");
	$grupo_id=3;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("../logout.php");	
// FIN DE VALIDACION
	$id=$_REQUEST["id"];
	require_once('../../connection/helpdesk.php');
	$consulta = "SELECT * FROM seg_visitante where codigo_visitante='$id'";
	$result=$query($consulta);	
	while($row=$fetch_array($result))
	{	
		$codigo=$row["codigo_visitante"];
		$nombre=$row["nombre_visitante"];
		$cbo_registro=$row["codigo_registro_cedula"];		
		$cedula=$row["numero_cedula"];		
		$licencia=$row["numero_licencia"];		
		$pasaporte=$row["numero_pasaporte"];		
		$carnet=$row["numero_carnet"];		
		$municipio=$row["extendida_en"];		
		$direccion=$row["direccion"];				
		$colegio=$row["colegio"];		
	}	
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
 if (form.txt_motivo.value!= "" && form.cbo_lista_negra.value == "2")
  { 
  	alert("Seleccione SI en el combo anterior"); 
	form.cbo_lista_negra.focus(); 
	return;
  }
 if (form.txt_motivo.value== "" && form.cbo_lista_negra.value == "1")
  { 
  	alert("Describa el motivo por el cual fu� colocado en lista negra"); 
	form.txt_motivo.focus(); 
	return;
  }
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.cbo_lista_negra.focus(); 
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
      <td><div align="center">Agregando a lista negra al visitante</div></td>
    </tr>
  </table>
</div>
<form name="form1" method="post" action="glista_negra.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td colspan="4">Datos principales del visitante: </td>
    </tr>
    <tr>
      <td width="8%">Nombre:* </td>
      <td colspan="3"><? echo $nombre; ?></td>
    </tr>
    <tr>
      <td align="left" class="alt1">C&eacute;dula:*</td>
      <td width="15%" align="left" class="alt1"><? echo $cedula; ?></td>
      <td width="26%" align="left" class="alt1"> Extendida en:
<?
					//Para desplegar como primer elemento del combo el municipio actual					
					$consulta="SELECT * FROM seg_municipio where codigo_municipio='$municipio'";
					$result=$query($consulta);	
					while($row=$fetch_array($result))
					{
						echo $row["nombre_municipio"];
					}
					$close($s);
				?></td>
      <td width="51%" align="left" class="alt1">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" class="alt1">Licencia:</td>
      <td align="left" class="alt1"><? echo $licencia; ?></td>
      <td colspan="2" align="left" class="alt1">Pasaporte: <? echo $pasaporte; ?></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Carnet:</td>
      <td align="left" class="alt1"><? echo $carnet ?></td>
      <td align="left" class="alt1">Direcci&oacute;n: <? echo $direccion; ?></td>
      <td align="left" class="alt1">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" class="alt1">Colegio:</td>
      <td colspan="3" align="left" class="alt1"><? echo $colegio; ?></td>
    </tr>
    <tr>
      <td colspan="2" align="left" class="alt1">Agregar a lista negra: 
        <select name="cbo_lista_negra" size="1" id="cbo_lista_negra">
          <option value="1">SI</option>
          <option value="2" selected>NO</option>
              </select></td>
      <td align="left" class="alt1">&nbsp;</td>
      <td align="left" class="alt1">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" class="alt1">Motivo:</td>
      <td colspan="3" align="left" class="alt1"><textarea name="txt_motivo" cols="50" id="txt_motivo"></textarea>
        <span class="alt2">
        <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>">
      </span></td>
    </tr>
    <tr>
      <td colspan="2" align="left" class="alt1"><span class="alt2">
  </span><span class="alt2">
        <input name="bt_guardar" type="button" id="bt_guardar" onClick="Validar(this.form)"  value="Ejecutar  petici&oacute;n">
      </span></td>
      <td colspan="2" align="left" class="alt1"><span class="alt2">
      </span></td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
