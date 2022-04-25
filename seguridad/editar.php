<?	
$grupo_id=3; // Para agentes de seguridad 
include("../restringir.php");	
?>
<?
	$id=$_REQUEST["id"];
	require_once('../connection/helpdesk.php');
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
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<style>
<!--
.bodyplainwhite { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: 98A2AB; font-weight: normal }
.bodyplain { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: #000000; font-weight: normal}
.credit { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; font-style: normal; color: #CCCCCC; font-weight: bold ; text-decoration: none }
-->
</style>



</head>

<body>

<div align="left"> </div>
<form name="form1" method="post" action="geditar.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td colspan="4">Datos  del visitante seleccionado: </td>
    </tr>
    <tr class="detalletabla1">
      <td width="8%">Nombre:* </td>
      <td colspan="3"><input name="txt_nombre" type="text" id="txt_nombre" value="<? echo $nombre ?>" size="57"></td>
    </tr>
    <tr class="detalletabla2">
      <td align="left" class="alt1">C&eacute;dula:*</td>
      <td align="left" class="alt1">	  		<input name="txt_numero_cedula" type="text" id="txt_numero3" value="<? echo $cedula ?>"></td>
      <td width="14%" align="left" class="alt1">
	  <?
					//Para desplegar como primer elemento del combo el municipio actual					
					$consulta="SELECT * FROM seg_municipio where codigo_municipio='$municipio'";
					$result=$query($consulta);	
					while($row=$fetch_array($result))
					{
						$nombre_municipio=$row["nombre_municipio"];
					}
					//Para mostrar los elementos siguientes del combo
					$consulta="SELECT * FROM seg_municipio where codigo_municipio<>'$municipio' order by nombre_municipio";
					$result=$query($consulta);	
					echo('<select name="cbo_municipio">');
					echo'<option value="0">'.$nombre_municipio.'</option>';
					while($row=$fetch_array($result))
					{
						echo'<option value="'.$row["codigo_municipio"].'">'.$row["nombre_municipio"].'</option>';
					}
					echo('</select>');
					$close($s);
				?></td>
      <td width="56%" align="left" class="alt1">&nbsp;</td>
    </tr>
    <tr class="detalletabla1">
      <td align="left" class="alt1">Licencia:</td>
      <td align="left" class="alt1"><input name="txt_licencia" type="text" id="txt_licencia" value="<? echo $licencia ?>"></td>
      <td colspan="2" align="left" class="alt1">&nbsp;</td>
    </tr>
    <tr class="detalletabla2">
      <td align="left" class="alt1">Pasaporte</td>
      <td colspan="3" align="left" class="alt1"><input name="txt_pasaporte" type="text" id="txt_pasaporte" value="<? echo $pasaporte ?>"></td>
    </tr>
    <tr class="detalletabla1">
      <td align="left" class="alt1">Carnet</td>
      <td colspan="3" align="left" class="alt1"><input name="txt_carnet" type="text" id="txt_carnet" value="<? echo $carnet ?>"></td>
    </tr>
    <tr class="detalletabla2">
      <td align="left" class="alt1">Direcci&oacute;n: </td>
      <td colspan="3" align="left" class="alt1"><input name="txt_direccion" type="text" id="txt_direccion" value="<? echo $direccion ?>" size="50"></td>
    </tr>
    <tr class="detalletabla1">
      <td align="left" class="alt1">Colegio:</td>
      <td colspan="3" align="left" class="alt1"><input name="txt_colegio" type="text" id="txt_colegio" value="<? echo $colegio ?>" size="50"></td>
    </tr>
    <tr>
      <td colspan="2" align="left" class="alt1"><span class="alt2">
   <input name="bt_guardar" type="submit" id="bt_guardar4" value="Actualizar">
  </span><span class="alt2">
      </span></td>
      <td colspan="2" align="left" class="alt1"><span class="alt2">
        <input name="txt_codigo" type="hidden" id="txt_codigo" value="<? echo $id ?>">
        <input name="txt_municipio" type="hidden" id="txt_municipio" value="<? echo $municipio ?>">
      </span></td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
