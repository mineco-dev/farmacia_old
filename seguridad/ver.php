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
		$lista_negra=$row["lista_negra"];		
		$motivo=$row["motivo_lista_negra"];		
		$fecha=$row["fecha_lista_negra"];		
	}	
?>
<html>
<head>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS - SISTEMA FARMACIA MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">
<style>
<!--
.bodyplainwhite { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: 98A2AB; font-weight: normal }
.bodyplain { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; font-style: normal; color: #000000; font-weight: normal}
.credit { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 8pt; font-style: normal; color: #CCCCCC; font-weight: bold ; text-decoration: none }
.Estilo1 {
	color: #FF0000;
	font-size: 24px;
}
-->
</style>



</head>

<body>

<div align="left"></div>
<form name="form1" method="post" action="index.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td colspan="4">Datos del visitante seleccionado: </td>
    </tr>
    <tr class="detalletabla1">
      <td width="10%">Nombre:* </td>
      <td colspan="3"><? echo $nombre; ?></td>
    </tr>
    <tr class="detalletabla2">
      <td align="left" class="alt1">C&eacute;dula:*</td>
      <td width="19%" align="left" class="alt1"><? echo $cedula; ?></td>
      <td colspan="2" align="left" class="alt1"> Extendida en:
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
    </tr>
    <tr class="detalletabla1">
      <td align="left" class="alt1">Licencia:</td>
      <td align="left" class="alt1"><? echo $licencia; ?></td>
      <td colspan="2" align="left" class="alt1">Pasaporte: <? echo $pasaporte; ?></td>
    </tr>
    <tr class="detalletabla2">
      <td align="left" class="alt1">Carnet:</td>
      <td align="left" class="alt1"><? echo $carnet ?></td>
      <td colspan="2" align="left" class="alt1">Colegio: <? echo $colegio; ?></td>
    </tr>
    <tr>
      <td align="left" class="detalletabla1">Direcci&oacute;n: </td>
      <td align="left" class="detalletabla1"><? echo $direccion; ?></td>
      <td width="71%" align="left" class="detalletabla1">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" align="left" class="alt1"><span class="alt1 Estilo1">
        <? if ($lista_negra==1)
	  		{
				echo "SE ENCUENTRA EN LISTA NEGRA";							
				echo '<br>';
				echo '<br>';
				echo "MOTIVO: $motivo";			
				echo '</td>';
			}
	  ?>
      </span></td>
    </tr>
    <tr>
      <td colspan="4" align="left" class="alt1"><span class="alt1 Estilo1">
        <input type="submit" name="Submit" value="Volver">
      </span> </td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
