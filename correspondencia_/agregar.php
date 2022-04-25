<?	
	//Validar la sesion 
	session_start();	
	include("../validate.php");
	$grupo_id=3;
    if (($_SESSION["group_id"]) < $grupo_id) 
	include("logout.php");		
?>
<html>
<head>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
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
<p>Nuevo visitante:
  </p>
<form name="form1" method="post" action="gagregar.php">
  <table class="tborder" cellpadding="6" cellspacing="1" border="0" width="100%" style="border-top-width:0px" id="table1">
    <tr>
      <td width="8%">Nombre:* </td>
      <td colspan="4"><input name="txt_nombre" type="text" id="txt_nombre" size="50"></td>
    </tr>
    <tr>
      <td align="left" class="alt1">C&eacute;dula:*</td>
      <td width="3%" align="left" class="alt1">
	  		<?
					require_once('../../connection/helpdesk.php'); 
					$consulta="SELECT * FROM seg_registro_cedula ORDER BY registro";
					$result=$query($consulta);	
					echo('<select name="cbo_registro_cedula">');
					$nombre="Orden";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=$fetch_array($result))
					{
						echo'<option value="'.$row["codigo_registro"].'">'.$row["registro"].'</option>';
					}
					echo('</select>');					
				?></td>
      <td width="11%" align="left" class="alt1"><input name="txt_numero_cedula" type="text" id="txt_numero_cedula3" size="15"></td>
      <td colspan="2" align="left" class="alt1"><?
					require_once('../../connection/helpdesk.php'); 
					$consulta="SELECT * FROM seg_municipio ORDER BY nombre_municipio";
					$result=$query($consulta);	
					echo('<select name="cbo_municipio">');
					$nombre="Extendida en";
					echo'<option value="0">'.$nombre.'</option>';
					while($row=$fetch_array($result))
					{
						echo'<option value="'.$row["codigo_municipio"].'">'.$row["nombre_municipio"].'</option>';
					}
					echo('</select>');				
					$close($s);	
				?>	    </td>
    </tr>
    <tr>
      <td align="left" class="alt1">Licencia:</td>
      <td colspan="4" align="left" class="alt1"><input name="txt_licencia" type="text" id="txt_licencia" size="15"> 
        &nbsp;&nbsp;&nbsp;&nbsp;Pasaporte:&nbsp;
          <input name="txt_pasaporte" type="text" id="txt_pasaporte4" size="15"></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Colegio:</td>
      <td colspan="4" align="left" class="alt1"><input name="txt_colegio" type="text" id="txt_colegio3" size="50"></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Direcci&oacute;n: </td>
      <td colspan="4" align="left" class="alt1"><input name="txt_direccion" type="text" id="txt_direccion3" size="50"></td>
    </tr>
    <tr>
      <td align="left" class="alt1">Carnet:</td>
      <td colspan="4" align="left" class="alt1"><input name="txt_carnet" type="text" id="txt_carnet2"></td>
    </tr>
    <tr>
      <td align="left" class="alt1"><span class="alt2">
   <input name="bt_guardar" type="submit" id="bt_guardar4" value="Guardar">
  </span></td>
      <td colspan="3" align="left" class="alt1"><span class="alt2">
      </span><span class="alt2">
      </span></td>
    </tr>
  </table>
</form>
<p class="bodyplain">&nbsp;
</p>            
</body>
</html>
